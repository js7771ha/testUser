<?php

namespace App\Providers;

use App\Helpers\mmLibHelper;
use Illuminate\Support\ServiceProvider;
use App\models\branch\Branch;
use App\models\award_banner\Award_banner;
use App\models\floating_banner\Floating_banner;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\statistics\StatisticsController;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // https://artisansweb.net/how-to-log-query-in-laravel/
        // https://stackoverflow.com/questions/44112238/check-if-input-is-from-console 콘솔실행 체크
        // .env 파일 APP_DEBUG 설정에 따라 일자별 퀴리 로그 생성함
        if (config('app.debug')) {
            DB::listen(function ($query) {
                $sql = $query->sql;

                foreach ($query->bindings as $binding) {
                    $value = is_string($binding) ? "'{$binding}'" : $binding;
                    $sql = preg_replace('/\?/', $value, $sql, 1);
                }
                $str = date("Y-m-d H:i:s") . " ";

                //$str .= $query->sql . ' [' . implode(', ', $query->bindings) . ']' . PHP_EOL;
                $str .= "QUERY: " . $sql . PHP_EOL;
                if (app()->runningInConsole()) {
                    File::append(
                        storage_path('logs/query-cli-' . date("Y-m-d") . '.log'),
                        $str
                    );
                } else {
                    File::append(
                        storage_path('logs/query-' . date("Y-m-d") . '.log'),
                        $str
                    );
                }

            });
        }
        //
        //-- ST : 190905_001 yhlim : 상단 메뉴 지점안내 정보 출력을 위한 코드부
        \View::composer(['layouts.includes.gnb.headgnb','layouts.includes.cmm.branchinfo_select','mobile.branchinfo.popup'], function ($view) {
            $branch = new Branch();
            $dsAllBranchinfoNm = $branch->getAllBranchinfoNm()->get();
            $view->with(['dsAllBranchinfoNm' => $dsAllBranchinfoNm]);
        });
        //-- ED : 190905_001

        //-- ST : 190909_001 yhlim : 하단 수상내역 정보 출력을 위한 코드부
        \View::composer(['layouts.includes.gnb.foot'], function ($view) {
            $award_banner = new Award_banner();
            $dsAllAwardBanner = $award_banner->getAllAwardBanner()->get();
            $view->with(['dsAllAwardBanner' => $dsAllAwardBanner]);
        });
        //-- ED : 190905_001

        //-- ST : 190909_002 yhlim : 오른쪽 사이드바 정보 출력을 위한 코드부
        \View::composer(['layouts.includes.gnb.rside'], function ($view) {
            $floating_banner = new Floating_banner();
            $dsAllFloatingBanner = $floating_banner->getAllFloatingBanner()->limit(4)->get();
            $view->with(['dsAllFloatingBanner' => $dsAllFloatingBanner]);
        });
        //-- ED : 190905_002

        //-- ST : 190911_003 dkswlgp13 : 유입경로
        \View::composer(['layouts.pc', 'mobile.layouts.mobile','mobile.layouts.mobile_main'], function ($view) {
            $statistics = new StatisticsController();
            $statistics->inflowType();
        });
        //-- ED : 190905_002

        //-- ST : 190911_003 dkswlgp13 : 접속통계
        \View::composer(['layouts.pc', 'mobile.layouts.mobile','mobile.layouts.mobile_main'], function ($view) {
            $statistics = new StatisticsController();
            $statistics->connnect();
        });
        //-- ED : 190911_003

        //-- ST : 190911_003 dkswlgp13 : 페이지뷰통계
        \View::composer(['layouts.pc', 'mobile.layouts.mobile'], function ($view) {
            $statistics = new StatisticsController();
            $statistics->pageView();
        });
        //-- ED : 190911_003

        //-- ST : 190925_004 dkswlgp13 : side 메뉴 정보
        \View::composer(['mobile.layouts.includes.gnb.sidebar'], function ($view) {
            $branch = new Branch();
            if (!session()->get('user_favorite_store_id')) {
                $default_branch = $branch->getDefaultBranch()->first();
            } else {
                $default_branch = $branch->getBranchinfo(session()->get('user_favorite_store_id'))->first();
            }
            $view->with(['default_branch' => $default_branch]);
        });
        //-- ED : 190925_004

        /* 페이징 처리 샘플 구현코드
        \View::composer('layouts.pc', function ($view) {
            $branch = new Branch();
            $normal_list = $branch->getAllBranchinfoNm()->paginate('5');
            $view->with(['normal_list' => $normal_list]);
        });
        */


        //국내전화번호 validation 확장
        Validator::extend('kor_tel',function ($attribute, $value, $parameters, $validator) {
            return mmLibHelper::isValidTelNumber($value);
        });

        //사업자등록번호 validation 확장
        Validator::extend('license_no',function ($attribute, $value, $parameters, $validator) {
            return mmLibHelper::chkLicenseNo($value);
        });
    }
}
