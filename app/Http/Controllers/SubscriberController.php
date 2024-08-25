<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubscriberController extends Controller
{

    /**
     * A Method to View All Subscribers
     *
     * @return view
     */
    public function index()
    {
        $subscribers = Subscriber::paginate(25);
        // return response()->json($subscribers);
        return view('backend.subscribers.index', compact('subscribers'));
    }


    public function show()
    {
        //$subscribers = Subscriber::paginate(25);
        $subscribers = Subscriber::orderBy('id', 'desc')->get();
        return response()->json($subscribers);
    }

    /**
     * A method to store subscribers
     * 
     * @param Request $request
     * @param Blog $blog[optional]
     * @return view
     */
    public function store(Request $request, Blog $blog = null)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email|max:250'
        ]);
        $subscriber_exists= Subscriber::where('email', $request->email)->first();
        
        if (!$subscriber_exists) {
            $subscriber = new Subscriber();
            $subscriber->email = $request->email;
            $subscriber->save();
        }
        

        if ($blog) {
            if ($blog->direct_download) {
                // redirect to download route
                // dd($blog->download_link);
                return redirect()->away($blog->download_link);
            } else {
                $text = "Requesting the file of https://" . $_SERVER['SERVER_NAME'] . "/blog/" . $blog->slug;
                return redirect()->away("https://wa.me/88" . get_settings('whatsapp_number') . "?text={$text}");
            }
        } else {
            // redirect back with success message
            return redirect()->route('home')->with('success', 'Thank You For Subscribing!');
        }
    }

    /** A Method to Download The List of Subscribers as txt file
     * @return response
     */
    public function download()
    {
        // $subscribers = Subscriber::all()->pluck('email')->toArray();
        // $file_name = 'subscribers.txt';
        // $destinationPath = public_path('downloads');

        // if (!file_exists($destinationPath)) {
        //     mkdir($destinationPath, 0777, true);
        // }

        // $file = fopen($destinationPath . "/" . $file_name, "w");
        // foreach ($subscribers as $subscriber) {
        //     fwrite($file, $subscriber . "\n");
        // }
        // fclose($file);

        // return response()->download($destinationPath . "/" . $file_name);

        $subscribers = Subscriber::all()->pluck('email')->toArray();

        $disk = Storage::disk('local'); // Specify disk (change to relevant disk if needed)
        $storagePath = storage_path('app'); // Get the path to storage folder
        $contents = implode("\n", $subscribers); // Create string with emails separated by newlines

        $disk->put('subscribers.txt', $contents); // Use putFile() for file-like object

        return response()->download($storagePath . '/subscribers.txt', 'subscribers.txt');
    }




    public function deleteSubscriber($id)
    {
        try {
            // Find the subscriber by ID
            $subscriber = Subscriber::findOrFail($id);

            // Delete the subscriber
            $subscriber->delete();

            return response()->json(['success' => true, 'message' => 'Subscriber deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Subscriber deletion failed.'], 500);
        }
    }





}
