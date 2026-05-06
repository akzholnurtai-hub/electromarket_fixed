<?php

namespace App\Http\Controllers;

use App\Mail\DemoEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        $details = [
            'title'   => 'Electro Market хабарламасы',
            'body'    => 'Сіздің тапсырысыңыз қабылданды!',
            'subject' => 'Electro Market — тест хат',
        ];

        Mail::to('akzhol.nurtai@narxoz.kz')->send(new DemoEmail($details));

        return "Email sent successfully!";
    }
}