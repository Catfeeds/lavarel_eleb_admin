<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Menu extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'route', 'parent_id','sort',
    ];

    static function navs(){
        $html = '';
        $menus = self::where('parent_id',0)->get();
        foreach ($menus as $menu){
            $children_html = '';
            $children = self::where('parent_id',$menu->id)->get();
            foreach ($children as $child){
                if(\Illuminate\Support\Facades\Auth::check() && Auth::user()->can($child->route)) // route:user/add  permission:user.create
                    $children_html .= '<li><a href="'.route($child->route).'">'.$child->name.'</a></li>';
            }
            //如果没有子菜单,当前菜单组隐藏
            if($children_html == ''){
                continue;
            }

            $html .= '<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$menu->name.' <span class="caret"></span></a>
                <ul class="dropdown-menu">';


            $html .= $children_html;
            $html .= '</ul> </li>';

        }
        return $html;
    }
}
