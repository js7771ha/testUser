<?php

namespace App\Http\Controllers\testuser;

use App\helpers\mmLibHelper;
use App\Http\Controllers\Controller;
use App\models\testfile\TestFile;
use App\models\testuser\TestUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

/**
 * Class TestUserController
 * @package App\Http\Controllers\testuser
 */
class TestUserController extends Controller
{
    const LEAVEACCOUNT = "0";
    const ACCOUNT = "1";
    const DORMANCY = "2";
    private $userModel = "";

// self::ACCOUNT, static::ACCOUNT, $this::ACCOUNT, TestUserController::ACCOUNT

//$a = new TestuserController();
//$b = $a::ACCOUNT;

    /**
     * TestUserController constructor.
     */
    public function __construct()
    {
        // 유저 모델
        $this->userModel = new TestUser();



//        $this->key = md5("password");       // encrypt 암호화 인크립트 키
//        $this->openKey = "a1b2c3d4e5f6g7h8";    // encrypt 암호화 공개 키
    }

    public function index(Request $request)
    {
        // Request
        // Define
        // Validation
        // DataSet
        // Return

//        $encode = openssl_encrypt("이름1", "AES-128-CBC", $this->key, $options=OPENSSL_RAW_DATA, $this->openKey);
//        $decode = openssl_decrypt($encode, "AES-128-CBC", $this->key, $options=OPENSSL_RAW_DATA, $this->openKey);
//
//        $encode1 = openssl_encrypt("이름", "AES-128-CBC", $this->key, $options=OPENSSL_RAW_DATA, $this->openKey);
//        $encode2 = openssl_encrypt("1", "AES-128-CBC", $this->key, $options=OPENSSL_RAW_DATA, $this->openKey);
//        dd($encode, $decode, $encode1, $encode2);

//dd(base64_encode("test1111@naver.com"), base64_encode("test1111@"), base64_encode("test"), base64_encode("naver"));
//dd(utf8_encode("이름1"), utf8_encode("이름"), utf8_encode("1"));

        $conditions = array();
        $conditions["perpage"] = $request->input("perpage", 2);
        $conditions["user_state"] = $request->input("user_state", array("all", self::ACCOUNT, self::DORMANCY));
        $conditions["user_gender"] = $request->input("user_gender", "all");
        $conditions["order_type"] = $request->input("order_type", "");
        $conditions["order_style"] = $request->input("order_style", "");
        $conditions["search_date"]["from_date"] = $request->input("from_date", "");
        $conditions["search_date"]["to_date"] = $request->input("to_date", "");
        $conditions["search_type"][0] = $request->input("search_type.0", "");
        $conditions["search_type"][1] = $request->input("search_type.1", "");
        $conditions["search_keyword"][0] = $request->input("search_keyword.0", "");
        $conditions["search_keyword"][1] = $request->input("search_keyword.1", "");

//        dd($conditions);
//        // 검색 키워드가 있으면 암호화 (아이디, 이메일, 전화번호)
//        if ($conditions["search_keyword"][0] !== "") {
//            $conditions["en_search_keyword"][0] = base64_encode($conditions["search_keyword"][0]);
//            $conditions["en_search_keyword"][0] = base64_encode($conditions["search_keyword"][0]);
////            $conditions["en_search_keyword"][0] = mmLibHelper::encrypt($conditions["search_keyword"][0], $this->key, $this->openKey);
//        }
//        if ($conditions["search_keyword"][1] !== "") {
//            $conditions["en_search_keyword"][1] = base64_encode($conditions["search_keyword"][1]);
//        }

        // 검색 리스트 조회
        $list = $this->userModel->getList($conditions)->paginate($conditions["perpage"]);
        // 검색 리스트 카운트 조회
        $data = array();
        $data["count_list"] = $this->userModel->getCount($conditions);
        $data["state"] = $this->getCountState();                     // 계정 카운트
        $data["age"] = $this->getCountAge();                         // 연령 카운트
        $data["gender"] = $this->getCountGender();                   // 성별 카운트
        $data["count_point"] = $this->getCountMembershipPoint();     // 포인트 카운트
        $data["total_point"] = $this->getTotalMembershipPoint();     // 포인트 total
        $data["avg_age"] = $this->getAvgAge();                       // 평균 연령대

        // 암호화 저장된 데이터 복호화 출력
        foreach ($list as $value) {
//            $value->user_name = mmLibHelper::decrypt($value->user_name, $this->key, $this->openKey);
//            $value->user_name = base64_decode($value->user_name);
//            $value->user_email = base64_decode($value->user_email);
//            $value->user_tel = base64_decode($value->user_tel);
            $tel_arr = mmLibHelper::splitKoreanTelNumber($value->user_tel);
            if ($tel_arr !== false) {
                $value->user_tel = implode("-", $tel_arr);
            }
        }

        $results = array("conditions" => $conditions, "data" => $data, "list" => $list);
        return view("testuser.list")->with("results", $results);

    }
        /*

        $datas = array();
        $conditions = array();

        $getList = $list;   // list
        $getInfo = $info;   // Row

        Carbon::class

        Date >> 검색조건 (Between => 조건식)
        */


    /**
     * 계정별 카운트 조회
     *
     * @return array
     */
    public function getCountState()
    {
        // 계정별 카운트
        $list = $this->userModel->getCountState();
        $count = array("all" => 0, "account" => 0, "dormancy" => 0, "leaveAccount" => 0);

        foreach ($list as $item) {
            if ($item->user_state == self::ACCOUNT) {
                $count["account"] = $item->count;
            } else if ($item->user_state == self::DORMANCY) {
                $count["dormancy"] = $item->count;
            } else if ($item->user_state == self::LEAVEACCOUNT) {
                $count["leaveAccount"] = $item->count;
            }
            $count["all"] += $item->count;
        }

        return $count;
    }

    /**
     * 연령대별 카운트 조회
     *
     * @return array
     */
    public function getCountAge()
    {
        // 연령대별 카운트
        $list = $this->userModel->getCountAge();
        $count = array("10" => 0, "20~30" => 0, "40~50" => 0, "60" => 0);

        foreach ($list as $item) {
            if ($item->user_age < 20) {
                $count["10"] += $item->count;
            } else if ($item->user_age >= 20 && $item->user_age < 40) {
                $count["20~30"] += $item->count;
            } else if ($item->user_age >= 40 && $item->user_age < 60) {
                $count["40~50"] += $item->count;
            } else {
                $count["60"] += $item->count;
            }
        }

        return $count;
    }

    /**
     * 평균 연령대 조회
     *
     * @return array
     */
    public function getAvgAge()
    {
        // 평균 연령대
        $avg = round($this->userModel->getAvgAge());

        return $avg;
    }

    /**
     * 성별 카운트 조회
     *
     * @return array
     */
    public function getCountGender()
    {
        // 성별 카운트
        $list = $this->userModel->getCountGender();
        $count = array("male" => 0, "female" => 0);

        foreach ($list as $item) {
            if ($item->user_gender == "1") {
                $count["male"] = $item->count;
            } else {
                $count["female"] = $item->count;
            }
        }

        return $count;
    }

    /**
     * 적림금 카운트 조회
     *
     * @return array
     */
    public function getCountMembershipPoint()
    {
        // 적립금 카운트
        $list = $this->userModel->getCountMembershipPoint();
        $count = array("1000" => 0, "9999" => 0, "10000" => 0, "total" => 0);

        foreach ($list as $item) {
            if ($item->user_point < 1000) {
                $count["1000"] += $item->count;
            } else if ($item->user_point >= 1000 && $item->user_point < 10000) {
                $count["9999"] += $item->count;
            } else {
                $count["10000"] += $item->count;
            }
        }

        return $count;
    }

    /**
     * 적립금 총액
     *
     * @return int
     */
    public function getTotalMembershipPoint()
    {
        $list = $this->userModel->getTotalMembershipPoint();
        $total = 0;
        foreach ($list as $item) {
            $total += $item->user_point;
        }

        return $total;
    }

    /**
     * 팝업 (탈퇴)리스트
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexLeave()
    {
        // 탈퇴회원 리스트 출력
        $list = $this->userModel->getLeaveList();

//        foreach ($list as $value) {
//            $value->user_name_decrypt = base64_decode($value->user_name);
//            $value->user_email_decrypt = base64_decode($value->user_email);
//            $value->user_tel_decrypt = base64_decode($value->user_tel);
//        }

        return view("testuser.list_del")->with("leave_list", $list);
    }


    /**
     * 신규 작성
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view("testuser.create");
    }

    /**
     * 신규 등록 저장
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        // 저장하기
        $rules = [
            "user_name.*" => "required",
            "user_id.*" => "required|alpha_dash",
            "user_pwd.*" => "required",
            "user_gender.*" => "required",
            "user_age.*" => "required|integer",
            "user_tel.*" => "required|numeric",
            "user_email.*" => "required|email",
            "user_point.*" => "required",
            "user_zip.*" => "required|numeric",
            "user_file.*" => "mimes:jpeg,png,jpg|max:3072"
        ];

        $messages = [
            "user_name.*.required" => "이름을 입력해주세요.",
            "user_id.*.required" => "아이디를 입력해주세요.",
            "user_id.*.alpha_dash" => "아이디의 값이 유효하지 않습니다.",
            "user_pwd.*.required" => "비밀번호를 입력해주세요.",
            "user_gender.*.required" => "성별을 선택해주세요.",
            "user_age.*.required" => "나이를 입력해주세요",
            "user_age.*.integer" => "나이는 숫자만 입력할 수 있습니다.",
            "user_tel.*.required" => "전화번호를 입력해주세요.",
            "user_tel.*.numeric" => "전화번호는 숫자만 입력할 수 있습니다.",
            "user_email.*.required" => "이메일을 입력해주세요.",
            "user_email.*.email" => "이메일 형식이 올바르지 않습니다.",
            "user_point.*.required" => "적립금을 입력해주세요.",
            "user_zip.*.required" => "우편번호를 입력해주세요.",
            "user_zip.*.numeric" => "우편번호는 숫자만 입력할 수 있습니다.",
            "user_file.*.mimes" => "등록할 수 없는 확장자 입니다. (jpg, png만 가능)",
            "user_file.*.max" => "3MB가 넘는 이미지는 등록할 수 없습니다."
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route("testuser_create")
                ->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $queryStr = $request->query();
            unset($queryStr["_route_"]);

            $count = count($request->input("user_name"));
            for ($i=0; $i<$count; $i++) {
                $user_info = array();
                $user_info["user_state"] = self::ACCOUNT;                     // 신규 등록은 "사용계정" 상태로 등록
                $user_info["user_name"] = $request->input("user_name.{$i}", "");
//                $user_info["user_name"] = base64_encode($request->input("user_name.{$i}", ""));
//                $user_info["user_name"] = encrypt($request->input("user_name.{$i}", ""));
                $user_info["user_id"] = $request->input("user_id.{$i}", "");
                $user_info["user_pwd"] = hash("sha512", $request->input("user_pwd.{$i}", ""), false);
                $user_info["user_age"] = $request->input("user_age.{$i}", 0);
                $user_info["user_gender"] = $request->input("user_gender.{$i}", "");
                $user_info["user_email"] = $request->input("user_email.{$i}", "");
                $user_info["user_tel"] = $request->input("user_tel.{$i}", "");
//                $user_info["user_email"] = base64_encode($request->input("user_email.{$i}", ""));
//                $user_info["user_tel"] = base64_encode($request->input("user_tel.{$i}", ""));
                $user_info["user_point"] = preg_replace("/[^0-9]/m", "", $request->input("user_point.{$i}", 0));
                $user_info["user_married"] = $request->input("user_married.{$i}");
                $user_info["user_remark"] = $request->input("user_remark.{$i}");
                $user_info["user_zip"] = $request->input("user_zip.{$i}", "");
                $user_info["user_addr"] = $request->input("user_addr.{$i}", "");
                $user_info["user_addr_detail"] = $request->input("user_addr_detail.{$i}", "");
                // user_order
                $order = $this->userModel->getLastOrder();
                $user_info["user_order"] = $order + 1;

                // 유저 정보 저장
                $user_idx = $this->userModel->setSave($user_info);

                // model return 값이 숫자가 아니고 1보다 작을때 back
                if (is_numeric($user_idx) && $user_idx <= 0) {
                    return back()->withInput()->with("message", config("test_user.test_con.message.error"));
                }

                // 파일 DB 저장
                if (!empty($request->file("user_file.{$i}"))) {
                    $this->fileSave($request->file("user_file.{$i}"), $user_idx);
                }
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception($exception);
        }

        return redirect()->route("testuser_index", $queryStr)->with("message", config("test_user.test_con.message.success"));
    }

    /**
     * @param $file
     * @param $user_idx
     */
    public function fileSave($file, int $user_idx = 0)
    {
        if (!is_numeric($user_idx) && $user_idx <= 0) {
            abort(404);
        }

        $file_extension = $file->getClientOriginalExtension();
        $file_info["user_idx"] = $user_idx;
        $file_info["file_original_name"] = $file->getClientOriginalName();
        $file_info["file_save_name"] = $user_idx."_".md5_file($file).".".$file_extension;

        Storage::disk("local")->put($file_info["file_save_name"],  File::get($file));

        $fileModel = new TestFile();
        $fileModel->saveFile($file_info);
    }


    /**
     * 회원 상세정보 view 페이지
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id)
    {
        if (!is_numeric($id) && $id <= 0) {
            abort(404);
        }

        $user_info = $this->userModel->getInfo($id);
//        $user_info->user_name_decrypt = base64_decode($user_info->user_name);
//        $user_info->user_email_decrypt = base64_decode($user_info->user_email);
//        $user_info->user_tel_decrypt = base64_decode($user_info->user_tel);
        $user_info->user_point = number_format($user_info->user_point);
        $tel_arr = mmLibHelper::splitKoreanTelNumber($user_info->user_tel);
        if ($tel_arr !== false) {
            $user_info->user_tel = implode("-", $tel_arr);
        }
        return view("testuser.detail")->with("user_info", $user_info);
    }

    /**
     * 회원정보 수정 view 페이지
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, int $id = 0)
    {
        if (!is_numeric($id) && $id <= 0) {
            abort(404);
        }

        $user_info = $this->userModel->getInfo($id);
        $user_info->user_pwd = "";
//        $user_info->user_name_decrypt = base64_decode($user_info->user_name);
//        $user_info->user_email_decrypt = base64_decode($user_info->user_email);
//        $user_info->user_tel_decrypt = base64_decode($user_info->user_tel);

        if (strpos($user_info->user_email, "@")) {
            $email = explode("@", $user_info->user_email);
            $user_info->email = $email[0];
            $user_info->domain = $email[1];
        }
        $user_info->user_point = number_format($user_info->user_point);

        return view("testuser.modify")->with("user_info", $user_info);
    }


    /**
     * 회원정보 수정 저장 (업데이트)
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(Request $request, $id)
    {

        // 수정하기
        $rules = [
            "user_gender" => "required",
            "user_age" => "required|integer",
            "user_tel" => "required|Numeric",
            "user_email" => "required|email",
            "user_point" => "required"
        ];
        $messages = [
            "user_gender.required" => "성별을 선택해주세요.",
            "user_age.required" => "나이를 입력해주세요",
            "user_age.integer" => "나이는 숫자만 입력할 수 있습니다.",
            "user_tel.required" => "전화번호를 입력해주세요.",
            "user_tel.integer" => "전화번호는 숫자만 입력할 수 있습니다.",
            "user_email.required" => "이메일을 입력해주세요.",
            "user_email.email" => "이메일 형식이 올바르지 않습니다.",
            "user_point.required" => "적립금을 입력해주세요."
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        // 기존 비번, 변경할 비번, 변경할 비번 확인
        $password["check_pwd"] = $request->input("check_pwd", "");
        $password["user_pwd"] = $request->input("user_pwd", "");
        $password["user_pwd2"] = $request->input("user_pwd2", "");

        // 기존 비밀번호가 입력 되었다면 기존 비밀번호가 동일한 지 확인
        if ($password["check_pwd"] != "") {
            $check_pwd = $this->checkPwd($id, $password["check_pwd"]);
            if ($check_pwd === "pwd_check_no") {
                return back()->withInput()->with("message", config("test_user.test_con.message.not_match_pwd"));
            }
        } else {
            return back()->withInput()->with("message", config("test_user.test_con.message.input_pwd"));
        }

        // 변경할 비밀번호 === 변경할 비밀번호 확인 -> 비밀번호 암호화 진행
        if ($password["user_pwd"] != "" && $password["user_pwd"] === $password["user_pwd2"]) {
            $encrypted_pwd = hash("sha512", $request->input("user_pwd"), false);
            $user_info["user_pwd"] = $encrypted_pwd;
        } else if ($password["user_pwd"] != "" && $password["user_pwd"] !== $password["user_pwd"]) {
            return back()->withInput()->with("message", "변경할 " . config("test_user.test_con.message.not_match_pwd"));
        }

        DB::beginTransaction();
        try {
            $queryStr = $request->query();
            unset($queryStr["_route_"]);

            $now = new \DateTime();
            $user_info = array();

            // 포인트 숫자 외 전부 replace
            $user_point = preg_replace("/[^0-9]/", "", $request->input("user_point", 0));
            // 암호화 저장
//            $encrypted_email = base64_encode($request->input("user_email", ""));
//            $encrypted_tel = base64_encode($request->input("user_tel", ""));

            $user_info["user_state"] = $request->input("user_state", self::ACCOUNT);
            $user_info["user_age"] = $request->input("user_age", 0);
            $user_info["user_gender"] = $request->input("user_gender", "");
            $user_info["user_email"] = $request->input("user_email", "");
            $user_info["user_tel"] = $request->input("user_tel", "");
            $user_info["user_married"] = $request->input("user_married");
            $user_info["user_point"] = $user_point;
            $user_info["user_zip"] = $request->input("user_zip", "");
            $user_info["user_addr"] = $request->input("user_addr", "");
            $user_info["user_addr_detail"] = $request->input("user_addr_detail", "");
            $user_info["user_remark"] = $request->input("user_remark");
            $user_info["updated_at"] = $now->format("Y-m-d H:i:s");

            $result = $this->userModel->modUser($user_info, $id);

            // 파일 DB 업데이트
            $file["file_idx"] = $request->input("file_idx", 0);
            $file["user_file"] = $request->file("user_file", 0);
            $file["user_file"] = $request->file("user_file", 0);

            // 기존에 저장된 파일이 없다면 새로 등록, 있으면 업데이트
            if (empty($file["file_idx"]) && !is_null($file["user_file"]) && $file["user_file"] != "") {
                $this->fileSave($file["user_file"], $id);
            } else if (!empty($file["file_idx"]) && !is_null($file["user_file"]) && $file["user_file"] != "") {
                $this->fileUpdate($file["user_file"], $file["file_idx"], $request->input("file_save_name"), $id);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception($exception);
//            return back()->withInput()->with("message", $exception);
        }

        return redirect()->route("testuser_index", $queryStr)->with("message", config("test_user.test_con.message.modify"));
    }


    /**
     * @param $file
     * @param $file_idx
     * @param $file_save_name
     * @param $user_idx
     */
    public function fileUpdate($file, $file_idx=0, $file_save_name="", $user_idx=0)
    {
        if (!is_numeric($file_idx) && $file_idx <= 0) {
            abort(404);
        }

        $file_extension = $file->getClientOriginalExtension();
        $file_info["file_original_name"] = $file->getClientOriginalName();
        $file_info["file_save_name"] = $user_idx."_".md5_file($file).".".$file_extension;

        if ($file_save_name != "") {
            Storage::disk("local")->delete($file_save_name);
        }

        Storage::disk("local")->put($file_info["file_save_name"],  File::get($file));

        $fileModel = new TestFile();
        $fileModel->updateFile($file_info, $file_idx);
    }


    /**
     * 삭제
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws
     */
    public function destroy(Request $request, $id)
    {
        // 삭제하기
        if (!is_numeric($id) && $id <= 0) {
            abort(404);
        }

        DB::beginTransaction();
        try {
            $queryStr = $request->query();
            unset($queryStr["_route_"]);

            $this->userModel->setLeave($id);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->withInput()->with("message", $exception);
        }

        return redirect()->route("testuser_index", $queryStr)->with("message", config("test_user.test_con.message.delete"));
    }

    /**
     * 일괄 삭제
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function allDestroy(Request $request)
    {
        // 일괄삭제하기
        $idx_arr = $request->input("idx_arr", array());

        if (is_null($idx_arr) && count($idx_arr) <= 0) {
            $res = array("result" => "", "message" => config("test_user.test_con.message.delete_input"));
            return response()->json($res);
        }

        $result = "all_delete_no";
        $message = config("test_user.test_con.message.delete_fail");

        DB::beginTransaction();
        try {

            $this->userModel->setAllLeave($idx_arr);

            $result = "all_delete_ok";
            $message = config("test_user.test_con.message.delete");

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }

        $res = array("result" => $result, "message" => $message);
        return response()->json($res);
    }


    /**
     * 복구 ajax
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        // 복구
        $user_idx = $request->input("user_idx", 0);
        if (!is_numeric($user_idx) || $user_idx == "") {
            $res = array("result" => "", "message" => config("test_user.test_con.message.error"));
            return response()->json($res);
        }

        $result = "restore_no";
        $message = config("test_user.test_con.message.restore_fail");

        DB::beginTransaction();
        try {

            $this->userModel->setRestore($user_idx);

            $result = "restore_ok";
            $message = config("test_user.test_con.message.restore");

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }

        $res = array("result" => $result, "message" => $message);
        return response()->json($res);
    }

    /**
     * 전체 복구 ajax
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function allRestore(Request $request)
    {
        // 전체 복구
        $idx_arr = $request->input("idx_arr", array());

        if (is_null($idx_arr) && count($idx_arr) <= 0) {
            $res = array("result" => "", "message" => config("test_user.test_con.message.restore_input"));
            return response()->json($res);
        }

        $result = "all_restore_no";
        $message = config("test_user.test_con.message.restore_fail");

        DB::beginTransaction();
        try {
            $this->userModel->setAllRestore($idx_arr);

            $result = "all_restore_ok";
            $message = config("test_user.test_con.message.restore");

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }

        $res = array("result" => $result, "message" => $message);
        return response()->json($res);
    }

    /**
     * 아이디 중복 조회 ajax
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function idCheck(Request $request)
    {
        // 아이디 중복 조회
        if ($request->input("user_id") == "") {
            $res = array("result" => "", "message" => config("test_user.test_con.message.input_id"));
            return response()->json($res);
        }

        $data = $this->userModel->getCheckId($request->input("user_id", ""));

        if ($data->isNotEmpty()) {     // 조회된 데이터가 있을 때 아이디 사용 불가
            $result = "use_no";
            $message = config("test_user.test_con.message.no_id");
        } else {
            $result = "use_ok";
            $message = config("test_user.test_con.message.ok_id");
        }

        $res = array("result" => $result, "message" => $message);
        return response()->json($res);
    }


    /**
     * 비밀번호 체크 view 페이지
     *
     * @param $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    function pwdCheckView (Request $request, $id) {
        return view("testuser.checkpwd")->with("user_idx", $id);
    }

    /**
     * 비밀번호 체크
     *
     * @param int $id
     * @param int $pwd
     * @return boolean $pwd_check
     */
    public function checkPwd($id, $pwd)
    {
        // 비밀번호 체크

        $encrypted_passwd = hash("sha512", $pwd, false);
        $data = $this->userModel->getCheckPwd($id, $encrypted_passwd);

        if ($data->isNotEmpty()) {       // 비밀번호 일치하는 데이터가 있으면 삭제 가능
            $pwd_check = "pwd_check_ok";
        } else {
            $pwd_check = "pwd_check_no";
        }
        return $pwd_check;
    }

    /**
     * 비밀번호 체크 ajax
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function pwdCheck(Request $request)
    {
        // 비밀번호 체크 ajax
        $user_idx = $request->input("user_idx", 0);
        $user_pwd = $request->input("user_pwd", "");

        if ($user_idx == "" || $user_pwd == null) {
            $res = array("result" => "", "message" => config("test_user.test_con.message.input_pwd"));
            return response()->json($res);
        }

        $encrypted_passwd = hash("sha512", $user_pwd, false);
        $data = $this->userModel->getCheckPwd($user_idx, $encrypted_passwd);

        if ($data->isNotEmpty()) {     // 비밀번호 일치하는 데이터가 있으면 삭제 가능
            $result = "pwd_check_ok";
            $message = config("test_user.test_con.message.del_user");
        } else {
            $result = "pwd_check_no";
            $message = config("test_user.test_con.message.not_match_pwd");
        }

        $res = array("result" => $result, "message" => $message);
        return response()->json($res);
    }

    /**
     * 출력 순번 변경 (↑)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function upIndex(Request $request)
    {
        $user_idx = $request->input("user_idx", 0);
        $user_order = $request->input("user_order", 0);
        $prev_user_idx = $request->input("prev_user_idx", 0);

        $result = "";
        DB::beginTransaction();
        try {
            $this->userModel->setUpOrder($user_order, $user_idx, $prev_user_idx);
            $result = "change_success";

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception("순서 변경 오류");
        }

        $res = array("result" => $result);
        return response()->json($res);
    }

    /**
     * 출력 순서 변경 (↓)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function downIndex(Request $request)
    {
        $user_idx = $request->input("user_idx", 0);
        $user_order = $request->input("user_order", 0);
        $next_user_idx = $request->input("next_user_idx", 0);

        $result = "";
        DB::beginTransaction();
        try {
            $this->userModel->setDownOrder($user_order, $user_idx, $next_user_idx);
            $result = "change_success";

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception("순서 변경 오류");
        }

        $res = array("result" => $result);
        return response()->json($res);
    }
}
