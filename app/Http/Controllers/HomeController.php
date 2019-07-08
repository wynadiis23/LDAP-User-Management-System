<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GH;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Prodi;
use App\Fakultas;
use Illuminate\Support\Facades\DB;

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
        $ldap_configuration = GH::config();

        $data = GH::getAllUser();
        $data = $data['count'];

        $fakultas = Fakultas::all();
        $jumFak = count($fakultas);
        return view('home.index', ['ldap_data'=>$ldap_configuration, 'jumlah'=>$data, 'jumFak'=>$jumFak]);
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
        $prodi = Prodi::all();

        return view('home.create',['lastUID'=>$lastUID, 'prodi'=>$prodi]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ldap_configuration = GH::config();
        $ldap_conn = ldap_connect($ldap_configuration['ldap_server']);
        ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        $lastUID = GH::lastUID();
        $ldap_bind = ldap_bind($ldap_conn, $ldap_configuration['ldap_user'],$ldap_configuration['ldap_password']);
        if($ldap_bind){
            $ldaprecord['cn'] = $request->get('CN');
            $ldaprecord['sn'] = $request->get('SN');
            $ldaprecord['uid'] = $request->get('uid');
            $ldaprecord['objectclass'][0] = "top";
            $ldaprecord['objectclass'][1] = "posixaccount";
            $ldaprecord['objectclass'][2] = "inetOrgPerson";
            $ldaprecord['loginshell'] = $request->get('loginShell');
            $ldaprecord['homedirectory'] = "/home/".$ldaprecord['cn'].$ldaprecord['sn'];

            $posix = $request->get('posixGroup');
            $prodi = DB::table('prodi')->where('id', $posix)->first();
            $fakultas = DB::table('fakultas')->where('id', $prodi->kode)->first();
            $ldaprecord['uidnumber'] = $lastUID+1;
            $ldaprecord['gidnumber'] = $posix;
            
            $tampungPass = md5($request->get('password'));
            $ldaprecord['userpassword'] = '{MD5}' . base64_encode(pack('H*',$tampungPass));
            $base_dn = "cn=".$ldaprecord['cn'].","."cn=".$prodi->prodi.","."cn=".$fakultas->fakultas.","."cn=fakultas,".$ldap_configuration['ldap_dn'];
            $r = ldap_add($ldap_conn, $base_dn, $ldaprecord);

            return redirect()->route('home.create')->with('success', 'Create user berhasil');
            }
            else{
                return redirect()->route('home.create')->with('error', 'Gagal membuat user');
                ldap_close($ldap_conn);
            }
    }
            
        // if(ldap_bind($ldap_conn, $ldap_dn, $ldap_password)){
            
        //     $ldaprecord['cn'] = $request->get('CN');
        //     $ldaprecord['sn'] = $request->get('SN');
        //     $ldaprecord['uid'] = $request->get('uid');
        //     $ldaprecord['objectclass'][0] = "top";
        //     $ldaprecord['objectclass'][1] = "posixaccount";
        //     $ldaprecord['objectclass'][2] = "inetOrgPerson";
        //     $ldaprecord['loginshell'] = $request->get('loginShell');
        //     $ldaprecord['homedirectory'] = "/home/".$ldaprecord['cn'].$ldaprecord['sn'];
            
        //     $posix = $request->get('posixGroup');
        //     $prodi = DB::table('prodi')->where('id', $posix)->first();
        //     $fakultas = DB::table('fakultas')->where('id', $prodi->kode)->first();
        //         $ldaprecord['uidnumber'] = $lastUID+1;
        //         $ldaprecord['gidnumber'] = $posix;

          
        //     $tampungPass = md5($request->get('password'));
        //     $ldaprecord['userpassword'] = '{MD5}' . base64_encode(pack('H*',$tampungPass));
        //     // dd($ldaprecord);
        //     $base_dn = "cn=".$ldaprecord['cn'].","."cn=".$prodi->prodi.","."cn=".$fakultas->fakultas.","."cn=fakultas,".$ldap_base;


        //     $r = ldap_add($ldap_conn, $base_dn, $ldaprecord);
            
        //     return redirect()->route('home.create')->with('success', 'Create user berhasil');
        // }
        // else{
        //     return redirect()->route('home.create')->with('error', 'Gagal membuat user');
        //     ldap_close($ldap_conn);
        //     echo "anuu";
        // }
    // }

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
        $ldap_configuration = GH::config();
        $status = GH::loginToLdapServer();
        if($status == 1){
            $result = ldap_search($ldap_configuration['ldap_conn'], $ldap_configuration['ldap_dn'], "(cn=".$id.")");
            $data = ldap_get_entries($ldap_configuration['ldap_conn'], $result);
            // dd($data);
            $getFakultas = DB::table('prodi')->where('id', $data[0]['gidnumber'][0])->first();
            $fakultas = DB::table('fakultas')->where('id', $getFakultas->kode)->first();
            $prodi = $getFakultas->prodi;

            return view('home.edit', ['hasil'=>$data, 'fakultas'=>$fakultas, 'prodi'=>$prodi]);
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
        $ldap_configuration = GH::config();
        $status = GH::loginToLdapServer();
        $ldap_conn = ldap_connect($ldap_configuration['ldap_server']);
        ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        if($status == 1){
            $ldap_bind = ldap_bind($ldap_conn, $ldap_configuration['ldap_user'], $ldap_configuration['ldap_password']);
            $ldap_update_dn = $request->get('userDN');
            $ldapupdates['sn'] = $request->get('SN');

            if($request->get('password') != ""){
                $tampungPass = md5($request->get('password'));
                $ldapupdates['userpassword'] = '{MD5}' . base64_encode(pack('H*',$tampungPass));
            }
            $result = ldap_mod_replace($ldap_conn, $ldap_update_dn, $ldapupdates);
            if($result){
                $getData = ldap_search($ldap_configuration['ldap_conn'], $ldap_configuration['ldap_dn'], "(cn=".$id.")");
                $data = ldap_get_entries($ldap_configuration['ldap_conn'], $getData);
                return view('home.show', ['hasil'=>$data])->with('success', 'Data berhasil diupdate');
            }else{
                echo "ambang";
            }
        }else{
            echo "sangar";
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
        $ldap_configuration = GH::config();
        $status = GH::loginToLdapServer();

        $ldap_conn = ldap_connect($ldap_configuration['ldap_server']);
        ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        $ldap_bind = ldap_bind($ldap_conn, $ldap_configuration['ldap_user'], $ldap_configuration['ldap_password']);
        if($status == 1){
            $result = ldap_search($ldap_configuration['ldap_conn'], $ldap_configuration['ldap_dn'], "(cn=".$id.")");
            $data = ldap_get_entries($ldap_configuration['ldap_conn'], $result);

            for($i = 0; $i<$data["count"]; $i++){
                $ldap_user_dn = $data[$i]["dn"];
            }
            ldap_delete($ldap_conn, $ldap_user_dn);
            return redirect()->route('cari')->with('success', 'User berhasil dihapus');
        }
    }

    public function cari(){
        //get semua user posix account
        $data = GH::getAllUser();
        if($data){
            // echo "mamang";
            return view('home.cari', ['data'=>$data]);    
        }
        return "view('home.cari')";
        
    }
    public function letsCari(Request $request){
        // 
        $ldap_configuration = GH::config();
        $status = GH::loginToLdapServer();
        $ldap_filter = $request->get('filter');
        ldap_set_option($ldap_configuration['ldap_conn'], LDAP_OPT_PROTOCOL_VERSION, 3);
        if($status == 1){
            $result = ldap_search($ldap_configuration['ldap_conn'], $ldap_configuration['ldap_dn'], "(cn=".$ldap_filter.")");

                $data = ldap_get_entries($ldap_configuration['ldap_conn'], $result);
                // dd($data);
            if($data['count'] == 0){
                // return view('home.cari')->with('error','Data tidak ditemukan');
                return redirect()->route('cari')->with('error', 'Data tidak ditemukan');
            }else{
                return view('home.show',['hasil'=>$data]);    
            }
        }
    }
    public function sinkronisasi(){
        $data = GH::getDataUserAPI();

        $result = json_decode($data);

        return view('home.sinkronisasi', ['datas'=>$result]);
    }
    // public function getSinkronisasi(){
    //     $ldap_server = "ldaps://192.168.1.3:636";
    //     $ldap_dn = "dc=ldaps,dc=cs,dc=unud,dc=ac,dc=id";
    //     $ldap_user = "cn=admin,".$ldap_dn;
    //     $ldap_password = "password";

    //     $uidnumber = [];
    //     $x = [];
    //     $var = "objectclass=posixAccount";
    //     $ldap_conn = ldap_connect($ldap_server);
    //     ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);

    //     if($ldap_conn){
    //         $ldap_bind = ldap_bind($ldap_conn, $ldap_user, $ldap_password);
    //         if($ldap_bind){
    //             $lastUID = GH::lastUID();
    //             echo $lastUID;
    //         }
    //     }
    // }

    // public function lastUID(){
    //     $ldap_server = "ldaps://192.168.1.3:636";
    //     $ldap_dn = "dc=ldaps,dc=cs,dc=unud,dc=ac,dc=id";
    //     $ldap_user = "cn=admin,".$ldap_dn;
    //     $ldap_password = "password";

    //     $uidnumber = [];
    //     $x = [];

    //     $ldap_conn = ldap_connect($ldap_server);
    //     ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);

    //     if($ldap_conn){
    //         $ldap_bind = ldap_bind($ldap_conn, $ldap_user, $ldap_password);
    //         if($ldap_bind){
    //             $result = ldap_search($ldap_conn, $ldap_dn, "(objectclass=posixAccount)");
    //             $data = ldap_get_entries($ldap_conn, $result);

    //             for ($i=0; $i<$data["count"]; $i++) {
    //                 array_push($uidnumber, $data[$i]["uidnumber"][0]);
    //             }
    //             $a = count($uidnumber)-1;
    //             sort($uidnumber);
    //             $lastUID = $uidnumber[$a];

    //             return $lastUID;
    //         }
    //     }
    // }

    public function getDataUser(){
        $data = GH::getDataUserAPI();

        $result = json_decode($data);

        echo $result[0]->username;
        return $result;
    }

    public function sinkronkanDataUser(){

        // $ldap_server = "ldaps://192.168.1.3:636";
        // $ldap_dn = "cn=admin,dc=ldaps,dc=cs,dc=unud,dc=ac,dc=id";
        // $ldap_password = "password";
        $ldap_configuration = GH::config();
        $ldap_conn = ldap_connect($ldap_configuration['ldap_server']);
        ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);

        if(ldap_bind($ldap_conn, $ldap_configuration['ldap_user'], $ldap_configuration['ldap_password'])){
            $data = GH::getDataUserAPI();
            $lastUID = GH::lastUID()+1;
            // dd($lastUID);
            $x = json_decode($data);
            $y = count($x);
            if($y == 0){
                return redirect()->route('sinkronisasi')->with('error', 'Tidak dapat mensinkronisasi, tidak ada data');
            }else{
                for($i=0; $i<$y; $i++){
                // echo $x[$i]->name;
                $ldaprecord['cn'] = $x[$i]->username;
                $ldaprecord['sn'] = $x[$i]->name;
                $ldaprecord['uid'] = $x[$i]->nimnip;
                $ldaprecord['objectclass'][0] = "top";
                $ldaprecord['objectclass'][1] = "posixaccount";
                $ldaprecord['objectclass'][2] = "inetOrgPerson";
                $ldaprecord['loginshell'] = "/bin/sh";
                $ldaprecord['homedirectory'] = "/home/".$x[$i]->username.$x[$i]->name;

                $ldaprecord['uidnumber'] = $lastUID+$i;
                $ldaprecord['gidnumber'] = $x[$i]->prodi;

                $getEncryptPass = $x[$i]->pasd;
                $plain = GH::decrypt($getEncryptPass);
                // dd($plain);
                $tampungPass = md5($plain);
                $ldaprecord['userpassword'] = '{MD5}' . base64_encode(pack('H*',$tampungPass));
                //ganti pakai db nanti
                if($x[$i]->prodi){

                    // $getProdi = Prodi::find($x[$i]->prodi);
                    $getProdi = Prodi::find($x[$i]->prodi);
                    $prodi = $getProdi->prodi;
                    if($x[$i]->fakultas){
                        $getFakultas = Fakultas::find($x[$i]->fakultas);
                        $fakultas = $getFakultas->fakultas;
                        $base_dn = "cn=".$ldaprecord['cn'].","."cn=".$prodi.","."cn=".$fakultas.","."cn=fakultas,".$ldap_configuration['ldap_dn'];
                        echo $base_dn;
                    }    
                }
                print_r($ldaprecord);
                $r = ldap_add($ldap_conn, $base_dn, $ldaprecord);
                if($r){
                    $flag = GH::setFlagSync();
                }else{
                    return redirect()->route('sinkronisasi')->with('error', 'Terjadi kesalahan');            
                }
            }
        }
        return redirect()->route('sinkronisasi')->with('success', 'Sinkronisasi user berhasil');
        }        
    }

    public function test(){
        GH::loginToLdapServer();
    }
}
