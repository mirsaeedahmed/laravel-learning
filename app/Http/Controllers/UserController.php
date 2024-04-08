<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all()->toJson();

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // todo generate otp and save in the db after create user
        // todo userrequest seprate file
        //$user = User::create($request->all());
        //return response()->json($user, 201);
        $data = $request->json()->all();
        $validator = Validator::make($data, [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            "mobile_no" => 'required|regex:/[0-9]{11}/',
            "occupation"	=>	'required|string|max:50',
            "education"	=>	'required|string|max:50',
            "country"	=>	'required|string|max:255',
            "city"	=>	'required|string|max:255',
            "area"	=>	'required|string|max:255',
            "sex"	=>	'required|in:Male,Female',
            "dob"	=>	"date_format:Y-m-d|before:today",
            'user_password' => 'min:8|required_with:password_confirm|same:password_confirm',
            'password_confirm' => 'min:8'

        ]);

        if ( $validator->fails() ) {
            //TODO Handle your error
            dd($validator->errors()->all());
        }

        $user = User::create([
            "first_name"	=>	$data['first_name'],
            "last_name"	=>	$data['last_name'],
            "username"	=>	$data['username'],
            "email"	=>	$data['email'],
            "user_password"	=>	Hash::make($data['user_password']),
            "mobile_no"	=>	$data['mobile_no'],
            "occupation"	=>	$data['occupation'],
            "education"	=>	$data['education'],
            "country"	=>	$data['country'],
            "city"	=>	$data['city'],
            "area"	=>	$data['area'],
            "sex"	=>	$data['sex'],
            "dob"	=>	$data['dob'],
            "role_id"	=>	999999999,


        ]);

        // Return response
        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);


    }

    public function testUser(Request $request)
    {
        if (!$request->user() || !$request->user()->hasRole("user")) {
            // Abort or return a custom response
            return response('Unauthorized from controller.', 401);
        }
        //return $next($request);
        return "testUser";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
