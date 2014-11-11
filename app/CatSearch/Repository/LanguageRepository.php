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

} 