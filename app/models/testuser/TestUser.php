<?php


namespace App\models\testuser;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class TestUser extends Model
{
    protected $table = "test_user";
    protected $primaryKey = "user_idx";

    public $timestamps = false;

    /**
     * 리스트 페이지 전체 유저 목록
     *
     * @param String $state
     * @param array $search
     * @return Model
     */
    public function getList(String $state, array $search=[])
    {
        // all list
        if ($state == "") {
            abort(404);
        }

        $listModel = $this->select(
            "user_idx",
            "user_state",
            "user_name",
            "user_id",
            "user_pwd",
            "user_age",
            "user_gender",
            "user_email",
            "user_tel",
            "user_married",
            "user_point",
            "created_at",
            "user_order"
        );

        if($state === "del_except_list") {

//            dd($search);
            $listModel = $listModel
                            // 계정 상태
                            ->wherein("user_state", $search["user_state"])
                            // 성별
                            ->when($search["user_gender"] != "all", function ($listmodel) use ($search) {
                                $listmodel->where("user_gender", $search["user_gender"]);
                            })
                            // 검색어
                            ->when(isset($search["search_select"]) && count($search["search_select"]) > 0 && !empty($search["search_select"][0]), function ($listmodel) use ($search) {
                                $listmodel->where(function ($listmodel) use ($search) {
                                    $listmodel->where($search["search_select"][0], "like", "%{$search["search_input"][0]}%");
                                    if (isset($search["search_select"][1]) && $search["search_select"][1] != "") {
                                        $listmodel->orwhere($search["search_select"][1], "like", "%{$search["search_input"][1]}%");
                                    }
                                });
                            })
                            // 정렬
                            ->when($search["search_date"]["from_date"] != "" && $search["search_date"]["to_date"] != "", function ($listmodel) use ($search) {
                                $listmodel->whereBetween("created_at", $search["search_date"]);
                            })
                            ->when($search["order_type"] != "" && $search["order_style"] != "", function ($listmodel) use ($search) {
                                $listmodel->orderby($search["order_type"], $search["order_style"]);
                            });

        } else if ($state === "del_list") {
            $listModel = $listModel->where("user_state", "=", "0");
        } else {
            abort(404);
        }

        return $listModel;
    }

    /**
     * 리스트 페이지 전체 유저 목록 카운트
     *
     * @param String $state
     * @param array $search
     * @return int listModelCount
     */
    public function getUserListModelCount(String $state, array $search=[])
    {
        // 검색 리스트 카운트

        $listModelCount = $this->getUserListModel($state, $search)->get()->count();

        return $listModelCount;
    }

    /**
     * 리스트 페이지 계정 카운트
     *
     * @return int count
     */

    public function getCountState()
    {
        $count = $this->select("user_state", DB::raw("count(*) as count"))->groupBy("user_state")->get();

        return $count;
    }

    /**
     * 리스트 페이지 연령대 카운트
     *
     * @return mixed
     */

    public function getCountAge()
    {
        $count = $this->select("user_age", DB::raw("count(*) as count"))->groupBy("user_age")->get();

        return $count;
    }


    /**
     * 리스트 페이지 평균 연령대
     *
     * @return mixed
     */
    public function getAvgAge()
    {
        $avg = $this->select("user_age")->avg("user_age");

        return $avg;
    }

    /**
     * 리스트 페이지 성별 카운트
     *
     * @return mixed
     */

    public function getCountGender()
    {
        $count = $this->select("user_gender", DB::raw("count(*) as count"))->groupBy("user_gender")->get();

        return $count;
    }


    /**
     * 리스트 페이지 적립금 sum
     *
     * @return mixed
     */

    public function getTotalPoint()
    {
        $sum = $this->select("user_point", DB::raw("SUM(user_point) as total"))->groupBy("user_point")->get();

        return $sum;
    }


    /**
     * 리스트 페이지 적립금 count
     *
     * @return mixed
     */

    public function getCountPoint()
    {
        $sum = $this->select("user_point", DB::raw("count(*) as count"))->groupBy("user_point")->get();

        return $sum;
    }


    /**
     * 상세보기 유저 정보
     *
     * @param int $user_idx
     * @return mixed
     */
    public function getUserDetail(int $user_idx=0)
    {
        // 유저 정보
        if ($user_idx <= 0) {
            abort(404);
        }

        $data = $this->select(
            "test_user.user_idx",
            "user_state",
            "user_name",
            "user_id",
            "user_pwd",
            "user_age",
            "user_gender",
            "user_email",
            "user_tel",
            "user_married",
            "user_point",
            "user_zip",
            "user_addr",
            "user_addr_detail",
            "user_remark",
            "test_user.created_at",
            "test_user.updated_at",
            "user_files.file_idx",
            "user_files.file_save_name",
            "user_files.file_original_name"
        )
            ->leftjoin("user_files", function($join) {
                $join->on("test_user.user_idx", "=", "user_files.user_idx");
            })
            ->where("test_user.user_idx", "=", $user_idx)
            ->get()
            ->first();

        return $data;
    }

    /**
     * 신규유저 등록
     *
     * @param  array $user_info
     * @return int $user_idx
     */
    public function saveUser($user_info)
    {
        // 저장
//        $this->insert($user_info);
        $user_idx = $this->insertGetId($user_info);

        return $user_idx;
    }

    /**
     * 비밀번호 체크
     *
     * @param  int $id
     * @param  int $pwd
     * @return
     */
    public function checkPwd($id, $pwd)
    {
        $data = $this->select("user_idx")
            ->where("user_idx", "=", $id)
            ->where("user_pwd", "=", $pwd)
            ->get();

        return $data;
    }

    /**
     * 유저정보 updqte
     *
     * @param  array $user_info
     * @param  int $id
     */
    public function modUser($user_info, int $id=0)
    {
        // 수정
        if ($user_info == null) {
            abort(404);
        }
        if ($id <= 0) {
            abort(404);
        }

        $this->where("user_idx", "=", $id)->update($user_info);

    }

    /**
     * 유저정보 삭제 (state "0"으로 update)
     *
     * @param int $id
     */
    public function delUser(int $id=0)
    {
        // 삭제
        if ($id <= 0) {
            abort(404);
        }

        $this->where("user_idx", "=", $id)->update(["user_state"=>"0"]);

    }

    /**
     * 유저정보 삭제 (state "0"으로 update)
     *
     * @param  array $idx_arr
     * @throws
     */
    public function userAllDel(array $idx_arr=[])
    {
        // 일괄 삭제
        if (count($idx_arr) == 0) {
            abort(404);
        }

        $this->wherein("user_idx", $idx_arr)->update(["user_state"=>"0"]);

    }


    /**
     * 신규유저 등록 > 아이디 중복체크 ajax
     *
     * @param  int $id
     * @return
     */
    public function getCheckId($id)
    {
        // 아이디 중복체크
        $data = $this->select(
            "user_idx"
        )
            ->where("user_id", "=", $id)
            ->get();

        return $data;
    }

    /**
     * 복구 ajax
     *
     * @param  int $id
     */
    public function userRestore(int $id)
    {
        // 탈퇴계정 복구
        if ($id <= 0) {
            abort(404);
        }

        $this->where("user_idx", "=", $id)->update(["user_state"=>"1"]);
    }

    /**
     * 전체 복구 ajax
     *
     * @param  array $idx_arr
     */
    public function userAllRestore(array $idx_arr=[])
    {
        // 탈퇴계정 복구
        if (count($idx_arr) == 0) {
            abort(404);
        }

        $this->wherein("user_idx", $idx_arr)->update(["user_state"=>"1"]);
    }

    /**
     * 계정 count (user_order 에 쓰임)
     *
     * @param array $state
     * @return mixed
     */
    public function getCountStateUseSave()
    {
        $count = $this->select("user_idx")->get()->count();
        return $count;
    }

    /**
     * 순번 변경 (↑)
     *
     * @param int $user_order
     * @param int $user_idx
     * @param int $prev_user_idx
     */
    public function upIndex(int $user_order=0, int $user_idx=0, int $prev_user_idx=0)
    {
        $prev_out_index = $this->where("user_idx", "=", $prev_user_idx)->value("user_order");

        $this->where("user_idx", "=", $prev_user_idx)->update(["user_order"=>$user_order]);
        $this->where("user_idx", "=", $user_idx)->update(["user_order"=>$prev_out_index]);
    }


    /**
     * 순번 변경 (↓)
     *
     * @param int $user_order
     * @param int $user_idx
     * @param int $prev_user_idx
     */
    public function downIndex(int $user_order=0, int $user_idx=0, int $next_user_idx=0)
    {
        $next_out_index = $this->where("user_idx", "=", $next_user_idx)->value("user_order");
        $this->where("user_idx", "=", $next_user_idx)->update(["user_order"=>$user_order]);
        $this->where("user_idx", "=", $user_idx)->update(["user_order"=>$next_out_index]);
    }
}
