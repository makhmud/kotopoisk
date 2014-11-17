<?php

namespace CatSearch\Repository;

use Illuminate\Support\Facades\DB;

class UserRepository {


    public function getUserBySocialId($uid) {

        $results = DB::table('users')
            ->join('social', 'social.id_user', '=', 'users.id')
            ->select(
                'users.id',
                'social.uid'
                )
            ->where('social.uid', '=', $uid)
            ->first();

        return $results;
    }

} 