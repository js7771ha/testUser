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
     * 유저 리스트
     *
     * @param array $conditions
     * @return Model
     */
    public function getList(array $conditions=[])
    {
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
        )
            // 계정 상태
            ->wherein("user_state", $conditions["user_state"])
            // 성별
            ->when($conditions["user_gender"] !== "all", function ($listModel) use ($conditions) {
                $listModel->where("user_gender", $conditions["user_gender"]);
            })
            // 검색어
            ->when(!is_null($conditions["search_type"][0]) && $conditions["search_type"][0] !== "", function ($listModel) use ($conditions) {
                $listModel->where(function ($listModel) use ($conditions) {
                    // 검색어 1
                    $listModel->where("{$conditions["search_type"][0]}", "like", "%{$conditions["search_keyword"][0]}%");
//                    $listModel->where("{$conditions["search_type"][0]}", "like", "%{$conditions["en_search_keyword"][0]}%");
                    // 검색어 2
                    if (!is_null($conditions["search_type"][1]) && $conditions["search_type"][1] !== "") {
                        $listModel->orwhere($conditions["search_type"][1], "like", "%{$conditions["search_keyword"][1]}%");
                    }
                });
            })
            // 가입일 from_date
            ->when(!is_null($conditions["search_date"]["from_date"]) && $conditions["search_date"]["from_date"] !== "", function ($listModel) use ($conditions) {
                $listModel->where("created_at", ">=", DB::raw("date_format('{$conditions["search_date"]["from_date"]}', '%Y-%m-%d')"));
            })
            // 가입일 to_date
            ->when(!is_null($conditions["search_date"]["to_date"]) && $conditions["search_date"]["to_date"] !== "", function ($listModel) use ($conditions) {
                $listModel->where("created_at", "<=", DB::raw("addtime(date_format('{$conditions["search_date"]["to_date"]}', '%Y-%m-%d 00:00:00'), '23:59:59')"));
            })
            // 정렬
            ->when($conditions["order_type"] !== "" && $conditions["order_style"] !== "", function ($listModel) use ($conditions) {
                $listModel->orderby($conditions["order_type"], $conditions["order_style"]);
            });

        return $listModel;
    }


    /**
     * 탈퇴회원 리스트
     *
     * @return mixed
     */
    public function getLeaveList()
    {
        $leaveList = $this->select(
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
        )
            ->where("user_state", "=", "0")
            ->get();

        return $leaveList;
    }

    /**
     * 리스트 페이지 전체 유저 목록 카운트
     *
     * @param String $state
     * @param array $search
     * @return int listModelCount
     */
    public function getCount(array $search=[])
    {
        // 검색 리스트 카운트

        $listModelCount = $this->getList($search)->get()->count();

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

    public function getTotalMembershipPoint()
    {
        $sum = $this->select("user_point", DB::raw("SUM(user_point) as total"))->groupBy("user_point")->get();

        return $sum;
    }


    /**
     * 리스트 페이지 적립금 count
     *
     * @return mixed
     */

    public function getCountMembershipPoint()
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
    public function getInfo(int $user_idx=0)
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
    public function setSave($user_info)
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
    public function getCheckPwd($id, $pwd)
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
    public function setLeave(int $id=0)
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
    public function setAllLeave(array $idx_arr=[])
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
    public function setRestore(int $id)
    {
        // 탈퇴계정 복구
        if ($id <= 0) {
            abort(404);
        }

        $this->where("user_idx", "=", $id)->update(["user_state"=>"2"]);
    }

    /**
     * 전체 복구 ajax
     *
     * @param  array $idx_arr
     */
    public function setAllRestore(array $idx_arr=[])
    {
        // 탈퇴계정 복구
        if (count($idx_arr) == 0) {
            abort(404);
        }

        $this->wherein("user_idx", $idx_arr)->update(["user_state"=>"2"]);
    }

    /**
     * 저장된 데이터중 제일 마지막 user_order 번호 가져오기
     *
     * @param array $state
     * @return mixed
     */
    public function getLastOrder()
    {
        $order = $this->orderby("user_order", "desc")->value("user_order");
        return $order;
    }

    /**
     * 순번 변경 (↑)
     *
     * @param int $user_order
     * @param int $user_idx
     * @param int $prev_user_idx
     */
    public function setUpOrder(int $user_order=0, int $user_idx=0, int $prev_user_idx=0)
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
    public function setDownOrder(int $user_order=0, int $user_idx=0, int $next_user_idx=0)
    {
        $next_out_index = $this->where("user_idx", "=", $next_user_idx)->value("user_order");
        $this->where("user_idx", "=", $next_user_idx)->update(["user_order"=>$user_order]);
        $this->where("user_idx", "=", $user_idx)->update(["user_order"=>$next_out_index]);
    }
}
