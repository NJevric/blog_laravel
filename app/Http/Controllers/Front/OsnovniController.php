<?php

namespace App\Http\Controllers\Front;
use \Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Category;
use App\Models\Social;

class OsnovniController extends Controller
{
    public $data;

    public function __construct()
    {
        $this->data['post_cat'] = Post::with(['category'])->get();
        $this->data['categories'] = Category::all();
        $this->data['socials'] = Social::all();
        $this->data["menuLogged"] = Menu::whereIn('display',array(0,2))->get();
        $this->data["menu"] = Menu::whereIn('display',array(0,1))->get();
 
    }
}
