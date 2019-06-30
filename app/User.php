<?php

namespace App;

use App\Http\Controllers\FrontEnd\PhotoController;
use Hekmatinasser\Verta\Verta;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password', 'last_name' , 'location' , 'status' , 'alias' , 'alias_original' , 'birthday' , 'phone' , 'gender' , 'description' , 'favorites' , 'cv' , 'favorites_book' , 'skills' , 'favorites_music' , 'favorites_movie' , 'active' , 'visible'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function posts()
    {
        return $this->hasMany(Post::class)
            ->where('active' , 1)->withCount(['likes' , 'comments'])->orderBy('created_at' , 'DESC');
            /*whereHas('category' , function ($q){
                $q->where('categories.sort' , '!=' , 'blog');
            });*/
    }

    public function studyPosts()
    {
        return $this->hasMany(Post::class)
            ->whereHas('category' , function ($q){
                $q->where('categories.sort' , 'major');
            });
    }

    public function dormPosts()
    {
        return $this->hasMany(Post::class)
            ->whereHas('category' , function ($q){
                $q->where('categories.sort' , 'dorm');
            });
    }

    public function matesPosts()
    {
        return $this->hasMany(Post::class)
            ->whereHas('category' , function ($q){
                $q->where('categories.sort' , 'mates');
            });
    }

    public function blogPosts()
    {
        return $this->hasMany(Post::class)
            ->whereHas('category' , function ($q){
                $q->where('categories.sort' , 'blog');
            });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withPivot('status' , 'year');
    }

    protected $appends = ['family' , 'url' , 'birthday_jalali' , 'path_sm' , 'path_md' , 'path_lg'];

    public function getFamilyAttribute()
    {
        return $this->name . ' ' . $this->last_name;
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function mentions()
    {
        return $this->hasMany(Mention::class);
    }

    public function seens()
    {
        return $this->hasMany(Seen::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class)->with('bookmarkable.category');
    }

    public function places()
    {
        return $this->hasMany(Place::class)->with('province' , 'city' , 'subcity');
    }

    public function schools()
    {
        return $this->hasMany(School::class);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function othermajors()
    {
        return $this->hasMany(Othermajor::class);
    }

    public function settings()
    {
        return $this->belongsToMany(Setting::class);
    }

    public function supports()
    {
        return $this->hasMany(Support::class);
    }

    public function Galleries()
    {
        return $this->hasMany(Gallery::class)->where('is_header' , null);
    }

    public function header()
    {
        return $this->hasMany(Gallery::class)->where('is_header' , 1);
    }

    /* messages */

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    /* end messages */

    public function sentRequests()
    {
        return $this->hasMany(Friend::class, 'sender_id');
    }

    public function receivedRequests()
    {
        return $this->hasMany(Friend::class, 'receiver_id');
    }

    /* friendShip */

    // friendship that user requested
    function friendsOfMine()
    {
        return $this->belongsToMany(User::class , 'friends', 'sender_id', 'receiver_id')
            ->with('photo' , 'categories')
            ->withPivot('id' , 'accepted');
    }

// friendship that user invited to
    function friendOf()
    {
        return $this->belongsToMany(User::class  , 'friends', 'receiver_id', 'sender_id')
            ->with('photo' , 'categories')
            ->withPivot('id' , 'accepted');
    }

    public function getFriendsAttribute()
    {
        if ( ! array_key_exists('friends', $this->relations)) $this->loadFriends();

        return $this->getRelation('friends');
    }

    protected function loadFriends()
    {
        if ( ! array_key_exists('friends', $this->relations))
        {
            $friends = $this->mergeFriends();

            $this->setRelation('friends', $friends);
        }
    }

    protected function mergeFriends()
    {
        return $this->friendsOfMine->merge($this->friendOf);
    }



    /* end friendShip */


    public function getBirthdayJalaliAttribute()
    {
        if (empty($this->birthday)){
            return 'نامشخص';
        } else {
            $v = new Verta($this->birthday);
            return $v->format('%d %B، %Y');
        }


    }

    public function getCreatedAtAttribute($value)
    {
        $v = new Verta($value);
        return $v->format('%d %B، %Y');
    }

    public function getLastseenAttribute($value)
    {
        if (empty($value)){
            return 'نامشخص';
        }
        return \Hekmatinasser\Verta\Verta::instance($value)->formatDifference();
    }

    public function getUrlAttribute()
    {
        if (!empty($this->alias)){
            return $this->alias;
        } else {
            return $this->id;
        }
    }

    public function getPathSmAttribute()
    {
        return $this->totalPath($this->photo['path'] , $this->gender , 'sm');
    }

    public function getPathMdAttribute()
    {
        return $this->totalPath($this->photo['path'] , $this->gender ,'md');
    }

    public function getPathLgAttribute()
    {
        return $this->totalPath($this->photo['path'] , $this->gender ,'lg');
    }

    public function totalPath($path , $gender , $type)
    {
        if (empty($path)){
            if (empty($gender)){
                $totalPath = \Constants::$img['user_avatar_unknown'];
            } elseif ($gender == 1) {
                $totalPath = \Constants::$img['user_avatar_male'];
            } elseif ($gender == 0){
                $totalPath = \Constants::$img['user_avatar_female'];
            }
            return $totalPath;
        }

        switch ($type){
            case 'sm':
                $totalPath = '/images/sm/'.$path;
                break;
            case 'md':
                $totalPath = '/images/md/'.$path;
                break;
            case 'lg':
                $totalPath = '/images/lg/'.$path;
                break;
        }

        return $totalPath;
    }

}
