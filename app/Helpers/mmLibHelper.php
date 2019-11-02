<?php

namespace App\helpers;


use App\Library\RestCall;

/**
 * Class mmLibHelper
 * @package App\helpers
 * @file app/Helpers/mmLibHelper.php
 * @brief 특수 라이브러리 헬퍼
 */
class mmLibHelper
{

    /**
     * @param string $number = 전화번호전체
     * @return   false | array [0=>DDD , 1=>국번 , 2=>번호] // 1588등의 특수번호는 4자리고 0으로 시작하지 않을때만 분리한다.
     * @brief   국내전화번호를 규칙에맞게 분리 한다.
     * @author  freshsms
     * @date    2019-01-28
     * @bug     미확인
     */
    public static function splitKoreanTelNumber(string $number = '')
    {
        if (strpos($number, "-")) {
            $number = str_replace("-", "", $number);
        }

        if (strlen($number) < 8) {
            return false;
        }

        if (preg_match('/^0/', $number)) {
            //국내용 전국 전화번호는 0 으로 시작한다 (국제규격은 국제기호뒤 ddd 는 0 탈락됨 국제전화번호 필요하면 국가코드 표 만들어서 앞글자 한자리~3자리까지 비교하는 로직 추가할것)
            if(preg_match('/^00/', $number)){
                 return false;
            } elseif (preg_match('/^02/', $number)) {
                //서울국번
                if (strlen($number) == 10) {
                    return self::NumberSplit(array(2, 4, 4), $number);
                } elseif (strlen($number) == 9) {
                    return self::NumberSplit(array(2, 3, 4), $number);
                } else {
                    return false;
                }
            } elseif (preg_match('/^0[3-6][1-5]/', $number)) {
                //지방국번
                if (strlen($number) == 11) {
                    return self::NumberSplit(array(3, 4, 4), $number);
                } elseif (strlen($number) == 10) {
                    return self::NumberSplit(array(3, 3, 4), $number);
                } else {
                    return false;
                }
            } elseif (preg_match('/^01/', $number)) {
                //휴대폰
                if (strlen($number) == 11) {
                    return self::NumberSplit(array(3, 4, 4), $number);
                } elseif (strlen($number) == 10) {
                    return self::NumberSplit(array(3, 3, 4), $number);
                } else {
                    return false;
                }
            } else {
                //070, 0505, 0507 등 정상적인 번호
                if (strlen($number) == 12) {
                    return self::NumberSplit(array(4, 4, 4), $number);
                } elseif (strlen($number) == 11) {
                    return self::NumberSplit(array(3, 4, 4), $number);
                } else {
                    return false;
                }
            }
        } else {
            if (strlen($number) == 8) {
                return self::NumberSplit(array(4, 4, null), $number);
            } else {
                return false;
            }
        }
    }

    /**
     * @param array $split_digit = 몇글자씩 자를것인지 길이를지정한 배열 ex) [2,4,4]
     * @param $number = 잘라낼 스트링
     * @return   array
     * @brief    스트링을 지정한 길이로 잘라주는 메소드
     * @author   freshsms
     * @date     2019-01-28
     */
    public static function NumberSplit(array $split_digit, $number): array
    {
        $current_length = 0;
        $return_arr = array();
        foreach ($split_digit as $length) {
            $current_length += $length;
            $return_arr[] = substr($number, $current_length - $length, $length);
        }

        return $return_arr;
    }

    /**
     * @param null $number
     * @return bool
     * @desc 입력받은 전화번호의 유효성검사 appServiceProvider 에서 Validatior::extend 됨
     */
    public static function isValidTelNumber($number = null): bool
    {
        if (is_null($number)) {
            return false;
        } else {
            if (is_array(self::splitKoreanTelNumber($number))) {
                return true;
            } else {
                return false;
            }
        }
    }


    /**
     * @param $no
     * @return bool
     * @desc 입력받은 사업자등록번호의 유효성검사 appServiceProvider 에서 Validitior::extend 됨
     */
    public static function chkLicenseNo($no)
    {
        if (!trim($no)) {
            return false;
        }

        $no = str_replace("-", "", $no);

        if (strlen($no) != 10) {
            return false;
        }

        $num = str_split(preg_replace('/[^0-9]/', '', $no));
        $att = 0;
        $sum = 0;
        $arr = array(1, 3, 7, 1, 3, 7, 1, 3, 5);
        foreach ($arr as $index => $value) {
            $sum += $num[$index] * $value;
        }

        $sum += intval(($num[8] * 5) / 10);
        $at = $sum % 10;

        if ($at != 0) {
            $att = 10 - $at;
        }

        if ($num[9] != $att) {
            return false;
        } else {
            return true;
        }
    }

}
