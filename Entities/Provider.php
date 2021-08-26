<?php

namespace Modules\Imeeting\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;

class Provider extends Model
{
    use Translatable, MediaRelation;

    public $translatedAttributes = [
        'title',
        'description'
    ];

    protected $table = 'imeeting__providers';

    protected $fillable = [
        'status',
        'name',
        'options'
    ];

    protected $casts = [
        'options' => 'array'
    ];


    public function getOptionsAttribute($value)
    {
        return json_decode($value);
    }

    public function setOptionsAttribute($value)
    {
        $this->attributes['options'] = json_encode($value);
    }

}