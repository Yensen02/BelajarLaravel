<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Operator Controller
Route::get('/operator/login','Auth\OperatorLoginController@showLoginForm')->name('operator.login');
Route::post('/operator/login','Auth\OperatorLoginController@login')->name('operator.login.submit');
Route::get('/operator','OperatorController@index')->name('operator.dashboard');
Route::get('/opprofile','OperatorController@profile');
//User Controller
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile','HomeController@profile')->name('Profile');
//Mobil Controller
Route::get('/mobil/tambah','HomeController@tambah')->name('TambahMobil');
Route::get('/mobil','MobilController@index');
Route::get('/mobil/{id}/edit','MobilController@edit');
Route::post('/mobil/store','MobilController@store')->name('AddData');
Route::post('/mobil/update','MobilController@update');  
route::get('/mobil/{id}/hapus','MobilController@hapus');
//Gedung Controller
Route::get('/gedung/{id}/tambah','GedungController@create');
Route::get('/gedung/{id}','GedungController@infogedung');
Route::post('/gedung/store','GedungController@store');
Route::post('/gedung/update','GedungController@update');  
Route::get('/gedung','GedungController@gedung');
//Saldo Controller
Route::get('/saldo','SaldoController@info');
Route::get('/saldo/{id}','SaldoController@infouser');
Route::post('/saldo/tambah','SaldoController@tambah');
Route::post('/saldo/cari','SaldoController@cari');
//SlotAdminController
Route::get('/slot/custom','SlotParkirController@custom');
route::get('/slot/{id}','SlotParkirController@index');
Route::get('/slotparkir/{id}','LantaiController@slotindex');
route::post('/slot/show','SlotParkirController@show');
Route::post('/slot/deletefull','SlotParkirController@fulldelete');
Route::get('/slot/{id}/add','SlotParkirController@tambah10');
Route::post('/slot/delete','SlotParkirController@delete');
Route::post('/slot/tambahlayout','SlotParkirController@tambah');
Route::post('/slotparkir/editinfo','SlotParkirController@store');   
Route::post('/slotparkir/deleteinfo','SlotParkirController@store1'); 
//AdminController
Route::get('/admin','AdminController@Index')->name('admin.dashboard');
Route::get('/admin/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login','Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/daftarop','AdminController@daftar');
Route::post('/daftarop/store','AdminController@store');
Route::get('/operatorinfo','AdminController@opindex');
Route::get('/slotoperator/{id}/edit','AdminController@edit');
Route::post('/slotoperator/delete','AdminController@hapus');
Route::post('/slotoperator/ganti','AdminController@ganti');
Route::get('/slotoperator/{id}','AdminController@infooperator');
Route::post('/slotoperator/edit','AdminController@editaccount');
//Operator Slot
Route::get('/opslotoperator/layout','OperatorSlotController@index')->name('');
Route::get('/opslotoperator/layout/{id}','OperatorSlotController@edit');    
Route::post('/opslotoperator/editinfo','OperatorSlotController@store');
Route::post('/opslotoperator/deleteinfo','OperatorSlotController@store1');
Route::post('/opslotoperator/delete10','OperatorSlotController@delete');
Route::post('/opslotoperator/deletefull','OperatorSlotController@fulldelete');
Route::post('/opslotoperator/tambahlayout','OperatorSlotController@tambah');
Route::get('/opslotoperator/{id}/tambah10','OperatorSlotController@tambah10');
//Lantai Controller
Route::post('/slot/tambahlantai','SlotParkirController@tambahlantai');
Route::get('/lantai/{id}','LantaiController@index');
Route::get('/lantaitest/{id}','LantaiController@index1');
Route::get('/lantaioperator/{id}','OperatorSlotController@indexlantaioperator');
Route::post('/slot/deletelantai','SlotParkirController@deletelantai');
Route::post('/opslotoperator/tambahlantai','OperatorSlotController@tambahlantai');
Route::post('/opslotoperator/deletelantai','OperatorSlotController@deletelantai');
Route::post('/lantai/tambahlayout','LantaiController@tambah');
//test Controller
Route::post('/lantaitest/tambah','LantaiController@tambahtest');
Route::post('/lantaitestdelete/delete','LantaiController@deletetest');
Route::get('/lantaitestdelete/{id}','LantaiController@index2');