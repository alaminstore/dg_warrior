<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\ReferalTracking;
use App\User;
use App\ReferalTrackings;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;

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
     * Show the application registration form.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm(Request $request)
    {
        if ($request->has('ref')) {
            session(['referrer' => $request->query('ref')]);
        }

        return view('auth.register');
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
            'username' => ['required', 'string', 'min:3', 'max:30','unique:users',],
            'gender' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'birth_date' => ['required', 'string'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:10'],
            'state' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $referrer = User::whereUsername(session()->pull('referrer'))->first();

        if($referrer != null){
            $core_number = User::where('referrer_id', $referrer->id)->get();
            $leader = User::where('id',$referrer->id)->first();
        }
        $user =  User::create([
            'name'        => $data['name'],
            'username'    => $data['username'],
            'gender'      => $data['gender'],
            'email'       => $data['email'],
            'referrer_id' => $referrer ? $referrer->id : null,
            'password'    => Hash::make($data['password']),
            'company_name' => $data['company_name'],
            'birth_date'  => $data['birth_date'],
            'address'     => $data['address'],
            'city'        => $data['city'],
            'zipcode'     => $data['zipcode'],
            'state'       => $data['state'],
            'country'     => $data['country'],
            'subscription'=> $data['subscription'],
        ]);
        if($referrer != null){
        $leader->core = count($core_number)+1;
        $currentUser = $leader->id;
        if($leader->subscription == 1){
        $check = ReferalTracking::with('getUserName')->where('refered_user', $currentUser)
        ->select('user')->get();
        // return $check;
        $data = [];
            $totalUser = [];
            $total2nd = 0;
            $range2 = 0;
            $data2nd = [];
        if($check != null){
            foreach($check as $val){
                $data[]=$val->user;
                $totalUser[]=$val->user;
            }
        }

        // return $data;
        //For 2nd tier list
        if($data != null){

        for($range2=0;$range2<count($data);$range2++){
            $check2ndTier = ReferalTracking::where('refered_user',$data[$range2])
            ->select('user')->get();

        foreach($check2ndTier as $val){
            $data2nd[]=$val->user;
            $totalUser[]=$val->user;
        }
        if ($check2ndTier != null) {
            $total2nd+=count($check2ndTier);
        }
        }
        }

        $secondCount = count($data);
        $thirdCount = count($data2nd);
        if($secondCount>=5){
            if($thirdCount < 2){
             $leader->user_title = 2;//Manager
            }else{
                if($thirdCount >= 2){
                 $leader->user_title = 3;//Director
                }
            }
        }else{
            if($secondCount < 5){
                $leader->user_title = 1;//Executive
            }
        }
    }
        $leader->save();
    }
        $referal = array();
        $referal['user'] = $user->id;
        $referal['refered_user'] = $referrer ? $referrer->id : null;
        $referaltracking = DB::table('referal_trackings')->insert($referal);
        return $user;
    }
}
