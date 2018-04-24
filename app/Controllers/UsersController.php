<?php

namespace App\Controllers;

use Hash;
use App\Models\User;
use App\Authorizable;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UsersRequest;
class UsersController extends Controller
{

    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('backend.users.index', [
            'title' => trans('main.show-all') . ' ' . trans('main.users')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create', [
            'title' => trans('main.add') . ' ' . trans('main.users'),
            'roles' => Role::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $requestAll = $request->all();
        $requestAll['image'] = UploadImages('users', $request->file('image'));
        $user = User::create($requestAll);

        $roles = $request['roles']; //Retrieving the roles field
        //Checking if a role was selected
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r); //Assigning role to user
            }
        }

        session()->flash('success', trans('main.added-message'));
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.show', [
            'title' => trans('main.show') .' ' . trans('main.user') . ' : ' . $user->name,
            'show'  => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.edit', [
            'title' => trans('main.edit') .' ' . trans('main.user') . ' : ' . $user->name,
            'edit'  => $user,
            'roles' => Role::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->has('password') && !empty($request->password) && !is_null($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->type = $request->type;

        if ($request->hasFile('image')) {
            if (file_exists(public_path('uploads/' . $user->image))) {
                @unlink(public_path('uploads/' . $user->image));
            }
            $user->image = UploadImages('users', $request->file('image'));
        }

        $user->save();

        $roles = $request['roles']; //Retreive all roles
        if (isset($roles)) {
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles
        } else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }

        session()->flash('success', trans('main.updated'));
        return redirect()->route('users.show', [$user->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  bool  $redirect
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $redirect = true)
    {
        $user = User::findOrFail($id);
        if (file_exists(public_path('uploads/' . $user->image))) {
            @unlink(public_path('uploads/' . $user->image));
        }
        $user->delete();

        if ($redirect) {
            session()->flash('success', trans('main.deleted-message'));
            return redirect()->route('users.index');
        }
    }


    /**
     * Remove the multible resource from storage.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request)
    {
        if (count($request->selected_data)) {
            foreach ($request->selected_data as $id) {
                $this->destroy($id, false);
            }
            session()->flash('success', trans('main.deleted-message'));
            return redirect()->route('users.index');
        }
    }

}
