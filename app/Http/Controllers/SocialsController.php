<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Social;
use App\Http\Requests\SocialRequest;
class SocialsController extends Controller
{
    //
    public function index(){
        $this->data['socials'] = Social::all();
        return view('admin.socials.index',$this->data);
    }
    public function store(SocialRequest $request){
        try{
            \DB::beginTransaction();
            $social = new Social;
            $social->text = $request->text;
            $social->href = $request->href;
            $social->save();
            \DB::commit();
            $request->session()->flash('messageCreated','Social link was crated');
            return redirect()->route('socials.index');
        }
        catch(Exception $e){
            \DB::rollBack();
            $request->session()->flash('errorMessage', 'An error occurred please try again later');
            return redirect()->route('socials.index');
        }
    }
    public function edit(Social $social){
        $this->data['social'] = $social;
        return view('admin.socials.edit',$this->data);
    }
    public function update(Social $social, SocialRequest $request){
        try{
            \DB::beginTransaction();
            $social->text = $request->text;
            $social->href = $request->href;
           
            $social->update();
            \DB::commit();
            $request->session()->flash('messageUpdated','Social icon was updated');
            return redirect()->route('socials.index');
        }
        catch(Exception $e){
            \DB::rollBack();
            $request->session()->flash('errorMessage', 'An error occurred please try again later');
            return redirect()->route('social.edit');
        }
      
    }
    public function destroy(Social $social,Request $request){
        try{
            $social->delete();
            $request->session()->flash('messageDeleted','Social icon was deleted');
            return redirect()->route('socials.index');
        }
        catch(Exception $e){
            \DB::rollBack();
            $request->session()->flash('errorMessage', 'An error occurred please try again later');
            return redirect()->route('socials.index');
        }
    }

}
