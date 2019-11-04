<?php

namespace App\Http\Controllers\testuser;

use App\Http\Controllers\Controller;
use App\models\testfile\TestFile;
use App\models\testuser\TestUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TestUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    const LEAVEACCOUNT = "0";
    const ACCOUNT = "1";
    const DORMANCY = "2";

    public function index(Request $request)
    {
        // 리스트 출력
        $user = new TestUser();
        $perpage = 2;
        if (!is_null($request->input("perpage"))&& $request->input("perpage") != ""&& $request->input("perpage") > 0) {
            $perpage = $request->input("perpage");
        }

        $search = array();

        // user_state 값이 없으면 모든 계정 출력, 값이 있으면 선택 된 값 출력
        if (!is_null($request->input("user_state"))) {
            $search["user_state"] = is_array($request->input("user_state")) ? $request->input("user_state") : [$request->input("user_state")];
            if ($search["user_state"][0] == "all" || count($search["user_state"]) == 0) {
                $search["user_state_arr"] = [self::ACCOUNT, self::DORMANCY];
            } else {
                $search["user_state_arr"] = $search["user_state"];
            }
        } else {
            $search["user_state"] = array();
            $search["user_state_arr"] = [self::ACCOUNT, self::DORMANCY];
        }

        // 라디오 선택이 "all"이면 1, 2 전부 조회, 아니면 해당 값 조회
        if (!is_null($request->input("user_gender")) && $request->input("user_gender") == "all") {
            $search["user_gender_arr"] = array("1", "2");
        } else if (!is_null($request->input("user_gender")) && $request->input("user_gender") != "all") {
            $search["user_gender_arr"] = array($request->input("user_gender", array("1", "2")));
        }

        // 검색어가 있으면 검색어 설정 (배열)
        if (is_array($request->input("search_select")) && count($request->input("search_select")) > 0) {
            foreach ($request->input("search_select") as $key => $item) {
                $search["search_select"][$key] = $request->input("search_select")[$key];
                $search["search_input"][$key] = $request->input("search_input")[$key];
            }
            if (count($search["search_select"]) == 1) {
                $search["search_select"][1] = "";
                $search["search_input"][1] = "";
            }
        } else {
            $search["search_select"] = array("", "");
            $search["search_input"] = array("", "");
        }

        $search["user_gender"] = $request->input("user_gender", "");
        $search["order_type"] = $request->input("order_type", "");
        $search["order_style"] = $request->input("order_style", "");
        $search["search_date"]['from_date'] = $request->input("from_date", "");
        $search["search_date"]['to_date'] = $request->input("to_date", "");

        if ($search["search_date"]['to_date'] != "") {
            $search["search_date"]['to_date'] = date("Y-m-d", strtotime($search["search_date"]['to_date'] . " + 1 days"));    // 0시 부터 0시까지 검색 이기때문에 +1일 후 검색)
        }

        // 검색 리스트 조회
        $user_list = $user->getUserListModel("del_except_list", $search)->paginate($perpage);
        // 검색 리스트 카운트 조회
        $user_list_count = $user->getUserListModelCount("del_except_list", $search);

        // 암호화 저장된 데이터 복호화 출력
        foreach ($user_list as $value) {
            $value->user_name = decrypt($value->user_name);
            $value->user_email = decrypt($value->user_email);
            $value->user_tel = decrypt($value->user_tel);
            $value->user_tel = substr($value->user_tel, 0, 3) . "-" . substr($value->user_tel, 3, 4) . "-" . substr($value->user_tel, 7);
        }

        $count_all = array();
        $count_all["state"] = $this->countState();      // 계정 카운트
        $count_all["age"] = $this->countAge();          // 연령 카운트
        $count_all["age"] = $this->countAge();          // 연령 카운트
        $count_all["gender"] = $this->countGender();    // 성별 카운트
        $count_all["point"] = $this->countPoint();      // 포인트 카운트
        $total_point = $this->totalPoint();             // total
        $avg_age = $this->avgAge();                     // 평균 연령대

        // 조회 후 가입일 검색 중 종료일 원래 입력된 데이터 값으로 변경
        $search["search_date"]['to_date'] = $request->input("to_date", "");

        return view("testuser.list")->with("user_list", $user_list)->with("perpage", $perpage)->with("search", $search)->with("user_list_count", $user_list_count)
            ->with("total_point", $total_point)->with("avg_age", $avg_age)->with("count_all", $count_all);
    }


    /**
     * 계정별 카운트 조회
     *
     * @return array
     */
    public function countState()
    {
        // 계정별 카운트
        $user = new TestUser();

        $count_collection_state = $user->getCountState();
        $count_state = array("all" => 0, "account" => 0, "dormancy" => 0, "leaveAccount" => 0);

        foreach ($count_collection_state as $item) {
            if ($item->user_state == self::ACCOUNT) {
                $count_state["account"] = $item->count;
            } else if ($item->user_state == self::DORMANCY) {
                $count_state["dormancy"] = $item->count;
            } else if ($item->user_state == self::LEAVEACCOUNT) {
                $count_state["leaveAccount"] = $item->count;
            }
            $count_state["all"] += $item->count;
        }

        return $count_state;
    }

    /**
     * 연령대별 카운트 조회
     *
     * @return array
     */
    public function countAge()
    {
        // 연령대별 카운트
        $user = new TestUser();

        $count_collection_age = $user->getCountAge();
        $count_age = array("teen" => 0, "two_three" => 0, "four_five" => 0, "six" => 0);

        foreach ($count_collection_age as $item) {
            if ($item->user_age < 20) {
                $count_age["teen"] += $item->count;
            } else if ($item->user_age >= 20 && $item->user_age < 40) {
                $count_age["two_three"] += $item->count;
            } else if ($item->user_age >= 40 && $item->user_age < 60) {
                $count_age["four_five"] += $item->count;
            } else {
                $count_age["six"] += $item->count;
            }
        }

        return $count_age;
    }

    /**
     * 평균 연령대 조회
     *
     * @return array
     */
    public function avgAge()
    {
        // 평균 연령대
        $user = new TestUser();

        $avg_age = round($user->getAvgAge());

        return $avg_age;
    }

    /**
     * 성별 카운트 조회
     *
     * @return array
     */
    public function countGender()
    {
        // 성별 카운트
        $user = new TestUser();

        $count_collection_gender = $user->getCountGender();
        $count_gender = array("male" => 0, "female" => 0);

        foreach ($count_collection_gender as $item) {
            if ($item->user_gender == "1") {
                $count_gender["male"] = $item->count;
            } else {
                $count_gender["female"] = $item->count;
            }
        }

        return $count_gender;
    }

    /**
     * 적림금 카운트 조회
     *
     * @return array
     */
    public function countPoint()
    {
        // 적립금 카운트
        $user = new TestUser();

        $count_collection_point = $user->getCountPoint();
        $count_point = array("1000" => 0, "9999" => 0, "10000" => 0, "total" => 0);

        foreach ($count_collection_point as $item) {
            if ($item->user_point < 1000) {
                $count_point["1000"] += $item->count;
            } else if ($item->user_point >= 1000 && $item->user_point < 10000) {
                $count_point["9999"] += $item->count;
            } else {
                $count_point["10000"] += $item->count;
            }
        }

        return $count_point;
    }

    /**
     * 적립금 총액
     *
     * @return int
     */
    public function totalPoint()
    {
        $user = new TestUser();

        $total_collection_point = $user->getTotalPoint();
        $total_point = 0;
        foreach ($total_collection_point as $item) {
            $total_point += $item->user_point;
        }

        return $total_point;
    }

    /**
     * 팝업 (탈퇴)리스트
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexDel()
    {
        // 탈퇴회원 리스트 출력
        $user = new TestUser();
        $search = array();

        $user_list = $user->getUserListModel("del_list", $search)->get();
        foreach ($user_list as $value) {
            $value->user_name_decrypt = decrypt($value->user_name);
            $value->user_email_decrypt = decrypt($value->user_email);
            $value->user_tel_decrypt = decrypt($value->user_tel);
        }

        return view("testuser.list_del")->with("user_list", $user_list);
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
//        $this->fileSave($request->file("user_file")[0], 1);
        $rules = [
            "user_name.*" => "required",
            "user_id.*" => "required|alpha_dash",
            "user_pwd.*" => "required",
            "user_gender.*" => "required",
            "user_age.*" => "required|integer",
            "user_tel.*" => "required|Numeric",
            "user_email.*" => "required|email",
            "user_point.*" => "required",
            "user_zip.*" => "required|Numeric",
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
            "user_tel.*.integer" => "전화번호는 숫자만 입력할 수 있습니다.",
            "user_email.*.required" => "이메일을 입력해주세요.",
            "user_email.*.email" => "이메일 형식이 올바르지 않습니다.",
            "user_point.*.required" => "적립금을 입력해주세요.",
            "user_zip.*.required" => "우편번호를 입력해주세요.",
            "user_zip.*.Numeric" => "우편번호는 숫자만 입력할 수 있습니다.",
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
            array_shift($queryStr);

            $user = new TestUser();

            foreach ($request->input("user_name") as $key => $value) {

                // 이름, 이메일, 전화번호 암호화 (복호화 가능하도록)
                $encrypted_name = encrypt($request->input("user_name")[$key]);
                $encrypted_email = encrypt($request->input("user_email")[$key]);
                $encrypted_tel = encrypt($request->input("user_tel")[$key]);
                // 비밀번호 암호화
                $encrypted_passwd = hash("sha512", $request->input("user_pwd")[$key], false);

                // 포인트 기호 제거
                $user_point = preg_replace("/[^0-9]/m", "", $request->input("user_point")[$key]);

                $user_info = array();
                $user_info["user_state"] = self::ACCOUNT;                     // 신규 등록은 "사용계정" 상태로 등록
                $user_info["user_name"] = $encrypted_name;
                $user_info["user_id"] = $request->input("user_id")[$key];
                $user_info["user_pwd"] = $encrypted_passwd;
                $user_info["user_age"] = $request->input("user_age")[$key];
                $user_info["user_gender"] = $request->input("user_gender")[$key];
                $user_info["user_email"] = $encrypted_email;
                $user_info["user_tel"] = $encrypted_tel;
                $user_info["user_point"] = $user_point;
                $user_info["user_married"] = $request->input("user_married")[$key];
                $user_info["user_remark"] = $request->input("user_remark")[$key];
                $user_info["user_zip"] = $request->input("user_zip")[$key];
                $user_info["user_addr"] = $request->input("user_addr")[$key];
                $user_info["user_addr_detail"] = $request->input("user_addr_detail")[$key];
                $user_info["user_out_idx"] = $user->getCountStateUseSave();
                $user_info["user_out_idx"] += 1;

                $user_idx = $user->saveUser($user_info);

                // model return 값이 숫자가 아니고 1보다 작을때 back
                if (is_numeric($user_idx) && $user_idx <= 0) {
                    return back()->withInput()->with("message", config("test_user.test_con.message.error"));
                }

                // 파일 DB 저장
                if (!empty($request->file("user_file")[$key])) {
                    $this->fileSave($request->file("user_file")[$key], $user_idx);
                }
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception($exception);
//            return back()->withInput()->with("message", $exception);
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
        $file_info["file_save_name"] = $user_idx."_".md5_file($file).'.'.$file_extension;

        $file->move("uploads/", $file_info["file_save_name"]);
//        Storage::disk('local')->put($file_info["file_save_name"],  File::get($file));

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

        $user = new TestUser();
        $detail_info = $user->getUserDetail($id);
        $detail_info->user_name_decrypt = decrypt($detail_info->user_name);
        $detail_info->user_email_decrypt = decrypt($detail_info->user_email);
        $detail_info->user_tel_decrypt = decrypt($detail_info->user_tel);
        $detail_info->user_point = number_format($detail_info->user_point);
        $detail_info->user_tel_decrypt = substr($detail_info->user_tel_decrypt, 0, 3) . "-" . substr($detail_info->user_tel_decrypt, 3, 4) . "-" . substr($detail_info->user_tel_decrypt, 7);

        return view("testuser.detail")->with("detail_info", $detail_info);
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

        $user = new TestUser();
        $detail_info = $user->getUserDetail($id);
        $detail_info->user_pwd = "";
        $detail_info->user_name_decrypt = decrypt($detail_info->user_name);
        $detail_info->user_email_decrypt = decrypt($detail_info->user_email);
        $detail_info->user_tel_decrypt = decrypt($detail_info->user_tel);
        $email = explode("@", $detail_info->user_email_decrypt);
        $detail_info->email = $email[0];
        $detail_info->domain = $email[1];
        $detail_info->user_point = number_format($detail_info->user_point);

        return view("testuser.modify")->with("detail_info", $detail_info);
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

        if ($request->input("check_pwd") != "") {
            $check_pwd = $this->checkPwd($id, $request->input("check_pwd"));
            if ($check_pwd === false) {
                return back()->withInput()->with("message", config("test_user.test_con.message.not_match_pwd"));
            }
        } else {
            return back()->withInput()->with("message", config("test_user.test_con.message.input_pwd"));
        }

        $user_info = array();

        if ($request->input("user_pwd") != "" && $request->input("user_pwd") === $request->input("user_pwd2")) {
            $encrypted_pwd = hash("sha512", $request->input("user_pwd"), false);
            $user_info["user_pwd"] = $encrypted_pwd;
        } else if ($request->input("user_pwd") != "" && $request->input("user_pwd") !== $request->input("user_pwd2")) {
            return back()->withInput()->with("message", "변경할 " . config("test_user.test_con.message.not_match_pwd"));
        }

        DB::beginTransaction();
        try {
            $queryStr = $request->query();
            array_shift($queryStr);

            $user = new TestUser();
            $now = new \DateTime();

            $user_point = preg_replace("/[^0-9]/", "", $request->input("user_point"));
            $encrypted_email = encrypt($request->input("user_email"));
            $encrypted_tel = encrypt($request->input("user_tel"));

            $user_info["user_state"] = $request->input("user_state", self::ACCOUNT);
            $user_info["user_age"] = $request->input("user_age");
            $user_info["user_gender"] = $request->input("user_gender");
            $user_info["user_email"] = $encrypted_email;
            $user_info["user_tel"] = $encrypted_tel;
            $user_info["user_married"] = $request->input("user_married");
            $user_info["user_point"] = $user_point;
            $user_info["user_zip"] = $request->input("user_zip");
            $user_info["user_addr"] = $request->input("user_addr");
            $user_info["user_addr_detail"] = $request->input("user_addr_detail");
            $user_info["user_remark"] = $request->input("user_remark");
            $user_info["updated_at"] = $now->format("Y-m-d H:i:s");

            $result = $user->modUser($user_info, $id);

            // 파일 DB 업데이트
            if (empty($request->input("file_idx")) && !is_null($request->file("user_file")) && $request->file("user_file") != "") {
                $this->fileSave($request->file("user_file"), $id);
            } else if (!empty($request->input("file_idx")) && !is_null($request->file("user_file")) && $request->file("user_file") != "") {
                $this->fileUpdate($request->file("user_file"), $request->input("file_idx"), $request->input("file_save_name"), $id);
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
        $file_info["file_save_name"] = $user_idx."_".md5_file($file).'.'.$file_extension;

        if ($file_save_name != "") {
//            Storage::disk("local")->delete($file_save_name);
            unlink("uploads/".$file_save_name);
        }

        $file->move("uploads/", $file_info["file_save_name"]);
//        Storage::disk("local")->put($file_info["file_save_name"],  File::get($file));

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
            array_shift($queryStr);

            $user = new TestUser();
            $user->delUser($id);

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
        $idx_arr = $request->input('idx_arr');

        if (is_null($idx_arr) && count($idx_arr) <= 0) {
            $res = array("result" => "", "message" => config("test_user.test_con.message.delete_input"));
            return response()->json($res);
        }

        $result = "all_delete_no";
        $message = config("test_user.test_con.message.delete_fail");

        DB::beginTransaction();
        try {
            $user = new TestUser();

            $user->userAllDel($idx_arr);

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
        $user_idx = $request->input("user_idx");
        if (!is_numeric($user_idx) || $user_idx == "") {
            $res = array("result" => "", "message" => config("test_user.test_con.message.error"));
            return response()->json($res);
        }

        $result = "restore_no";
        $message = config("test_user.test_con.message.restore_fail");

        DB::beginTransaction();
        try {
            $user = new TestUser();

            $user->userRestore($user_idx);

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
        $idx_arr = $request->input("idx_arr");

        if (is_null($idx_arr) && count($idx_arr) <= 0) {
            $res = array("result" => "", "message" => config("test_user.test_con.message.restore_input"));
            return response()->json($res);
        }

        $result = "all_restore_no";
        $message = config("test_user.test_con.message.restore_fail");

        DB::beginTransaction();
        try {
            $user = new TestUser();

            $user->userAllRestore($idx_arr);

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

        $user = new TestUser();
        $data = $user->getCheckId($request->input("user_id"));

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
        $user = new TestUser();

        $encrypted_passwd = hash("sha512", $pwd, false);
        $data = $user->checkPwd($id, $encrypted_passwd);

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
        $user_idx = $request->input("user_idx");
        $user_pwd = $request->input("user_pwd");

        if ($user_idx == "" || $user_pwd == null) {
            $res = array("result" => "", "message" => config("test_user.test_con.message.input_pwd"));
            return response()->json($res);
        }
        $user = new TestUser();

        $encrypted_passwd = hash("sha512", $user_pwd, false);
        $data = $user->checkPwd($user_idx, $encrypted_passwd);

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
        $user_idx = $request->input("user_idx");
        $user_out_idx = $request->input("user_out_idx");
        $prev_user_idx = $request->input("prev_user_idx");

        $result = "";
        DB::beginTransaction();
        try {
            $user = new TestUser();
            $user->upIndex($user_out_idx, $user_idx, $prev_user_idx);
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
        $user_idx = $request->input("user_idx");
        $user_out_idx = $request->input("user_out_idx");
        $next_user_idx = $request->input("next_user_idx");

        $result = "";
        DB::beginTransaction();
        try {
            $user = new TestUser();
            $user->downIndex($user_out_idx, $user_idx, $next_user_idx);
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
