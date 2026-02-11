<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'type' => ['required', 'string'],
            'shop_name' => ['required_if:type,vendor', 'nullable', 'string'],
            'website' => ['nullable', 'string'],
            'mobile' => ['required_if:type,vendor', 'nullable', 'string'],
            'pan_number' => ['required_if:type,vendor', 'nullable', 'string'],
            'aadhar_number' => ['required_if:type,vendor', 'nullable', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['type'], // 'vendor' or 'customer'
            'password' => Hash::make($data['password']),
            'shop_name' => $data['shop_name'] ?? null,
            'website' => $data['website'] ?? null,
            'mobile' => $data['mobile'] ?? null,
            'pan_number' => $data['pan_number'] ?? null,
            'aadhar_number' => $data['aadhar_number'] ?? null,
            'status' => $data['type'] === 'vendor' ? 'pending' : 'active',
            'is_approved' => $data['type'] === 'vendor' ? false : true,
        ]);
    }
}
