<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        // die();
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255' ],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users' ],
            'password' => ['required', 'string', 'min:8', 'confirmed' ],
            // 'phone_no' => ['required' ],
            // 'cnic' => ['required' ],
            // 'wallet_address' => ['required','alpha_num', 'unique:users' ],
            // 'dob' => ['required', 'before:' . now()->toDateString()  ],
            // 'house_street' => ['required' ],
            // 'area' => ['required' ],
            // 'city' => ['required' ],
            // 'state' => ['required' ],
            // 'country' => ['required' ]
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

        $address = $data['house_street'].' '. $data['area'].'  '.$data['city'].'  '.$data['state'].'  '.$data['country'];
        $dataSource = [
            'name' =>$data['name'],
            'email' =>$data['email'],
            'password' => Hash::make($data['password']),
            'phone_no' =>$data['phone_no'],
            'wallet_address' =>$data['wallet_address'],           
            'cnic' =>$data['cnic'],
            'doc_type'=>$data['doc_type'],
            'address' =>$address,
            'dob' =>$data['dob'],
            'referred_by' => "1",
            'referral_code' => $data['refferal_code'],
            'initial_investment' =>$data['initial_investment']
        ];

        if($data['doc_img'] != null){
            $imageName = 'user_doc_'.time() . '.'. $data['doc_img']->extension();  
            $data['doc_img']->move(public_path('file'), $imageName);
            $dataSource['doc_img'] = $imageName;
        }

        if($data['doc_img_1'] != null){
            $imageName1 = 'user_doc_1_'.time() . '.'. $data['doc_img_1']->extension();  
            $data['doc_img_1']->move(public_path('file'), $imageName1);
            $dataSource['doc_img_1'] = $imageName1;
        }

        return User::create($dataSource);


        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        //     'phone_no' => $data['phone_no'],
        //     'wallet_address' => $data['wallet_address'],
        //     'cnic' => $data['cnic'],
        //     'address' => $data['address'],
        //     'dob' => $data['dob'],
        //     'referred_by' => '1',
        //     'referral_code' => Hash::make($data['email']),
        //     'initial_investment' => $data['initial_investment']
        // ]);
    }
}
