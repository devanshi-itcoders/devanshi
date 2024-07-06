<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{

  function __construct(Request $request)
  {
    parent::__construct($request);
    // set permission
    $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
    $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
    $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
    $this->middleware('permission:user-delete', ['only' => ['destroy']]);
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    // get user session 
    if (!empty(session()->get('master_filter'))) {
      $master_filter = $request->session()->get('master_filter');
    } else {
      $master_filter = date('Y');
    }

    $filter = $request->input('filter');
    $roleFilter = $request->input('role');

    $roles = Role::pluck('name', 'name')->all();
    $userQuery = User::sortable()->latest();
    if (!empty($filter) || !empty($roleFilter) || !empty($master_filter)) {

      $userQuery = $userQuery->where(function ($query) use ($filter) {
        $query->where('name', 'like', '%' . $filter . '%')
          ->orWhere('phone', 'like', '%' . $filter . '%');
      });
      if (!empty($roleFilter)) {
        $userQuery = $userQuery->whereRelation('roles', 'roles.name', '=', $roleFilter);
      }
      if ($master_filter !== 'null') {
        $userQuery = $userQuery->where('created_at', 'like', '%' . $master_filter . '%');
      }
    }
    $data = $userQuery->paginate(env('DEFAULT_PAGINATION', 10))->withQueryString();

    return view('admin.users.index', compact('data', 'roles', 'roleFilter'))->with('filter', $filter)->with('i', ($request->input('page', 1) - 1) *  env('DEFAULT_PAGINATION', 10));
  }



  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $roles = Role::pluck('name', 'name')->all();
    return view('admin.users.create', compact('roles'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|email|unique:users,email',
      'phone' => 'required|unique:users',
      'password' => 'required|same:confirm-password',
      'roles' => 'required'
    ]);

    $input = $request->all();
    $input['password'] = Hash::make($input['password']);
    $user = User::create($input);
    $user->assignRole($request->input('roles'));
    return redirect()->route('admin.users.index')->with('success', 'User created successfully');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $user = User::find($id);
    return view('admin.users.show', compact('user'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $user = User::find($id);
    $roles = Role::pluck('name', 'name')->all();
    $userRole = $user->roles->pluck('name', 'name')->all();

    return view('admin.users.edit', compact('user', 'roles', 'userRole'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'previous_url' => 'required',
      'name' => 'required',
      'email' => 'required|email|unique:users,email,' . $id,
      'password' => 'same:confirm-password',
      'roles' => 'required'
    ]);


    $input = $request->all();
    if (!empty($input['password'])) {
      $input['password'] = Hash::make($input['password']);
    } else {
      $input = Arr::except($input, array('password'));
    }

    $user = User::find($id);
    $user->update($input);
    DB::table('model_has_roles')->where('model_id', $id)->delete();
    $user->assignRole($request->input('roles'));
    unset($input['previous_url']);

    return redirect()->to($request->get('previous_url'))->with('success', 'User updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    User::find($id)->delete();
    return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
  }

  //update Password

  public function updatePassword(Request $request)
  {

    $request->validate([
      'oldPassoword' => 'required',
      'newPassword' => 'required',
      'confirmPassword' => 'required',

    ]);

    #Match The Old Password
    if (!Hash::check($request->oldPassoword, auth()->user()->password)) {
      return back()->with("error", "Old Password Doesn't match!");
    }

    // Current password and new password same
    if (!strcmp($request->newPassword, $request->confirmPassword) == 0) {

      return back()->with("error", "New Password and confirm pasword does not match");
    }
    #Update the new Password
    User::whereId(auth()->user()->id)->update([
      'password' => Hash::make($request->newPassword)
    ]);

    return back()->with("status", "Password changed successfully!");
  }
}
