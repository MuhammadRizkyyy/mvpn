<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $partnership->status === 'approved' ? 'Pengajuan Disetujui' : 'Pengajuan Ditolak' }}</title>
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
                                        Portal Kerjasama
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
                            @if($partnership->status === 'approved')
                                <span style="display:inline-block;padding:6px 14px;border-radius:999px;background-color:#EAF7EF;color:#0F8A47;font-size:12px;font-weight:700;letter-spacing:0.3px;text-transform:uppercase;">
                                    Disetujui
                                </span>
                            @else
                                <span style="display:inline-block;padding:6px 14px;border-radius:999px;background-color:#FDECEC;color:#B00E20;font-size:12px;font-weight:700;letter-spacing:0.3px;text-transform:uppercase;">
                                    Ditolak
                                </span>
                            @endif

                            <h1 style="margin:18px 0 4px;font-size:20px;font-weight:700;color:#12233B;">
                                @if($partnership->status === 'approved')
                                    Pengajuan Kerjasama Anda Disetujui
                                @else
                                    Pengajuan Kerjasama Anda Belum Dapat Disetujui
                                @endif
                            </h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:0 32px 8px;">
                            <p style="margin:0 0 16px;font-size:14px;line-height:1.7;color:#2b3648;">
                                Yth. Bapak/Ibu {{ $partnership->pic_name }},
                            </p>

                            @if($partnership->status === 'approved')
                                <p style="margin:0 0 16px;font-size:14px;line-height:1.7;color:#2b3648;">
                                    Terima kasih atas pengajuan kerjasama yang disampaikan atas nama
                                    <strong>{{ $partnership->institution_name }}</strong>. Dengan ini kami
                                    informasikan bahwa pengajuan kerjasama Anda telah
                                    <strong style="color:#0F8A47;">disetujui</strong>.
                                </p>
                                <p style="margin:0 0 16px;font-size:14px;line-height:1.7;color:#2b3648;">
                                    Tim kami akan segera menghubungi Anda melalui email ini untuk membahas
                                    tindak lanjut dan langkah-langkah kerjasama selanjutnya.
                                </p>
                            @else
                                <p style="margin:0 0 16px;font-size:14px;line-height:1.7;color:#2b3648;">
                                    Terima kasih atas pengajuan kerjasama yang disampaikan atas nama
                                    <strong>{{ $partnership->institution_name }}</strong>. Setelah melalui
                                    proses peninjauan, dengan berat hati kami sampaikan bahwa pengajuan
                                    kerjasama Anda <strong style="color:#B00E20;">belum dapat kami setujui</strong>
                                    pada saat ini.
                                </p>
                                <p style="margin:0 0 16px;font-size:14px;line-height:1.7;color:#2b3648;">
                                    Kami sangat menghargai minat Anda untuk bekerja sama, dan Anda tetap
                                    terbuka untuk mengajukan kembali kerjasama di kesempatan berikutnya.
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
                                        Ringkasan Pengajuan
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:16px 20px;font-size:13px;color:#2b3648;">
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="padding:4px 0;color:#5C7A9B;width:140px;">Institusi</td>
                                                <td style="padding:4px 0;font-weight:600;">{{ $partnership->institution_name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:4px 0;color:#5C7A9B;">Penanggung Jawab</td>
                                                <td style="padding:4px 0;font-weight:600;">{{ $partnership->pic_name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:4px 0;color:#5C7A9B;">Email</td>
                                                <td style="padding:4px 0;font-weight:600;">{{ $partnership->email }}</td>
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
                                pengajuan kerjasama Anda. Mohon untuk tidak membalas email ini secara langsung.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
