<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class VitePayController
{
    public function webhook(Request $request)
    {
        $request->validate([
            'code' => 'string|required',
            'description' => 'string',
            'status' => 'int|required|in:0,1,2,3,4,5,6' //0 (Unpaid), 1 (Paid), 2 (Approved), 3 (Delivered), 4 (Expired), 5 (Canceled), 6 (Refunded)
        ]);

        if ($request->header('X-Api-Key') == Config::get('vitepay.api_key')) {
            /*
             * You could handle the response of transaction here like:
             * if ($request->input('status') == 1) {approve order for use or email them...} else {notice them}
             */
        }
    }
}