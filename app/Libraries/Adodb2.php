<?php namespace App\Libraries;
/**
 * Adodb2 library using Adodb in CodeIgniter system
 * 
 * This Adodb will implement your Adodb Database Abstraction 
 * into CodeIgniter Framework allow you to connect with more 
 * Database than native CodeIgniter 4 has. This library will
 * be used in parent model class, all you have to do is extends
 * the base Adodb_model model class and using the $this->db_adodb
 * object instance 
 * 
 * Example usage :
 * 
 * $this->db_adodb->getArray($sql);
 * 
 * @author      Suwi D. Utomo <suwidadi@gmail.com>
 * @version     1.0
 * @access      public
 * @param       string $hostname
 * @param       string $username
 * @param       string $password
 * @param       string $db_driver
 * @param       string $database
 * @return      object $db_adodb
 * @throws      Error Exceptions 
 * @since       5.21
 * @see         http://adodb.org
 * @copyright   GPLv2
 *  
 */

define('ADODB_ASSOC_CASE', ADODB_ASSOC_CASE_UPPER);
class Adodb2 {
    var $db_adodb;

    function __construct()
    {
        $this->init();
    }
    
    /**
     * init
     *
     * @return void
     */

    public function init()
    {
        
        $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

        $hostname           = getenv('database.default.hostname');
        $username           = getenv('database.default.username');
        $password           = getenv('database.default.password');
        $db_driver          = getenv('database.default.DBDriver');
        $database           = getenv('database.default.database');

        try {
            $this->db_adodb = NewADOConnection($db_driver);
            $this->db_adodb->connect($hostname,$username,$password,$database);
            $this->db_adodb->setFetchMode(ADODB_FETCH_ASSOC);

            return $this->db_adodb;
        } catch (\Exception $e) {
            
            return $e->getMessage();
        }
    }
}

