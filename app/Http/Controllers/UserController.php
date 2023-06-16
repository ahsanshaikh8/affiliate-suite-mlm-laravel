<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Http\Request ;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Models\Product;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function index(){
        // dd(auth()->user());
        // $refered_by = Helper::getUserIdByReferralCode(auth()->user()->referral_code);
        // dd(Helper::getUserIdByReferralCode(auth()->user()->referral_code));
        $users= User::where('is_delete',0)
                ->where('referred_by',auth()->user()->id)
                ->paginate(10);
        // dd($users);

        return view('user.listUser')->with('users',$users);
    }
    /**
     * Create a new user instance after .
     *
     * @param  Null
     * @return View
     */
    protected function create()
    {

        $loggedInUser = auth()->user();

        $referral_code = "default";

        if ($loggedInUser->referral_code !== null) {
            $referral_code = $loggedInUser->referral_code;
        }

        return view('user.create',['referral_code'=>$referral_code]);
      
    }

    public function orders() {

        $orders = Order::paginate(10);
        return view('user.orders')->with('orders',$orders);

    }

    public function createOrder()
    {
        $products = Product::all();
        $users = User::all();
        return view('user.orders.create',compact('products','users'));
    }

    public function register() {

        return view('auth.register');

    }
    protected function save(Request $request)
    {

        $loggedInUser = auth()->user();
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255' ],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users' ],
            'password' => ['required', 'string', 'min:8', 'confirmed' ],
            'phone_no' => ['required' ],
            'cnic' => ['required' ],
            'wallet_address' => ['required','alpha_num', 'unique:users' ],
            'dob' => ['required', 'before:' . now()->toDateString()  ],
            'house_street' => ['required' ],
            'area' => ['required' ],
            'city' => ['required' ],
            'state' => ['required' ],
            'country' => ['required' ]
        ]);

        $address = $request->house_street.' '. $request->area.'  '.$request->city.'  '.$request->state.'  '.$request->country;
        $data = [
            'name' =>$request->name,
            'email' =>$request->email,
            'password' => Hash::make($request->password),
            'phone_no' =>$request->phone_no,
            'wallet_address' =>$request->wallet_address,           
            'cnic' =>$request->cnic,
            'doc_type'=>$request->doc_type,
            'address' =>$address,
            'dob' =>$request->dob,
            'referred_by' => $loggedInUser->id,
            'referral_code' => $request->refferal_code,
            'initial_investment' =>$request->initial_investment
        ];

        if($request->doc_img != null){
            $imageName = 'user_doc_'.time() . '.'. $request->doc_img->extension();  
            $request->doc_img->move(public_path('file'), $imageName);
            $data['doc_img'] = $imageName;
        }

        if($request->doc_img_1 != null){
            $imageName1 = 'user_doc_1_'.time() . '.'. $request->doc_img_1->extension();  
            $request->doc_img_1->move(public_path('file'), $imageName1);
            $data['doc_img_1'] = $imageName1;
        }
       
        User::create($data);

        return back()->with('success','User is created Successfully');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit',compact('user'));
    }


    public function editProfile(User $user)
    {
        return view('user.edit-profile',compact('user'));
    }

    public function getTreeHTML(User $user) {

        $loggedInUser = auth()->user();

        $allUsers = User::getAffiliateUsers($loggedInUser->id);

        return view('user.tree',['users'=> $allUsers]);

    }

    public function getEarningsHTML(User $user) {

        return view('user.earnings',compact('user'));

    }

    public function getWithdrawHTML(User $user) {

        return view('user.withdraw',compact('user'));

    }

    public function getMarketingHTML(User $user) {

        return view('user.marketing',compact('user'));

    }

    public function getReferralHTML(User $user) {

        return view('user.referral',compact('user'));

    }
}
