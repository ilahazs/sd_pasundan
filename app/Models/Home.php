<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use URL;

class Home extends Model
{
    protected $table = 'wording_home';
    protected $appends = ["image_link"];
    public function getImageLinkAttribute()
    {
        $url = URL::to('/');
        return $url."/landing-page/image/".$this->content;
    }
}
