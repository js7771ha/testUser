<?php


namespace App\models\testfile;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class TestFile extends Model
{
    protected $table = "test_file";
    protected $primaryKey = "file_idx";

    public $timestamps = false;

    public function saveFile() {

    }

}
