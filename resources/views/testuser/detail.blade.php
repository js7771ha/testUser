<!DOCTYPE html>
<html lang="utf-8">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Detail</title>
</head>
<body>
<div>
    <table class="table table-bordered">
        <tbody>
        <tr>
            <th width="200px;">
                상태
            </th>
            <td>
                {{ $user_info->user_state == "1" ? "사용계정" : "휴면계정" }}
            </td>
        </tr>
        <tr>
            <th width="200px;" style="vertical-align: middle">
                이름
            </th>
            <td style="max-width: 700px;">
                {{ $user_info->user_name." (".$user_info->user_name.")" }}
            </td>
        </tr>
        <tr>
            <th width="200px;">
                아이디
            </th>
            <td>
                {{ $user_info->user_id }}
            </td>
        </tr>
        <tr>
            <th width="200px;">
                성별
            </th>
            <td>
                {{ $user_info->user_gender == "1" ? "남자" : "여자" }}
            </td>
        </tr>
        <tr>
            <th width="200px;">
                나이
            </th>
            <td>
                {{ $user_info->user_age }} 세
            </td>
        </tr>
        <tr>
            <th width="200px;">
                전화번호
            </th>
            <td>
                {{ $user_info->user_tel }}
            </td>
        </tr>
        <tr>
            <th width="200px;">
                이메일
            </th>
            <td>
                {{ $user_info->user_email }}
            </td>
        </tr>
        <tr>
            <th width="200px;">
                적립금
            </th>
            <td>
                {{ $user_info->user_point }} 원
            </td>
        </tr>
        <tr>
            <th width="200px;">
                결혼 여부
            </th>
            <td>
                {{ $user_info->user_married == "1" ? "미혼" : "기혼" }}
            </td>
        </tr>
        <tr>
            <th width="200px;">
                주소
            </th>
            <td>
                {{ "(".$user_info->user_zip.") ".$user_info->user_addr." ".$user_info->user_addr_detail }}
            </td>
        </tr>
        <tr>
            <th style="vertical-align: middle">
                등록 파일
            </th>
            <td>
                @if($user_info->file_save_name != "")
                    <a href="/uploads/{{ $user_info->file_save_name }}" download>
                        <img src="/uploads/{{ $user_info->file_save_name }}" style="max-width: 500px;max-height: 500px;"><br>
                    </a>
                @else
                    등록된 파일이 없습니다.
                @endif
            </td>
        </tr>
        <tr>
            <th width="200px;">
                비고
            </th>
            <td>
                {{ $user_info->user_remark }}
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="button" id="save_btn" class="btn btn-success" value="수정하기">
                <input type="button" id="del_btn" class="btn btn-danger" value="탈퇴하기">
                <input type="button" id="list_btn" class="btn btn-secondary" value="목록보기">
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>

<script>

    $(document).ready(function() {

        // 수정하기 버튼 클릭 시
        $("#save_btn").click(function() {
            location.href = "{{ route("testuser_edit", ["user_idx" => $user_info->user_idx]) }}" + location.search;
        });

        // 탈퇴하기 클릭 시
        $("#del_btn").click(function() {
            location.href = "{{ route("testuser_pwdcheckview", ["user_idx" => $user_info->user_idx]) }}" + location.search;
        });

        // 목록보기 클릭 시
        $("#list_btn").click(function() {
            location.href = "{{ route("testuser_index") }}" + location.search;
        });
    });

</script>
</html>
