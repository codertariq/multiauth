<?php

namespace Tariqul\Multiauth\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tariqul\Multiauth\Model\Admin;
use Yajra\Datatables\Datatables;

class RoleController extends Controller {
	public function __construct() {
		$this->middleware('auth:admin');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		return view('multiauth::admin.role.index');
	}
	/**
	 * Process datatables ajax request.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getRoles(Request $request) {
		if ($request->ajax()) {
			$roles = Role::all()->except(1);
			return Datatables::of($roles)
				->addColumn('can', function ($role) {
					$can = '';
					//$i = 1;
					foreach ($role->permissions as $key => $value) {
						$can .= '<span class="badge badge-success mr-1">' . $value->name . '</span>';
						/*if ($i < count($role->permissions)) {
								$can .= ', ';
							}
						*/
					}
					if (empty($can)) {
						$can = '<span class="badge badge-danger mr-1">' . trans('multilang::input.no_permission') . '</span>';
					}
					return $can;
					//return view('multiauth::action', compact('data', 'route'));
				})->addColumn('action', function ($data) {
				$route = 'role';
				return view('multiauth::action', compact('data', 'route'));
			})->addColumn('user', function ($role) {
				$users = Admin::role($role->id)->get()->count();
				if ($users > 0) {
					return '<span class="badge badge-success">' . $users . '</span>';
				}
				return '<span class="badge badge-danger">' . $users . '</span>';

			})->rawColumns(['action', 'user', 'can'])->make(true);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$permissions = Permission::all();
		return view('multiauth::admin.role.create', compact('permissions'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		//dd($request->permission);
		$validator = Validator::make($request->all(), [
			'role_name' => 'required|unique:roles,name|max:255',
			'permission.*' => 'required',
		]);

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		$role = Role::create(['name' => $request->role_name, 'guard_name' => 'admin']);

		$role->givePermissionTo($request->permission);

		return redirect(route('role.index'))->with('success', trans('multilang::msg.create_role'));

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, $id) {
		if ($id == 1) {
			return abort(401);
		}
		$role = Role::where('id', $id)->firstOrFail();
		$users = Admin::role($role->id)->get();

		return view('multiauth::admin.role.show', compact('role', 'users'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		if ($id == 1) {
			return abort(401);
		}
		$role = Role::where('id', $id)->firstOrFail();

		$permissions = Permission::all();
		return view('multiauth::admin.role.edit', compact(['role', 'permissions']));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$role = Role::where('id', $id)->firstOrFail();

		//dd($request->permission);
		$validator = Validator::make($request->all(), [
			'permission.*' => ['required'],
			'role_name' => ['required', 'max:255',
				Rule::unique('roles', 'name')->ignore($role->id)],
		]);

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		$role->name = $request->name;

		$role->syncPermissions($request->permission);

		return redirect(route('role.index'))->with('status', trans('multilang::msg.update_role'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$role = Role::where('id', $id)->firstOrFail();

		$role->delete();

		return redirect(route('role.index'))->with('status', trans('multilang::msg.delete_role'));

	}
}
