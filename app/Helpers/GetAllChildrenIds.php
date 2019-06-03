<?php

use App\Category;

/****get all category children ids by category id****/
 function allChildren($id)
{
    $all_ids=[];
    $ids = $id;

    while (sizeof($ids) > 0){
        $firstIds = Category::whereIn('parent_id' , $ids)->pluck('id');
        array_push($all_ids , $firstIds);
        $ids = $firstIds;
    }

    $array = array_collapse($all_ids);
    $array = array_merge($array , $id);
    return $array;
}