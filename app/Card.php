<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Card extends Model
{
    protected $table = 'cards';
    protected $fillable = ['name', 'list_id', 'description'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function list()
    {
        return $this->belongsTo(Lists::class);
    }
}
