<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partnership;

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

        Partnership::create($data);

        return redirect()->back()->with('success', 'Pengajuan berhasil');
    }
}
