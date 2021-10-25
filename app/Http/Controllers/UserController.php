<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
// use Illuminate\Pagination\Pagination;

class UserController extends Controller{

    const USER_LIMIT = 5;

    public function index(){
        // $this->data['userRole'] = auth()->user()->roles;
        $this->data['userRoles'] = User::with('roles')->get();
        $this->data['users'] = User::with('roles')->paginate(self::USER_LIMIT);
        return view('admin.users.index',$this->data);
    }

    public function show(User $user){
        $this->data['roles'] = Role::all();
        $this->data['user'] = $user;
        return view('admin.users.user',$this->data);
    }

    public function update(User $user, UserUpdateRequest $request){
        
        try{
            \DB::beginTransaction();
            if($file = $request->file('user_image')){

                $name = $file->getClientOriginalName();
                $file->move('images',$name);
                $user->user_image = $name;
               
            }

            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            
            if($request->password == null){
                $user->password = $user->password;
             
            }
            else{
                $user->password = $request->password;
            }
            $user->update();
            \DB::commit();

            $request->session()->flash('messageUpdate', 'User was updated');
            return back();
        }
        catch(Exception $e){
            DB::rollback();
            $request->session()->flash('errorMessage','An error occurred please try again later');
            return back();
        }
      
    }

    public function destroy(User $user,Request $request){
        try{
            \DB::beginTransaction();
            $user->delete();
            \DB::commit();
            $request->session()->flash('messageDestroy', 'User was deleted');
    
            return back();
        }
        catch(Exception $e){
            DB::rollback();
            $request->session()->flash('errorMessage','An error occurred please try again later');
            return back();
        }
        
        
    }
   
    public function addRole(User $user){
        
        $user->roles()->attach(request('role'));
        return back();
    }
    public function removeRole(User $user){
    
        $user->roles()->detach(request('role'));
        return back();
     }
}
