<?php namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Adodb2;

class User_credentials extends Model
{
    protected $table      = 'dc_user';
    protected $primaryKey = 'username';
    protected $allowedFields = [];

    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    function find_user($arr_user = array())
    {
        if (isset($arr_user)){
            $builder = $this->db->table($this->table);
            $query = $builder->getWhere(['username'=>$arr_user['username'],'password'=>$arr_user['password']]);
            
            $arr_result = $query->getResultArray();
            $result = array($arr_result[0]['username']=>array("password"=>$arr_result[0]['password'],"user_name"=>$arr_result[0]['username']));

            return $result;
        }
    }

}