<?php

namespace CatSearch\Repository;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class CatsRepository {

    /**
     * Cat list part size
     */
    const LIMIT = 15;

    /**
     * Checking which order to use
     * @param $order
     * @return string
     */
    private function _checkOrder ($order) {
        return is_null($order)?'cats.created_at':$order;
    }

    /**
     * Optimized query for cats feed
     * @param int $offset
     * @param string $order
     * @param string $lng
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function catsFeed($offset, $order, $lng) {

        $order = $this->_checkOrder($order);

        $results = DB::table('cats')
            ->join('like', 'like.id_cats', '=', 'cats.id', 'left')
            ->join('users', 'users.id', '=', 'cats.id_author')
            ->join('contacts', 'contacts.id', '=', 'users.id_contacts', 'left')
            ->groupBy('cats.id')
            ->select(
                'cats.id',
                'cats.created_at',
                'cats.position',
                'users.email',
                DB::Raw('CONCAT_WS(" ", contacts.name, contacts.surname) as full_name'),
                DB::Raw('ifnull((select path from photo where id_cats = cats.id limit 1), "1.png") as path'),
                DB::Raw('count(`like`.`id`) as count_likes'
                ))
            ->skip($offset)
            ->take(self::LIMIT)
            ->orderBy($order, 'DESC')
            ->get();

        foreach ($results as $item) {
            \App::setLocale($lng);
            $item->created_at = \LocalizedCarbon::createFromTimeStamp(strtotime( $item->created_at ))->diffForHumans();
            $tempCoords = explode(',', $item->position);
            $item->position = array(
                'latitude' => $tempCoords[0],
                'longitude' => $tempCoords[1]
            );
        }

        \Log::info(DB::getQueryLog());

        return new Collection($results);
    }

//    public static function catsIds ( $order ) {
//
//        $order = self::_checkOrder($order);
//
//        $results = DB::table('cats')
//            ->join('like', 'like.id_cats', '=', 'cats.id', 'left')
//            ->groupBy('cats.id')
//            ->select(
//                'cats.id',
//                'cats.created_at',
//                DB::Raw('count(`like`.`id`) as count_likes'
//                ))
//            ->orderBy($order, 'DESC')
//            ->get();
//
//        return new Collection($results);
//
//    }



} 