<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BaseModel extends Model
{
    protected $guarded = [];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            if (!empty(request()->user()))
                $model->created_by = request()->user()->id;
        });


        static::updating(function ($model) {
            if (!empty(request()->user()))
                $model->updated_by = request()->user()->id;
        });
    }

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }


    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }
}
