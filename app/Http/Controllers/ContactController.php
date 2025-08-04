<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inbox;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inbox_nama' => 'required|string|max:255',
            'inbox_whatsapp' => 'required|string|max:15',
            'inbox_perihal' => 'required|string|max:255',
            'inbox_isi' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Inbox::create([
            'inbox_nama' => $request->inbox_nama,
            'inbox_whatsapp' => $request->inbox_whatsapp,
            'inbox_perihal' => $request->inbox_perihal,
            'inbox_isi' => $request->inbox_isi,
            'inbox_status' => 0, // 0 for unread
        ]);

        return response()->json(['success' => 'Pesan Anda telah berhasil terkirim.']);
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}