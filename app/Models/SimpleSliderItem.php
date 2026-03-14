<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimpleSliderItem extends Model
{
    protected $table = 'simple_slider_items';

    protected $fillable = [
        'simple_slider_id',
        'title',
        'subtitle',
        'link',
        'button_label',
        'description',
        'image',
        'tablet_image',
        'mobile_image',
        'background_color',
        'background_color_light',
        'order',
        'status',
    ];

    public function slider()
    {
        return $this->belongsTo(SimpleSlider::class, 'simple_slider_id', 'id');
    }
}
