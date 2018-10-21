<?php
/**
 * Created by PhpStorm.
 * User: mehmetcanhoroz
 * Date: 17.10.2018
 * Time: 01:35
 */

Route::get('/backend', function () {
    return view("layouts.backend");
});

/*
Route::get("/admin/login", "Auth\LoginController@showLoginForm")->name("backend.login");
Route::post("/admin/login", "Auth\LoginController@login");
Route::get("/admin/logout", "Auth\LoginController@logout")->name("backend.logout");
*/

Route::group(["prefix" => "admin", "as" => "backend", "namespace" => "Backend"], function () {

    Route::group(["as" => ".home", "namespace" => "Home"], function () {
        Route::get("/", "HomeController@index")->name(".index");
    });

    Route::group(["prefix" => "category", "as" => ".category", "namespace" => "Category"], function () {
        Route::get("/", "CategoryController@index")->name(".index");
        Route::get("/create", "CategoryController@create")->name(".create");
        Route::post("/createpost", "CategoryController@createpost")->name(".createpost");
        Route::post("/delete", "CategoryController@delete")->name(".delete");
    });

});