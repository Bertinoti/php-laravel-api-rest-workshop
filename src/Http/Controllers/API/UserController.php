<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\User;
use App\Http\Resources\UserResource as UserResource;

class UserController extends BaseController
{

    public function index()
    {
        $users = User::all();       
        return $this->sendResponse(UserResource::collection($users), 'Users fetched');
    }
   
    public function show($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return $this->sendError('User does not exist.');
        }
        return $this->sendResponse(new UserResource($user), 'User fetched.');
    }
    

    public function destroy($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return $this->sendError('User does not exist.');
        }

        $user->delete();
        
        return $this->sendResponse([], 'User deleted.');
    }
}
