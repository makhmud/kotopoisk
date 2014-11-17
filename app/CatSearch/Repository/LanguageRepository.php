<?php

namespace CatSearch\Repository;

use Illuminate\Support\Facades\DB;

class LanguageRepository {


    public function translations($key) {

        $results = DB::table('translations')
            ->select(
                'translations.key',
                'translations.value'
                )
            ->where('lng', '=', $key)
            ->get();

        $returnArray = array();
        foreach ($results as $item) {
            $returnArray[$item->key] = $item->value;
        }

        return $returnArray;
    }

    public function getFormattedList ($search = null) {


        $translations = \Translation::orderBy('key', 'asc')->where('value', 'LIKE', '%'.$search.'%')->get();

        $formatted = [];

        foreach($translations as $item) {
            $formatted[$item->key][] = ['lng' => $item->lng, 'value' => $item->value];
            $other = \Translation::orderBy('key', 'asc')
                ->where('key', '=', $item->key)
                ->where('lng', '!=', $item->lng)
                ->first();
            $formatted[$item->key][] = ['lng' => $other->lng, 'value' => $other->value];
        }

        return $formatted;
    }

} 