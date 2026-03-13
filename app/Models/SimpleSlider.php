<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimpleSlider extends Model
{
    protected $table = 'simple_sliders';

    protected $fillable = [
        'name',
        'key',
        'description',
        'status',
    ];

    public function sliderItems()
    {
        return $this->hasMany(SimpleSliderItem::class, 'simple_slider_id', 'id')->orderBy('order', 'asc');
    }
}
