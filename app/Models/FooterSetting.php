<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    protected $table = 'footer_settings';
    
    protected $fillable = [
        'user_id', 
        'footer_description', 
        'footer_phone', 
        'footer_email', 
        'footer_address', 
        'facebook_url', 
        'twitter_url', 
        'youtube_url', 
        'linkedin_url', 
        'footer_logo', 
        'site_name', 
        'contact_map_iframe'
    ];
}
