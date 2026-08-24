<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    public const INTEREST_FIELDS = [
        'pendidikan_sdm' => 'Pendidikan & SDM',
        'umkm_kewirausahaan' => 'UMKM & Kewirausahaan',
        'perdagangan_internasional' => 'Perdagangan Internasional',
        'diplomasi_hubungan_internasional' => 'Diplomasi & Hubungan Internasional',
        'ekonomi_kreatif' => 'Ekonomi Kreatif',
        'kelautan_perikanan' => 'Kelautan & Perikanan',
        'lingkungan_sustainability' => 'Lingkungan & Sustainability',
        'teknologi_inovasi' => 'Teknologi & Inovasi',
        'sosial_kemanusiaan' => 'Sosial & Kemanusiaan',
        'kepemudaan' => 'Kepemudaan',
        'kebudayaan' => 'Kebudayaan',
        'public_speaking_leadership' => 'Public Speaking & Leadership',
        'media_komunikasi' => 'Media & Komunikasi',
        'riset_kajian_strategis' => 'Riset & Kajian Strategis',
        'lainnya' => 'Bidang lainnya',
    ];

    protected $fillable = [
        'full_name',
        'nickname',
        'nik',
        'birth_place',
        'birth_date',
        'gender',
        'whatsapp',
        'email',
        'address',
        'province',
        'city',
        'social_media',
        'photo',
        'photo_public_id',
        'last_education',
        'education_institution',
        'occupation',
        'company',
        'expertise',
        'organizations',
        'leadership_experience',
        'social_experience',
        'international_experience',
        'motivation_reason',
        'mvpn_knowledge',
        'contribution',
        'interest_issue',
        'vision_youth',
        'interest_fields',
        'agree_statement',
        'agree_code_of_conduct',
        'agree_participate',
        'agree_data_true',
        'status',
    ];

    protected $casts = [
        'interest_fields' => 'array',
        'birth_date' => 'date',
        'agree_statement' => 'boolean',
        'agree_code_of_conduct' => 'boolean',
        'agree_participate' => 'boolean',
        'agree_data_true' => 'boolean',
    ];

    public const LAST_EDUCATION_LABELS = [
        'sd' => 'SD/Sederajat',
        'smp' => 'SMP/Sederajat',
        'sma' => 'SMA/SMK/Sederajat',
        'd3' => 'D3',
        'd4_s1' => 'D4/S1',
        's2' => 'S2',
        's3' => 'S3',
    ];

    public function interestFieldLabels(): array
    {
        return array_map(
            fn ($key) => self::INTEREST_FIELDS[$key] ?? $key,
            $this->interest_fields ?? []
        );
    }

    public function lastEducationLabel(): string
    {
        return self::LAST_EDUCATION_LABELS[$this->last_education] ?? $this->last_education;
    }
}
