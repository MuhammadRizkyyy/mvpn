<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran Keanggotaan</title>
</head>
<body style="margin:0;padding:0;background-color:#EAF0F6;font-family:'Segoe UI',Arial,Helvetica,sans-serif;color:#12233B;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#EAF0F6;padding:40px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:560px;background-color:#ffffff;border-radius:14px;overflow:hidden;box-shadow:0 1px 3px rgba(18,35,59,0.08);">

                    {{-- Header --}}
                    <tr>
                        <td style="background-color:#12233B;padding:28px 32px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="font-size:18px;font-weight:700;color:#ffffff;letter-spacing:0.3px;">
                                        {{ config('app.name') }}
                                    </td>
                                    <td align="right" style="font-size:12px;color:#C3D3E3;">
                                        Portal Keanggotaan
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Accent bar --}}
                    <tr>
                        <td style="height:4px;background-color:#D4A017;line-height:0;font-size:0;">&nbsp;</td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding:36px 32px 8px;">
                            @php
                                $badge = match($membership->status) {
                                    'verified' => ['bg' => '#EAF3FD', 'fg' => '#0B5FBF', 'label' => 'Terverifikasi'],
                                    'interview' => ['bg' => '#FDF6E3', 'fg' => '#8A6A0F', 'label' => 'Undangan Interview'],
                                    'accepted' => ['bg' => '#EAF7EF', 'fg' => '#0F8A47', 'label' => 'Diterima'],
                                    'rejected' => ['bg' => '#FDECEC', 'fg' => '#B00E20', 'label' => 'Ditolak'],
                                    default => ['bg' => '#F1F1F1', 'fg' => '#555', 'label' => 'Pending'],
                                };
                            @endphp
                            <span style="display:inline-block;padding:6px 14px;border-radius:999px;background-color:{{ $badge['bg'] }};color:{{ $badge['fg'] }};font-size:12px;font-weight:700;letter-spacing:0.3px;text-transform:uppercase;">
                                {{ $badge['label'] }}
                            </span>

                            <h1 style="margin:18px 0 4px;font-size:20px;font-weight:700;color:#12233B;">
                                @if($membership->status === 'verified')
                                    Data Pendaftaran Anda Telah Terverifikasi
                                @elseif($membership->status === 'interview')
                                    Undangan Interview / Member Assessment
                                @elseif($membership->status === 'accepted')
                                    Selamat! Anda Diterima sebagai Anggota MVP.N
                                @else
                                    Informasi Status Pendaftaran Keanggotaan Anda
                                @endif
                            </h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:0 32px 8px;">
                            <p style="margin:0 0 16px;font-size:14px;line-height:1.7;color:#2b3648;">
                                Yth. {{ $membership->full_name }},
                            </p>

                            @if($membership->status === 'verified')
                                <p style="margin:0 0 16px;font-size:14px;line-height:1.7;color:#2b3648;">
                                    Terima kasih telah mendaftarkan diri sebagai calon anggota
                                    <strong>Muda Visioner Penggerak Nasional</strong>. Data yang Anda kirimkan telah
                                    kami <strong style="color:#0B5FBF;">verifikasi</strong> dan akan dilanjutkan ke
                                    tahap seleksi administrasi.
                                </p>
                            @elseif($membership->status === 'interview')
                                <p style="margin:0 0 16px;font-size:14px;line-height:1.7;color:#2b3648;">
                                    Selamat! Pendaftaran Anda lolos seleksi administrasi. Kami mengundang Anda untuk
                                    mengikuti tahap <strong style="color:#8A6A0F;">Interview / Member Assessment</strong>.
                                    Tim kami akan segera menghubungi Anda melalui WhatsApp atau email ini untuk
                                    menjadwalkan sesi interview.
                                </p>
                            @elseif($membership->status === 'accepted')
                                <p style="margin:0 0 16px;font-size:14px;line-height:1.7;color:#2b3648;">
                                    Dengan bangga kami sampaikan bahwa Anda resmi
                                    <strong style="color:#0F8A47;">diterima</strong> sebagai anggota Muda Visioner
                                    Penggerak Nasional. Selamat bergabung dan berkontribusi bersama kami!
                                </p>
                            @else
                                <p style="margin:0 0 16px;font-size:14px;line-height:1.7;color:#2b3648;">
                                    Terima kasih atas minat Anda untuk bergabung dengan
                                    <strong>Muda Visioner Penggerak Nasional</strong>. Setelah melalui proses
                                    peninjauan, dengan berat hati kami sampaikan bahwa pendaftaran Anda
                                    <strong style="color:#B00E20;">belum dapat kami lanjutkan</strong> pada saat ini.
                                    Anda tetap terbuka untuk mendaftar kembali di kesempatan berikutnya.
                                </p>
                            @endif

                            <p style="margin:24px 0 0;font-size:14px;line-height:1.7;color:#2b3648;">
                                Hormat kami,<br>
                                <strong>Tim {{ config('app.name') }}</strong>
                            </p>
                        </td>
                    </tr>

                    {{-- Details card --}}
                    <tr>
                        <td style="padding:24px 32px 32px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#F7F9FB;border-radius:10px;border:1px solid #E4E9EF;">
                                <tr>
                                    <td style="padding:16px 20px;font-size:12px;color:#5C7A9B;text-transform:uppercase;letter-spacing:0.4px;font-weight:700;border-bottom:1px solid #E4E9EF;">
                                        Ringkasan Pendaftaran
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:16px 20px;font-size:13px;color:#2b3648;">
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="padding:4px 0;color:#5C7A9B;width:140px;">Nama Lengkap</td>
                                                <td style="padding:4px 0;font-weight:600;">{{ $membership->full_name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:4px 0;color:#5C7A9B;">Email</td>
                                                <td style="padding:4px 0;font-weight:600;">{{ $membership->email }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background-color:#F7F9FB;padding:20px 32px;border-top:1px solid #E4E9EF;">
                            <p style="margin:0;font-size:11px;line-height:1.6;color:#5C7A9B;">
                                Email ini dikirim otomatis oleh sistem {{ config('app.name') }} terkait status
                                pendaftaran keanggotaan Anda. Mohon untuk tidak membalas email ini secara langsung.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
