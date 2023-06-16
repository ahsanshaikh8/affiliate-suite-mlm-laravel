<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
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
        $this->middleware('is_admin');
    }

    protected function index(){
        $users= User::where('is_delete',0)->paginate(10);
        return view('admin.users.list')->with('users',$users);
    }
    /**
     * Create a new user instance after .
     *
     * @param  Null
     * @return View
     */
    protected function create()
    {
        return view('admin.users.create');
      
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
       
       $userId = User::insertGetId($data);

       $products = Product::all();
       $users = User::all();

       return view('admin.orders.create',compact('products','users','userId'))->with('success','User is created Successfully');

        // return back()->with('success','User is created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit',compact('user'));
    }

    public function getTreeHTML(User $user) {

        $loggedInUser = auth()->user();

        $allUsers = User::all();

        $allUsersTree = array();

        foreach ($allUsers as $index => $dbUser) {

            $allUsersTree["tree"][$index]["admin"] = $dbUser;

            $AffiliateUsers = User::getAffiliateUsers($dbUser->id);

            $allUsersTree["tree"][$index]["users"] = $AffiliateUsers;

        }

        return view('admin.users.tree',['users'=> $allUsersTree['tree']]);

    }

    public function getEarningsHTML(User $user) {

        return view('admin.users.earnings',compact('user'));

    }

    public function getWithdrawHTML(User $user) {

        return view('admin.users.withdraw',compact('user'));

    }

    public function getMarketingHTML(User $user) {

        return view('admin.users.marketing',compact('user'));

    }

    public function getReferralHTML(User $user) {

        return view('admin.users.referral',compact('user'));

    }

    

    
    /**
     * Update the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find($request->user_id);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255' ],
            'phone_no' => ['required' ],
            'cnic' => ['required' ],
            'dob' => ['required', 'before:' . now()->toDateString()  ],
            'address' => ['required' ],
            
        ]);
        $data = $request->all();
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
        if($data['password'] != null){
            $data['password']  = Hash::make($request->password);
        }else{
            unset($data['password'] );
        }
        $data['updated_by'] = Auth::user()->id;
        return redirect()->back()
                        ->with('success','User updated successfully');
    }
    
    public function editProfile(User $user)
    {
        return view('admin.users.edit-profile',compact('user'));
    }
    public function destroy(Request $request){

        DB::update('update users set is_delete = 1 where id = ?', [$request->user_id]);
        return redirect()->route('admin.users')->with('success','User deleted successfully');
    }

    public function changeStatus(Request $request) {

        DB::table('users')->where('id', $request->user_id)->update(array('status' => $request->status));

        return redirect()->route('admin.users')->with('success','User status successfully updated');
    }

    public function getFieldDataHTML(Request $request) {
        $user = User::where('id',$request->user_id)->first();

        ob_start();
        ?>
        <div class="main-card alert-info" style="padding:5%">
        <style>
            .user-data-table td {
                width: 50%;
            }
        </style>
        <table class="user-data-table">
        <tr><td>Name: </td><td>  <?php echo $user['name'] ?> </td></tr>
        <tr><td>Email: </td><td> <?php echo $user['email'] ?> </td></tr>
        <tr><td>Phone: </td><td> <?php echo $user['phone_no'] ?> </td></tr>
        <tr><td>Wallet Address: </td><td> <?php echo $user['wallet_address'] ?> </td></tr>
        <tr><td>CNIC: </td><td> <?php echo $user['cnic'] ?> </td></tr>
        <tr><td>Doc Type: </td><td> <?php echo $user['doc_type'] ?> </td></tr>
        <tr><td>Image 1: </td><td> <?php echo $user['doc_img'] ?> </td></tr>
        <tr><td>Image 2: </td><td> <?php echo $user['doc_img_1'] ?> </td></tr>
        <tr><td>Address: </td><td> <?php echo $user['address'] ?> </td></tr>
        <tr><td>DOB: </td><td> <?php echo $user['dob'] ?> </td></tr>
        <tr><td>Status: </td><td> <?php echo $user['status'] ?> </td></tr>
        <tr><td>Initial Investment: </td><td> <?php echo $user['initial_investment'] ?> </td></tr>
        <tr><td>Referred By: </td><td> <?php echo $user['referred_by'] ?> </td></tr>
        </div>

        </table>
        <?php $html = ob_get_clean();

        return $html;
    }

}
