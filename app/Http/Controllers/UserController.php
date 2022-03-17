<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if (!auth()->attempt($data)) {
            return response(['error_message' => 'Incorrect Details. 
            Please try again']);
        }

        $token = auth()->user()->createToken('API Token')->accessToken;

        return response(['user' => auth()->user(), 'token' => $token]);

    }


    public function logout (Request $request)
    {
        $token =$request->user()->token();
        $token->delete();
        $response =["massage"=>"you have success logout "];
        return response($response,200);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|',
            'phone'=>'required',
            'governate'=>'required'
          
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'governate' => $request->governate
        ]);
 
        $token = $user->createToken('API Token')->accessToken;

        return response([ 'user' => $user, 'token' => $token]);

    }
    public function index()
    {
        $allusers = user::get();
        return $allusers;
    }
    public function destroy($userId)
    {
        $oneUser = user::findOrFail($userId);
        $oneUser->delete();
        return  $oneUser;
    }
    public function show($userId)
    {
        $user = User::get()->find($userId);
        return $user;
    }
    public function update($UserId, Request $request)
    {
        $data = $request->all();
        $oneUser = User::findOrFail($UserId);
        $oneUser->update([
            'email' => (isset($data['email'])) ? $data['email'] : $oneUser->email,
            'password' => isset($data['password']) ? Hash::make($data['password']) : $oneUser->password,
            'password_confirmation' => isset($data['password_confirmation']) ? Hash::make($data['password_confirmation']) : $oneUser->password,
            'user_name' => isset($data['user_name']) ? $data['user_name'] : $oneUser->user_name,
        ]);
        return $oneUser;
    }

    public function updatecoins($UserId, Request $request)
    {
        $data = $request->all();
        $oneUser = User::findOrFail($UserId);
        $oneUser->update([
            'coins' => (isset($data['coins'])) ? $data['coins'] : $oneUser->coins,
        ]);
        return $oneUser;
    }

}
