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
    return 'welcome';
});

Route::get('/list', 'testuser\TestUserController@index')->name('testuser_index');                       // 리스트
Route::get('/list/del', 'testuser\TestUserController@indexDel')->name('testuser_indexdel');             // 삭제 리스트
Route::get('/create', 'testuser\TestUserController@create')->name('testuser_create');                   // 신규 등록 폼
Route::post('/store', 'testuser\TestUserController@store')->name('testuser_store');                     // 등록
Route::get('/detail/{user_idx?}', 'testuser\TestUserController@detail')->name('testuser_detail');        // user 상세정보
Route::get('/edit/{user_idx?}', 'testuser\TestUserController@edit')->name('testuser_edit');              // user 상세정보 수정 폼
Route::post('/update/{user_idx}', 'testuser\TestUserController@update')->name('testuser_update');       // 업데이트
Route::get('/delete/{user_idx?}', 'testuser\TestUserController@destroy')->name('testuser_destroy');     // 삭제
Route::POST('/delete/all', 'testuser\TestUserController@allDestroy')->name('testuser_alldestroy');      // 일괄 삭제
Route::post('/restore', 'testuser\TestUserController@restore')->name('testuser_restore');               // 복구
Route::post('/restore/all', 'testuser\TestUserController@allRestore')->name('testuser_allrestore');     // 전체 복구

Route::post('/ajax/id_check', 'testuser\TestUserController@idCheck')->name('testuser_idcheck');         // 아이디 체크
Route::post('/ajax/pwd_check', 'testuser\TestUserController@pwdCheck')->name('testuser_pwdcheck');      // 비밀번호 체크

Route::get('/ajax/upindex', 'testuser\TestUserController@upIndex')->name('testuser_upindex');           // 순번변경(위)
Route::get('/ajax/downindex', 'testuser\TestUserController@downIndex')->name('testuser_downindex');     // 순번변경(아래)
