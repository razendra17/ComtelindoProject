<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body style="font-family:Arial;background:#f6f6f6;padding:20px;">

    <div style="max-width:600px;margin:auto;background:white;padding:25px;border-radius:10px">

        <h2 style="color:#f97316;">📊 Laporan Pengajuan Hari Ini</h2>

        <p>Tanggal: {{ now()->format('d M Y') }}</p>

        <div style="background:#fff7ed;padding:15px;border-radius:8px;margin:20px 0">
            <h3>Total Pengajuan Hari Ini</h3>
            <h1 style="color:#ea580c">{{ $total }}</h1>
        </div>


        <p style="margin-top:30px;font-size:13px;color:#888">
            Email ini dikirim otomatis oleh sistem.
        </p>

    </div>

</body>

</html>
