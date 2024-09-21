<?php

namespace App\Http\Controllers\Api;

use App\Mail\ContactMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Contact
{
    public function submit(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        Mail::to('executioneraldaas@gmail.com')
            ->send(
                new ContactMail(
                    $request->input('message'),
                    $request->input('name'),
                    $request->input('email')
                )
            );

        return response()->json(['success' => true]);
    }
}
