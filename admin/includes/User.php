<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/22/2017
 * Time: 12:06 AM
 */
class User
{

    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;


    public static function find_all_users(){
        $sql = "SELECT * FROM users";
        return self::find_this_query($sql);
    }

    public static function find_user_by_id($user_id){

        $sql = "SELECT * FROM users WHERE id = $user_id LIMIT 1";
        return self::find_this_query($sql);
    }

    public static function find_this_query($sql){
        global $database;
         $result_set = $database->query($sql);
         $object_array = array();

         while ($row = mysqli_fetch_array($result_set)){
             $object_array[] = self::initUser($row);
         }
        return  $object_array;
    }

    public static function verify_user($username, $password){
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM users WHERE username='{$username}' AND password='{$password}'";

        $the_result = self::find_this_query($sql);

        return !empty($the_result) ? array_shift($the_result):false;

    }

    public static function initUser($found_user){
       /* $found_user = $found_user->fetch_assoc();*/
        $the_obj = new self();
       /* $the_obj->id = $found_user['id'];
        $the_obj->username = $found_user['username'];
        $the_obj->password = $found_user['password'];
        $the_obj->first_name = $found_user['first_name'];
        $the_obj->last_name = $found_user['last_name'];*/

       foreach ($found_user as $the_attribute => $value){
           if($the_obj->has_the_attribute($the_attribute)){
               $the_obj->$the_attribute = $value;
           }

       }
        return $the_obj;
    }

    private function has_the_attribute($the_attribute){
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute,$object_properties);
    }
}
