<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;
use \Auth;
class AdminController extends Controller
{
    //
    public function index(){
        $this->data['registersLog'] = Activity::where('subject_type','=','App\Models\\User')->get();
        $this->data['postsLog'] = Activity::where('subject_type','=','App\Models\\Post')->get();
        $this->data['commentsLog'] = Activity::where('subject_type','=','App\Models\\Comment')->get();
        $this->data['permissionsLog'] = Activity::where('subject_type','=','App\Models\\Permission')->get();
        return view('admin.index', $this->data);
    }

    public function sort(Request $request){
        if($request->ddl == 0){
            $this->data['registersLog'] = Activity::where('subject_type','=','App\Models\\User')->orderBy('created_at','desc')->get();
            $this->data['postsLog'] = Activity::where('subject_type','=','App\Models\\Post')->orderBy('created_at','desc')->get();
            $this->data['commentsLog'] = Activity::where('subject_type','=','App\Models\\Comment')->orderBy('created_at','desc')->get();
            $this->data['permissionsLog'] = Activity::where('subject_type','=','App\Models\\Permission')->orderBy('created_at','desc')->get();
        }
        else{
            $this->data['registersLog'] = Activity::where('subject_type','=','App\Models\\User')->orderBy('created_at','asc')->get();
            $this->data['postsLog'] = Activity::where('subject_type','=','App\Models\\Post')->orderBy('created_at','asc')->get();
            $this->data['commentsLog'] = Activity::where('subject_type','=','App\Models\\Comment')->orderBy('created_at','asc')->get();
            $this->data['permissionsLog'] = Activity::where('subject_type','=','App\Models\\Permission')->orderBy('created_at','asc')->get();
        }
        return view('admin.index',$this->data);
    }
}
