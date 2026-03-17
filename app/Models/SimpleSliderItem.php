<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimpleSliderItem extends Model
{
    protected $table = 'simple_slider_items';

    protected $fillable = [
        'simple_slider_id',
        'title',
        'link',
        'description',
        'image',
        'order',
    ];

    public function slider()
    {
        return $this->belongsTo(SimpleSlider::class, 'simple_slider_id', 'id');
    }
}
