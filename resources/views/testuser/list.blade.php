<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />


    <title>List</title>
    <style type="text/css">
        #list_table {
            text-align: center;
        }
        #div1 {
            width: 100%;
            text-align: center;
        }
        #paging {
            display: inline-block;
        }
    </style>
</head>
<body>

<div id="div1">
    <form id="search_form" name="search_form" class="form-inline" action="{{ route("testuser_index") }}" method="GET">
        <table id="search_table" class="table table-bordered">
            <tr>
                <th colspan="2" style="background-color: aliceblue"> 검색 </th>
            </tr>
            <tr>
                <th rowspan="2" style="background-color: aliceblue;vertical-align: middle">
                    검색어
                </th>
                <td align="left">
                    <select id="search_select1" name="search_select[]" class="form-control search_select" style="width: 150px;display: inline-block;">
                        <option value="__default__">선택</option>
                        <option value="user_name">이름</option>
                        <option value="user_id">아이디</option>
                        <option value="user_email">이메일</option>
                    </select>
                    <input type="text" id="search_input1" name="search_input[]" class="form-control search_input" value="{{ $search["search_input"][0] }}" style="width: 200px;display: inline-block;">
                </td>
            </tr>
            <tr>
                <td align="left">
                    <select id="search_select2" name="search_select[]" class="form-control search_select" style="width: 150px;display: inline-block;">
                        <option value="__default__">선택</option>
                        <option value="user_name">이름</option>
                        <option value="user_id">아이디</option>
                        <option value="user_email">이메일</option>
                    </select>
                    <input type="text" id="search_input2" name="search_input[]" class="form-control search_input" value="{{ $search["search_input"][1] }}" style="width: 200px;display: inline-block;">
                </td>
            </tr>
            <tr>
                <th style="background-color: aliceblue">
                    상태
                </th>
                <td align="left">
                    <div class="custom-control custom-checkbox" style="width:100px;display: inline-block;">
                        <input type="checkbox" id="state1" name="user_state[]" class="custom-control-input user_state" value="all">
                        <label class="custom-control-label" for="state1">모든계정</label>
                    </div>
                    <div class="custom-control custom-checkbox" style="width:100px;display: inline-block;">
                        <input type="checkbox" id="state2" name="user_state[]" class="custom-control-input user_state" value="1">
                        <label class="custom-control-label" for="state2">사용계정</label>
                    </div>
                    <div class="custom-control custom-checkbox" style="width:100px;display: inline-block;">
                        <input type="checkbox" id="state3" name="user_state[]" class="custom-control-input user_state" value="2">
                        <label class="custom-control-label" for="state3">휴면계정</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th style="background-color: aliceblue">
                    성별
                </th>
                <td align="left">
                    <div class="custom-control custom-radio" style="width:70px;display: inline-block;">
                        <input type="radio" id="gender" name="user_gender" class="custom-control-input user_gender" value="all" checked>
                        <label class="custom-control-label" for="gender">전체</label>
                    </div>
                    <div class="custom-control custom-radio" style="width:70px;display: inline-block;">
                        <input type="radio" id="gender1" name="user_gender" class="custom-control-input user_gender" value="1">
                        <label class="custom-control-label" for="gender1">남자</label>
                    </div>
                    <div class="custom-control custom-radio" style="width:70px;display: inline-block;">
                        <input type="radio" id="gender2" name="user_gender" class="custom-control-input user_gender" value="2">
                        <label class="custom-control-label" for="gender2">여자</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th style="background-color: aliceblue;vertical-align: middle">
                    가입일
                </th>
                <td align="left">
                    <div class="input-daterange input-group" id="datepicker" style="width:400px;">
                        <input type="text" id="from_date" name="from_date" class="input-sm form-control" value="{{ $search["search_date"]["from_date"] }}">
                        <span class="input-group-addon">&nbsp;~&nbsp;</span>
                        <input type="text" id="to_date" name="to_date" class="input-sm form-control" value="{{ $search["search_date"]["to_date"] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <th style="background-color: aliceblue">
                    정렬
                </th>
                <td align="left">
                    <select class="form-control" id="order_type" name="order_type" style="width: 10%;display: inline-block;">
                        <option value="user_out_idx">순번</option>
                        <option value="user_idx">번호</option>
                        <option value="user_state">상태</option>
                        <option value="user_name">이름</option>
                        <option value="user_id">아이디</option>
                        <option value="user_gender">성별</option>
                        <option value="user_age">나이</option>
                        <option value="user_point">적립금</option>
                    </select>
                    <select class="form-control" id="order_style" name="order_style" style="width: 15%;display: inline-block;">
                        <option value="asc">오름차순</option>
                        <option value="desc">내림차순</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="button" id="search_btn" class="btn btn-dark" value="검색">
                    <input type="button" id="reset_btn" class="btn btn-outline-secondary" value="초기화">
                </td>
            </tr>
            <tr>
                <td align="left" style="border-right: hidden;vertical-align: bottom;">조회된 건수 : {{ $user_list_count }}</td>
                <td align="right">
                    <a href="{{ route("testuser_create") }}" id="create_btn" class="btn btn-primary">유저 등록</a>
                    <a href="#" id="all_destroy" class="btn btn-danger">일괄 탈퇴</a>
                    <select class="form-control" id="perpage" name="perpage" style="width: 10%;display: inline-block;">
                        <option value="1">1개</option>
                        <option value="2">2개</option>
                        <option value="3">3개</option>
                        <option value="5">5개</option>
                        <option value="7">7개</option>
                        <option value="10">10개</option>
                    </select>
                </td>
            </tr>
        </table>
    </form>

    <table id="list_table" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th><input type="checkbox" id="check_all" name="check_all"></th>
            <th>순번</th>
            <th>번호</th>
            <th>상태</th>
            <th>이름</th>
            <th>아이디</th>
            <th>성별</th>
            <th>나이</th>
            <th>전화번호</th>
            <th>email</th>
            <th>적립금</th>
            <th>가입일</th>
            <th colspan="2">이동</th>
            <th>순번변경</th>
        </tr>
        </thead>
        <tbody>
        @if(!is_null($user_list) && $user_list->count() > 0)
            @foreach($user_list as $key => $list)
                <tr class="tr_row" @if($list->user_state=="2") style="background-color: yellowgreen" @endif>
                    <td><input type="checkbox" name="list_select"></td>
                    <td class="list_num">{{ ($user_list->total() - ( $user_list->total() - (($user_list->currentPage()-1) * $user_list->perPage() + ($key+1)) )) }}</td>
{{--                    <td>{{ $list->user_out_idx }}</td>--}}
                    <td class="td_col">{{ $list->user_idx }}</td>
                    <td>@if($list->user_state=="1") 사용 @elseif($list->user_state=="2") 휴면 @else - @endif</td>
                    <td><a href="{{ route("testuser_detail", ["user_id"=>$list->user_idx]) }}" class="list_user_name" onclick="list_user_name_click('{{ $list->user_idx }}')">{{ $list->user_name }}</a></td>
                    <td>{{ $list->user_id }}</td>
                    <td>{{ $list->user_gender=="1" ? "남자" : "여자" }}</td>
                    <td>{{ $list->user_age }}</td>
                    <td>{{ $list->user_tel }}</td>
                    <td>{{ $list->user_email }}</td>
                    <td>{{ number_format($list->user_point) }}</td>
                    <td>{{ $list->created_at }}</td>
                    <td><a href="{{ route("testuser_edit", ["user_idx"=>$list->user_idx]) }}" class="btn btn-success modify_btn" onclick="modify_btn_click('{{ $list->user_idx }}')">수정</a></td>
                    <td><input type="button" name="del_btn" class="btn btn-danger" value="탈퇴" onclick="del_click({{ $list->user_idx }})"></td>
                    <td>
                        <input type="button" name="up_btn" class="btn-sm btn-outline-warning up_btn" value="▲" onclick="up_index_click($(this), '{{ $list->user_out_idx }}', '{{ $list->user_idx }}', '{{ $key+1 }}')">
                        <input type="button" name="down_btn" class="btn-sm btn-outline-warning down_btn" value="▼" onclick="down_index_click($(this), '{{ $list->user_out_idx }}', '{{ $list->user_idx }}', '{{ $user_list->perPage() }}', '{{ $key+1 }}', '{{ $user_list->total() }}')">
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td style="border:1px solid;" colspan="15" align="center">
                    등록된 데이터가 없습니다.
                </td>
            </tr>
        @endif
        </tbody>
    </table>
    <div id="paging">
        {{ $user_list
            ->appends([
                'search_select'=>request()->search_select,
                'search_input'=>request()->search_input,
                'user_state'=>request()->user_state,
                'user_gender'=>request()->user_gender,
                'from_date'=>request()->from_date,
                'to_date'=>request()->to_date,
                'order_type'=>request()->order_type,
                'order_style'=>request()->order_style,
                'perpage'=>request()->perpage
            ])->links() }}
    </div><br>
    <table id="list_table" class="table table-bordered">
        <thead>
        <tr>
            <th colspan="8" style="background-color: aliceblue">
                통계 자료
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th rowspan="2" width="10%" style="vertical-align: middle;background-color: aliceblue">
                계정별
            </th>
            <th width="15%">
                총 계정
            </th>
            <th width="15%">
                사용계정
            </th>
            <th width="15%">
                휴면계정
            </th>
            <th width="15%">
                탈퇴계정 <a href="#" class="btn btn-warning btn-sm" onclick="del_list_click()">리스트</a>
            </th>
        </tr>
        <tr>
            <td>
                {{ $count_all["state"]["all"] }}명
            </td>
            <td>
                {{ $count_all["state"]["account"] }}명
            </td>
            <td>
                {{ $count_all["state"]["dormancy"] }}명
            </td>
            <td>
                {{ $count_all["state"]["leaveAccount"] }}명
            </td>
        </tr>
        <tr>
            <th rowspan="2" width="10%" style="vertical-align: middle;background-color: aliceblue">
                성별
            </th>
            <th width="15%">
                남자
            </th>
            <th width="15%">
                여자
            </th>
        </tr>
        <tr>
            <td>
                {{ $count_all["gender"]["male"] }}명
            </td>
            <td>
                {{ $count_all["gender"]["female"] }}명
            </td>
        </tr>
        <tr>
            <th rowspan="2" width="10%" style="vertical-align: middle;background-color: aliceblue">
                연령별
            </th>
            <th width="15%">
                19 세 이하
            </th>
            <th width="15%">
                20 ~ 30 대
            </th>
            <th width="15%">
                40 ~ 50 대
            </th>
            <th width="15%">
                60 세 이상
            </th>
            <th width="15%">
                평균 나이
            </th>
        </tr>
        <tr>
            <td>
                {{ $count_all["age"]["teen"] }}명
            </td>
            <td>
                {{ $count_all["age"]["two_three"] }}명
            </td>
            <td>
                {{ $count_all["age"]["four_five"] }}명
            </td>
            <td>
                {{ $count_all["age"]["six"] }}명
            </td>
            <td>
                {{ $avg_age }}세
            </td>
        </tr>
        <tr>
            <th rowspan="2" width="10%" style="vertical-align: middle;background-color: aliceblue">
                적립금별
            </th>
            <th width="15%">
                1,000원 미만
            </th>
            <th width="15%">
                1,000 ~ 9,999원
            </th>
            <th width="15%">
                10,000원 이상
            </th>
            <th width="15%">
                적립금 총액
            </th>
        </tr>
        <tr>
            <td>
                {{ $count_all["point"]["1000"] }}명
            </td>
            <td>
                {{ $count_all["point"]["9999"] }}명
            </td>
            <td>
                {{ $count_all["point"]["10000"] }}명
            </td>
            <td>
                {{ number_format($total_point) }}원
            </td>
        </tr>
        </tbody>
    </table>
</div>

</body>

<script>

    // 탈퇴 버튼 onclick function
    function del_click (idx) {
        let input_pwd = prompt("비밀번호를 입력해주세요.");

        if (input_pwd == null || input_pwd == undefined || input_pwd == "") {
            alert("비밀번호가 입력되지 않았습니다.");
            return false;
        } else {
            // 비밀번호 체크 ajax
            $.ajax({
                type : "POST",
                url : "{{ route("testuser_pwdcheck") }}",
                data : {
                    "user_idx" : idx,
                    "user_pwd" : input_pwd,
                    _token : "{{ csrf_token() }}"
                },
                error : function(request, status, error) {
                    alert("message : " + request.responseJSON.message + ", status : " + status + ", error : " + error);
                },
                complete : function (response) {
                    alert(response.responseJSON.message);
                    // 비밀번호 체크 ok 후 탈퇴 처리
                    if(response.responseJSON.result === "pwd_check_ok") {
                        location.href = "{{ route("testuser_destroy") }}/"+idx+location.search;
                    }
                }
            });
        }
    }

    // 탈퇴계정 리스트 보기 클릭 시
    function del_list_click () {
        let url = '{{ route("testuser_indexdel") }}'+location.search;
        window.open(url, 'window팝업', 'width=1500, height=800, menubar=no, status=no, toolbar=no');
    }

    // 각 row 의 순번 ▲ 버튼 클릭 시
    function up_index_click (object, out_idx, user_idx, list_num) {
        let prev_user_idx = object.closest("tr").prev().find(".td_col").text();
        let this_number = object.closest("tr").find(".list_num").text();        // 현재 row 의 순번 td 값
        if (this_number == "1") {
            alert("가장 첫번째 순번입니다.");
        } else if (list_num == "1") {
            alert("현재 페이지 중 첫번째 순번 입니다.");
        } else if (confirm("순번을 변경합니다.") === true) {
            $.ajax({
                type : "GET",
                url : "{{ route("testuser_upindex") }}",
                data : {
                    "user_idx" : user_idx,
                    "user_out_idx" : out_idx,
                    "prev_user_idx" : prev_user_idx
                },
                dataType : "json",
                success : function(response) {
                    if(response.result === "change_success") {
                        location.href = "{{ route("testuser_index") }}"+location.search;
                    }
                },
                error : function(request) {
                    alert(request.responseJSON.message);
                }
            })
        } else {
            return false;
        }
    }

    // 각 row 의 순번 ▼ 버튼 클릭 시
    function down_index_click (object, out_idx, user_idx, perpage, list_num, list_total) {      // this, user_out_idx, user_idx, 페이지 표시 개수, 현재 row 의 key 값, total 리스트 개수
        let next_user_idx = object.closest("tr").next().find(".td_col").text(); // 바꿀 row 의 user_idx 값
        let this_number = object.closest("tr").find(".list_num").text();        // 현재 row 의 순번 td 값
        if (this_number == list_total) {
            alert("가장 마지막 순번입니다.");
        } else if (list_num == perpage) {
            alert("현재 페이지 중 마지막 순번입니다.");
        } else if (confirm("순번을 변경합니다.") === true) {
            $.ajax({
                type : "GET",
                url : "{{ route("testuser_downindex") }}",
                data : {
                    "user_idx" : user_idx,
                    "user_out_idx" : out_idx,
                    "next_user_idx" : next_user_idx
                },
                dataType : "json",
                success : function(response) {
                    if(response.result === "change_success") {
                        location.href = "{{ route("testuser_index") }}"+location.search;
                    }
                },
                error : function(request) {
                    console.log(request);
                }
            })
        } else {
            return false;
        }
    }

    function modify_btn_click (user_idx) {
        $(this).attr("href", "{{ route("testuser_edit") }}"+user_idx+location.search);
    }

    function list_user_name_click (user_idx) {
        $(this).attr("href", "{{ route("testuser_detail") }}"+user_idx+location.search);
    }

    $(document).ready(function() {

        let msg = "{{ session("message") }}";
        if (msg !== "") {
            alert(msg);
        }

        // 검색어 selected
        @if(isset($search["search_select"]) && count($search["search_select"]) > 0)
            @foreach($search["search_select"] as $key => $item)
                $("#search_select1 option").each(function() {
                    if("{{ $key }}" === "0" && "{{ $item }}" === $(this).val()) {
                        $(this).prop("selected", true);
                        return false;
                    }
                });
                $("#search_select2 option").each(function() {
                    if("{{ $key }}" === "1" && "{{ $item }}" === $(this).val()) {
                        $(this).prop("selected", true);
                        return false;
                    }
                });
            @endforeach
        @endif

        // 상태 checked
        @if(isset($search["user_state"]) && count($search["user_state"]) > 0)
            $(".user_state").each(function() {
                @foreach($search["user_state"] as $state)
                    if("{{ $state }}" === $(this).val() && $(this).attr("id") === "state1") {
                        $(".user_state").prop("checked", true);
                    } else if ("{{ $state }}" === $(this).val() && $(this).attr("id") !== "state1") {
                        $(this).prop("checked", true);
                    }
                @endforeach
            });
        @else
            $(".user_state").prop("checked", true);
        @endif

        // 성별 checked
        @if(isset($search["user_gender"]) && $search["user_gender"] !== "")
            $("input[name='user_gender']").each(function() {
                if("{{ $search["user_gender"] }}" === $(this).val()) {
                    $(this).prop("checked", true);
                    return false;
                }
            });
        @endif

        // 정렬 타입 selected
        @if(isset($search["order_type"]) && $search["order_type"] !== "")
            $("#order_type > option").each(function() {
                if("{{ $search["order_type"] }}" === $(this).val()) {
                    $(this).prop("selected", true);
                    return false;
                }
            });
        @endif

        // 정렬 방식 selected
        @if(isset($search["order_style"]) && $search["order_style"] !== "")
            $("#order_style > option").each(function() {
                if("{{ $search["order_style"] }}" === $(this).val()) {
                    $(this).prop("selected", true);
                    return false;
                }
            });
        @endif

        // 페이지 개수 selected
        $("#perpage > option").each(function () {
            if ("{{ $perpage }}" === $(this).val()) {
                $(this).prop("selected", true);
                return false;
            }
        });

        // 페이지 select box 체인지 이벤트
        $("#perpage").change(function() {
            $("#search_btn").click();
        });

        // 부트스트랩 달력 설정 (1번째 입력)
        $(".input-daterange").datepicker({
            format: 'yyyy/mm/dd'
        });

        // 모든 계정 클릭 시 전부 체크 혹은 체크 해제
        $("#state1").click(function() {
            if ($(this).prop("checked") === true) {
                $(".user_state").prop("checked", true);
            } else {
                $(".user_state").prop("checked", false);
            }
        });

        // 사용계정 클릭 시 다른 항목 전부 체크 되어있으면 모든계정 체크 혹은 체크 해제
        $("#state2").click(function() {
            if ($(this).prop("checked") === true && $("#state3").prop("checked") === true) {
                $("#state1").prop("checked", true);
            } else {
                $("#state1").prop("checked", false);
            }
        });

        // 휴면계정 클릭 시 다른 항목 전부 체크 되어있으면 모든계정 체크 혹은 체크 해제
        $("#state3").click(function() {
            if ($(this).prop("checked") === true && $("#state2").prop("checked") === true) {
                $("#state1").prop("checked", true);
            } else {
                $("#state1").prop("checked", false);
            }
        });

        // table check box 클릭 이벤트 (all check)
        $("#check_all").click(function() {
            if ($("#check_all").prop("checked") === true) {
                $("input[name='list_select']").prop("checked", true);
            } else {
                $("input[name=list_select]").prop("checked", false);
            }
        });

        // 각 tr check box 클릭 이벤트 (전부 체크 시 check_all->check)
        $("input[name='list_select']").click(function() {
            let check = "전부체크";
            $("input[name='list_select']").each(function () {
                if ($(this).prop("checked") === false) {
                    check = "체크해제";
                }
            });
            if (check === "전부체크") {
                $("#check_all").prop("checked", true);
            } else {
                $("#check_all").prop("checked", false);
            }
        });

        // 검색 버튼 클릭 시
        $("#search_btn").click(function() {
            // 검색어 select 된 값이 없으면 select, input 초기화
            $(".search_select").each(function() {
                if ($(this).val() === "__default__") {
                    $(this).val("");
                    $(this).closest("tr").find(".search_input").val("");
                }
                if($(this).closest("tr").find(".search_input").val() === "") {
                    $(this).val("");
                }
            });
            $("#search_form").submit();
        });

        // 초기화 버튼 클릭 시
        $("#reset_btn").click(function() {
            $("#search_select").find("option:eq(0)").prop("selected", true);
            $("#search_input").val("");
            $(".user_state").each(function() {
                $(this).prop("checked", false);
            });
            $(".user_gender").each(function() {
                $(this).prop("checked", false);
            });
            $("#order_type").find("option:eq(0)").prop("selected", true);
            $("#order_style").find("option:eq(0)").prop("selected", true);
            $("#from_date").val("");
            $("#to_date").val("");
        });

        // 일괄 탈퇴버튼 클릭 시
        $("#all_destroy").click(function () {
            if(confirm("탈퇴하시겠습니까?") === true) {
                // 리스트에 체크 된 것의 idx 값 idx_arr 에 배열로 담음
                let idx_arr = [];
                $(".tr_row").each(function () {
                    if ($(this).find("input[name=list_select]").prop("checked") === true) {
                        idx_arr.push($(this).find(".td_col").text());
                    }
                });

                if (idx_arr.length > 0) {
                    // 일괄 탈퇴 ajax
                    $.ajax({
                        type : "POST",
                        url : "{{ route("testuser_alldestroy") }}",
                        data : {
                            "idx_arr" : idx_arr,
                            _token: "{{ csrf_token() }}"
                        },
                        success : function(response) {
                            alert(response.msg);
                            // 탈퇴처리 완료 후 재 조회
                            if(response.result === "all_delete_ok") {
                                location.href = "{{ route("testuser_index") }}"+location.search;
                            }
                        },
                        error : function(request, status, error) {
                            alert("message : " + request.responseJSON.message + ", status : " + status + ", error : " + error);
                        }
                    });
                }
            }
        });

        $("#create_btn").click(function() {
            $(this).attr("href", "{{ route("testuser_create") }}"+location.search);
        });


        {{--        $("#all_destroy").click(function () {--}}
        {{--            var idx_arr = [];--}}
        {{--            var i = 0;--}}
        {{--            $("[name=list_select]:checked").each(function () {--}}
        {{--                idx_arr[i] = $(this).closest("tr").find("td:nth-child(3)").text();--}}
        {{--                i++;--}}
        {{--            });--}}

        {{--            $("#search_form").attr("action", "{{ route("testuser_alldestroy") }}");--}}
        {{--            // console.log($("#search_form"));--}}
        {{--            $("#search_form").submit();--}}
        {{--        });--}}

    });
</script>
</html>
