<?php
namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasJsonColumns
{
    public static function bootHasJsonColumns()
    {
        static::saving(function (Model $model) {
            if (blank($model->casts)) return;

            collect($model->casts)->each(function ($item, $key) use ($model) {
                if (! in_array($item, ['array', 'json'])) return;

                if (! $model->{$key}) return;

                $model->{$key} = static::filter_recursive($model->{$key}, function ($item) {
                    return filled($item);
                });
            });
        });
    }

    public static function filter_recursive($array, $callback = null)
	{
		foreach ($array as &$value)
		{
			if (is_array($value))
			{
				$value = $callback === null ? static::filter_recursive($value) : static::filter_recursive($value, $callback);
			}
		}

		return $callback === null ? array_filter($array) : array_filter($array, $callback);
   	}
}