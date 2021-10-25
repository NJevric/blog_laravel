<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Http\Requests\PermissionRequest;

class PermissionController extends Controller
{
    public function index(){
        $this->data['permissions'] = Permission::all();
        return view('admin.permissions.index', $this->data);
    }

    public function store(Permission $permission, PermissionRequest $request){
        try{
            \DB::beginTransaction();
            $permission = new Permission;

            $permission->name = $request->name;
            
            $permission->save();
            \DB::commit();
            $request->session()->flash('messageCreated','Permission was crated');
            return redirect()->route('permissions.index');
        }
        catch(Exception $e){
            \DB::rollBack();
            $request->session()->flash('errorMessage', 'An error occurred please try again later');
            return redirect()->route('permissions.store');
        }
    }

    public function edit(Permission $permission){
        $this->data['permission'] = $permission;
        return view('admin.permissions.edit',$this->data);
    }

    public function update(Permission $permission, PermissionRequest $request){
        try{
            \DB::beginTransaction();
            $permission->name = $request->name;
            $permission->update();
            \DB::commit();
            $request->session()->flash('messageUpdated','Permission was updated');
            return redirect()->route('permissions.index');
        }
        catch(Exception $e){
            \DB::rollBack();
            $request->session()->flash('errorMessage', 'An error occurred please try again later');
            return redirect()->route('permissions.edit');
        }
    }

    public function destroy(Permission $permission, Request $request){
        try{
            \DB::beginTransaction();
            $permission->delete();
            \DB::commit();
            $request->session()->flash('messageDeleted','Permission was deleted');
            return redirect()->route('permissions.index');
        }
        catch(Exception $e){
            \DB::rollBack();
            $request->session()->flash('errorMessage', 'An error occurred please try again later');
            return redirect()->route('permissions.index');
        }
    }

   


}
