<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    //
    public function index(){
        $this->data['roles'] = Role::all();
        return view('admin.roles.index',$this->data);
    }

    public function store(RoleRequest $request){
        try{
            \DB::beginTransaction();
            $role = new Role;

            $role->name = $request->name;
            
            $role->save();
            \DB::commit();
            $request->session()->flash('messageCreated','Role was crated');
            return redirect()->route('roles.index');
        }
        catch(Exception $e){
            \DB::rollBack();
            $request->session()->flash('errorMessage', 'An error occurred please try again later');
            return redirect()->route('roles.store');
        }
        
    }
    public function edit(Role $role){
        $this->data['role'] = $role;
        $this->data['permissions'] = Permission::all();
        return view('admin.roles.edit',$this->data);
    }

    public function update(Role $role, RoleRequest $request){
        try{
            \DB::beginTransaction();
            $role->name = $request->name;
            $role->update();
            \DB::commit();
            $request->session()->flash('messageUpdated','Role was updated');
            return redirect()->route('roles.index');
        }
        catch(Exception $e){
            \DB::rollBack();
            $request->session()->flash('errorMessage', 'An error occurred please try again later');
            return redirect()->route('roles.edit');
        }
    }
    public function destroy(Role $role,Request $request){
        try{
            \DB::beginTransaction();
            $role->delete();
            \DB::commit();
            $request->session()->flash('messageDeleted','Role was deleted');
            return redirect()->route('roles.index');
        }
        catch(Exception $e){
            \DB::rollBack();
            $request->session()->flash('errorMessage', 'An error occurred please try again later');
            return redirect()->route('roles.index');
        }
    }


    public function addPermission(Role $role){
        $role->permissions()->attach(request('permission'));
        return back();
    }

    public function removePermission(Role $role){
        
        $role->permissions()->detach(request('permission'));
        return back();
    }

    
}
