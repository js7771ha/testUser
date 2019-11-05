<!DOCTYPE html>
<html lang="utf-8">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Modify</title>
</head>
<body>
<div>
    <form id="usermod_form" name="usermod_form" class="form-inline" action="{{ route("testuser_update", ["user_idx" => $user_info->user_idx]) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th width="20%">
                    상태
                </th>
                <td>
                    <select id="user_state" name="user_state" class="form-control">
                        <option value="">선택</option>
                        <option value="1">사용계정</option>
                        <option value="2">휴면계정</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th width="20%">
                    이름
                </th>
                <td>
                    <input type="text" class="form-control" value="{{ $user_info->user_name }}" readonly />
                </td>
            </tr>
            <tr>
                <th width="20%">
                    아이디
                </th>
                <td>
                    <input type="text" name="user_id" class="form-control" value="{{ $user_info->user_id }}" readonly />
                </td>
            </tr>
            <tr>
                <th width="20%">
                    성별
                </th>
                <td>
                    <select id="user_gender" name="user_gender" class="form-control">
                        <option value="">선택</option>
                        <option value="1">남자</option>
                        <option value="2">여자</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th width="20%">
                    나이
                </th>
                <td>
                    <input type="text" name="user_age" class="form-control" maxlength="3" value="{{ $user_info->user_age }}" />
                </td>
            </tr>
            <tr>
                <th width="20%">
                    전화번호
                </th>
                <td>
                    <input type="text" name="user_tel" class="form-control" minlength="8" maxlength="12" value="{{ $user_info->user_tel }}" />
                </td>
            </tr>
            <tr>
                <th width="20%">
                    이메일
                </th>
                <td>
                    <input type="text" name="email" class="form-control" maxlength="30" value="{{ $user_info->email }}" />@
                    <input type="text" id="domain_input" name="domain" class="form-control" style="display:none;" value="{{ $user_info->domain }}">
                    <select id="domain" name="domain" class="form-control">
                        <option value="__default__">선택</option>
                        <option value="user_input">직접입력</option>
                        <option value="naver.com">naver.com</option>
                        <option value="gmail.com">gmail.com</option>
                        <option value="hanmail.net">hanmail.net</option>
                        <option value="nate.net">nate.com</option>
                    </select>
                    <input type="hidden" name="user_email" value="{{ $user_info->user_email }}" />
                </td>
            </tr>
            <tr>
                <th width="20%">
                    적립금
                </th>
                <td>
                    <input type="text" name="user_point" class="form-control" maxlength="20" value="{{ $user_info->user_point }}" />
                </td>
            </tr>
            <tr>
                <th width="20%">
                    결혼 여부
                </th>
                <td>
                    <div class="custom-control custom-radio" style="width:70px;">
                        <input type="radio" id="married1" name="user_married" class="custom-control-input" value="1">
                        <label class="custom-control-label" for="married1">미혼</label>
                    </div>
                    <div class="custom-control custom-radio" style="width:70px;">
                        <input type="radio" id="married2" name="user_married" class="custom-control-input" value="2">
                        <label class="custom-control-label" for="married2">기혼</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th width="20%">
                    우편번호
                </th>
                <td>
                    <input type="text" id="user_zip" name="user_zip" class="form-control" value="{{ $user_info->user_zip }}" readonly>
                    <input type="button" id="zip_btn" class="btn btn-sm" value="우편번호 찾기" onclick="daumPostcode()">
                </td>
            </tr>
            <tr>
                <th width="20%">
                    기본 주소
                </th>
                <td>
                    <input type="text" id="user_addr" name="user_addr" class="form-control" style="width: 50%" value="{{ $user_info->user_addr }}" readonly>
                </td>
            </tr>
            <tr>
                <th width="20%">
                    상세 주소
                </th>
                <td>
                    <input type="text" id="user_addr_detail" name="user_addr_detail" class="form-control" value="{{ $user_info->user_addr_detail }}" style="width: 50%">
                </td>
            </tr>
            <tr>
                <th style="vertical-align: middle">
                    업로드파일
                </th>
                <td>
                    @if ($user_info->file_save_name != "")
                        <a href="/uploads/{{ $user_info->file_save_name }}" id="file_save_name" download>
                            <img src="/uploads/{{ $user_info->file_save_name }}" style="max-width: 100px;max-height: 100px;">
                        </a>
                        <span id="input_file_hidden" style="display: none">
                            <input type="file" id="user_file" name="user_file" class="form-control user_file" accept=".jpg, .png" onclick="file_click($(this))" onchange="file_change($(this))">
                            <span class="span_hidden" style="display: none;"></span>
                        </span>
                        <input type="button" id="btn_file_restore" href="" class="btn-sm btn-dark" value="새로등록">
                    @else
                        <input type="file" id="user_file" name="user_file" class="form-control user_file" accept=".jpg, .png" onclick="file_click($(this))" onchange="file_change($(this))">
                        <span class="span_hidden" style="display: none;"></span>
                    @endif
                    <input type="hidden" name="file_idx" value="{{ $user_info->file_idx }}">
                    <input type="hidden" name="file_save_name" value="{{ $user_info->file_save_name }}">
                </td>
            </tr>
            <tr>
                <th width="20%">
                    비고
                </th>
                <td>
                    <textarea name="user_remark" class="form-control" style="width: 50%">{{ $user_info->user_remark }}</textarea>
                </td>
            </tr>
            <tr>
                <th width="20%">
                    현재 비밀번호
                </th>
                <td>
                    <input type="password" name="check_pwd" class="form-control" minlength="4" maxlength="20" /> <input type="button" id="pwd_btn" class="btn btn-dark" value="비밀번호 변경하기">
                </td>
            </tr>
            <tr name="tr_hidden" style="display:none;">
                <th width="20%">
                    변경할 비밀번호
                </th>
                <td>
                    <input type="password" name="user_pwd" class="form-control" minlength="4" maxlength="20" />
                </td>
            </tr>
            <tr name="tr_hidden" style="display:none;">
                <th width="20%">
                    변경할 비밀번호 확인
                </th>
                <td>
                    <input type="password" name="user_pwd2" class="form-control" minlength="4" maxlength="20" />
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="button" id="save_btn" class="btn btn-success" value="수정하기">
{{--                    <input type="button" id="del_btn" class="btn btn-danger" value="탈퇴하기">--}}
                    <input type="button" id="list_btn" class="btn btn-secondary" value="목록보기">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
</body>

<script>

    // 다음 주소 api
    function daumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                $("#user_zip").val(data.zonecode);
                $("#user_addr").val(data.roadAddress);
            }
        }).open();
    }

    // 천단위 콤마 추가 function
    function number_format(number) {
        let arr = number.split("").join(",").split("");
        for(let i=arr.length-1, j=1; i>=0; i--, j++) {
            if(j%6 != 0 && j%2 == 0) {
                arr[i] = "";
            }
        }
        return arr.join("");
    }

    // 파일 선택 클릭 시 기존 파일 복제
    function file_click(object) {
        let $span_hidden = object.closest("tr").find(".span_hidden");
        let $file_hidden = $span_hidden.find(".file_hidden");
        if ($file_hidden.length === 0) {
            let $clone = object.clone().appendTo($span_hidden);
            $clone.attr("name", "");
            $clone.attr("class", "file_hidden");
        } else {
            $file_hidden[0].files = object[0].files;
        }
    }

    // 파일 변경 시 취소하면 복제 해놓은 파일 입력
    function file_change(object) {
        let $span_hidden = object.closest("tr").find(".span_hidden");
        let $file_hidden = $span_hidden.find(".file_hidden");
        if (object.val() === "" || object.val() === undefined) {
            object[0].files = $file_hidden[0].files;
        }
    }


    $(document).ready(function() {

        @if ($errors->any())
            alert("{{ $errors->first() }}");
        @endif

        let msg = "{{ session("message") }}";
        if(msg !== "") {
            alert(msg);
        }

        // 비밀번호 확인
        $("[name=user_pwd]").on("keyup", function() {
            if($("[name=user_pwd2]").val() != "") {
                if ($(this).val() === $("[name=user_pwd2]").val()) {
                    $("#check_pwd").text("비밀번호가 일치합니다.").css("color", "blue");
                } else {
                    $("#check_pwd").text("비밀번호가 일치하지 않습니다.").css("color", "red");
                }
            }
        });

        $("[name=user_pwd2]").on("keyup", function() {
            if ($(this).val() === $("[name=user_pwd]").val()) {
                $("#check_pwd").text("비밀번호가 일치합니다.").css("color", "blue");
            } else {
                $("#check_pwd").text("비밀번호가 일치하지 않습니다.").css("color", "red");
            }
        });

        // 상태 selected
        $("#user_state > option").each(function() {
            if("{{ $user_info->user_state }}" === $(this).val()) {
                $(this).prop("selected", true);
                return false;
            }
        });

        @if (!is_null($user_info) && $user_info !== "")
            // 성별 selected
            $("#user_gender > option").each(function() {
                if("{{ $user_info->user_gender }}" === $(this).val()) {
                    $(this).prop("selected", true);
                    return false;
                }
            });

            // 도메인 selected
            $("#domain > option").each(function () {
                if("{{ $user_info->domain }}" === $(this).val()) {
                    $("#domain_input").hide();
                    $(this).prop("selected", true);
                    return false;
                } else {
                    $("#domain_input").show();
                    $("#domain option:eq(1)").prop("selected", true);
                }
            });

            // 결혼여부 checked
            $("[name=user_married]").each(function() {
                if("{{ $user_info->user_married }}" === $(this).val()) {
                    $(this).prop("checked", true);
                    return false;
                }
            });

        @endif

        // 나이 숫자만 입력
        $("[name=user_age]").on("keyup", function() {
            $(this).val($(this).val().replace(/[^0-9]/g,""));
        });

        // 전화번호 숫자만 입력
        $("[name=user_tel]").on("keyup", function() {
            $(this).val($(this).val().replace(/[^0-9]/g,""));
        });

        // 적립금 숫자만 입력
        $("[name=user_point]").on("keyup", function() {
            $(this).val($(this).val().replace(/[^0-9]/g,""));
            $(this).val(number_format($(this).val()));
        });

        // 도메인 change 이벤트
        $("#domain").change(function() {
            if($(this).val() === "user_input") {
                $("#domain_input").show();
            } else {
                $("#domain_input").hide();
                $("#domain_input").val("");
            }
        });

        // 비밀번호 변경 버튼 클릭 시
        $("#pwd_btn").click(function() {
            if ($("#pwd_btn").val() == "비밀번호 변경하기") {
                $("[name=tr_hidden]").show();
                $("#pwd_btn").val("비밀번호 변경 취소");
            } else {
                $("[name=tr_hidden]").hide();
                $("#pwd_btn").val("비밀번호 변경하기");
            }
        });

        // 파일 새로등록 버튼 클릭 시
        $("#btn_file_restore").click(function() {
            if ($("#btn_file_restore").val() == "새로등록") {
                $("#input_file_hidden").show();
                $("#file_save_name").hide();
                $("#btn_file_restore").val("등록 취소");
            } else {
                $("#input_file_hidden").hide();
                $("#user_file").val("");
                $("#file_save_name").show();
                $("#btn_file_restore").val("새로등록");
            }
        });



        // 수정하기 버튼 클릭 시
        $("#save_btn").click(function() {
            let reg = "";       // 유효성 체크 정규식
            let domain = "";    // selected 도메인 값

            if ($("[name=check_pwd]").val() == "") {
                alert("비밀번호를 입력해주세요.");
                return false;
            }

            if ($("[name=user_gender]").val() == "") {
                alert("성별을 선택해주세요.");
                return false;
            }

            if ($("[name=user_age]").val() == "") {
                alert("나이를 입력해주세요.");
                return false;
            }

            if ($("[name=user_tel]").val() == "") {
                alert("전화번호를 입력해주세요.");
                return false;
            } else {
                if ($("[name=user_tel]").val().length < 8) {
                    alert("전화번호를 8글자 이상 입력해주세요.");
                    return false;
                }
            }

            if ($("[name=email]").val() == "") {
                alert("이메일을 입력해주세요.");
                return false;
            } else {
                reg = /^[a-zA-Z0-9]{4,25}$/g;
                // 이메일 유효성 체크
                if (reg.test($("[name=email]").val()) === false) {
                    alert("올바른 이메일 형식이 아닙니다.");
                    return false;
                }
                // 직접 입력일때 입력한 값 사용
                if ($("#domain").val() == "user_input") {
                    domain = "@"+$("#domain_input").val();
                } else {
                    domain = "@"+$("#domain").val();
                }
                $("[name=user_email]").val($("[name=email]").val()+domain);
            }

            if ($("[name=user_check]").prop("checked") == false) {
                alert("개인정보 수집을 동의해주세요.");
                return false;
            }

            if(confirm("수정하시겠습니까?") === true) {
                $("#usermod_form").attr("action", "{{ route("testuser_update", ["user_idx" => $user_info->user_idx]) }}"+location.search);
                $("#usermod_form").submit();
            } else {
                return false;
            }
        });

        {{--// 탈퇴하기 클릭 시--}}
        {{--$("#del_btn").click(function() {--}}
        {{--    location.href = "{{ route("testuser_pwdcheckview", ["user_idx" => $user_info->user_idx]) }}" + location.search;--}}
        {{--});--}}

        // 목록보기 클릭 시
        $("#list_btn").click(function() {
            location.href = "{{ route("testuser_index") }}" + location.search;
        });
    });

</script>
</html>
