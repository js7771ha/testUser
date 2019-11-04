<!DOCTYPE html>
<html lang="utf-8">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Create</title>
</head>

<body>
<div>
    dd
{{--    {{ dd(old()) }}--}}
    <form id="usersave_form" name="usersave_form" class="form-inline" action="{{ route("testuser_store") }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <table id="original" name="original" class="table table-bordered original">
            <tbody>
            <tr>
                <th width="20%">
                    이름
                </th>
                <td>
                    <input type="text" name="user_name[]" class="form-control user_name" maxlength="50" value="{{ old("user_name")[0] }}">
                </td>
            </tr>
            <tr>
                <th width="20%">
                    아이디
                </th>
                <td>
                    <input type="text" id="user_id" name="user_id[]" class="form-control user_id" maxlength="20" value="{{ old("user_id")[0] }}">
                    <input type="button" name="check_btn[]" class="btn btn-success check_btn" value="아이디중복확인">
                    <span name="check_val[]" class="check_val"></span>
                    <input type="hidden" name="check_id[]" class="check_id">
                </td>
            </tr>
            <tr class="row_pwd">
                <th width="20%">
                    비밀번호
                </th>
                <td>
                    <input type="password" name="user_pwd[]" class="form-control user_pwd" minlength="4" maxlength="20">
                </td>
            </tr>
            <tr class="row_pwd2">
                <th width="20%">
                    비밀번호 확인
                </th>
                <td>
                    <input type="password" name="user_pwd2[]" class="form-control user_pwd2" minlength="4" maxlength="20">
                    <span name="check_pwd" class="check_pwd"></span>
                </td>
            </tr>
            <tr>
                <th width="20%">
                    성별
                </th>
                <td>
                    <select id="user_gender" name="user_gender[]" class="form-control">
                        <option value="__default__">선택</option>
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
                    <input type="text" name="user_age[]" class="form-control user_age" maxlength="3" value="{{ old("user_age")[0] }}" />
                </td>
            </tr>
            <tr>
                <th width="20%">
                    전화번호
                </th>
                <td>
                    <input type="text" name="user_tel[]" class="form-control user_tel" maxlength="12" value="{{ old("user_tel")[0] }}" />
                </td>
            </tr>
            <tr>
                <th width="20%">
                    이메일
                </th>
                <td>
                    <input type="text" name="email[]" class="form-control email" maxlength="30" value="{{ old("email")[0] }}" />@
                    <input type="text" name="input_domain[]" class="form-control i_domain" style="display:none;" value="{{ old("input_domain")[0] }}">
                    <select id="domain" name="domain[]" class="form-control s_domain">
                        <option value="__default__">선택</option>
                        <option value="user_input">직접입력</option>
                        <option value="naver.com">naver.com</option>
                        <option value="gmail.com">gmail.com</option>
                        <option value="hanmail.net">hanmail.net</option>
                        <option value="nate.net">nate.com</option>
                    </select>
                    <input type="hidden" name="user_email[]" class="user_email" value="{{ old("user_email")[0] }}">
                </td>
            </tr>
            <tr>
                <th width="20%">
                    적립금
                </th>
                <td>
                    <input type="text" name="user_point[]" class="form-control user_point" maxlength="20" value="{{ old("user_point")[0] }}" />
                </td>
            </tr>
            <tr>
                <th width="20%">
                    결혼 여부
                </th>
                <td>
                    <div class="custom-control custom-radio" style="width:70px;display: inline-block;">
                        <input type="radio" id="married1" name="user_married[0]" class="custom-control-input user_married" value="1">
                        <label class="custom-control-label married_label1" for="married1">미혼</label>
                    </div>
                    <div class="custom-control custom-radio" style="width:70px;display: inline-block;">
                        <input type="radio" id="married2" name="user_married[0]" class="custom-control-input user_married" value="2">
                        <label class="custom-control-label married_label2" for="married2">기혼</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    우편번호
                </th>
                <td>
                    <input type="text" name="user_zip[]" class="form-control user_zip" readonly>
                    <input type="button" class="btn btn-sm" value="우편번호 찾기" onclick="daumPostcode($(this))">
                </td>
            </tr>
            <tr>
                <th>
                    기본 주소
                </th>
                <td>
                    <input type="text" name="user_addr[]" class="form-control user_addr" style="width: 50%" readonly>
                </td>
            </tr>
            <tr>
                <th>
                    상세 주소
                </th>
                <td>
                    <input type="text" name="user_addr_detail[]" class="form-control user_addr_detail" style="width: 50%">
                </td>
            </tr>
            <tr>
                <th>
                    파일업로드
                </th>
                <td>
                    <input type="file" name="user_file[]" class="form-control user_file" accept=".jpg, .png" onclick="file_click($(this))" onchange="file_change($(this))">
                    <span class="span_hidden" style="display: none;"></span>
                </td>
            </tr>
            <tr>
                <th width="20%">
                    비고
                </th>
                <td>
                    <textarea name="user_remark[]" class="form-control user_remark" style="width: 50%">{{ old("user_remark")[0] }}</textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="custom-control custom-checkbox" style="width:170px;">
                        <input type="checkbox" id="user_check" name="user_check[]" class="custom-control-input user_check" />
                        <label class="custom-control-label check_label" for="user_check">개인정보수집동의</label>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    <div align="center">
        <input type="button" id="save_btn" class="btn btn-primary" value="저장하기">
        <input type="button" id="list_btn" class="btn btn-secondary" value="목록보기">
        <input type="button" id="clone_btn" class="btn btn-warning" value="다중등록" onclick="clone_btn_click()">
        <input type="button" id="clone_remove_btn" class="btn btn-danger" value="다중등록 취소" style="display: none;" onclick="clone_remove_click()">
    </div>
</div>
</body>

<script>

    // 다음 주소 api
    function daumPostcode(object) {
        new daum.Postcode({
            oncomplete: function(data) {
                // 우편번호와 주소 정보를 해당 필드에 넣는다. (도로명주소)
                let $zip_code = object.closest("tr").find($(".user_zip"));
                let $addr = object.closest("tr").next().find($(".user_addr"));
                $zip_code.val(data.zonecode);
                $addr.val(data.roadAddress);
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

    function file_change(object) {
        let $span_hidden = object.closest("tr").find(".span_hidden");
        let $file_hidden = $span_hidden.find(".file_hidden");
        if (object.val() === "" || object.val() === undefined) {
            object[0].files = $file_hidden[0].files;
        }
    }

    function clone_btn_click() {
        let cloneIndex = $("[name='original']").length;
        if (cloneIndex >= 3) {
            alert("다중 등록은 3개까지만 가능합니다.");
            return false;
        }
        let $clone = $("#original").clone(true).appendTo("#usersave_form");

        // table id 값 변경
        $clone.attr("id", "original" + cloneIndex);

        // user_id 의 id 값 변경
        $clone.find("#user_id").attr("id", "user_id" + cloneIndex);

        // user_gender 값 변경
        $clone.find("#user_gender").attr("id", "user_gender" + cloneIndex);

        // domain id 값 변경
        $clone.find("#domain").attr("id", "domain" + cloneIndex);

        // user_married 라디오 id, name, label for 변경
        $clone.find("#married1").attr("id", "married1_" + cloneIndex);
        $clone.find(".user_married").attr("name", "user_married[" + cloneIndex + "]");
        $clone.find(".married_label1").attr("for", "married1_" + cloneIndex);

        $clone.find("#married2").attr("id", "married2_" + cloneIndex);
        $clone.find(".user_married").attr("name", "user_married[" + cloneIndex + "]");
        $clone.find(".married_label2").attr("for", "married2_" + cloneIndex);

        // 개인정보처리 동의 체크박스 id, label for 변경
        $clone.find("#user_check").attr("id", "user_check" + cloneIndex);
        $clone.find(".check_label").attr("for", "user_check" + cloneIndex);

        // 입력값 초기화
        $clone.find(".user_name").val("");
        $clone.find(".user_id").val("");
        $clone.find(".check_val").text("");
        $clone.find(".user_pwd").val("");
        $clone.find(".user_pwd2").val("");
        $clone.find(".user_age").val("");
        $clone.find(".user_tel").val("");
        $clone.find(".email").val("");
        $clone.find(".i_domain").hide();
        $clone.find(".user_point").val("");
        $clone.find(".user_zip").val("");
        $clone.find(".user_addr").val("");
        $clone.find(".user_addr_detail").val("");
        $clone.find(".user_file").val("");
        $clone.find(".user_remark").val("");
        $clone.find(".user_check").prop("checked", false);

        $("#clone_remove_btn").show();
    }

    function clone_remove_click () {
        let origin_index = $(".original").length-1;
        $("#original"+origin_index).remove();

        if($(".original").length <= 1) {
            $("#clone_remove_btn").hide();
        } else {
            $("#clone_remove_btn").show();
        }
    }

    $(document).ready(function() {

        // 서버에서 validation 체크 통과하지 못했을 때 에러 메세지 출력
        @if ($errors->any() === true)
            alert("{{ $errors->first() }}");
        @endif

        // 세션에 메세지가 있으면 해당 메세지 출력
        let msg = "{{ session("message") }}";
        if(msg != "") {
            alert(msg);
        }

        // 서버 validation 체크 실패 후 old 값 입력
        @if (old() !== [] && count(old("user_name")) === 1)     // 다중 등록 없이 1개만 등록 시

            // 성별 old selected
            @if(!is_null(old("user_gender")[0]) && old("user_gender")[0] !== "")
                $("#user_gender > option").each(function() {
                    if("{{ old("user_gender")[0] }}" === $(this).val()) {
                        $(this).prop("selected", true);
                        return false;
                    }
                });
            @endif

            // 도메인 old selected
            @if(!is_null(old("domain")[0]) && old("domain")[0] !=="")
                $("#domain > option").each(function () {
                    let $domain_input = $(this).closest("tr").find(".i_domain");
                    if("{{ old("domain")[0] }}" === $(this).val() && "{{ old("domain")[0] }}" !== "user_input") {
                        $(this).prop("selected", true);
                        $domain_input.hide();
                        return false;
                    } else if ("{{ old("domain")[0] }}" === $(this).val() && "{{ old("domain")[0] }}" === "user_input") {
                        $(this).prop("selected", true);
                        $domain_input.show();
                        return false;
                    }
                });
            @endif

            // 결혼여부 old checked
            @if(!is_null(old("user_married")[0]) && old("user_married")[0] !== "")
                $("[name='user_married[0]']").each(function() {
                    if("{{ old("user_married")[0] }}" === $(this).val()) {
                        $(this).prop("checked", true);
                        return false;
                    }
                });
            @endif

        @elseif (old() !== [] && count(old("user_name")) > 1)   // 다중 등록 했을 때
            @if (count(old("user_name")) == 2)
                clone_btn_click();
            @elseif (count(old("user_name")) == 3)
                clone_btn_click();
                clone_btn_click();
            @endif

            @foreach(old("user_name") as $key => $val)
                $(".user_name").eq("{{ $key }}").val("{{ $val }}");
            @endforeach

            @if (is_array(old("user_id")) && count(old("user_id")) > 0)
                @foreach(old("user_id") as $key => $val)
                    $(".user_id").eq("{{ $key }}").val("{{ $val }}");
                @endforeach
            @endif

            @if (is_array(old("user_pwd")) && count(old("user_pwd")) > 0)
                @foreach(old("user_pwd") as $key => $val)
                    $(".user_pwd").eq("{{ $key }}").val("{{ $val }}");
                @endforeach
            @endif

            @if (is_array(old("user_pwd2")) && count(old("user_pwd2")) > 0)
                @foreach(old("user_pwd2") as $key => $val)
                    $(".user_pwd2").eq("{{ $key }}").val("{{ $val }}");
                @endforeach
            @endif

            @if (is_array(old("user_age")) && count(old("user_age")) > 0)
                @foreach(old("user_age") as $key => $val)
                    $(".user_age").eq("{{ $key }}").val("{{ $val }}");
                @endforeach
            @endif

            @if (is_array(old("user_tel")) && count(old("user_tel")) > 0)
                @foreach(old("user_tel") as $key => $val)
                    $(".user_tel").eq("{{ $key }}").val("{{ $val }}");
                @endforeach
            @endif

            @if (is_array(old("email")) && count(old("email")) > 0)
                @foreach(old("email") as $key => $val)
                    $(".email").eq("{{ $key }}").val("{{ $val }}");
                @endforeach
            @endif

            @if (is_array(old("user_email")) && count(old("user_email")) > 0)
                @foreach(old("user_email") as $key => $val)
                    $(".user_email").eq("{{ $key }}").val("{{ $val }}");
                @endforeach
            @endif

            @if (is_array(old("user_point")) && count(old("user_point")) > 0)
                @foreach(old("user_point") as $key => $val)
                    $(".user_point").eq("{{ $key }}").val("{{ $val }}");
                @endforeach
            @endif

            @if (is_array(old("user_zip")) && count(old("user_zip")) > 0)
                @foreach(old("user_zip") as $key => $val)
                    $(".user_zip").eq("{{ $key }}").val("{{ $val }}");
                @endforeach
            @endif

            @if (is_array(old("user_addr")) && count(old("user_addr")) > 0)
                @foreach(old("user_addr") as $key => $val)
                    $(".user_addr").eq("{{ $key }}").val("{{ $val }}");
                @endforeach
            @endif

            @if (is_array(old("user_addr_detail")) && count(old("user_addr_detail")) > 0)
                @foreach(old("user_addr_detail") as $key => $val)
                    $(".user_addr_detail").eq("{{ $key }}").val("{{ $val }}");
                @endforeach
            @endif

            @if (is_array(old("user_remark")) && count(old("user_remark")) > 0)
                @foreach(old("user_remark") as $key => $val)
                    $(".user_remark").eq("{{ $key }}").text("{{ $val }}");
                @endforeach
            @endif

            @if (is_array(old("user_file")) && count(old("user_file")) > 0)
                @foreach(old("user_file") as $key => $val)
                    $(".user_file").eq("{{ $key }}").val("{{ $val }}");
                @endforeach
            @endif

        @endif

        // 아이디 중복확인 ajax
        $(".check_btn").click(function() {
            let $closest_tr = $(this).closest("tr");
            let user_id = $closest_tr.find(".user_id").val();
            let this_id = $closest_tr.find(".user_id").attr("id");
            let $check_val = $closest_tr.find($(".check_val"));
            let reg = /^[a-zA-Z][a-zA-Z0-9]{5,11}$/g;
            let flag = "";

            if (user_id === "" || user_id === undefined) {
                alert("아이디를 입력해주세요.");
                return false;
            } else {
                // 아이디 유효성 체크
                if (reg.test(user_id) === false) {
                    alert("아이디의 형식이 올바르지 않습니다.");
                    return false;
                }

                // 현재 form 에 입력되어 있는 값 중에 동일한 아이디가 있는 지 확인
                $(".user_id").each(function() {
                    if (this_id !== $(this).attr("id") && $(this).val() === user_id) {
                        flag = "return";
                        return false;
                    }
                });

                if (flag === "return") {
                    $check_val.text("사용할 수 없는 아이디 입니다.");
                    $check_val.css("color", "black");
                    return false;
                }

                // 아이디 중복 확인 ajax
                $.ajax({
                    type : "POST",
                    url : "{{ route("testuser_idcheck") }}",
                    data : {
                        "user_id" : user_id,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType : "json",
                    success : function(response) {
                        // 해당 필드에 받아온 값 입력
                        $check_val.text(response.message);
                        $closest_tr.find($(".check_id")).val(response.result);
                        if (response.result === "use_ok") {
                            $check_val.css("color", "blue");
                        } else {
                            $check_val.css("color", "red");
                        }
                    },
                    error : function(request, status, error) {
                        alert("message : " + request.responseJSON.message + ", status : " + status + ", error : " + error);
                    }
                });
            }
        });

        // 나이 숫자만 입력 가능하도록
        $(".user_age").on("keyup", function() {
            $(this).val($(this).val().replace(/[^0-9]/g,""));
        });

        // 전화번호 숫자만 입력
        $(".user_tel").on("keyup", function() {
            $(this).val($(this).val().replace(/[^0-9]/g,""));
        });

        // 적립금 숫자만 입력, 천단위 콤마
        $(".user_point").on("keyup", function() {
            $(this).val($(this).val().replace(/[^0-9]/g,""));
            $(this).val(number_format($(this).val()));
            // $(this).val($(this).val().toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        });

        // 도메인 change 이벤트
        $(".s_domain").change(function() {
            let $domain_input = $(this).closest("tr").find(".i_domain");
            // 직접입력일 때
            if($(this).val() === "user_input") {
                $domain_input.show();
            } else {
                $domain_input.hide();
                $domain_input.val("");
            }
        });

        // 저장 버튼 클릭 시
        $("#save_btn").click(function() {

            let $find_id;               // 아이디 필드
            let $find_pwd;              // 비밀번호 필드
            let $find_email;            // 이메일(아이디) 필드
            let find_domain_val = "";   // 도메인 selected 값
            let reg = "";               // 유효성 체크 정규식 값
            let domain = "";            // selected || input 도메인 값
            let flag = "";              // return 시킬지 여부

            // original table 마다 validation check
            $(".original").each(function() {

                if ($(this).find(".user_name").val() === "" || $(this).find(".user_name").val() === undefined) {
                    alert("이름을 입력해주세요.");
                    flag = "return";
                    return false;
                }

                $find_id = $(this).find(".user_id");

                if ($find_id.val() == "") {
                    alert("아이디를 입력해주세요.");
                    flag = "return";
                    return false;
                } else {
                    // 아이디 중복 확인 했는지 확인
                    if ($find_id.closest("tr").find($(".check_id")).val() !== "use_ok") {
                        alert("아이디 중복 확인을 해주세요.");
                        flag = "return";
                        return false;
                    }
                }

                $find_pwd = $(this).find(".user_pwd");

                if ($find_pwd.val() == "") {
                    alert("비밀번호를 입력해주세요.");
                    flag = "return";
                    return false;
                } else {
                    // 비밀번호, 비밀번호 확인 두 값이 일치 하는지 확인
                    if ($find_pwd.val() !== $find_pwd.closest("tr").next().find($(".user_pwd2")).val()) {
                        alert("비밀번호가 일치하지 않습니다.\n비밀번호를 확인해주세요.");
                        flag = "return";
                        return false;
                    }
                }

                if ($(this).find(".user_gender").val() == "") {
                    alert("성별을 선택해주세요.");
                    flag = "return";
                    return false;
                }

                if ($(this).find(".user_age").val() == "") {
                    alert("나이를 입력해주세요.");
                    flag = "return";
                    return false;
                }

                if ($(this).find(".user_tel").val() == "") {
                    alert("전화번호를 입력해주세요.");
                    flag = "return";
                    return false;
                }

                $find_email = $(this).find(".email");
                find_domain_val = $find_email.closest("tr").find($(".s_domain")).val();

                if ($find_email.val() == "" || find_domain_val == "__default__") {
                    alert("이메일을 입력해주세요.");
                    flag = "return";
                    return false;
                } else {
                    // 이메일 유효성 확인 (도메인 제외한 아이디 값만 체크)
                    reg = /^[a-zA-Z][a-zA-Z0-9]{5,11}$/g;
                    if (!reg.test($find_email.val())) {
                        alert("올바른 이메일 형식이 아닙니다.");
                        flag = "return";
                        return false;
                    }

                    // 직접 입력일때 입력한 값 사용
                    if (find_domain_val == "user_input") {
                        domain = "@"+$find_email.closest("tr").find($(".i_domain")).val();
                    } else {
                        domain = "@"+find_domain_val;
                    }
                    $find_email.closest("tr").find($(".user_email")).val($find_email.val()+domain);
                }

                if ($(this).find(".user_check").prop("checked") == false) {
                    alert("개인정보 수집을 동의해주세요.");
                    flag = "return";
                    return false;
                }
            });

            if (flag === "return") {
                return false;
            }

            if(confirm("저장하시겠습니까?") === true) {
                $("#usersave_form").attr("action", "{{ route("testuser_store") }}"+location.search);
                $("#usersave_form").submit();
            } else {
                return false;
            }
        });

        // 목록보기 버튼 클릭 시
        $("#list_btn").click(function() {
            location.href = "{{ route("testuser_index") }}" + location.search;
        });
    });

</script>
</html>
