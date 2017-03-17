<?php

namespace Urbanevich;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

trait CreatedUpdatedTrait
{

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if ($createdAt = self::getField('CREATED_AT')) {
                $model->$createdAt = date('Y-m-d H:i:s');
            }
            if ($updatedAt = self::getField('UPDATED_AT')) {
                $model->$updatedAt = date('Y-m-d H:i:s');
            }
            if (Auth::user()) {
                if ($createdBy = self::getField('CREATED_BY')) {
                    $model->$createdBy = Auth::user()->id;
                }
                if ($updatedBy = self::getField('UPDATED_BY')) {
                    $model->$updatedBy = Auth::user()->id;
                }
            }
        });
        static::updating(function ($model) {
            if ($updatedAt = self::getField('UPDATED_AT')) {
                $model->$updatedAt = date('Y-m-d H:i:s');
            }
            if (Auth::user() && $updatedBy = self::getField('UPDATED_BY')) {
                $model->$updatedBy = Auth::user()->id;
            }
        });
    }

    protected static function getField($columnName)
    {
        $field = self::getColumnName($columnName);
        return Schema::hasTable(self::getTableName()) && Schema::hasColumn(self::getTableName(), $field) ? $field : false;
    }

    protected static function getColumnName($columnName)
    {
        return defined('static::'.$columnName) ? constant('static::'.$columnName) : strtolower($columnName);
    }
    
    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    public function usesTimestamps()
    {
        return false;
    }
}