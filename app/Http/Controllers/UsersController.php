<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersController extends Controller
{
    public function index(Request $req) {
        $user = User::where('email', $req->email)->get();
        return response()->json($user);
    }

    public function show($id) {
        $users = User::where('id', '!=', $id)->get();
        return response()->json($users);
    }

    public function store() {
        $formValues = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::create([
            'name' => $formValues['name'],
            'surname' => $formValues['surname'],
            'phone_number' => $formValues['phone_number'],
            'email' => $formValues['email'],
            'password' => Hash::make($formValues['password']),
            'role' => 'staff',
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);

        return "USPEH USPEH USPELI SMO JE";
    }
    
    public function update($id) {

        $data = request()->validate([
            'name' => 'required',
            'surname' => 'required',
            'phone_number' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        User::where('id', $id)->update($data);
        
        return "e je";
    }
}
