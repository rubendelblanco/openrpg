<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spell extends Model
{
    public function scopeSearch($query, $search) {
        if (! $search) {
            return $query;
        }
        return $query
                ->whereRaw("searchtext @@ plainto_tsquery('spanish', ?)", [$search])
                ->orderByRaw("ts_rank(searchtext, plainto_tsquery('spanish', ?)) DESC", [$search]);
    }
}
