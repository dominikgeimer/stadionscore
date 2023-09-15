<?php

namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait BelongsToTeam
{
    protected static function bootBelongsToTeam()
    {
        static::creating(function ($model) {
            if (session()->has('team_id')) {
                $model->team_id = session('team_id');
            }
        });

        static::addGlobalScope('team_id', function (Builder $builder) {
            if (session()->has('team_id')) {
                $builder->where('team_id', session('team_id'));
            }
        });
    }
}
