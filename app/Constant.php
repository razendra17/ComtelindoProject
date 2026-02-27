<?php

namespace App;

class Constant
{
    public const status = [
        "pending" => "pending",
        "approved" => "approved",
        "rejected" => "rejected",
    ];
    public const rejectionMessage = [
        'data_invalid' => 'Data tidak valid',
        'document_missing' => 'Dokumen tidak lengkap',
        'area_unavailable' => 'Area belum tersedia',
    ];
}
