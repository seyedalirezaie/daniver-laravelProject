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
        'name', 'email', 'password', 'last_name' , 'location' , 'status' , 'alias' , 'alias_original' , 'birthday' , 'phone' , 'gender' , 'description' , 'favorites' , 'cv' , 'favorites_book' , 'skills' , 'favorites_music' , 'favorites_movie'
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
            ->where('active' , 1);
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

    protected $appends = ['family' , 'url' , 'birthday_jalali'];

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

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function sentRequests()
    {
        return $this->hasMany(Friend::class, 'sender_id');
    }

    public function receivedRequests()
    {
        return $this->hasMany(Friend::class, 'receiver_id');
    }

    /*//*/

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



    /*//*/


    public function getBirthdayJalaliAttribute()
    {
        $v = new Verta($this->birthday);
        return $v->format('%d %B، %Y');
    }

    public function getCreatedAtAttribute($value)
    {
        $v = new Verta($value);
        return $v->format('%d %B، %Y');
    }

    public function getLastseenAttribute($value)
    {
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
}
