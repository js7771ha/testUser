<!DOCTYPE html>
<html lang="utf-8">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Detail</title>
</head>
<body>
<div>
    <form id="checkpwd_form" name="checkpwd_form" class="form-inline">
        <table class="table table-bordered" style="vertical-align: middle">
            <tbody>
            <tr>
                <td align="center">
                    비밀번호 입력 : &nbsp;
                    <input type="password" name="check_pwd" class="form-control" minlength="4" maxlength="20">
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="button" id="del_btn" class="btn btn-danger" value="탈퇴하기">
                    <input type="button" id="list_btn" class="btn btn-secondary" value="취소">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
</body>

<script>

    $(document).ready(function() {

        // 탈퇴하기 클릭 시
        $("#del_btn").click(function() {
            location.href = "{{ route("testuser_destroy", ["user_idx"=>$user_idx]) }}" + location.search;
            // $("#checkpwd_form").submit();
        });

        // 목록보기 클릭 시
        $("#list_btn").click(function() {
            history.back();
            {{--location.href = "{{ route("testuser_index") }}" + location.search;--}}
        });
    });

</script>
</html>
