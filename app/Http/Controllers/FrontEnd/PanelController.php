<?php

namespace App\Http\Controllers\FrontEnd;

use App\Account;
use App\Category;
use App\City;
use App\Comment;
use App\Events\NotificationSeenEvent;
use App\Friend;
use App\Http\Requests\EditEducationInformationRequest;
use App\Http\Requests\EditPersonalInformationRequest;
use App\Mention;
use App\Message;
use App\Place;
use App\Post;
use App\Province;
use App\School;
use App\Seen;
use App\Subcity;
use App\Support;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\DocBlock\Tags\See;

class PanelController extends Controller
{

    public function index()
    {

        $userId = Auth::id();
        $user = User
            ::with('places', 'photo' , 'categories', 'accounts', 'posts.category', 'posts.photos' , 'galleries' , 'header' , 'schools')
            ->withCount(['posts'])
            ->whereId($userId)->first();

        $friendsCount = $user->friends->where('pivot.accepted' , 1)->count();

        return view('frontend.panel.index' , compact(['user' , 'friendsCount']));
    }

    public function initialize()
    {
        $verta = \verta();
        $month = $verta->month;
        $year = $verta->year;
        if ($month < 6){
            $year--;
        }

        $majors = Category::with('childrenRecursive')->where('parent_id' , 1)->get();

        $provinces = Province::all('title as label' , 'id as value');

        $dorms = Category::where('parent_id' , 2)->get();

        $response = [
            'year' => $year,
            'majors' => $majors,
            'provinces' => $provinces,
            'dorms' => $dorms
        ];
        return response()->json($response , 200);
    }

    public function getCities($provinceId)
    {
        $cities = City::where('province_id' , $provinceId)->select('title as label', 'id as value')->get();

        $response = [
            'cities' => $cities
        ];
        return response()->json($response , 200);
    }

    public function getSubCities($cityId)
    {
        $subCities = Subcity::where('city_id' , $cityId)->select('title as label', 'id as value')->get();

        $response = [
            'subCities' => $subCities
        ];
        return response()->json($response , 200);
    }

    public function editPersonalInformation(EditPersonalInformationRequest $request)
    {

        if ($request->alias){
            $alias = make_slug($request->alias);
        }

        $user = User::findOrFail(Auth::id());
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->alias = $request->$alias;
        $user->alias_original = $request->alias;
        $user->birthday = $request->birthday;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->save();

        /*update places data*/

        $placesArray = [];
        if (isset($request->provinceLive) && $request->isLiveForeign == false) {
            array_push($placesArray , ['province' => $request->provinceLive , 'city' => $request->cityLive , 'subCity' => $request->subCityLive , 'foreign' => false , 'type' => 'live']);
        }
        if (isset($request->birthPlaceProvince) && $request->isBornedForeign == false) {
            array_push($placesArray , ['province' => $request->birthPlaceProvince , 'city' => $request->birthPlaceCity , 'subCity' => $request->birthPlaceSubCity , 'foreign' => false , 'type' => 'birth' ,]);
        }
        if (isset($request->liveForeign) && $request->isLiveForeign == true){
            array_push($placesArray , ['country' => $request->liveForeign , 'foreign' => true , 'type' => 'live' , 'id' => $request->liveId]);
        }
        if (isset($request->foreignBirthPlace) && $request->foreignBirthPlace == true){
            array_push($placesArray , ['country' => $request->foreignBirthPlace , 'foreign' => true , 'type' => 'birth' , 'id' => $request->birthId]);
        }

        Place::whereIn('type' , collect($placesArray)->pluck('type'))->where('user_id' , Auth::id())->delete();

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

        /*update user schools*/

        $schools = [];
        $itemsForDelete = [];
        if (isset($request->school1) && !empty($request->school1)){
            array_push($schools , ['user_id' => $user->id , 'title' => $request->school1 , 'type' => 1]);
            array_push($itemsForDelete , $request->schoolId1);
        }
        if (isset($request->school2) && !empty($request->school2)){
            array_push($schools , ['user_id' => $user->id , 'title' => $request->school2 , 'type' => 2]);
            array_push($itemsForDelete , $request->schoolId2);
        }
        if (isset($request->school3) && !empty($request->school3)){
            array_push($schools , ['user_id' => $user->id , 'title' => $request->school3 , 'type' => 3]);
            array_push($itemsForDelete , $request->schoolId3);
        }

        School::whereIn('id' , $itemsForDelete)->delete();
        School::insert($schools);

        return ['result' => 'updated' , 'changes' => collect($placesArray)->pluck('type')];
    }

    public function editEducationInformation(EditEducationInformationRequest $request)
    {

        if ($request->description){
            $support = new Support();
            $support->user_id = Auth::id();
            $support->description = nl2br($request->description);
            $support->type = 'edit-education';
            $support->save();
        }

        $user = User::findOrFail(Auth::id());
        $user->location = $request->dormStatus;
        $user->save();


        $result = $user->categories->where('sort' , 'dorm')->first();
        if (!is_null($result)){
            $result->pivot->delete();
        }

        if ($request->dormStatus == 'dorm-vru' && isset($request->dorm) && !empty($request->dorm)){
            $category[$request->dorm] = ['year' => 0 , 'status' => 0];
            $user->categories()->attach($category);
        }


    }

    public function editHobbiesInformation(Request $request)
    {


        $user = User::findOrFail(Auth::id());
        $user->description = nl2br($request->selfDescription);
        $user->favorites = nl2br($request->favorites);
        $user->cv = nl2br($request->cv);
        $user->favorites_book = nl2br($request->favorites_book);
        $user->favorites_music = nl2br($request->favorites_music);
        $user->favorites_movie = nl2br($request->favorites_movie);
        $user->save();
    }

    public function editAccountsInformation(Request $request)
    {
        $accounts = $request->accounts;

        $accountsArray = [];
        foreach ($accounts as $key=>$account)
        {
            array_push($accountsArray , [
                'user_id' => Auth::id(),
                'address' => $account,
                'type' => $key
            ]);
        }

        Account::insert($accountsArray);
    }

    public function deleteCity(Request $request)
    {
        $type = $request->type;
        Place::whereIn('type' , [$type])->where('user_id' , Auth::id())->delete();
    }

}