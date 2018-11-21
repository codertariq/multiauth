<?php

namespace Tariqul\Multiauth\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Tariqul\Multiauth\Model\Admin;
use Yajra\Datatables\Datatables;

class AdminController extends Controller {

	public function __construct() {
		$this->middleware('auth:admin');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('multiauth::admin.admin.index');
	}

	/**
	 * Process datatables ajax request.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getUsers(Request $request) {
		if ($request->ajax()) {
			$admins = Admin::all();
			return Datatables::of($admins)
				->addColumn('name', function ($admin) {
					return $admin->first_name . ' ' . $admin->last_name;
				})->addColumn('roles', function ($admin) {
				$role = '';
				foreach ($admin->roles as $key => $value) {
					$role .= '<span class="badge badge-success mr-1">' . $value->name . '</span>';
				}
				if (empty($role)) {
					$role = '<span class="badge badge-danger">' . trans('multilang::index.no_role') . '</span>';
				}
				return $role;
			})->addColumn('action', function ($admin) {
				return view('multiauth::admin.admin.column', compact('admin'));
			})->editColumn('status', function ($admin) {
				return view('multiauth::admin.admin.status', compact('admin'));
			})->rawColumns(['status', 'action', 'roles'])->make(true);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('multiauth::auth.register');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$admin = Admin::where('id', $id)->firstOrFail();
		return view('multiauth::admin.admin.edit', compact('admin'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {

		$admin = Admin::where('id', $id)->firstOrFail();
		$validator = Validator::make($request->all(), [
			'first_name' => ['required', 'string', 'max:255'],
			'last_name' => ['required', 'string', 'max:255'],
			'dob' => ['required', 'date'],
			'nid' => ['required', 'string', 'max:17', 'min:17', Rule::unique('admins')->ignore($admin->id)],
			'address' => ['required', 'string', 'max:255'],
			'city' => ['required', 'string', 'max:255'],
			'gender' => ['required', 'integer', 'max:1'],
			'image' => ['sometimes', 'mimes:jpeg,bmp,png'],
			'mobile' => ['required', 'string', 'max:11', 'min:11', Rule::unique('admins')->ignore($admin->id)],
			'email' => ['required', 'string', 'email', 'max:255', Rule::unique('admins')->ignore($admin->id)],
		]);
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		if (isset($request->image_action)) {
			if ($request->image_action == 0) {
				$path = Null;
			} elseif ($request->image_action == 2) {
				if (isset($request->image)) {
					$image = $request->image;
					$filepath = 'profile' . DIRECTORY_SEPARATOR . date('FY') . DIRECTORY_SEPARATOR;
					$path = $image->store($filepath);
				} else {
					$path = Null;
				}
			} else {
				$validator = Validator::make($request->all(), [
					'image' => ['required', 'mimes:jpeg,bmp,png'],
				]);
				if ($validator->fails()) {
					return redirect()->back()
						->withErrors($validator)
						->withInput();
				}
				$image = $request->image;
				$filepath = 'profile' . DIRECTORY_SEPARATOR . date('FY') . DIRECTORY_SEPARATOR;
				$path = $image->store($filepath);
			}
		} else {
			$path = $admin->image;
		}
		//dd($path);
		$admin->update($request->except('image'));

		$admin->image = $path;
		$admin->save();

		return redirect(route('admin.index'))->with('success', trans('multilang::msg.admin_update'));

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$user = Admin::where('id', $id)->firstOrFail();

		$user->delete();

		return back()->with('danger', trans('multilang::msg.admin_delete'));
	}

	public function changePassword() {
		$admin = Admin::where('id', Auth::user()->id)->firstOrFail();
		$token = Str::random(60);
		Session::put('token', $token);
		return view('multiauth::admin.admin.changePassword', compact('admin', 'token'));
	}

	public function updatePassword(Request $request) {
		if ($request->id != Auth::user()->id) {
			return abort(401);
		} elseif (Session::get('token') != $request->token) {
			return redirect()->back()
				->withErrors(['password' => trans('password.token')]);
		}
		$admin = Admin::where('id', Auth::user()->id)->firstOrFail();
		$validator = Validator::make($request->all(), [
			'password' => 'required|string|min:6|confirmed',
		]);
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator);
		}
		$password = Hash::make($request->password);
		$admin->password = $password;
		$admin->save();
		Session::put('token', Null);
		return redirect()->back()->with('success', trans('multilang::msg.password_change'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function userEdit() {
		$token = Str::random(60);
		Session::put('token', $token);
		$admin = Admin::where('id', Auth::user()->id)->firstOrFail();
		return view('multiauth::admin.admin.edit', compact('admin', 'token'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function userUpdate(Request $request) {
		//dd($request->all());
		if ($request->id != Auth::user()->id) {
			return abort(401);
		} elseif (Session::get('token') != $request->token) {
			return redirect()->back()
				->with(['danger' => trans('password.token')]);
		}
		$admin = Admin::where('id', Auth::user()->id)->firstOrFail();
		$validator = Validator::make($request->all(), [
			'first_name' => ['required', 'string', 'max:255'],
			'last_name' => ['required', 'string', 'max:255'],
			'dob' => ['required', 'date'],
			'nid' => ['required', 'string', 'max:17', 'min:17', Rule::unique('admins')->ignore($admin->id)],
			'address' => ['required', 'string', 'max:255'],
			'city' => ['required', 'string', 'max:255'],
			'gender' => ['required', 'integer', 'max:1'],
			'image' => ['sometimes', 'mimes:jpeg,bmp,png'],
			'mobile' => ['required', 'string', 'max:11', 'min:11', Rule::unique('admins')->ignore($admin->id)],
			'email' => ['required', 'string', 'email', 'max:255', Rule::unique('admins')->ignore($admin->id)],
		]);
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		if (isset($request->image_action)) {
			if ($request->image_action == 0) {
				$path = Null;
			} elseif ($request->image_action == 2) {
				if (isset($request->image)) {
					$image = $request->image;
					$filepath = 'profile' . DIRECTORY_SEPARATOR . date('FY') . DIRECTORY_SEPARATOR;
					$path = $image->store($filepath);
				} else {
					$path = Null;
				}
			} else {
				$validator = Validator::make($request->all(), [
					'image' => ['required', 'mimes:jpeg,bmp,png'],
				]);
				if ($validator->fails()) {
					return redirect()->back()
						->withErrors($validator)
						->withInput();
				}
				$image = $request->image;
				$filepath = 'profile' . DIRECTORY_SEPARATOR . date('FY') . DIRECTORY_SEPARATOR;
				$path = $image->store($filepath);
			}
		} else {
			$path = $admin->image;
		}
		//dd($path);
		$admin->update($request->except('image'));

		$admin->image = $path;
		$admin->save();

		return redirect()->back()->with('success', trans('multilang::msg.admin_update'));

	}

	public function action($id) {
		if ($id == Auth::user()->id) {
			return redirect()->back()->with('danger', trans('multilang::msg.unauth'));
		}
		$admin = Admin::where('id', $id)->firstOrFail();
		if ($admin->status == 1) {
			$admin->status = 0;
			$msg = trans('multilang::msg.admin_suspend');
		} else {
			$admin->status = 1;
			$msg = trans('multilang::msg.admin_activate');
		}
		$admin->save();
		return back()->with('success', $msg);

	}

	public function assignRole($id) {
		$token = Str::random(60);
		Session::put('token', $token);
		$admin = Admin::where('id', $id)->firstOrFail();
		$roles = Role::all()->except(1);
		return view('multiauth::admin.admin.role', compact('admin', 'roles', 'token'));
	}
	public function syncRole(Request $request, $id) {
		if ($request->id == Auth::user()->id) {
			return abort(401);
		} elseif ($request->id != $id) {
			return abort(401);
		} elseif (Session::get('token') != $request->token) {
			return redirect()->back()
				->with(['danger' => trans('password.token')]);
		}
		//dd($request->all());
		$role = '';
		if ($request->roles) {
			$i = 1;
			foreach ($request->roles as $key => $value) {
				if ($value == 1) {
					return abort(401);
				} else {
					$roleName = Role::where('id', $value)->first();
					$role .= $roleName->name;
					if ($i < count($request->roles)) {
						$role .= ', ';
					}
					$i++;
				}
			}
		}
		$admin = Admin::where('id', $id)->firstOrFail();

		$admin->syncRoles($request->roles);
		return redirect()->route('admin.index')->with('success', trans('multilang::msg.assign_role'));

	}

}
