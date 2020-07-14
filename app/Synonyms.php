<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Synonyms extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'word_id',
        'syno_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'word_id' => 'integer',
        'syno_id' => 'integer',
    ];
}
