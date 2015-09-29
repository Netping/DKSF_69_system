<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::group(array('before' => 'auth'), function () {
	//ниже идут запросы, требующие авторизованности пользователя

Route::get('/', function()
{
	return View::make("base")
	->with("currentMenu","main")
	->nest("conetent","intro.index",[])
	;
});

Route::get("/main",function()
{
	return View::make("base")
	->with("currentMenu","main")
	->nest("conetent","intro.main",[])
	;
});

Route::get("/admin",function()
{

		$admin = Admin::first();
		$admin_users = AdminUser::all();
		$admin_access_subnet = AdminAccessSubnet::all();
		$admin_ntp_servers = AdminNtpServer::all();

		// dd($admin);

	return View::make("base")
	->with("currentMenu","admin")
		->nest("conetent","intro.admin",[
				"admin" => $admin,
				"admin_users" => $admin_users,
				"admin_access_subnet" => $admin_access_subnet,
				"admin_ntp_servers" => $admin_ntp_servers
			])
	;
});

	Route::post("/admin/save",function()
	{
		$admin = Admin::first();

		// dd(Input::get("datetime_offset"),$admin);

		$admin->hostname = Input::get("hostname");
		$admin->location = Input::get("location");
		$admin->contacts = Input::get("contacts");
		$admin->access_read = Input::get("access_read");
		$admin->access_write = Input::get("access_write");
		$admin->access_filter = Input::get("access_filter");
		$admin->timezone = Input::get("timezone");
		$admin->datetime_offset	 = Input::get("datetime_offset");
		// $admin->time = Input::get("time");
		$admin->save();

		return "ok";

	});

	Route::post("/admin/save/users",function()
	{

		DB::table('admin_users')->truncate();

		$users = Input::get("users");

		$insert_users_arr = [];


		foreach($users as $user)
		{
			$insert_users_arr[] = 
			[
				"id" => $user['id'],
				"username" => $user['username'],
				"password" => Hash::make($user['password']),
				"access_level" => $user['access_level']
			];
		}

		DB::table("admin_users")->insert($insert_users_arr);

		return "ok";

	});

	Route::post("/admin/save/subnets",function()
	{
		DB::table('admin_access_subnet')->truncate();
		
		$subnets = Input::get("subnets");

		$insert_subnet_arr = [];


		foreach($subnets as $subnet)
		{
			$insert_subnet_arr[] = 
			[
				"id" => $subnet['id'],
				"subnet" => $subnet['subnet']
			];
		}

		DB::table("admin_access_subnet")->insert($insert_subnet_arr);

		return "ok";

	});

	Route::post("/admin/save/ntps",function()
	{

		DB::table('admin_ntp_servers')->truncate();
		
		$ntps = Input::get("ntps");

		$insert_ntp_arr = [];


		foreach($ntps as $ntp)
		{
			$insert_ntp_arr[] = 
			[
				"id" => $ntp['id'],
				"ntp_server" => $ntp['ntp']
			];
		}

		DB::table("admin_ntp_servers")->insert($insert_ntp_arr);

		return "ok";

	});



Route::get("/network",function()
{
	return View::make("base")
	->with("currentMenu","network")
	->nest("conetent","intro.networks_settings",[])
	;
});

Route::get("/notifications/config",function()
{
	return View::make("base")
	->with("currentMenu","notifications/config")
	->nest("conetent","intro.notifications_config",[])
	;
});

Route::get("/firmware",function()
{
	return View::make("base")
	->with("currentMenu","firmware")
	->nest("conetent","intro.firmware")
	;
});

Route::get("/log",function()
{
	return View::make("base")
	->with("currentMenu","log")
	->nest("conetent","intro.log",[])
	;
});

Route::get("/sockets",function()
{
	return View::make("base")
	->with("currentMenu","sockets")
	->nest("conetent","intro.sockets",[])
	;
});

Route::get("/sensors",function()
{
	return View::make("base")
	->with("currentMenu","sensors")
	->nest("conetent","intro.sensors",[])
	;
});

Route::get("/notifications",function()
{
	return View::make("base")
	->with("currentMenu","notifications")
	->nest("conetent","intro.notifications",[])
	;
});

Route::get("/reports",function()
{
	return View::make("base")
	->with("currentMenu","reports")
	->nest("conetent","intro.reports",[])
	;
});

Route::get("/logic",function()
{
	return View::make("base")
	->with("currentMenu","logic")
	->nest("conetent","intro.logic",[])
	;
});
});//конец запросов, требующих авторизованности



//сбрасываем все настройки в значение "по умолчанию"
Route::get("/set/default/settings",function()
{
	//ADMIN

	//clear
	DB::table('admin')->truncate();
	DB::table('admin_users')->truncate();
	DB::table('admin_access_subnet')->truncate();
	DB::table('admin_ntp_servers')->truncate();
	

	//set defaults
	$admin = new Admin();
	$admin->hostname = "hostname";
	$admin->location = "location";
	$admin->contacts = "contacts";
	$admin->access_read = "access_read";
	$admin->access_write = "access_write";
	$admin->access_filter = "access_filter";
	$admin->timezone = "3.0";
	$admin->datetime_offset = 0;
	$admin->save();

	$admin_users = new AdminUser();
	$admin_users->username = "admin";
	$admin_users->password = Hash::make("admin");
	$admin_users->access_level = "admin";
	$admin_users->remember_token = Hash::make(time());
	$admin_users->save();

	$admin_access_subnet = new AdminAccessSubnet();
	$admin_access_subnet->subnet = "192.168.0.1";
	$admin_access_subnet->save();

	$admin_ntp_servers = new AdminNtpServer();
	$admin_ntp_servers->ntp_server = "192.168.0.1";
	$admin_ntp_servers->save();

	//

	return "settings was set default.";
});

Route::get("/login",function()
{
	return View::make("intro.login");
	;
});

Route::post("/login",function()
{
	$username = Input::get("username");
	$password = Input::get("password");

	// dd(AdminUser::all());

	if(Auth::attempt(["username"=>$username,"password"=>$password]))
	{
		return Response::json(
			[
				"status" =>"ok",
				"info"=>""
			]);
	}
	else
	{
		return Response::json(
			[
				"status" =>"error",
				"info"=> Lang::get('login.login_error')
			]);
	}
});

Route::get("/logout",function()
{
	Auth::logout();
	return Redirect::back();//to("/");
});