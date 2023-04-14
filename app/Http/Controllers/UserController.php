<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use File;
use Illuminate\Http\Request;
use Storage;
use Str;
use Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->get();
        // return view('users', ['users'=>$users]);
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('createUser');
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

        $request->file->move(storage_path($path), 'profilePic.png');
            
        $user->images = 'user'.$user->id.'/profilePic.png';

        return $user->update();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // return view('user', ['user'=>$user]);
        $user = User::with('roles')->find($user->id);
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $user = User::find($id);
        // return view('editUser', ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
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
    public function destroy(User $user)
    {
        try {
            $path = 'user'.$user->id;
            Storage::disk("public")->deleteDirectory($path);
            $user->delete();
         }
         catch(Exception $e) {
            \Log::error('Query fallita');
            return response()->json([$e->getMessage()], 500);
         }

        return true;
    }

}
