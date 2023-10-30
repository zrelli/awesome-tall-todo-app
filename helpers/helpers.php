<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

if (!function_exists('initSubscribersData')) {
    function initSubscribersData($todoId,$cacheKey=null) {
        $subscribers = DB::table('todo_subscriptions')->select(["subscriber_id", 'todo_id'])->where('todo_id', $todoId)->get()->pluck('subscriber_id')->flatten()->toArray();
        $users = DB::table('users')
            ->select(['email', 'email_provider_id'])
            ->whereIn('id', array_values($subscribers))
            ->get()
            ->pluck('email_provider_id', 'email');


        if($cacheKey){

            // $users =['jsdfjd@jsdjfjd.com'=>1];
            Cache::put($cacheKey, $users, 3600);
            return [];

        }

        return $users;

        }
}


if (!function_exists('getSubscribersData')) {
    function getSubscribersData($cacheKey) {
        $users = Cache::get($cacheKey);
        Cache::forget($cacheKey);


        return $users;

        }
}




