<?php
namespace App\Repository;

use Illuminate\Support\Facades\DB;

class PasswordResetRepository {
    public $tableName;
    public function __construct(){
        $this->tableName='password_resets';
    }

    public function getEmailByToken($token){
        return DB::table($this->tableName)->where('token',$token)->first('email');
    }

}
