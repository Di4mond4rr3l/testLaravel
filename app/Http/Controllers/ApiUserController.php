<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use File;
use Illuminate\Http\Request;
use Storage;
use Str;
use Validator;

class ApiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::with('roles')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->post(), [
            'name' => 'bail|required|string|max:20',
            'phone' => 'bail|required|string',
            'email' => 'bail|required|email',
            'password' => 'bail|required|string'
        ],
        [
            'name' => 'Inserisci nome utente',
            'phone' => 'Inserisci numero di telefono',
            'email' => 'Inserisci una email valida',
            'password' => 'Inserisci password'
        ]
        );

        if($validator->fails())
            return response()->json([$validator->errors()], 500);

        $user = new User();
        $user->name = $request->post('name');
        $user->phone = $request->post('phone');
        $user->email = $request->post('email');
        $user->password = bcrypt($request->post('password'));
        $user->remember_token = Str::random(10);

        try {
            $user->save();
         }
         catch(Exception $e) {
            \Log::error('Query fallita');
            return response()->json([$e->getMessage()], 500);
         }

        $path = 'app/public/user'.$user->id;

        File::makeDirectory(storage_path($path), 0711, true, true); 
            
        $user->images = 'user'.$user->id.'/profilePic.png';

        return $user->update();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::with('roles')->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->post(), [
            'name' => 'bail|required|string|max:20',
            'phone' => 'bail|required|string|',
            'email' => 'bail|required|email',
            'password' => 'bail|required|string'
        ],
        [
            'name' => 'Inserisci nome utente',
            'phone' => 'Inserisci numero di telefono',
            'email' => 'Inserisci una email valida',
            'password' => 'Inserisci password'
        ]
        );

        if($validator->fails())
            return response()->json([$validator->errors()], 500);

        $user = User::find($id);

        $user->name = $request->post('name');
        $user->phone = $request->post('phone');
        $user->email = $request->post('email');
        $user->password = $request->post('password');
        
        try {
           $user->update();
        }
        catch(Exception $e) {
           \Log::error('Query fallita');
           return response()->json([$e->getMessage()], 500);
        }

        return true;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $path = 'user'.$id;
            Storage::disk("public")->deleteDirectory($path);
            User::find($id)->delete();
         }
         catch(Exception $e) {
            \Log::error('Query fallita');
            return response()->json([$e->getMessage()], 500);
         }

        return true;
    }

}
