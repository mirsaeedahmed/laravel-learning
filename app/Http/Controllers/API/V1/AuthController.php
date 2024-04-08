<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterAdvertiserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class AuthController extends Controller
{
    /**
     * Register a new user as an 'Advertiser'.
     */
    public function registerAdvertiser(RegisterAdvertiserRequest $request)
    {
        $user = $this->register($request, 'advertiser');
        return response()->json(['user' => $user], 201);
    }

    /**
     * Register a new user as a 'User'.
     */
    public function registerUser(RegisterUserRequest $request)
    {
        $user = $this->register($request, 'user');
        return response()->json(['user' => $user], 201);
    }

    /**
     * Handle user registration.
     */
    protected function register(Request $request, $roleName)
    {
        $validatedData = $request->validated();
        //role = user
        DB::beginTransaction();
        try {
            $user = User::create($validatedData);

            // Assign role to user
            $this->assignRole($user, $roleName);

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
            // something went wrong
        }

    }

    /** LOGIN */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->user_password)) {
            return response()->json(['message' => 'The provided credentials are incorrect.'], 401);
        }

        // Revoke all tokens...
        $user->tokens()->delete();

        // Generate a new token
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    private function assignRole($user, $role)
    {
        $role = Role::where('name', $role)->firstOrFail();
        $user->roles()->attach($role->id);

//        $role = Role::where('name', $role)->firstOrFail();
//        $user->roles()->attach($role);
    }

}

