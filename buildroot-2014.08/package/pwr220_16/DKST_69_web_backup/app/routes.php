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
	return View::make("base")
	->with("currentMenu","admin")
	->nest("conetent","intro.admin",[])
	;
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
