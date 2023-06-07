<?php
namespace App\Service\CustomerServices;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactService{

    public function __construct(){}

    //send email to orchid-campus team
    public function sendEmail($contactData){

        Mail::mailer('support')->to(env('SUPPORT_MAIL_USERNAME'))->send(new ContactMail($contactData));
    }

}
