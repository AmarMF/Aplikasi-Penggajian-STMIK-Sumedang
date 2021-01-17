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

Route::get('login', 'LoginController@index')->name('karyawan.login');
Route::post('login/store', 'LoginController@store')->name('karyawan.login.store');
Route::post('login/logout', 'LoginController@logout')->name('karyawan.login.logout');

Route::group(['middleware' => 'auth:karyawan'], function(){
	Route::get('/', 'KaryawanController@index')->name('karyawan.karyawan');
	Route::get('/data', 'KaryawanController@data')->name('karyawan.karyawan.data');
	Route::get('/print_pdf/{id}', 'KaryawanController@exportpdfbyid')->name('karyawan.karyawan.exportpdfbyid');
	Route::get('/pengaturan', 'KaryawanController@pengaturan')->name('karyawan.karyawan.pengaturan');
	Route::post('/pengaturan/store', 'KaryawanController@pengaturanstore')->name('karyawan.karyawan.pengaturan.store');
});

Route::group(['prefix' => 'internal'], function(){
	Route::get('login', 'Internal\Auth\LoginController@index')->name('login.form');
	Route::post('login/store', 'Internal\Auth\LoginController@store')->name('login.store');
	Route::post('login/logout', 'Internal\Auth\LoginController@logout')->name('login.logout');

	Route::group(['middleware' => 'auth:pengguna'], function(){

		Route::get('/', 'Internal\Upload\UploadController@index')->name('upload');

		Route::group(['prefix' => 'upload'], function(){
			Route::get('/', 'Internal\Upload\UploadController@index')->name('upload');
			Route::get('data/{id}', 'Internal\Upload\UploadController@data')->name('upload.data');
			Route::post('store', 'Internal\Upload\UploadController@store')->name('upload.store');
			Route::get('data_upload', 'Internal\Upload\UploadController@dataupload')->name('upload.dataupload');
			Route::delete('destroy', 'Internal\Upload\UploadController@destroy')->name('upload.destroy');
		});

		Route::group(['prefix' => 'slipgaji'], function(){
			Route::get('/', 'Internal\Slipgaji\SlipgajiController@index')->name('slipgaji');
			Route::get('data', 'Internal\Slipgaji\SlipgajiController@data')->name('slipgaji.data');
			Route::get('datafilter/{bulan}/{tahun}', 'Internal\Slipgaji\SlipgajiController@datafilter')->name('slipgaji.datafilter');
			Route::get('print_pdf/{id}/{date}', 'Internal\Slipgaji\SlipgajiController@exportpdfbyid')->name('slipgaji.printpdf');
			Route::get('filter', 'Internal\Slipgaji\SlipgajiController@filter')->name('slipgaji.filter');
			Route::get('review', 'Internal\Slipgaji\SlipgajiController@review')->name('slipgaji.review');
			Route::get('review/actionpublish', 'Internal\Slipgaji\SlipgajiController@publish')->name('slipgaji.review.actionpublish');
			Route::get('review/actioncancelpublish', 'Internal\Slipgaji\SlipgajiController@cancelpublish')->name('slipgaji.review.actioncancelpublish');
			Route::post('print_pdf', 'Internal\Slipgaji\SlipgajiController@exportpdfall')->name('slipgaji.printpdfall');
		});

		Route::group(['prefix' => 'karyawan', 'middleware' => 'auth:pengguna'], function() {
			Route::get('/', 'Internal\Karyawan\KaryawanController@index')->name('karyawan');
			Route::get('data_karyawan', 'Internal\Karyawan\KaryawanController@datakaryawan')->name('karyawan.datakaryawan');
			Route::get('single_data_karyawan/{id}', 'Internal\Karyawan\KaryawanController@singledatakaryawan')->name('karyawan.singledatakaryawan');
			Route::post('store', 'Internal\Karyawan\KaryawanController@store')->name('karyawan.store');
			Route::put('update/{id}', 'Internal\Karyawan\KaryawanController@update')->name('karyawan.update');
			Route::delete('destroy/{id}', 'Internal\Karyawan\KaryawanController@destroy')->name('karyawan.destroy');
		});

		Route::group(['prefix' => 'pengguna', 'middleware' => 'auth:pengguna'], function(){
			Route::get('/', 'Internal\Pengguna\PenggunaController@index')->name('pengguna');
			Route::get('data_pengguna', 'Internal\Pengguna\PenggunaController@datapengguna')->name('pengguna.datapengguna');
			Route::get('single_data_pengguna/{id}', 'Internal\Pengguna\PenggunaController@singledatapengguna')->name('penguna.singledatapenguna');
			Route::post('store', 'Internal\Pengguna\PenggunaController@store')->name('pengguna.store');
			Route::put('update/{id}', 'Internal\Pengguna\PenggunaController@update')->name('pengguna.update');
			Route::delete('destroy/{id}', 'Internal\Pengguna\PenggunaController@destroy')->name('pengguna.destroy');
		});

		Route::group(['prefix' => 'jabatan', 'middleware' => 'auth:pengguna'], function(){
			Route::get('/', 'Internal\Jabatan\JabatanController@index')->name('jabatan');
			Route::get('data_jabatan', 'Internal\Jabatan\JabatanController@datajabatan')->name('jabatan.datajabatan');
			Route::get('single_data_jabatan/{id}', 'Internal\Jabatan\JabatanController@singledatajabatan')->name('jabatan.singledatajabatan');
			Route::post('store', 'Internal\Jabatan\JabatanController@store')->name('jabatan.store');
			Route::put('update/{id}', 'Internal\Jabatan\JabatanController@update')->name('jabatan.update');
			Route::delete('destroy/{id}', 'Internal\Jabatan\JabatanController@destroy')->name('jabatan.destroy');
		});

		Route::group(['prefix' => 'tunjangan', 'middleware' => 'auth:pengguna'], function(){
			Route::get('/', 'Internal\Tunjangan\TunjanganController@index')->name('tunjangan');
			Route::get('data_tunjangan', 'Internal\Tunjangan\TunjanganController@datatunjangan')->name('tunjangan.datatunjangan');
			Route::get('single_data_tunjangan/{id}', 'Internal\Tunjangan\TunjanganController@singledatatunjangan')->name('tunjangan.singledatatunjangan');
			Route::post('store', 'Internal\Tunjangan\TunjanganController@store')->name('tunjangan.store');
			Route::put('update/{id}', 'Internal\Tunjangan\TunjanganController@update')->name('tunjangan.update');
			Route::delete('destroy/{id}', 'Internal\Tunjangan\TunjanganController@destroy')->name('tunjangan.destroy');
		});

		Route::group(['prefix' => 'transport', 'middleware' => 'auth:pengguna'], function(){
			Route::get('/', 'Internal\Transport\TransportController@index')->name('transport');
			Route::get('data_transport', 'Internal\Transport\TransportController@datatransport')->name('jabatan.datatransport');
			Route::get('single_data_transport/{id}', 'Internal\Transport\TransportController@singledatatransport')->name('jabatan.singledatatransport');
			Route::post('store', 'Internal\Transport\TransportController@store')->name('transport.store');
			Route::put('update/{id}', 'Internal\Transport\TransportController@update')->name('transport.update');
			Route::delete('destroy/{id}', 'Internal\Transport\TransportController@destroy')->name('transport.destroy');
		});
	});
});
