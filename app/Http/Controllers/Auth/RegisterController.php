<?php

namespace App\Http\Controllers\Auth;

use App\Account;
use App\Category;
use App\City;
use App\Othermajor;
use App\Place;
use App\Province;
use App\School;
use App\Subcity;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;



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
    /*protected $redirectTo = '/';*/

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        /*$this->guard()->login($user);*/

        return $this->registered($request, $user);
           /* ?: redirect($this->redirectPath());*/
    }

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

        if ($data['alias']){
            $data['alias'] = make_slug($data['alias']);
        }

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'majorNow' => ['required_if:userStatus,==,now'],
            'yearNow' => ['required_if:userStatus,==,now'],
            'majorEnd1' => ['required_if:userStatus,==,end' , 'required_if:userStatus,==,end-now'],
            'yearEnd1' => ['required_if:userStatus,==,end' , 'required_if:userStatus,==,end-now'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'alias' => ['string', 'max:255', 'nullable' , 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
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

        if ($data['alias']){
            $alias = make_slug($data['alias']);
        }

        if ($data['userStatus'] == 'end'){
            $data['dormStatus'] = null;
        }

        /*store user data*/

        $user = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'birthday' => $data['birthday'] ,
            'location' => $data['dormStatus'],
            'status' => $data['userStatus'],
            'alias' => $alias,
            'alias_original' => $data['alias'],
            'phone' => @$data['phone'],
            'gender' => $data['gender'],
            'description' => nl2br(@$data['selfDescription']),
            'favorites' => nl2br(@$data['favorites']),
            'cv' => nl2br(@$data['cv']),
            'favorites_book' => nl2br(@$data['favorites_book']),
            'skills' => nl2br(@$data['skills']),
            'favorites_music' => nl2br(@$data['favorites_music']),
            'favorites_movie' => nl2br(@$data['favorites_movie']),
            'password' => Hash::make($data['password']),
        ]);

        $user->sendEmailVerificationNotification();


        /*store places data*/

        $placesArray = [];
        if (isset($data['provinceLive']) && $data['isLiveForeign'] == false) {
            array_push($placesArray , ['province' => $data['provinceLive'] , 'city' => $data['cityLive'] , 'subCity' => $data['subCityLive'] , 'foreign' => false , 'type' => 'live']);
        }
        if (isset($data['birthPlaceProvince']) && $data['isBornedForeign'] == false) {
            array_push($placesArray , ['province' => $data['birthPlaceProvince'] , 'city' => $data['birthPlaceCity'] , 'subCity' => $data['birthPlaceSubCity'] , 'foreign' => false , 'type' => 'birth']);
        }
        if (isset($data['liveForeign']) && $data['isLiveForeign'] == true){
            array_push($placesArray , ['country' => $data['liveForeign'] , 'foreign' => true , 'type' => 'live']);
        }
        if (isset($data['foreignBirthPlace']) && $data['foreignBirthPlace'] == true){
            array_push($placesArray , ['country' => $data['foreignBirthPlace'] , 'foreign' => true , 'type' => 'birth']);
        }


        foreach ($placesArray as $row){
            $place = new Place();
            $place->user_id = $user->id;
            if (!$row['foreign']) {
                $place->province_id = $row['province'];
                $place->city_id = $row['city'];
                $place->subcity_id = $row['subCity'];
            } else {
                $place->country = $row['country'];
            }
            $place->type = $row['type'];
            $place->save();
        }


        /*store majors data*/

        $category = [];
        if ($data['userStatus'] == 'now'){
            $category[$data['majorNow']] = ['year' => $data['yearNow'] , 'status' => 1];
        }
        if (isset($data['majorEnd1']) && $data['majorEnd1'] != ''){
            $category[$data['majorEnd1']] = ['year' => $data['yearEnd1'] , 'status' => 2];
        }
        if (isset($data['majorEnd2']) && $data['majorEnd2'] != ''){
            $category[$data['majorEnd2']] = ['year' => $data['yearEnd2'] , 'status' => 2];
        }
        if (isset($data['majorEnd3']) && $data['majorEnd3'] != ''){
            $category[$data['majorEnd3']] = ['year' => $data['yearEnd3'] , 'status' => 2];
        }

        /*add dorm category to majors category*/
        if ($data['dormStatus'] == 'dorm-vru' && isset($data['dorm']) && !empty($data['dorm'])){
            $category[$data['dorm']] = ['year' => 0 , 'status' => 0];
        }

        $user->categories()->attach($category);

        /*add other majors*/
        $otherMajorArray = [];
        if ($data['userStatus'] == 'end-now'){
            if (isset($data['majorOtherNow']) && !empty($data['majorOtherNow'])){
                array_push($otherMajorArray , ['user_id' => $user->id , 'title' => $data['majorOtherNow'] , 'status' => 1]);
            }
        }
        if (isset($data['majorOtherEnd']) && !empty($data['majorOtherEnd'])){
            array_push($otherMajorArray , ['user_id' => $user->id , 'title' => $data['majorOtherEnd'] , 'status' => 2]);
        }

        Othermajor::insert($otherMajorArray);

        /*store user schools*/

        $schools = [];
        if (isset($data['school1']) && !empty($data['school1'])){
            array_push($schools , ['user_id' => $user->id , 'title' => $data['school1'] , 'type' => 1]);
        }
        if (isset($data['school2']) && !empty($data['school2'])){
            array_push($schools , ['user_id' => $user->id , 'title' => $data['school2'] , 'type' => 2]);
        }
        if (isset($data['school3']) && !empty($data['school3'])){
            array_push($schools , ['user_id' => $user->id , 'title' => $data['school3'] , 'type' => 3]);
        }

        School::insert($schools);

        $accounts = $data['accounts'];

        $accountsArray = [];
        foreach ($accounts as $key=>$account)
        {
            array_push($accountsArray , [
                'user_id' => $user->id,
                'address' => $account,
                'type' => $key
            ]);
        }

        Account::insert($accountsArray);
        Session::put('userId', $user->id);

        Auth::loginUsingId($user->id);
    }
}
