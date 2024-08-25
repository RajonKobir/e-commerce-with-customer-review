<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{


    public function index()
    {
        //$users = User::paginate(25);
        //return view('backend.users.index', compact('users'));
        $users = User::orderBy('id', 'desc')->get();
        return view('backend.users.index', compact('users'));
    }

    public function show()
    {
        //$users = User::paginate(25);
        $users = User::orderBy('id', 'desc')->get();
        return response()->json($users);
    }

    /** A Method to Download The List of Users as txt file
     * @return response
     */
    public function download()
    {
        // $subscribers = User::all()->pluck('email')->toArray();
        // $file_name = 'users.txt';
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

        $users = User::all()->pluck('email')->toArray();

        $disk = Storage::disk('local'); // Specify disk (change to relevant disk if needed)
        $storagePath = storage_path('app'); // Get the path to storage folder
        $contents = implode("\n", $users); // Create string with emails separated by newlines

        $disk->put('users.txt', $contents); // Use putFile() for file-like object

        return response()->download($storagePath . '/users.txt', 'users.txt');
    }

    // A Method To Search Users Based on name or email
    public function search(Request $request)
    {
        $search = $request->get('search');
        $users = User::where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->paginate(25);
        return view('backend.users.index', compact('users'));
    }

    public function deleteUser($id)
    {
        try {
            // Find the user by ID
            $user = User::findOrFail($id);

            // Delete the user
            $user->delete();

            return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'User deletion failed.'], 500);
        }
    }


    public function addNote(Request $request)
    {

        // Validate the incoming request 
        $request->validate([
            'user_note' => 'required|string|max:250|min:10',
        ]);
        
        // Update the user's note
        $user = User::findOrFail($request->user_id);
        $user->note = $request->user_note;
        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'Note saved!');

    }


    public function addNoteToMany(Request $request)
    {

        // Validate the incoming request 
        $request->validate([
            'add_user_note' => 'required|string|max:250|min:10',
        ]);

        $all_selected_users = $request->all_selected_users;

        foreach( $all_selected_users as $all_selected_user_key => $all_selected_user){
            // Update the user's note
            $user = User::findOrFail($all_selected_user);
            $user->note = $request->add_user_note;
            $result = $user->save();
            if(!$result){
                return 'A note could not be saved!';
            }
        }

        return 'Notes have been saved successfully!';

    }



}
