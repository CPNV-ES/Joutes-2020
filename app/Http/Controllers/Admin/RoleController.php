<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CreateRoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('administrations.roles.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrations.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        
        $newRole = new Role();
        $newRole->slug = $request->input("slug");
        $newRole->name = $request->input("name");
        $newRole->save();

        return redirect()->route('roles.index');
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        return view('administrations.roles.edit')->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateRoleRequest $request, Role $role)
    {
        /* CUSTOM SPECIFIC VALIDATION */
        $customError = null;
        // Check if the name already exists AND is not the same between the form POST and the DB
        // This way, we can edit just the description and save the same name, but we cannot save the same name as an other sport on DB
        if($role->slug != $request->input('slug') && Role::where('slug', '=', $request->input('slug'))->exists()){
            $customError = 'le role "'.$request->input('slug').'"'.' existe déjà.';
        }


        /* LARAVEL VALIDATION */
        // create the validation rules
        $rules = array(
            'slug' => 'required|min:2|max:4',
            'nom' => 'max:45'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails() || !empty($customError)) {
            return view('administrations.roles.edit')->withErrors($validator->errors())->with('role', $role)->with('customError', $customError);
        } else {
            $role->update($request->all());
            return redirect()->route('roles.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($role)
    {
        $roleToDelete = Role::findOrFail($role);
        $roleToDelete->delete();    
        return redirect()->route('roles.index');
    }
}
