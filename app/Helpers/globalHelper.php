<?php 
namespace App\Helpers;

use GH;
use GuzzleHttp\Client;

class globalHelper{
    //config
    public static function config(){
        //server config
        $ldap_configuration = [
            'ldap_server' => "ldaps://192.168.1.3:636/",
            'ldap_dn' => "dc=ldaps,dc=unud,dc=ac,dc=id",
            'ldap_user' => "cn=admin,dc=ldaps,dc=unud,dc=ac,dc=id",
            'ldap_password' => "password",
            'ldap_conn' => ldap_connect("ldaps://192.168.1.3:636/")
        ];
        return $ldap_configuration;
    }

    public static function apiConfig(){
        $apiConfig = [
            'getUser' => 'http://127.0.0.1:8000/getUser',
            'setFlag' => 'http://127.0.0.1:8000/setFlag'
        ];

        return $apiConfig;
    }

    public static function loginToLdapServer(){
        $status = 0;
        $ldap_configuration = GH::config();

        $ldap_conn = ldap_connect($ldap_configuration['ldap_server']);
        ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);

        if($ldap_conn){
            $ldap_bind = ldap_bind($ldap_conn, $ldap_configuration['ldap_user'], $ldap_configuration['ldap_password']);
            if($ldap_bind){
                $status = 1;
                return $status;
            }else{
                return $status;
            }
        }else{
            return $status;
        }
    }

	public static function lastUID(){
        $ldap_configuration = GH::config();
        $status = GH::loginToLdapServer();
        $uidnumber = [];
        $x = [];
        ldap_set_option($ldap_configuration['ldap_conn'], LDAP_OPT_PROTOCOL_VERSION, 3);
        if($status == 1){
            $result = ldap_search($ldap_configuration['ldap_conn'], $ldap_configuration['ldap_dn'], "(objectclass=posixAccount)");
            $data = ldap_get_entries($ldap_configuration['ldap_conn'], $result);

            for ($i=0; $i<$data["count"]; $i++) {
                array_push($uidnumber, $data[$i]["uidnumber"][0]);
            }
            $c = count($uidnumber);
            $a = count($uidnumber)-1;
            if($c <= 0){
                $a = count($uidnumber);
                $lastUID = 2000;
            }else{
                $a = count($uidnumber)-1;
                sort($uidnumber);
                $lastUID = $uidnumber[$a];
            }
            return $lastUID;
        }else{
            return false;
        }
        // if($ldap_conn){
        //     $ldap_bind = ldap_bind($ldap_conn, $ldap_user, $ldap_password);
        //     if($ldap_bind){

        //         //sorting berdasarkan tipe objek class
        //         $result = ldap_search($ldap_conn, $ldap_dn, "(objectclass=posixAccount)");
        //         $data = ldap_get_entries($ldap_conn, $result);
        //         //sorting berdasarkan cn dan uidnumber low to high
        //         // for ($i=0; $i<$data["count"]; $i++) {
        //         //     if($data[$i]["dn"] == "cn=".$data[$i]["cn"][0].","."cn=moodleuser,dc=ldaps,dc=cs,dc=unud,dc=ac,dc=id"){
        //         //         echo "User: ". $data[$i]["uidnumber"][0] ."<br />";    
        //         //         // dd($data);
        //         //         array_push($uidnumber, $data[$i]["uidnumber"][0]);
        //         //     }
        //         // }
        //         // $a = count($uidnumber)-1;
        //         // sort($uidnumber);
        //         // echo $a;
        //         // dd($uidnumber[$a]);

        //         for ($i=0; $i<$data["count"]; $i++) {
        //             array_push($uidnumber, $data[$i]["uidnumber"][0]);
                    
        //             // dd($data);
        //         }
        //         $a = count($uidnumber)-1;
        //         sort($uidnumber);
        //         // echo $a;
        //         // dd($uidnumber[$a]);
        //         $lastUID = $uidnumber[$a];
        //         // dd($lastUID);
        //         return $lastUID;
        //     }
        // }
    }	

    public static function getDataUserAPI(){
        $apiLink = GH::apiConfig();
        $client = new Client();
        $res = $client->get($apiLink['getUser']);


        $result = $res->getBody();
        return $result;
    }

    public static function decrypt($string){
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'cs.unud.ac.id';
        $secret_iv = 'cs.unud.ac.id';

         // hash
        $key = hash('sha256', $secret_key);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        return $output;
    }

    public static function setFlagSync(){
        $apiLink = GH::apiConfig();
        $client = new Client();
        
        $res = $client->get($apiLink['setFlag']);        
    }


    public static function getAllUser(){
        $ldap_configuration = GH::config();
        $status = GH::loginToLdapServer();
        $uidnumber = [];
        $x = [];
        ldap_set_option($ldap_configuration['ldap_conn'], LDAP_OPT_PROTOCOL_VERSION, 3);
        if($status == 1){
            $result = ldap_search($ldap_configuration['ldap_conn'], $ldap_configuration['ldap_dn'], "(objectclass=posixAccount)");
                $data = ldap_get_entries($ldap_configuration['ldap_conn'], $result);

                return $data;
        }else{
            return "not binding";
        }
    }

    //////setingan active url


}
function set_active($uri, $output = ‘active’)
    {
     if( is_array($uri) ) {
       foreach ($uri as $u) {
         if (Route::is($u)) {
           return $output;
         }
       }
     } else {
       if (Route::is($uri)){
         return $output;
       }
     }
    }


?>