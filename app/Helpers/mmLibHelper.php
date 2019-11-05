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
     * @brief   aes-256-cbc 암호화
     * @params  $message = 인코딩할 텍스트
     * @params  $key = 인크립트 키
     * @params  $openKey = 공개키
     * @return  $ciphertext 암호화문자열
     * @throws  object Exception
     * @author  freshsms
     * @date    2019-03-11
     * @bug     미확인
     * @todo
     */

    public static function encrypt($message, $key, $openKey)
    {
//        if (mb_strlen($key, '8bit') !== 32) {
//            throw new \Exception("Needs a 256-bit key!");
//        }
//        $ivsize = openssl_cipher_iv_length('aes-256-cbc');
//        $iv = openssl_random_pseudo_bytes($ivsize);
//        $ciphertext = openssl_encrypt($message, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $openKey);
//        return $openKey . $ciphertext;

        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $ciphertext_raw = openssl_encrypt($message, $cipher, $key, $options=OPENSSL_RAW_DATA, $openKey);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        $ciphertext = base64_encode( $openKey.$hmac.$ciphertext_raw );

        return $ciphertext;
    }

    /**
     * @brief   aes-256-cbc 복호화
     * @param string $message = 디코딩할 텍스트
     * @param string $key = 인크립트 키
     * @param string $openKey = 공개키
     * @return  string $decrypted 복호화된문자열
     * @throws  object Exception
     * @author  freshsms
     * @date    2019-03-11
     * @bug     미확인
     * @todo    인증실패 공백문자 trim 추가 (발생시마다)
     */
    public static function decrypt($message, $key, $openKey): string
    {

//        if (mb_strlen($key, '8bit') !== 32) {
//            throw new \Exception("Needs a 256-bit key!");
//        }
////        $ivsize = openssl_cipher_iv_length('aes-256-cbc');
////        $iv = mb_substr($message, 0, $ivsize, '8bit');
////        dd($ivsize);
//        $ciphertext = mb_substr($message, 16, null, '8bit');
//        $decrypted = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING, $openKey);
//        return $decrypted;

        $c = base64_decode($message);
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len=32);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $openKey);

        return $original_plaintext;
    }


}
