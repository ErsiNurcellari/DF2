<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\DB;

class ProductTerm extends Pivot
{
    protected $table = 'term_relationships';

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($item) {
            try {
                DB::table('terms')->whereId($item->term_id)->increment('product_count');
            } catch (\Exception $exception) {}
        });

        static::deleted(function ($item) {
            try {
                DB::table('terms')->whereId($item->term_id)->update(['product_count' => DB::raw('GREATEST(product_count - 1, 0)')]);
            } catch (\Exception $exception) {}
        });
    }
}
