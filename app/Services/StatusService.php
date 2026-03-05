<?php

namespace App\Services;

use App\Constant;
use App\Mail\StatusUpdateMail;
use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class StatusService
{
    // dashboard approval 
    public function approve($data)
    {
        Mail::to($data->email)
            ->send(new StatusUpdateMail($data, 'approved'));
        $data->status = Constant::status['approved']; // atau 'approved'
        $data->save();
    }

    //dashboard rejectionFFFF
    public function reject($data, $reason)
    {
        Mail::to($data->email)
            ->send(new StatusUpdateMail($data, 'rejected', $reason));

        $data->status = Constant::status['rejected'];
        $data->rejection = $reason;
        $data->save();
    }
}
