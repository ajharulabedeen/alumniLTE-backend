<?php

namespace App\Http\Controllers;

use App\Utils\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send()
    {
        error_log(" MAIL :> ");
        error_log(" MAIL : " . __CLASS__);
        try {
            Mail::send('pass', ['text' => 'mail'], function ($message) {
                $message->to('cse1301096@gmail.com', 'To Bitfumes')->subject('Test Mail');
                $message->from('gub.cse.files@gmail.com', 'AlumniLTE');
            });
            error_log("\n Mail Send Success : " . __CLASS__);
        } catch (\Throwable $th) {
            error_log("ERROR in SENDING MAIL!");
        }
    }

    public function sendNewPass(Request $r)
    {
        $response = "";
        error_log("Mail : " . $r->mail);
        $mail_id = $r->mail;
        try {
            $from = 'gub.cse.files@gmail.com';
            $to = $mail_id;
            $new_pass = Utils::getRandomPass();
            Mail::send(
                'pass',
                ['new_pass' => $new_pass],
                function ($m) use ($from, $to) {
                    $m->from($from, 'AlumniLTE');
                    $m->to($to, "Reset Pass")->subject('Reset Pass!');
                }
            );
            error_log("\n Mail Send Success : " . __CLASS__);
            $response = "OK";
        } catch (\Throwable $th) {
            $response = "FAIL";
            error_log("ERROR in SENDING MAIL!");
        }
        return ['status' => $response];
    }// sendPass

    /**
     * this is to verify the email address.
     */
    public function sendVerificationCode()
    {

    }

    public function checkVerificationCode()
    {

    }


}// class
