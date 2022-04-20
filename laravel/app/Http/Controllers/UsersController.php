<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\File;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("users.index", [
            "users" => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.create", [
            "roles" => Role::all(),
        ]);
    }


    /**
     * Store a newly created user in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'role_id' => 'required',
            'upload' => 'required|mimes:gif,jpeg,jpg,png|max:2048'
        ]);

        $input = $request->all();
        $input['password'] = Hash::Make($input['password']);

        $upload = $request->file('upload');
        $fileName = $upload->getClientOriginalName();
        $fileSize = $upload->getSize();
        $uploadName = time() . '_' . $fileName;

        $filePath = $upload->storeAs(
            'uploads',    
            $uploadName,   
            'public'        
        );

        if (Storage::disk('public')->exists($filePath)) {

            $fullPath = Storage::disk('public')->path($filePath);

            $file = File::create([
                'filepath' => $filePath,
                'filesize' => $fileSize,
            ]);

            $upload->filepath = $filePath;
            $upload->filesize = $fileSize;
            $input['photo_id'] = $file->id;
        }

        $user = User::create($input);

        return redirect()->route('users.show', $user)
            ->with('success', "L'usuari " . $user->name . " s'ha creat correctament.");
    }


    /** 
     * Show the form for editing the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit',  [
            "user" => $user,
            "roles" => Role::all()
        ]);
    }


    /**
     * Update the specified user in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'role_id' => 'required',
            'upload' => 'mimes:gif,jpeg,jpg,png|max:2048'
        ]);

        if($request->hasFile('upload'))
        {
            $file = File::where('id', $user->photo_id)->first();

            $antigua_ruta = $file -> filepath;
            $upload = $request->file('upload');
            $fileName = $upload->getClientOriginalName();
            $fileSize = $upload->getSize();
    
            $uploadName = time() . '_' . $fileName;
            $filePath = $upload->storeAs(
                'uploads',    
                $uploadName,   
                'public'        
            );

            if (\Storage::disk('public')->exists($filePath)) {

                $fullPath = \Storage::disk('public')->path($filePath);
                $file->filepath = $filePath;
                $file->filesize = $fileSize;
                $file->save();

                Storage::disk('public')->delete($antigua_ruta);
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('users.show', $user)
            ->with('success', "L'usuari " .$user->name. " s'ha editat correctament.");
    }

    /**
     * Display the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $file = File::where('id', $user->photo_id)->first();
        $role = Role::where('id', $user->role_id)->first();
        
        return view('users.show',  [
            "user" => $user,
            "role" => $role,
            "file" => $file
        ]);
    }


    /**
     * Remove the specified user from database.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $file = File::where('id', $user->photo_id)->first();

        $user->delete();
        $file->delete();
        Storage::disk('public')->delete($file->filepath);

        return redirect()->route("users.index")
            ->with('success', "L'usuari " . $user->name . " s'ha esborrat correctament");
    }
}