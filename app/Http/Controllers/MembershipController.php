<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Services\CloudinaryImageService;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function __construct(private CloudinaryImageService $cloudinary)
    {
    }

    public function create()
    {
        return view('pages.keanggotaan');
    }

    public function store(Request $request)
    {
        if ($request->filled('website')) {
            return redirect()->back()->with('success', 'Pendaftaran berhasil');
        }

        $data = $request->validate([
            'full_name' => 'required|string|max:150',
            'nickname' => 'nullable|string|max:50',
            'nik' => 'required|digits:16|unique:memberships,nik',
            'birth_place' => 'required|string|max:100',
            'birth_date' => 'required|date|before:today',
            'gender' => 'required|in:male,female',
            'whatsapp' => 'required|string|max:20',
            'email' => 'required|email:rfc,dns|max:150',
            'address' => 'required|string|max:500',
            'province' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'social_media' => 'nullable|string|max:150',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:5120',

            'last_education' => 'required|string|in:' . implode(',', array_keys(Membership::LAST_EDUCATION_LABELS)),
            'education_institution' => 'nullable|string|max:150',
            'occupation' => 'nullable|string|max:150',
            'company' => 'nullable|string|max:150',
            'expertise' => 'nullable|string|max:150',
            'organizations' => 'nullable|string|max:1000',
            'leadership_experience' => 'nullable|string|max:1000',
            'social_experience' => 'nullable|string|max:1000',
            'international_experience' => 'nullable|string|max:1000',

            'motivation_reason' => 'required|string|max:2000',
            'mvpn_knowledge' => 'required|string|max:2000',
            'contribution' => 'required|string|max:2000',
            'interest_issue' => 'required|string|max:2000',
            'vision_youth' => 'required|string|max:2000',

            'interest_fields' => 'required|array|min:1|max:3',
            'interest_fields.*' => 'required|string|in:' . implode(',', array_keys(Membership::INTEREST_FIELDS)),

            'agree_statement' => 'accepted',
            'agree_code_of_conduct' => 'accepted',
            'agree_participate' => 'accepted',
            'agree_data_true' => 'accepted',
        ]);

        $uploaded = $this->cloudinary->upload($request->file('photo'), 'keanggotaan');
        $data['photo'] = $uploaded['url'];
        $data['photo_public_id'] = $uploaded['public_id'];

        Membership::create($data);

        return redirect()->back()->with('success', 'Pendaftaran berhasil');
    }
}
