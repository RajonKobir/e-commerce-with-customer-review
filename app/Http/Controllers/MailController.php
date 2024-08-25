<?php

namespace App\Http\Controllers;

use App\Mail\CampaignEmail;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        return view('backend.mails.index');
    }

    public function sendMail(Request $request)
    {
        $mailData = $request->validate([
            'subject' => 'required|string',
            'body' => 'required|string'
        ]);
        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new CampaignEmail($mailData));
        }

        return redirect()->route('admin.mails.index')->with('success', 'Emails has been sent successfully!');
    }

    public function selectedMail(){
        return view('backend.mails.selectedMail');
    }

    public function sendSelectedMail(Request $request){
        $mailData = $request->validate([
            'emails' => "required|string",
            'subject' => "required|string",
            'body' => "required|string"
        ]);

        $emails = $this->removeSpaces($request->emails);
        // Get emails from request and split them into an array
        $emails = explode(',', $emails);

        $emails = $this->filterValidEmails($emails);
        
        if (count($emails) > 0) {
            foreach($emails as $email) {
                Mail::to($email)->send(new CampaignEmail($mailData));
            }
        }

        return redirect()->route('admin.mails.selectedMail')->with('success', 'Emails has been sent successfully!');
    }

    public function filterValidEmails($emails) {
        $filteredEmails = [];
        foreach ($emails as $email) {
            // Validate email using filter_var
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $filteredEmails[] = $email;
            }
        }
        return $filteredEmails;
    }

    public function removeSpaces($string) {
        return str_replace(' ', '', $string);
    }
}

