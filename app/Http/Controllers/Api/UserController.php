<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;

class UserController extends Controller
{
    public function show($id){
        $user = user::find($id);

        if(!is_null($user)){
            return response([
                'message' => 'Retrieve user Success',
                'data' => $user
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 404);
    }

    // public function update(Request $request, $id){
    //     $user = user::find($id);
    //     if(is_null($user)){
    //         return response([
    //             'message' => 'user Not Found',
    //             'data' => null
    //         ], 404);
    //     }

    //     $updateData = $request->all();
    //     $validate = Validator::make($updateData, [
    //         'name' => ['max:60', Rule::unique('users')->ignore($user)],
    //         'email' => '',
    //     ]);

    //     if($validate->fails())
    //         return response(['message' => $validate->errors()],400);

    //     $user->name = $updateData['name'];
    //     $user->phone_number_account = $updateData['phone_number_account'];
    //     $user->email = $updateData['email'];

    //     if($user->save()){
    //         return response([
    //             'message' => 'Update user success',
    //             'data' => $user
    //         ], 200);
    //     }
    //     return response([
    //         'message' => 'Update user failed',
    //         'data' => null
    //     ], 400);
    // }

    public function update(Request $request, $id){
        $user = user::find($id);
        if(is_null($user)){
            return response([
                'message' => 'user Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'name' => ['max:60', Rule::unique('users')->ignore($user)],
            'email' => '',
            'password' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $user->name = $updateData['name'];
        $user->phone_number_account = $updateData['phone_number_account'];
        $user->email = $updateData['email'];
        $password = Hash::make($updateData['password']);
        $user->password = $password;

        if($user->save()){
            return response([
                'message' => 'Update user success',
                'data' => $user
            ], 200);
        }
        return response([
            'message' => 'Update user failed',
            'data' => null
        ], 400);
    }

    public function destroy($id){
        $user = user::find($id);

        if(is_null($user)){
            return response([
                'message' => 'User Not Found',
                'data' => null
            ], 404);
        }

        if($user->delete()){
            return response([
                'message' => 'Delete user Success',
                'data' => $user
            ], 200);
        }
        return response([
            'message' => 'Delete user Failed',
            'data' => $user
        ], 400);
    }
}
