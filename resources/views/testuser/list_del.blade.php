<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>List</title>
    <style type="text/css">
        table > thead > tr, table > tbody > tr {
            text-align: center;
        }
    </style>
</head>
<body>
<div>
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>순번</th>
            <th>번호</th>
            <th>상태</th>
            <th>이름</th>
            <th>아이디</th>
            <th>성별</th>
            <th>나이</th>
            <th>전화번호</th>
            <th>email</th>
            <th>복구</th>
        </tr>
        </thead>
        <tbody>
        @if(!is_null($user_list) && $user_list->count() > 0)
            @foreach($user_list as $key => $list)
                <tr class="tr_row">
                    <td>{{ $key+1 }}</td>
                    <td class="td_col">{{ $list->user_idx }}</td>
                    <td>{{ $list->user_state=="0" ? "탈퇴" : "-" }}</td>
                    <td>{{ $list->user_name_decrypt }}</td>
                    <td>{{ $list->user_id }}</td>
                    <td>{{ $list->user_gender=="1" ? "남자" : "여자" }}</td>
                    <td>{{ $list->user_age }}</td>
                    <td>{{ $list->user_tel_decrypt }}</td>
                    <td>{{ $list->user_email_decrypt }}</td>
                    <td><input type="button" id="restore_btn{{ $key }}" class="btn btn-danger btn-restore" value="복구"></td>
                </tr>
            @endforeach
        @else
            <tr>
                <td style="border:1px solid;" colspan="10" align="center">
                    등록된 데이터가 없습니다.
                </td>
            </tr>
        @endif
        </tbody>
    </table>
    @if(isset($user_list) && $user_list->count() > 0)
        <input type="button" id="all_restore_btn" class="btn btn-danger" value="전체 복구">
    @endif
</div>
</body>


<script>
    // 복구 버튼 클릭 시
    $(".btn-restore").click(function() {
        if(confirm("복구하시겠습니까?") === true) {
            let idx = $(this).closest("tr").find(".td_col").text();
            // 복구 ajax
            $.ajax({
                type : "POST",
                url : "{{ route("testuser_restore") }}",
                data : {
                    "user_idx" : idx,
                    _token: "{{ csrf_token() }}"
                },
                success : function(response) {
                    alert(response.message);
                    // 복구 완료 시 list 재 조회
                    if(response.result === "restore_ok") {
                        window.close();
                        opener.location.href = "{{ route('testuser_index') }}" + location.search;
                    }
                },
                error : function(request, status, error) {
                    alert("message : " + request.responseJSON.message + ", status : " + status + ", error : " + error);
                }
            });
        } else {
            return false;
        }

    });

    // 전체 복구 클릭 시
    $("#all_restore_btn").click(function() {
        if(confirm("전체 복구하시겠습니까?") === true) {
            // 전체 list 의 idx 값 배열에 저장
            let idx_arr = [];
            $(".tr_row").each(function () {
                idx_arr.push($(this).find(".td_col").text());
            });
            // 전체 복구 ajax
            $.ajax({
                type : "POST",
                url : "{{ route("testuser_allrestore") }}",
                data : {
                    "idx_arr" : idx_arr,
                    _token: "{{ csrf_token() }}"
                },
                success : function(response) {
                    alert(response.message);
                    // 복구 완료 시 팝업 닫고, list 재 조회
                    if(response.result === "all_restore_ok") {
                        close();
                        opener.location.href = "{{ route('testuser_index') }}" + location.search;
                    }
                },
                error : function(request, status, error) {
                    alert("message : " + request.responseJSON.message + ", status : " + status + ", error : " + error);
                }
            });
        } else {
            return false;
        }

    });
</script>
</html>
