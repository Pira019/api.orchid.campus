<?php

namespace App\Http\Controllers\CustomerController\Contact;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessMail;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //from form contact to contact@orchid-campus.com
    public function ContactUs(){

        /*$validated = $request->validate([
            'name' => ['required','string'],
           // 'email' => ['required','string','email']
        ]);*/


      //  return $validated;
      ProcessMail::dispatch();
    }
}
