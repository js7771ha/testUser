<?php
/**
 * @file    routes/mobile.php
 * @brief   모다홈페이지 모바일 라우터 정보
 * @autho   yhlim
 * @date    20190911
 **/

Route::domain(env('APP_MOBILE_URL', 'm.modaoutlet.com'))->group(function () {

    Route::get('/layout/mobile', function () {
        return view('mobile.layouts.mobile');
    });

    Route::get('/popup/setting', function () {
        return view('mobile.popup.setting');
    })->name('m.app.setting');

    Route::get('/sso/login', 'mobile\sso\SsoController@login')->name('m.sso.login');
    Route::get('/sso/login_proc', 'mobile\sso\SsoController@login_proc')->name('m.sso.login_proc');
    Route::get('/sso/logout', 'mobile\sso\SsoController@logout')->name('m.sso.logout');
    Route::get('/sso/auth', 'mobile\sso\SsoController@auth')->name('m.sso.auth');
    Route::get('/sso/auth_proc', 'mobile\sso\SsoController@auth_proc')->name('m.sso.auth_proc');

    /*toolbar 포인트세션*/
    Route::get('/sso/pointRefresh', 'mobile\sso\SsoController@pointRefresh')->name('m.sso.point_refresh');

    /* toolbar 멤버쉽바코드 */
    Route::get('/popup/barcode', function () {
        return view('mobile.popup.barcode');
    })->name('m.membership.barcode');

    /* 메인 */
    Route::get('/', 'mobile\MainController@main')->name('m.main');
    Route::get('/eventclick', 'mobile\MainController@eventClickCount')->name('m.eventclick');

    /* 마이페이지 */
    Route::get('/mypage', 'mobile\mypage\MypageController@mypage')->name('m.mypage');
    Route::get('/mypage/qna/{ix}', 'mobile\mypage\MypageController@qnaDetail')->name('m.mypage.qna.detail');

	/* 지점안내 */
    Route::get('/branchpopup/{ix?}', function($ix=null){
        return view('mobile.branchinfo.popup', array("ix"=>$ix));
    })->name('m.branchpopup');

	Route::prefix('branchinfo')->group(function () {
		Route::get('/{ix?}', 'mobile\branchinfo\BranchinfoController@branch_info')->name('m.branchinfo');
        Route::get('/{ix}/branchselect', 'mobile\branchinfo\BranchinfoController@branch_select')->name('m.branchselect');
		Route::get('/floorinfo/{ix}', 'mobile\branchinfo\BranchinfoController@floor_info')->name('m.floorinfo');
        Route::get('/convenience/{branch_ix}', 'mobile\branchinfo\BranchinfoController@convenience')->name('m.convenience');
        Route::get('/transfort/{ix}', 'mobile\branchinfo\BranchinfoController@transfort')->name('m.transfort');
	});

    /* 선호지점 변경 */
    Route::post('/changebranch', 'mobile\branchinfo\BranchinfoController@branchChage')->name('m.changebranch');

	/* 혜택 */
	Route::get('/benefit', 'mobile\benefit\BenefitController@benefit')->name('m.benefit');

    /* 고객센터 */
	Route::group(['prefix' => 'cs'], function () {
		Route::get('/faq', 'mobile\cs\FaqController@list')->name('m.faq_list');
		Route::get('/claim/claim_write', 'mobile\cs\ClaimController@claim_write')->name('m.claim_write');
		Route::get('/claim/idea_write', 'mobile\cs\ClaimController@idea_write')->name('m.idea_write');
		Route::post('/claim/store', 'mobile\cs\ClaimController@store')->name('m.claim_store');
		Route::get('/institution', 'mobile\cs\InstitutionController@list')->name('m.institution_list');
		Route::get('/notice', 'mobile\cs\NoticeController@list')->name('m.notice_list');
		Route::get('/notice/{ix}', 'mobile\cs\NoticeController@detail')->name('m.notice_detail');
	});

	/* 이용약관 */
    Route::prefix('agreement')->group(function () {
        Route::get('/agreement/{ix?}', 'mobile\agreement\AgreeMentController@agreement')->name('m.agreement');
        Route::get('/privacy/{ix?}', 'mobile\agreement\AgreeMentController@agreement')->name('m.privacy');
        Route::get('/email/{ix?}', 'mobile\agreement\AgreeMentController@agreement')->name('m.email');
    });

    /* 사업제휴 */
    Route::prefix('partnership')->group(function(){
        Route::prefix('contact')->group(function(){
            Route::get('regist', 'mobile\partnership\ContactController@createContact')->name('m.partnership.contact.regist');
            Route::post('save', 'mobile\partnership\ContactController@insertContact')->name('m.partnership.contact.save');
        });
        Route::prefix('marketing')->group(function(){
            Route::get('regist', 'mobile\partnership\MarketingController@createContact')->name('m.partnership.marketing.regist');
            Route::post('save', 'mobile\partnership\MarketingController@insertContact')->name('m.partnership.marketing.save');
        });
    });

    /* 이벤트/프로모션 */
	Route::prefix('promotion')->group(function() {
		Route::get('event/', 'mobile\promotion\EventController@list')->name('m.event_list');
		Route::get('event/{ix}', 'mobile\promotion\EventController@detail')->name('m.event_detail');
		Route::get('shoppingnews', 'mobile\promotion\ShoppingNewsController@list')->name('m.shoppingnews_list');
		Route::get('shoppingnews/{ix}', 'mobile\promotion\ShoppingNewsController@detail')->name('m.shoppingnews_detail');
		Route::prefix('pr')->group(function() {
			Route::get('gallary/{ix?}', 'mobile\promotion\pr\GallaryController@list')->name('m.gallary_list');
            Route::get('gallary/view/{ix}', 'mobile\promotion\pr\GallaryController@view')->name('m.gallary_view');
			Route::get('article/{ix?}', 'mobile\promotion\pr\ArticleController@list')->name('m.article_list');
		});
	});

    /* 푸쉬알림 */
    Route::prefix('apppush')->group(function() {
        Route::get('list', 'mobile\apppush\AppPushController@list')->name('m.apppush_list');
    });

    Route::fallback(function(){
        abort(404);
    });
});

