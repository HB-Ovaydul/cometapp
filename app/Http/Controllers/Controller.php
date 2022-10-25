<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     *  Youtub & Vimeo Link Convert
     */
    public function embed($link = '')
    {
       if(strpos($link,'vimeo.com')){
        $array = explode('vimeo.com/', $link);
        $id = $array[1];
       return "https://player.vimeo.com/video/{$id}";
    }else{
        $embed = str_replace('watch?v=', 'embed/', $link);
        $new_array = explode('&t', $embed);
        return $new_array[0];
    }
    }

    /**
     * Slug Convert
     */
    public function slugconvert($title)
    {
        $lowar = strtolower($title);
        return str_replace(' ', '-', $lowar);
    }
}
