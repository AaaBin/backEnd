<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMail;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    


    public function sendMail()
    {
        $details['to'] = 'birnie1571@gmail.com';
        $details['name'] = 'AaaBin';
        $details['subject'] = 'Hello';
        $details['message'] = 'Here goes all message body.';

        Mail::to($details['to'])
                ->send(new SendMail($details));
    }
}
