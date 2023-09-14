<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait BelongsToTeam
{
    protected static function bootBelongsToTeam()
    {
        if(session('team_id')) {
            static::creating(function ($model) {
                $model->team_id = session('team_id');
            });

            static::addGlobalScope('team_id', function (Builder $builder) {
                $builder->where('team_id', session('team_id'));
            });
        }
    }
}
