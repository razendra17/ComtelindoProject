<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Status Pengajuan</title>
</head>
<body style="margin:0; padding:0; background-color:#f2f2f2; font-family:Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
    <tr>
        <td align="center">

            <!-- Container -->
            <table width="600" cellpadding="0" cellspacing="0" 
                style="background:#ffffff; padding:40px; border-radius:8px;">

                <!-- Logo -->
                <tr>
                    <td style="padding-bottom:30px;">
                        <img src="{{ $message->embed(public_path('assets/Logo-Full-Color.png')) }}" width="140">
                    </td>
                </tr>

                <!-- Title -->
                <tr>
                    <td style="padding-bottom:20px;">
                        <h1 style="margin:0; font-size:26px; color:#000;">
                            Hai {{ $data->name }},
                        </h1>
                    </td>
                </tr>

                <!-- Content -->
                <tr>
                    <td style="color:#444; font-size:14px; line-height:1.6; padding-bottom:30px;">

                        @if($status === 'approved')

                            <p>
                                Pengajuan dengan ID 
                                <strong>{{ $data->customer_id }}</strong> 
                                telah <strong style="color:#16a34a;">DISETUJUI</strong>.
                            </p>

                            <p>
                                Selanjutnya kami akan menghubungi anda dalam kurun waktu 72jam, terimakasih telah mengajukan layanan kami.
                            </p>
                            <p>
                                Untuk info lebih lanjut anda dapat menghubungi Costumer Service kami melalui link di bawah ini
                            </p>

                        @else

                            <p>
                                Terima kasih telah mengajukan permohonan dengan ID 
                                <strong>{{ $data->customer_id }}</strong>.
                            </p>

                            <p>
                                Setelah proses peninjauan, mohon maag kami, pengajuan Anda 
                                <strong style="color:#dc2626;">DITOLAK</strong>.
                            </p>

                            <p>
                                Alasan penolakan:
                            </p>

                            <div style="background:#fef2f2; padding:15px; border-radius:6px; margin-bottom:20px;">
                                {{ $reason ?? 'Tidak memenuhi persyaratan.' }}
                            </div>

                            <p>
                                Anda dapat melakukan pengajuan ulang setelah melakukan perbaikan atau setelah masalah yang kami dapat telah kami tindaklanjuti.
                            </p>

                        @endif

                    </td>
                </tr>

                <!-- Button -->
                <tr>
                    <td align="center" style="padding-bottom:25px;">
                            <a href="https://wa.me/0878-7912-6292" 
                               style="background-color:#f9ab03; 
                                      color:#ffffff; 
                                      padding:14px 28px; 
                                      text-decoration:none; 
                                      border-radius:50px; 
                                      font-weight:bold; 
                                      display:inline-block;">
                                HUBUNGI CS
                            </a>
                    </td>
                </tr>

                <!-- Fallback Link -->
                <tr>
                    <td style="font-size:12px; color:#777; word-break:break-all; padding-bottom:30px;">
                        Jika tombol di atas tidak berfungsi, gunakan link berikut:
                        <br><br>
                        <a href="https://wa.me/0878-7912-6292" style="color:#2563eb;">
                            {{ url('https://wa.me/0878-7912-6292') }}
                        </a>
                    </td>
                </tr>

                <!-- Closing -->
                <tr>
                    <td style="font-size:14px; color:#444;">
                        Hormat kami,<br>
                        <strong>Tim Comtelindo</strong>
                    </td>
                </tr>

            </table>

            <!-- Footer -->
            <table width="600" cellpadding="0" cellspacing="0" style="margin-top:20px;">
                <tr>
                    <td style="font-size:12px; color:#888; text-align:center;">
                        © {{ date('Y') }} Comtelindo. All rights reserved.<br>
                        Email ini dikirim otomatis, mohon tidak membalas email ini.
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>

</body>
</html>