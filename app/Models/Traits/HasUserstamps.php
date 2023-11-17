<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Auth;

/**
 * @author Pinebranch
 * Tham khảo từ https://github.com/WildsideUK/Laravel-Userstamps
 */
trait HasUserstamps
{
    protected $userstamps = true;

    public static function bootHasUserstamps()
    {
        static::creating(function ($model) {
            $user = Auth::user();
            $creator = $user ? $user->id : 0;
            $model->{$model->getCreatedByColumn()} = $creator;
            $model->{$model->getUpdatedByColumn()} = $creator;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $updater = $user ? $user->id : 0;
            $model->{$model->getUpdatedByColumn()} = $updater;
        });
    }

    public static function usingSoftDeletes()
    {
        static $usingSoftDeletes;

        if (is_null($usingSoftDeletes)) {
            return $usingSoftDeletes = in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive(get_called_class()));
        }

        return $usingSoftDeletes;
    }

    public function creator()
    {
        return $this->belongsTo($this->getUserClass(), $this->getCreatedByColumn());
    }

    public function editor()
    {
        return $this->belongsTo($this->getUserClass(), $this->getUpdatedByColumn());
    }

    public function destroyer()
    {
        return $this->belongsTo($this->getUserClass(), $this->getDeletedByColumn());
    }

    public function getCreatedByColumn()
    {
        return 'created_by';
    }

    public function getUpdatedByColumn()
    {
        return 'updated_by';
    }

    public function getDeletedByColumn()
    {
        return 'deleted_by';
    }

    protected function getUserClass()
    {
        return config('auth.providers.users.model');
    }
}
