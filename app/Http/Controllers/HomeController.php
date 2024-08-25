<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Review;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\User;
use App\Models\SupportTicket;
use App\Mail\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Validator; 
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('logout');
        $this->middleware('guest')->only('login', 'registerPost', 'login_view', 'loginPost', 'getDownloadLink');
    }

    public function index()
    {
        $blogs = Blog::with('sub_category', 'tags')->orderBy('views', 'DESC')->paginate(12);
        $sliders = Slider::all();
        $brands = Brand::all();
        return view('home', compact('blogs', 'sliders', 'brands'));
    }

    public function contactPage()
    {
        return view('contact');
    }

    public function aboutPage()
    {
        return view('about');
    }

    public function privacyPage()
    {
        return view('privacy');
    }

    public function termsPage()
    {
        return view('terms');
    }

    public function blogs()
    {
        $blogs = Blog::with('sub_category', 'tags')->orderBy('created_at', 'DESC')->paginate(15);
        return view('blogs', compact('blogs'));
    }

    public function blog(Blog $blog)
    {

        $reviews = Review::all();

        $total_reviews = 0;
        $total_rating = 0;
        $excellent = 0;
        $good = 0;
        $average = 0;
        $below_average = 0;
        $poor = 0;
        foreach( $reviews as $review_key => $review){
            // not approved 
            if($review->approved != 1){
                continue;
            }
            // matching with consecutive blog
            if( (int)$review->blog_id != (int)$blog->id ){
                continue;
            }
            $review_rating = (float)$review->rating;
            $total_rating += $review_rating;
            $total_reviews++;
            switch ($review_rating) {
                case ($review_rating < 1.0):
                    $poor += $review_rating;
                    break;
                case ($review_rating >= 1.0 && $review_rating < 2.0):
                    $below_average += $review_rating;
                    break;
                case ($review_rating >= 2.0 && $review_rating < 3.0):
                    $average += $review_rating;
                    break;
                case ($review_rating >= 3.0 && $review_rating < 4.0):
                    $good += $review_rating;
                    break;
                case ($review_rating >= 4.0 && $review_rating <= 5.0):
                    $excellent += $review_rating;
                    break;
                default:
                    $excellent += $review_rating;
            }
        }
    
        $average_rating = 0;
        if( $total_reviews != 0 ){
            $average_rating =  round( $total_rating / $total_reviews, 2 );
        }
    
        $excellent_percentage = 0;
        $good_percentage = 0;
        $average_percentage = 0;
        $below_average_percentage = 0;
        $poor_percentage = 0;
    
        if( $total_rating != 0 ){
            if ( $excellent != 0){
                $excellent_percentage = round ($excellent * 100 / $total_rating, 2);
            }
            if ( $good != 0){
                $good_percentage = round ($good * 100 / $total_rating, 2);
            }
            if ( $average != 0){
                $average_percentage = round ($average * 100 / $total_rating, 2);
            }
            if ( $below_average != 0){
                $below_average_percentage = round ($below_average * 100 / $total_rating, 2);
            }
            if ( $poor != 0){
                $poor_percentage = round ($poor * 100 / $total_rating, 2);
            }
        }

        // creating associative array
        $all_percentages = [
            "excellent_percentage" => $excellent_percentage,
            "good_percentage" => $good_percentage,
            "average_percentage" => $average_percentage,
            "below_average_percentage" => $below_average_percentage,
            "poor_percentage" => $poor_percentage,
        ];


        // increment views by one each time a vistior visit the blog
        $blog->increment('views');
        $reviews = Review::where('blog_id', $blog->id)->where('approved', 1)->paginate(2);
        return view( 'blog', compact( 'blog', 'reviews', 'total_reviews', 'average_rating', 'all_percentages'  ) );
    }




    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string|min:3',
        ]);

        $blogs = Blog::where('title', 'like', '%' . $request->search . '%')
            ->orWhere('body', 'like', '%' . $request->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('blogs', compact('blogs'));
    }

    public function blogsByTag(Tag $tag)
    {
        $blogs = $tag->blogs()->with('sub_category')->orderBy('created_at', 'DESC')->paginate(15);
        return view('blogs', compact('blogs'));
    }

    public function blogsBySubCat(SubCategory $subcategory)
    {
        $blogs = $subcategory->blogs()->latest()->paginate(15);
        return view('blogs', compact('blogs'));
        
    }

    public function login_view()
    {
        // stores the previous url from where the login page was accessed.
        session()->put('prev_url', url()->previous());

        return view('login');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required|max:250',
            'mobile' => 'required|max:15',
            'dial_code' => 'required|max:5',
            'country_short_name' => 'required|max:5',
            'country_name' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|min:6|max:100|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile = $request->mobile;
        $user->dial_code = $request->dial_code;
        $user->country_short_name = $request->country_short_name;
        $user->country_name = $request->country_name;
        $user->save();

        return redirect()->route('home')->with('success', 'Your account has been created successfully');
    }

    public function loginPost(Request $request)
    {
        // get the prev_url from session
        $prevUrl = session()->get('prev_url') ?? route('home');

        $credentials = $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended($prevUrl);
        }

        return redirect()->back()->with('error', 'Login attempt failed. Please try again');
    }

    public function getDownloadLink(Request $request){

        $userExists = User::where('email', $request->email)->where('mobile', $request->mobile)->exists();

        if ($userExists) {
            return response()->json([
                'success' => true,
                'data' => "existing_user"
            ]);
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->dial_code = $request->dial_code;
            $user->country_short_name = $request->country_short_name;
            $user->country_name = $request->country_name;
            $user->save();
            return redirect()->back()->with('success', 'Your account has been created successfully');
        }

        return response()->json([
            'success' => true,
            'data' => $request->all()
        ]);
    }

    public function createSupportTicket(Request $request){

        $supportTicket = new SupportTicket();

        $supportTicket->name = $request->name;
        $supportTicket->email = $request->email;
        $supportTicket->country_name = $request->country_name;
        $supportTicket->country_short_name = $request->country_short_name;
        $supportTicket->dial_code = $request->dial_code;
        $supportTicket->mobile = $request->mobile;
        $supportTicket->subject = $request->subject;
        $supportTicket->message = $request->message;
        $supportTicket->save();
   
        Mail::to("unlockplcexpert@gmail.com")->send(new ContactUs($supportTicket)); 

        return response()->json([
            'success' => true,
            'data' => $request->all()
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function allUsers(Request $request)
    {
        $users = User::orderBy('id', 'desc')->get();
        // return response()->json($users);
        return view('allUsers', compact('users'));
    }


}
