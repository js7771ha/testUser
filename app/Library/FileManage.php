<?php


namespace App\Library;


use File;

/**
 * Class FileManage
 * @package App\Library
 * @file app/Library/FileManage.php
 * @bref 파일생성관리 라이브러리
 */
class FileManage
{
    /**
     * @param $file
     * @param $newFileName
     * @param $basePath
     * @param null $additionalPath
     * @return array|bool
     * @bref 파일쓰기 메소드
     */
    public function put($file, $newFileName, $basePath, $additionalPath = null)
    {
        $oriFileName = $file->getClientOriginalName();   // 원 파일명 정보 필요시 저장 처리
        if ($additionalPath !== null) {
            $destinationPath = $basePath . "/" . $additionalPath; //신규경로생성
        } else {
            $destinationPath = $basePath;
        }

        $this->checkDirectoryAndMake($destinationPath);

        $FileHash = md5_file($file);//업로드파일 md5 해쉬

        if ($file->move($destinationPath, $newFileName)) { //파일생성
            return array("oriFile" => $oriFileName, "newFile" => $newFileName, "hash" => $FileHash);
        } else {
            return false;
        }
    }

    /**
     * @param $file
     * @return mixed
     * @bref 파일삭제
     */
    public function remove($file)
    {
        return File::delete($file);
    }

    /**
     * @param $directory
     * @return mixed
     * @bref 디렉토리 삭제
     */
    public function removeDir($directory)
    {
        return File::deleteDirectory($directory);
    }


    /**
     * @param null $path
     * @return bool
     * @bref 디렉토리가 생성되어있는지 체크하고 경로가 없을때는 생성
     */
    public function checkDirectoryAndMake($path = null)
    {
        $dir="";
        try {
            if (!$this->file->exists(storage_path($path))) {
                foreach (explode("/", $path) as $directory) {
                    $dir.= "{$directory}/";
                    if (!$this->file->exists(storage_path($dir))) {
                        $oldmask = umask(0);
                        $this->file->makeDirectory(storage_path($dir), $mode = 0775);
                        umask($oldmask);
                    }
                }
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}

