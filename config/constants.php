<?php

define('MYCONST', array("someValue1","someValue2"));

class Constants
{


public static $img = [
    'user_avatar_male' => '/images/avatars/avatar_male.png',
    'user_avatar_female' => '/images/avatars/avatar_female.png',
    'user_avatar_unknown' => '/images/avatars/avatar_unknown.png',
    'post_profile' => '/images/avatars/post_profile.png',
];

public static $userImg = [
    'user_avatar_male' => '/images/avatars/avatar_male.png',
    'user_avatar_female' => '/images/avatars/avatar_female.png',
];

public static $postImg = [
    '1' => '/images/avatars/post1.png',
    '2' => '/images/avatars/post2.png',
    '3' => '/images/avatars/post3.png',
    '4' => '/images/avatars/post4.png',
    '5' => '/images/avatars/post5.png',
];

    public static function postImgRandom()
    {
        try {
            return self::$postImg[random_int(1, 5)];
        } catch (Exception $e) {
        }
    }


}