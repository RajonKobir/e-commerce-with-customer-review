<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetEmail;
use App\Models\Admin;
use App\Models\Blog;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->only('index', 'logout', 'passwordReset');
        $this->middleware('guest:admin')->only('login_view', 'loginPost');
    }

    public function index()
    {
        $blogCount= Blog::count();
        $userCount= User::count();
        $subscriberCount = Subscriber::count();
        return view('backend.index', compact('blogCount', 'userCount', 'subscriberCount'));
    }


    public function login_view()
    {
        return view('backend.login');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|max:250',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.index');
        }

        return redirect()->back()->with('error', 'Login Faild. Please check your email and password');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function passwordReset(){
        $admin = auth('admin')->user();
        return view('backend.passwordReset', compact('admin'));
    }

    public function updatePassword() {
        $adminCred = auth('admin')->user();
        $admin = Admin::where('email', $adminCred->email)->first();
        if($admin) {
            $newPassword = $this->randomPassword();
            $admin->password = Hash::make($newPassword);
            if($admin->save()) {
                // Send an email with new password.
                Mail::to('munna.batbd@gmail.com')->send(new PasswordResetEmail($admin->name, $admin->email, $newPassword));

                // Log the user out
                Auth::guard('admin')->logout();

                // Redirect to login page
                return redirect()->route('admin.login')->with('success', 'Your New Password has been sent to your email.');
            }
        }
    }

    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function ckeditorUpload(Request $request) {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }
}
