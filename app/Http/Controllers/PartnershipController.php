<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partnership;
use App\Services\CloudinaryImageService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PartnershipController extends Controller
{
    public function __construct(private CloudinaryImageService $cloudinary)
    {
    }

    public function store(Request $request)
    {
        if ($request->filled('website')) {
            return redirect()->back()->with('success', 'Pengajuan berhasil');
        }

        $data = $request->validate([
            'institution_name' => 'required|string|max:150',
            'pic_name' => 'required|string|max:100',
            'email' => 'required|email:rfc,dns|max:150',
            'summary' => 'required|string|max:2000',
            'proposal_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('proposal_file')) {
            $uploaded = $this->cloudinary->upload($request->file('proposal_file'), 'partnership_files', 'auto');
            $data['proposal_file'] = $uploaded['url'];
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
                'proposal_file_url' => $partnership->proposal_file_url ?? '',
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
