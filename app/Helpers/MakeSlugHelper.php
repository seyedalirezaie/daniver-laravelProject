<?php

function make_slug($string){
    $caractersArray = ['/' , '+' , '+' , '*' , '}' , '{' , '[' , ']' , '?' , '.' , ',' , '#' , '$' , '%' , '^' , '&' , '(' , ')' , '_'];
    $string = str_replace($caractersArray , '-' , $string);
    return preg_replace('/\s+/u' , '-' , trim($string));
}

//for using helper in laravel
// in composer.json -> add to "autoload" -> "files":["app/Helpers/MakeSlugHelper.php"]
// in Terminal -> composer dump-autoload