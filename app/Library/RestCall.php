<?php

namespace App\Library;


/**
 * Class RestCall
 * @package App\Library
 * @file app/Library/RestCall.php
 * @bref Curl 을 쉽게 하기위한 라이브러리
 */
class RestCall
{
    public $RestObj;

    public function __construct($timeout = 30)
    {
        $this->RestObj = curl_init();
        curl_setopt($this->RestObj, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($this->RestObj, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($this->RestObj, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($this->RestObj, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($this->RestObj, CURLOPT_MAXREDIRS, 5);
    }

    public function __destruct()
    {
        //curl_close($this->RestObj);
    }

    public function getinfo()
    {
        return curl_getinfo($this->RestObj);
    }

    public function GET($url, $ssl = false, $header = array())
    {
        curl_setopt($this->RestObj, CURLOPT_SSL_VERIFYPEER, $ssl);

        if (count($header) > 0) {
            curl_setopt($this->RestObj, CURLOPT_HTTPHEADER, $header);
        }

        curl_setopt($this->RestObj, CURLOPT_URL, $url);
        curl_setopt($this->RestObj, CURLOPT_RETURNTRANSFER, true);

        $returnVal = curl_exec($this->RestObj);
        return $returnVal;
    }

    public function POST($url, $data = array(), $ssl = false, $header = array())
    {
        curl_setopt($this->RestObj, CURLOPT_SSL_VERIFYPEER, $ssl);

        if (!empty($header)) {
            curl_setopt($this->RestObj, CURLOPT_HTTPHEADER, $header);
        }

        curl_setopt($this->RestObj, CURLOPT_URL, $url);
        curl_setopt($this->RestObj, CURLOPT_POST, true);
        curl_setopt($this->RestObj, CURLOPT_POSTFIELDS, $data);
        $returnVal = curl_exec($this->RestObj);


        return $returnVal;

    }

    public function getErrorNo()
    {
        return curl_errno($this->RestObj);
    }

    public function getErrorString()
    {
        return curl_error($this->RestObj);
    }

    public function close()
    {
        $this->__destruct();
    }
}
