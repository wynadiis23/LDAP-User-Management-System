<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GH;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $newServer = $server;
        return view('home.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        //
        $lastUID = GH::lastUID()+1;
        return view('home.create',['lastUID'=>$lastUID]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $ldap_server = "ldaps://192.168.1.3:636";
        $ldap_dn = "cn=admin,dc=ldaps,dc=cs,dc=unud,dc=ac,dc=id";
        $ldap_password = "password";

        $ldap_conn = ldap_connect($ldap_server);
        ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        $ldap_base = "dc=ldaps,dc=cs,dc=unud,dc=ac,dc=id";
        $lastUID = GH::lastUID();
        if(ldap_bind($ldap_conn, $ldap_dn, $ldap_password)){
            
            $ldaprecord['cn'] = $request->get('CN');
            $ldaprecord['sn'] = $request->get('SN');
            $ldaprecord['uid'] = $request->get('uid');
            $ldaprecord['objectclass'][0] = "top";
            $ldaprecord['objectclass'][1] = "posixaccount";
            $ldaprecord['objectclass'][2] = "inetOrgPerson";
            $ldaprecord['loginshell'] = $request->get('loginShell');
            // $ldaprecord['homedirectory'] = $request->get('homeDir');
            $ldaprecord['homedirectory'] = "/home/".$ldaprecord['cn'].$ldaprecord['sn'];
            // $ldaprecord['username'] = $ldaprecord['cn'];
            
            
            $posix = $request->get('posixGroup');
            if($posix == 'moodleuser'){
                $ldaprecord['uidnumber'] = $lastUID+1;
                $ldaprecord['gidnumber'] = 2000;
                // echo "moodleuser";
            }
            $tampungPass = md5($request->get('password'));
            $ldaprecord['userpassword'] = '{MD5}' . base64_encode(pack('H*',$tampungPass));
            // dd($ldaprecord);
            $base_dn = "cn=".$ldaprecord['cn'].","."cn=".$posix.",".$ldap_base;
            // dd($ldaprecord);
            // ldap_add($ds, "cn=$name,ou=contacts,ou="domain",dc=tld", $info);
            // $query = ldap_add($ldap_conn, "cn=pegi,cn=moodleuser,dc=ldaps,dc=cs,dc=unud,dc=ac,dc=id", $ldaprecord);
            // dd($ldap_conn, $base_dn, $ldaprecord);
            $r = ldap_add($ldap_conn, $base_dn, $ldaprecord);
            // $query = ldap_add($ldap_conn, $base_dn, $ldaprecord);
            // if($r){
            //     echo "behasil";
            // }else{
            //     echo "gagal";
            // }

            // dd($base_dn);
            // dd($ldaprecord['userpassword']);
            // dd($ldaprecord['objectClass'][0]);
            return redirect()->route('home.create')->with('success', 'Create user berhasil');
        }
        else{
            return redirect()->route('home.create')->with('error', 'Gagal membuat user');
            ldap_close($ldap_conn);
            echo "anuu";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $ldap_server = "ldaps://192.168.1.3:636";
        $ldap_dn = "dc=ldaps,dc=cs,dc=unud,dc=ac,dc=id";
        $ldap_user = "cn=admin,".$ldap_dn;
        $ldap_password = "password";

        $ldap_conn = ldap_connect($ldap_server);

        ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);

        if($ldap_conn){
            $ldap_bind = ldap_bind($ldap_conn, $ldap_user, $ldap_password);
            if($ldap_bind){
                $result = ldap_search($ldap_conn, $ldap_dn, "(cn=".$id.")");
                $data = ldap_get_entries($ldap_conn, $result);
                // dd($data);

                return view('home.edit', ['hasil'=>$data]);
            }
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $ldap_server = "ldaps://192.168.1.3:636";
        $ldap_dn = "dc=ldaps,dc=cs,dc=unud,dc=ac,dc=id";
        $ldap_user = "cn=admin,".$ldap_dn;
        $ldap_password = "password";

        $ldap_conn = ldap_connect($ldap_server);
        ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);

        if($ldap_conn){
            $ldap_bind = ldap_bind($ldap_conn, $ldap_user, $ldap_password);
            if($ldap_bind){
                $ldap_update_dn = $request->get('userDN');
                // dd($ldap_update_dn);    
                // $ldapupdates['uid'] = $request->get('uid');

                $ldapupdates['sn'] = $request->get('SN');
                
                $tampungPass = md5($request->get('password'));
                $ldapupdates['userpassword'] = '{MD5}' . base64_encode(pack('H*',$tampungPass));
                // dd($ldapupdates);
                $result = ldap_mod_replace($ldap_conn, $ldap_update_dn, $ldapupdates);
                if($result){
                    $getData = ldap_search($ldap_conn, $ldap_dn, "(cn=".$id.")");
                    $data = ldap_get_entries($ldap_conn, $getData);
                    return view('home.show', ['hasil'=>$data])->with('success', 'Data berhasil diupdate');
                    // return redirect()->route('home.show')->with(['hasil'=>$data], 'success', 'data bersuh');
                    // echo "berhasil update";
                }else{
                    echo "ambang";
                }
            }else{
                echo "sangar";
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $ldap_server = "ldaps://192.168.1.3:636";
        $ldap_dn = "dc=ldaps,dc=cs,dc=unud,dc=ac,dc=id";
        $ldap_user = "cn=admin,".$ldap_dn;
        $ldap_password = "password";

        $ldap_conn = ldap_connect($ldap_server);
        ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);

        if($ldap_conn){
            $ldap_bind = ldap_bind($ldap_conn, $ldap_user, $ldap_password);
            if($ldap_bind){
                $result = ldap_search($ldap_conn, $ldap_dn, "(cn=".$id.")");
                $data = ldap_get_entries($ldap_conn, $result);

                for($i = 0; $i<$data["count"]; $i++){
                    $ldap_user_dn = $data[$i]["dn"];
                }
                ldap_delete($ldap_conn, $ldap_user_dn);
                return redirect()->route('cari')->with('success', 'User berhasil dihapus');
            }
        }
        // dd($ldap_user);
    }
    public function cari(){
        return view('home.cari');
    }
    public function letsCari(Request $request){
        $ldap_server = "ldaps://192.168.1.3:636";
        
        $ldap_dn = "dc=ldaps,dc=cs,dc=unud,dc=ac,dc=id";
        $ldap_user = "cn=admin,".$ldap_dn;
        $ldap_password = "password";
        $ldap_filter = $request->get('filter');

        $ldap_conn = ldap_connect($ldap_server);
        ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        
        if($ldap_conn){
            $ldap_bind = ldap_bind($ldap_conn, $ldap_user, $ldap_password);
            if($ldap_bind){
                $result = ldap_search($ldap_conn, $ldap_dn, "(cn=".$ldap_filter.")");
                $data = ldap_get_entries($ldap_conn, $result);

                if($data['count'] == 0){
                    // return view('home.cari')->with('error','Data tidak ditemukan');
                    return redirect()->route('cari')->with('error', 'Data tidak ditemukan');
                }else{
                    return view('home.show',['hasil'=>$data]);    
                }
                // // dd($data);
                
                // echo "berhasil";
                
            }
        }
    }
    public function sinkronisasi(){
        return view('home.sinkronisasi');
    }
    public function getSinkronisasi(){
        $ldap_server = "ldaps://192.168.1.3:636";
        $ldap_dn = "dc=ldaps,dc=cs,dc=unud,dc=ac,dc=id";
        $ldap_user = "cn=admin,".$ldap_dn;
        $ldap_password = "password";

        $uidnumber = [];
        $x = [];
        $var = "objectclass=posixAccount";
        $ldap_conn = ldap_connect($ldap_server);
        ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);

        if($ldap_conn){
            $ldap_bind = ldap_bind($ldap_conn, $ldap_user, $ldap_password);
            if($ldap_bind){
                $lastUID = GH::lastUID();
                echo $lastUID;

                //sorting berdasarkan tipe objek class

                //aaa
                // $result = ldap_search($ldap_conn, $ldap_dn, "(objectclass=posixAccount)");
                // $data = ldap_get_entries($ldap_conn, $result);
                //aaa
                //sorting berdasarkan cn dan uidnumber low to high
                // for ($i=0; $i<$data["count"]; $i++) {
                //     if($data[$i]["dn"] == "cn=".$data[$i]["cn"][0].","."cn=moodleuser,dc=ldaps,dc=cs,dc=unud,dc=ac,dc=id"){
                //         echo "User: ". $data[$i]["uidnumber"][0] ."<br />";    
                //         // dd($data);
                //         array_push($uidnumber, $data[$i]["uidnumber"][0]);
                //     }
                // }
                // $a = count($uidnumber)-1;
                // sort($uidnumber);
                // echo $a;
                // dd($uidnumber[$a]);

                // for ($i=0; $i<$data["count"]; $i++) {
                //     array_push($uidnumber, $data[$i]["uidnumber"][0]);
                    
                //     // dd($data);
                // }
                // $a = count($uidnumber)-1;
                // sort($uidnumber);


                // echo $a;
                // return $this->lastUID();
                // dd($uidnumber[$a]);
                

            }
        }
    }

    public function lastUID(){
        $ldap_server = "ldaps://192.168.1.3:636";
        $ldap_dn = "dc=ldaps,dc=cs,dc=unud,dc=ac,dc=id";
        $ldap_user = "cn=admin,".$ldap_dn;
        $ldap_password = "password";

        $uidnumber = [];
        $x = [];

        $ldap_conn = ldap_connect($ldap_server);
        ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);

        if($ldap_conn){
            $ldap_bind = ldap_bind($ldap_conn, $ldap_user, $ldap_password);
            if($ldap_bind){

                //sorting berdasarkan tipe objek class
                $result = ldap_search($ldap_conn, $ldap_dn, "(objectclass=posixAccount)");
                $data = ldap_get_entries($ldap_conn, $result);
                //sorting berdasarkan cn dan uidnumber low to high
                // for ($i=0; $i<$data["count"]; $i++) {
                //     if($data[$i]["dn"] == "cn=".$data[$i]["cn"][0].","."cn=moodleuser,dc=ldaps,dc=cs,dc=unud,dc=ac,dc=id"){
                //         echo "User: ". $data[$i]["uidnumber"][0] ."<br />";    
                //         // dd($data);
                //         array_push($uidnumber, $data[$i]["uidnumber"][0]);
                //     }
                // }
                // $a = count($uidnumber)-1;
                // sort($uidnumber);
                // echo $a;
                // dd($uidnumber[$a]);

                for ($i=0; $i<$data["count"]; $i++) {
                    array_push($uidnumber, $data[$i]["uidnumber"][0]);
                    
                    // dd($data);
                }
                $a = count($uidnumber)-1;
                sort($uidnumber);
                // echo $a;
                // dd($uidnumber[$a]);
                $lastUID = $uidnumber[$a];

                return $lastUID;
            }
        }
    }
}
