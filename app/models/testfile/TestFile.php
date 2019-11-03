<?php


namespace App\models\testfile;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class TestFile extends Model
{
    protected $table = "user_files";
    protected $primaryKey = "file_idx";

    public function saveFile($file_info) {
        $this->insert($file_info);
    }

    public function updateFile($file_info, $id) {
        $this->where("file_idx", "=", $id)->update($file_info);
    }

}
