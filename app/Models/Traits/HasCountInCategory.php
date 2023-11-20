<?php
namespace App\Models\Traits;

use Illuminate\Support\Facades\DB;

trait HasCountInCategory
{
    public static function bootHasCountInCategory()
    {
        static::saved(function ($model) {
            $categories = $model->categories()->select('categories.id')->pluck('id')->all();
            DB::table('categories')->whereIn('id', $categories)->increment('count');
        });
    }

    private function getUpdateCountIn()
    {
        if (property_exists($this, 'updateCountIn')) {
            return $this->updateCountIn;
        }

        return 'updateCountIn';
    }
}