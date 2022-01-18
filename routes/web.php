<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Masters\ProductController;
use App\Http\Controllers\Masters\WarehouseController;
use App\Http\Controllers\Masters\TypeController;
use App\Http\Controllers\Masters\GroupController;
use App\Http\Controllers\Masters\UnitController;
use App\Http\Controllers\ActivityLogController;


Route::get('/', function () {
	return redirect()->route('login');
});


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('password/forget',  function () {
	return view('pages.forgot-password');
})->name('password.forget');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::group(['middleware' => 'auth'], function () {
	// logout route
	Route::get('/logout', [LoginController::class, 'logout']);
	Route::get('/clear-cache', [HomeController::class, 'clearCache']);

	// dashboard route  
	Route::get('/dashboard', function () {
		return view('pages.dashboard');
	})->name('dashboard');

	//only those have manage_user permission will get access
	Route::group(['middleware' => 'can:mengelola user'], function () {
		Route::get('user', [UserController::class, 'index']);
		Route::get('user/get-list', [UserController::class, 'getUserList']);
		Route::get('user/create', [UserController::class, 'create']);
		Route::post('user/create', [UserController::class, 'store'])->name('create.user');
		Route::get('user/{id}', [UserController::class, 'edit']);
		Route::post('user/update', [UserController::class, 'update']);
		Route::get('user/delete/{id}', [UserController::class, 'delete']);
	});

	//only those have manage_role permission will get access
	Route::group(['middleware' => 'can:mengelola role,mengelola user'], function () {
		Route::get('role', [RolesController::class, 'index']);
		Route::get('role/get-list', [RolesController::class, 'getRoleList']);
		Route::post('role/create', [RolesController::class, 'create']);
		Route::get('role/edit/{id}', [RolesController::class, 'edit']);
		Route::post('role/update', [RolesController::class, 'update']);
		Route::get('role/delete/{id}', [RolesController::class, 'delete']);
	});


	//only those have manage_permission permission will get access
	Route::group(['middleware' => 'can:mengelola permission,mengelola user'], function () {
		Route::get('permission', [PermissionController::class, 'index']);
		Route::get('permission/get-list', [PermissionController::class, 'getPermissionList']);
		Route::post('permission/create', [PermissionController::class, 'create']);
		Route::get('permission/update', [PermissionController::class, 'update']);
		Route::get('permission/delete/{id}', [PermissionController::class, 'delete']);
	});

	// get permissions
	Route::get('get-role-permissions-badge', [PermissionController::class, 'getPermissionBadgeByRole']);


	// permission examples
	Route::get('permission-example', function () {
		return view('permission-example');
	});
	// API Documentation
	Route::get('/rest-api', function () {
		return view('api');
	});
	// Editable Datatable
	Route::get('/table-datatable-edit', function () {
		return view('pages.datatable-editable');
	});

	// Themekit demo pages
	Route::get('/calendar', function () {
		return view('pages.calendar');
	});
	Route::get('/charts-amcharts', function () {
		return view('pages.charts-amcharts');
	});
	Route::get('/charts-chartist', function () {
		return view('pages.charts-chartist');
	});
	Route::get('/charts-flot', function () {
		return view('pages.charts-flot');
	});
	Route::get('/charts-knob', function () {
		return view('pages.charts-knob');
	});
	Route::get('/forgot-password', function () {
		return view('pages.forgot-password');
	});
	Route::get('/form-addon', function () {
		return view('pages.form-addon');
	});
	Route::get('/form-advance', function () {
		return view('pages.form-advance');
	});
	Route::get('/form-components', function () {
		return view('pages.form-components');
	});
	Route::get('/form-picker', function () {
		return view('pages.form-picker');
	});
	Route::get('/invoice', function () {
		return view('pages.invoice');
	});
	Route::get('/layout-edit-item', function () {
		return view('pages.layout-edit-item');
	});
	Route::get('/layouts', function () {
		return view('pages.layouts');
	});

	Route::get('/navbar', function () {
		return view('pages.navbar');
	});
	Route::get('/profile', function () {
		return view('pages.profile');
	});
	Route::get('/project', function () {
		return view('pages.project');
	});
	Route::get('/view', function () {
		return view('pages.view');
	});

	Route::get('/table-bootstrap', function () {
		return view('pages.table-bootstrap');
	});
	Route::get('/table-datatable', function () {
		return view('pages.table-datatable');
	});
	Route::get('/taskboard', function () {
		return view('pages.taskboard');
	});
	Route::get('/widget-chart', function () {
		return view('pages.widget-chart');
	});
	Route::get('/widget-data', function () {
		return view('pages.widget-data');
	});
	Route::get('/widget-statistic', function () {
		return view('pages.widget-statistic');
	});
	Route::get('/widgets', function () {
		return view('pages.widgets');
	});

	// themekit ui pages
	Route::get('/alerts', function () {
		return view('pages.ui.alerts');
	});
	Route::get('/badges', function () {
		return view('pages.ui.badges');
	});
	Route::get('/buttons', function () {
		return view('pages.ui.buttons');
	});
	Route::get('/cards', function () {
		return view('pages.ui.cards');
	});
	Route::get('/carousel', function () {
		return view('pages.ui.carousel');
	});
	Route::get('/icons', function () {
		return view('pages.ui.icons');
	});
	Route::get('/modals', function () {
		return view('pages.ui.modals');
	});
	Route::get('/navigation', function () {
		return view('pages.ui.navigation');
	});
	Route::get('/notifications', function () {
		return view('pages.ui.notifications');
	});
	Route::get('/range-slider', function () {
		return view('pages.ui.range-slider');
	});
	Route::get('/rating', function () {
		return view('pages.ui.rating');
	});
	Route::get('/session-timeout', function () {
		return view('pages.ui.session-timeout');
	});
	Route::get('/pricing', function () {
		return view('pages.pricing');
	});

	// product route
	Route::group(['middleware' => 'can:mengelola produk'], function () {
		Route::get('product/get-list', [ProductController::class, 'getProductList']);
		Route::get('product/show-form', [ProductController::class, 'showForm']);
		Route::resource('products', ProductController::class);
	});

	// warehouse route
	Route::get('warehouse/show-form', [WarehouseController::class, 'showForm']);
	Route::get('warehouse/get-list', [WarehouseController::class, 'getWarehouseList']);
	Route::get('warehouses', [WarehouseController::class, 'index'])->middleware('can:lihat gudang')->name('warehouses.index');
	Route::post('warehouses', [WarehouseController::class, 'store'])->middleware('can:tambah gudang')->name('warehouses.store');
	Route::get('warehouses/{warehouse}/edit', [WarehouseController::class, 'edit'])->name('warehouses.edit');
	Route::put('warehouses/{warehouse}', [WarehouseController::class, 'update'])->middleware('can:edit gudang')->name('warehouses.update');
	Route::delete('warehouses/{warehouse}', [WarehouseController::class, 'destroy'])->middleware('can:hapus gudang')->name('warehouses.destroy');

	// type route
	Route::get('product-type/show-form', [TypeController::class, 'showForm']);
	Route::get('product-type/get-list', [TypeController::class, 'getProductTypeList']);
	Route::get('product-types', [TypeController::class, 'index'])->middleware('can:lihat tipe produk')->name('product-types.index');
	Route::post('product-types', [TypeController::class, 'store'])->middleware('can:tambah tipe produk')->name('product-types.store');
	Route::get('product-types/{product_type}/edit', [TypeController::class, 'edit'])->name('product-types.edit');
	Route::put('product-types/{product_type}', [TypeController::class, 'update'])->middleware('can:edit tipe produk')->name('product-types.update');
	Route::delete('product-types/{product_type}', [TypeController::class, 'destroy'])->middleware('can:hapus tipe produk')->name('product-types.destroy');

	// group route
	Route::get('product-group/show-form', [GroupController::class, 'showForm']);
	Route::get('product-group/get-list', [GroupController::class, 'getProductGroupList']);	
	Route::get('product-groups', [GroupController::class, 'index'])->middleware('can:lihat grup produk')->name('product-groups.index');
	Route::post('product-groups', [GroupController::class, 'store'])->middleware('can:tambah grup produk')->name('product-groups.store');
	Route::get('product-groups/{product_group}/edit', [GroupController::class, 'edit'])->name('product-groups.edit');	
	Route::put('product-groups/{product_group}', [GroupController::class, 'update'])->middleware('can:edit grup produk')->name('product-groups.update');
	Route::delete('product-groups/{product_group}', [GroupController::class, 'destroy'])->middleware('can:hapus grup produk')->name('product-groups.destroy');


	// unit route
	Route::get('product-unit/show-form', [UnitController::class, 'showForm']);
	Route::get('product-unit/get-list', [UnitController::class, 'getProductUnitList']);
	Route::get('product-units', [UnitController::class, 'index'])->middleware('can:lihat unit produk')->name('product-units.index');
	Route::post('product-units', [UnitController::class, 'store'])->middleware('can:tambah unit produk')->name('product-units.store');
	Route::get('product-units/{product_unit}/edit', [UnitController::class, 'edit'])->name('product-units.edit');
	Route::put('product-units/{product_unit}', [UnitController::class, 'update'])->middleware('can:edit unit produk')->name('product-units.update');
	Route::delete('product-units/{product_unit}', [UnitController::class, 'destroy'])->middleware('can:hapus unit produk')->name('product-units.destroy');

	Route::group(['middleware' => 'can:melihat log aktivitas'], function () {
		Route::get('activity-log/get-list', [ActivityLogController::class, 'getActivityLogList']);
		Route::get('activity-log/{activity}/show', [ActivityLogController::class, 'show']);
		Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity.log');
	});
});
