var mons = {
    _maxFileSize : 5,
    namespace: function (ns) {
        var parts = ns.split(".");
        object = this;
        var len = parts.length;
        for (var i = 0; i < len; i++) {
            if (!object[parts[i]]) {
                object[parts[i]] = {};
            }
            object = object[parts[i]];
        }
        return object;
    }
};
//네임스페이스지정
mons.namespace("ModaHome.FrontJs");

//숫자만입력
mons.NumberOnly = function (obj) {
    $(obj).bind("paste", function (event) {
        var text = "";
        if (window.clipboardData) {
            text = window.clipboardData.getData("Text");
        } else if (event.originalEvent && event.originalEvent.clipboardData) {
            text = event.originalEvent.clipboardData.getData("Text");
        }

        if (/[^0-9]/g.test(text)) {
            event.preventDefault();
            mm.bom.alert("숫자만 붙여넣을 수 있습니다.");
        }
    });

    $(obj).keydown(function (e) {
        console.log(e.keyCode);
        var eCode = (window.netscape) ? e.which : event.keyCode;
        if ((eCode < 48 || eCode > 57) && (eCode > 105 || eCode < 96) && eCode != 8 && eCode != 46 && eCode != 9) {
            if (!(eCode == 86 && e.ctrlKey === true) && !(eCode == 45 && e.shiftKey === true)) {
                e.preventDefault();
            }
        }
    });

    $(obj).keyup(function () {
        $(this).val($(this).val().replace(/[^0-9]/g, ""));
    });

    $(obj).blur(function () {
        $(this).val($(this).val().replace(/[^0-9]/g, ""));
        var maxlen = $(this).attr("maxlength");
        if(maxlen != undefined && maxlen>0 )
        {
            $(this).val($(this).val().slice(0,maxlen))
        }
    });
};

//문자만입력
mons.WordOnly = function (obj) {
    $(obj).bind("paste", function (event) {
        var text = "";
        if (window.clipboardData) {
            text = window.clipboardData.getData("Text");
        } else if (event.originalEvent && event.originalEvent.clipboardData) {
            text = event.originalEvent.clipboardData.getData("Text");
        }

        if (/[0-9]/g.test(text)) {
            event.preventDefault();
            mm.bom.alert("숫자는 붙여넣을 수 없습니다.");
        }
    });

    $(obj).keydown(function (e) {
        var eCode = (window.netscape) ? e.which : event.keyCode;
        if (
            ((eCode >=48 && eCode <= 57 )) || ((eCode >=96 && eCode <= 105 )) //숫자범위 쉬프트키와 상관없이 눌리면 탈출
            || eCode === 189 || eCode === 187 || eCode === 219 || eCode === 221 || eCode === 220 //특수문자범위
            || eCode === 186 || eCode === 222 || eCode === 188 || eCode === 190 || eCode === 191 //특수문자범위
            || eCode === 110 || eCode === 111 || eCode === 106 || eCode === 109 || eCode === 107 //특수문자범위
        ) { //여기에 포함되면 탈출
            e.preventDefault();
            e.returnValue = false;
            return false;
        }
    });

    $(obj).keyup(function () {
        $(this).val($(this).val().replace(/[^a-zA-Zㄱ-힣]/g, ""));
    });

    $(obj).blur(function () {
        $(this).val().replace(/[^a-zA-Zㄱ-힣]/g, "");
        var maxlen = $(this).attr("maxlength");
        if(maxlen != undefined && maxlen>0 )
        {
            $(this).val($(this).val().slice(0,maxlen))
        }
    });
};

mons.filecheck = function(obj){
        // 사이즈체크
    var maxSize  = mons._maxFileSize * 1024 * 1024;    //5MB

    if(obj[0].files.length === 0){
        return true;
    }

    return obj[0].files[0].size <= maxSize;

};

mons.filetype = function(obj){
    var file_types = {
        "application/pdf":"pdf",
        "image/jpeg":"jpg",
        "image/x-citrix-jpeg":"jpg",
        "image/png":"png",
        "image/x-citrix-png":"png",
        "image/x-png":"png",
        "image/gif":"gif",
    };
    var passed = false;
    if($(obj).data("mons").indexOf(":")){
        var allowed_types = $(obj).data("mons").split(":")[1];
        var allowed_types_arr = allowed_types.split(",");
        for(var allowed in allowed_types_arr){
            if( file_types[obj[0].files[0].type] == allowed_types_arr[allowed]){
                passed = true;
            }
        }
    }
    return passed;
};



$(document).ready(function(){
    $("[data-mons='NumberOnly']").each(function(){
        mons.NumberOnly($(this));
    });

    $("[data-mons='WordOnly']").each(function(){
        mons.WordOnly($(this));
    });

    /*$("[data-mons='FileCheck']").each(function(){
        $(this).change(function(){
            if(!mons.filecheck($(this))){
                mm.bom.alert("첨부파일은 최대 5MB 이하로 등록 가능합니다.");
            }
        });
    });*/

    $("[data-mons='FileForm']").each(function(){
        $(this).submit(function(e){
            var filechecked = true;
            $(this).find("[type='file']").each(function(){
                if(!mons.filecheck($(this))){
                    filechecked = false;
                }
            });

            if(!filechecked){
                e.preventDefault();
                mm.bom.alert("첨부파일은 5MB 이하로 등록해주세요.");
                return false;
            }
        });
    });

    $("[data-mons*='file:']").each(function(){
        $(this).change(function(){
            if(!mons.filetype($(this))){
                mm.bom.alert("첨부파일은 " + $(this).data("mons").split(":")[1] + "만 등록 가능합니다.");
                $(this).val("").next().text("");
            }
        })
    });
});
