<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class m_contact extends FormRequest
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
            "branch" => "bail|required|exists:branch,ix",
            "uptae" => "required",
            "company_name" => "required",
            "tel" => "bail|required|numeric|kor_tel",
            "brand" => "required",
            "license_number" => "bail|required|numeric|license_no",
            "customer" => "required",
            "customer_tel" => "bail|required|numeric|kor_tel",
            "email.0" => "required",
            "content" => "required",
            "file" => "required|file|max:5000",
            "privacy_agreement" => "accepted",
        ];
    }

    public function messages()
    {
        return [
            "branch.required" => "지점을 선택해주세요.",
            "branch.exists" => "지점정보가 잘못되었습니다.",
            "uptae.required" => "업태,업종을 입력해주세요.",
            "company_name.required" => "업체명을 입력해주세요.",
            "tel.required" => "업체 전화번호를 입력해주세요.",
            "tel.numeric" => "업체 전화번호는 숫자만 입력해주세요.",
            "tel.kor_tel" => "업체 전화번호가 잘못되었습니다..",
            "brand.required" => "브랜드명을 입력해주세요.",
            "license_number.required" => "사업자번호를 모두 입력해주세요.",
            "license_number.numeric" => "사업자번호는 숫자만 입력해주세요.",
            "license_number.license_no" => "사업자번호가 잘못되었습니다.",
            "customer.required" => "담당자명을 입력해주세요.",
            "customer_tel.required" => "담당자 전화를 모두 입력해주세요.",
            "customer_tel.numeric" => "담당자 전화는 숫자만 입력해주세요.",
            "customer_tel.kor_tel" => "담당자 전화가 잘못되었습니다.",
            "content.required" => "문의내용을 입력해주세요.",
            "email.0.required" => "이메일을 입력해주세요",
            "email.0.email" => "이메일주소가 잘못되었습니다.",
            "email.0.regex" => "이메일주소가 잘못되었습니다.",
            "file.required" => "사업자등록증을 등록해주세요.",
            "file.max" => "파일 최대 크기는 5MB 까지만 업로드 가능합니다.",
            "privacy_agreement.accepted" => "개인정보처리방침에 동의해주세요",
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
