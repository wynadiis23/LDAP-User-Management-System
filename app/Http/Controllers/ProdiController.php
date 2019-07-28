<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra;
use Illuminate\Support\Facades\DB;
use App\Prodi;
use App\Fakultas;
use GH;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('prodi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $query = Fakultas::all();
        return view('prodi.create', ['data'=>$query]);
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
        $fakultas = $request->get('fakultas');
        // $idProdi = DB::table('prodi')
        //     ->select('prodi_id')->where('fakultas_id', $fakultas)->get();
        $idProdi = Prodi::where('fakultas_id', $fakultas)->get();
        $getFakultas = Fakultas::where('fakultas_id', $fakultas)->first();
        // dd($idProdi);
        $a = "mamamng";
        // dd($a);
        // dd($fakultas);
        $prodi = new Prodi;
        $countProdi = count($idProdi);
        if($countProdi == 0){
            $newProdiID = $fakultas . '01';
            // dd($newProdiID);
            $prodi->prodi_id = $newProdiID;

        }
        else{
            $countProdi = count($idProdi)-1;
            $lastIDProdi = $idProdi[$countProdi]->prodi_id;
            $prodi->prodi_id = $lastIDProdi+1;

            // dd($lastIDProdi);
        }
        
        
        $prodi->prodi_name = $request->get('prodi');
        $prodi->fakultas_id = $request->get('fakultas');

        if (Prodi::where('prodi_name', '=', $request->get('prodi'))->count() > 0) {
           // user found
            return redirect()->route('prodi.create')->with('error', 'Tambah prodi gagal, prodi sudah ada');
        }else{
            $ldap_configuration = GH::config();
            $ldap_conn = ldap_connect($ldap_configuration['ldap_server']);
            ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);

            $ldap_bind = ldap_bind($ldap_conn, $ldap_configuration['ldap_user'],$ldap_configuration['ldap_password']);
            if($ldap_bind){
                // dd($getFakultas->fakultas_name);
                $prodirecord['cn'] = $prodi->prodi_name;
                $prodirecord['objectclass'][0] = 'posixgroup';
                $prodirecord['objectclass'][1] = 'top';
                $prodirecord['gidnumber'] = $prodi->prodi_id;
                
                $prodi_dn = "cn=".$getFakultas->fakultas_name.","."cn=fakultas".",".$ldap_configuration['ldap_dn'];
                $base_dn = "cn=".$prodirecord['cn'].",".$prodi_dn;
                // dd($base_dn);
                $r = ldap_add($ldap_conn, $base_dn, $prodirecord);

                if($r){
                    $prodi->save();            
                    return redirect()->route('prodi.create')->with('success', 'Create prodi berhasil');
                }
                    return redirect()->route('prodi.create')->with('error', 'Tambah prodi gagal');
                // dd($base_dn);
            }
            //$prodi->save();            
        }    
        

        // $prodi->save();
        // if($prodi->save()){
            
        // }else{
        
        // }
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
        $a = 11;
        $query = DB::table('prodi')->select('*')->where('prodi_id', $id)->first();
        return view('prodi.edit', ['prodi'=>$query]);
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
        
        //ganti base dn pencarian
        $cari_base_dn = "cn=fakultas,".$ldap_configuration['ldap_dn'];
        
        //mencari cn dari prodi yang dihapus
        $getProdi = Prodi::where('prodi_id', $id)->first();
        $ldap_filter = $getProdi->prodi_name;
        // dd($ldap_filter);
        if($status == 1){

            $result = ldap_search($ldap_configuration['ldap_conn'], $ldap_configuration['ldap_dn'], "(cn=".$ldap_filter.")");
            $data = ldap_get_entries($ldap_configuration['ldap_conn'], $result);
            for($i = 0; $i<$data["count"]; $i++){
                $ldap_user_dn = $data[$i]["dn"];
            }
            // dd($ldap_user_dn);
            //hapus di ldapserver
            ldap_delete($ldap_conn, $ldap_user_dn);

            //hapus diDB
            $prodi = Prodi::where('prodi_id', $id);
            $prodi->delete();
            return redirect()->route('prodi.index')->with('success', 'User berhasil dihapus');
        }

    }

    public function getProdi(){
        // $prodi = DB::table('prodi')->select('*');
        $query = Prodi::orderBy('prodi_id','DESC');
        // dd($prodi);
        // return datatables()->of($prodi)->make(true);
        return datatables()->of($query)
            ->addColumn('action', function($data){
                return "
                    <a href=".route('prodi.edit',$data->prodi_id)." class='btn btn-info btn-sm'>Edit</a>
                    <form action=".route('prodi.destroy',$data->prodi_id)." class='d-inline' onsubmit=return confirm(Hapus User?) method=POST>
                        ".csrf_field()."
                        <input type='hidden' name='_method' value='DELETE'>
                        <input type='submit' value='Hapus' class='btn btn-danger btn-xsm'>
                    </form>
                ";
            })
            ->make(true);
    }
}
