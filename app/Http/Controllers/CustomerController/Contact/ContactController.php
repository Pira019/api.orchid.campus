<?php

namespace App\Http\Controllers\CustomerController\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //from form contact
    public function ContactUs(Request $request){

        $validated = $request->validate([
            'name' => ['required','string'],
           // 'email' => ['required','string','email']
        ]);

        if ($request->fails()) {
            return response()->json($request->errors(), 422);
          }
        return $validated;
    }
}
