<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login','LoginController@index');
Route::post('/login-new','LoginController@store')->name('pasok');
Route::get('/logout','LoginController@logout')->name('gawas');

Route::get('/dashboard','DashboardController@index')->name('dashboard.index');

Route::get('/expense/delete-entry/{id}','ExpenseController@delete');
Route::resource('/expenses','ExpenseController');

Route::get('/income/delete-entry/{id}','IncomeController@delete');
Route::resource('/incomes','IncomeController');

Route::get('/organization/delete-entry/{id}','OrganizationController@delete');
Route::resource('/organizations','OrganizationController');

Route::get('/role/delete-entry/{id}','RoleController@delete');
Route::resource('roles','RoleController');

Route::get('/user/delete-entry/{id}','UserController@delete');
Route::get('/user/reset-password/{id}','UserController@reset');
Route::resource('/users','UserController');

Route::get('/org-income/delete-entry/{id}','OrgIncomeController@delete');
Route::get('/org-income/approve-entry/{id}','OrgIncomeController@approved')->name('org-incomes.approved');
Route::resource('/org-incomes','OrgIncomeController');

Route::get('/org-expense/delete-entry/{id}','OrgExpenseController@delete');
Route::get('/org-expense/approve-entry/{id}','OrgExpenseController@approved')->name('org-expenses.approved');
Route::resource('/org-expenses','OrgExpenseController');

Route::get('/report/print-finance-report','ReportController@view_finance_report')->name('report.finance');
Route::post('/report/print-finance-report','ReportController@print_finance_report');


