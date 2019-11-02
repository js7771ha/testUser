<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class claim extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "branch_id"=>"bail|numeric|exists:branch,ix",
            "customer_name"=> "bail|required",
            "tel" => "bail|required|numeric|kor_tel",
            "mail" => "required",
            "title"=>"bail|required|max:100",
            "contents" => "bail|required|max:2000",
            "policy_agree" => "accepted",
        ];
    }

    public function messages()
    {
        return [
            "customer_name.required" => "이름을 입력해 주세요.",
            "tel.required" => "연락처를 입력해주세요.",
            "tel.numeric" => "연락처는 숫자만 입력해주세요.",
            "tel.kor_tel" => "연락처가 잘못되었습니다..",
            "mail.required" => "이메일을 입력해주세요",
            "mail.regex" => "이메일주소가 잘못되었습니다.",
            "title.required" => "제목을 입력해 주세요.",
            "title.max" => "제목은 100자까지 입력가능합니다.",
            "contents.required" => "내용을 입력해 주세요.",
            "contents.max" => "내용은 2천자까지 입력 가능합니다.",
            "policy_agree.accepted" => "개인정보 처리방침에 동의 해주세요.",
            "branch_id.exists" => "잘못된 지점정보입니다.",
            "branch_id.numeric" => "지점을 선택해 주세요.",
        ];
    }

    protected function getValidatorInstance(){
        $validator = parent::getValidatorInstance();

        $validator->sometimes('email.0', 'regex:/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,6}$/i', function ($input) {
            return is_null($input->email[1]);
        });

        $validator->sometimes('email.0', 'regex:/[A-Za-z0-9_\.\-]+/', function ($input) {
            return !is_null($input->email[1]);
        });

        return $validator;
    }
}
