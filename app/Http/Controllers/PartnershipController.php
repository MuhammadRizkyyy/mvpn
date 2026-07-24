<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partnership;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PartnershipController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'institution_name' => 'required',
            'pic_name' => 'required',
            'email' => 'required|email',
            'summary' => 'required',
            'proposal_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('proposal_file')) {
            $data['proposal_file'] = $request->file('proposal_file')
                                    ->store('partnership_files', 'public');
        }

        $partnership = Partnership::create($data);

        $this->syncToGoogleSheets($partnership);

        return redirect()->back()->with('success', 'Pengajuan berhasil');
    }

    private function syncToGoogleSheets(Partnership $partnership): void
    {
        $webhookUrl = config('services.google_sheets.webhook_url');

        if (! $webhookUrl) {
            return;
        }

        try {
            Http::timeout(5)->asForm()->post($webhookUrl, [
                'institution_name' => $partnership->institution_name,
                'pic_name' => $partnership->pic_name,
                'email' => $partnership->email,
                'summary' => $partnership->summary,
                'proposal_file_url' => $partnership->proposal_file
                    ? asset('storage/' . $partnership->proposal_file)
                    : '',
                'submitted_at' => $partnership->created_at?->timezone('Asia/Jakarta')->toDateTimeString(),
            ]);
        } catch (\Throwable $e) {
            Log::warning('Failed to sync partnership submission to Google Sheets', [
                'partnership_id' => $partnership->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
