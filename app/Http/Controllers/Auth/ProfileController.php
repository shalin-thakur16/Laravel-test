<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
/**
 * return the user edit form
 *
 * @return void
 */
  public function showEditForm(){
      return view('users.edit')->with('user', Auth::user());

  }
/**
 * update the user
 *
 * @return void
 */
  public function updateUser(Request $request){

    try {
        $user_id = $request->user()->id;
        $user =User::findOrFail($user_id);

        if ($request->hasFile('image')) {
               $image = $request->file('image');
               if (Storage::exists('public/images' . $image)) {
                Storage::delete('public/images' . $image);
                }
               $name = time().'.'.$image->getClientOriginalExtension();
               $destinationPath = public_path('/images');
               $image->move($destinationPath, $name);
           }
        $user->image = $name;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
       return redirect()->route('home')->withSuccess(['updated successfully']);
       } catch (Exception $e) {
        return redirect()->route('home')->withErrors(['Something went wrong!..']);


       }


  }
}
