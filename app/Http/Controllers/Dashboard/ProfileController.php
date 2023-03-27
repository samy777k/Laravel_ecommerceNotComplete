<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Symfony\Component\Intl\Countries;
use Auth;

class ProfileController extends Controller
{
    public function edit(){
        $user = Auth::user();
        return view('dashboard.profile.edit' , [
            'user' => $user,
            'countries' => Countries::getNames('ar')
        ]);
    }

    public function update(Request $request){
        $user = Auth::user();
        if($user->profile->first_name){

            $user->profile->update([
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'street_address' => $request->street_address,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
                'local' => $request->local
            ]);
        }else{
            Profile::create([
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'street_address' => $request->street_address,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
                'local' => $request->local
            ]);
        }
        return redirect()->route('profileEdit')->with('success' , 'profile updated');
    }
}
