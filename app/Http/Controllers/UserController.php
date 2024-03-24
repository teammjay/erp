<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('is_admin', 0)->paginate(10);
        return view('pages.users.index',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.users.form', ['user' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'email' => 'required|email|max:255|unique:users,email',
            'name' => 'required',
            'phone' => 'required|max:10',
            'about' => 'max:350',
            'gstin' => 'required|max:15',
            'gstin_type' => 'required',
            'legal_name' => 'required',
            'store_name' => 'required',
            'address' => 'required',
            'pincode' => 'required',
            'city' => 'required',
            'state' => 'required',
            'certificate' => [File::types(['pdf', 'jpg','png','gif'])]
        ]);

        if(!isset($attributes['password'])) $attributes['password'] = '123456';

        User::create($attributes);
        return redirect('user-management')->withStatus('User successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user_management
     * @return \Illuminate\Http\Response
     */
    public function show(User $user_management)
    {
        return view('pages.users.form', ['user' => $user_management]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user_management
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user_management)
    {
        return view('pages.users.form', ['user' => $user_management]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user_management
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user_management)
    {
        $attributes = request()->validate([
            'email' => ['required','email',Rule::unique('users')->ignore($user_management)],
            'name' => 'required',
            'phone' => 'required|max:10',
            'about' => 'max:350',
            'gstin' => 'required|max:15',
            'gstin_type' => 'required',
            'legal_name' => 'required',
            'store_name' => 'required',
            'address' => 'required',
            'pincode' => 'required',
            'city' => 'required',
            'state' => 'required',
            'certificate' => [File::types(['pdf','jpg','png','gif'])]
        ]);

        $path = $request->file('certificate')->store('certificate');
        dd($path);

        $user_management->update($attributes);
        return redirect('user-management')->withStatus('User successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user_management
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user_management)
    {
        $user_management->delete();
        return redirect('user-management')->withStatus('User deleted successfully.');
    }
}
