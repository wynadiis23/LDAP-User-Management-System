<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fakultas;
use Illuminate\Support\Facades\DB;
use GH;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('fakultas.index');
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
        return view('fakultas.create', ['data'=>$query]);
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
        $getAll = Fakultas::all();
        $x = count($getAll);
        $newID = $getAll[$x-1]->fakultas_id + 1;
        // dd($getAll[$x-1]->fakultas_id);
        // dd($newID);
        $fakultas = new Fakultas;
        $fakultas->fakultas_name = $request->get('fakultas');
        $fakultas->fakultas_id = $newID;

        if (Fakultas::where('fakultas_name', '=', $request->get('fakultas'))->count() > 0) {
           // user found
            return redirect()->route('fakultas.create')->with('error', 'Tambah fakultas gagal, fakultas sudah ada');
        }
        else{
            $ldap_configuration = GH::config();
            $ldap_conn = ldap_connect($ldap_configuration['ldap_server']);
            ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);

            $ldap_bind = ldap_bind($ldap_conn, $ldap_configuration['ldap_user'],$ldap_configuration['ldap_password']);
            if($ldap_bind)
            {
                $gidnumber = $newID.'00';
                // dd($gidnumber);
                $fakultasrecord['cn'] = $fakultas->fakultas_name;
                $fakultasrecord['objectclass'][0] = 'posixgroup';
                $fakultasrecord['objectclass'][1] = 'top';
                $fakultasrecord['gidnumber'] = $gidnumber;

                $base_dn = "cn=".$fakultas->fakultas_name.","."cn=fakultas".",".$ldap_configuration['ldap_dn'];
                // dd($base_dn);

                $r = ldap_add($ldap_conn, $base_dn, $fakultasrecord);

                if($r)
                {
                    $fakultas->save();
                    return redirect()->route('fakultas.create')->with('success', 'Fakultas berhasil ditambahkan');
                }
                else
                {
                    return redirect()->route('fakultas.create')->with('error', 'Fakultas gagal ditambahkan');   
                }
            }
        }
        if($fakultas->save()){
            return redirect()->route('fakultas.create')->with('success', 'Tambah Fakultas Berhasil!!');
        }else{
            return redirect()->route('fakultas.create')->with('error', 'Tambah Fakultas Gagal!!');
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
        $query = DB::table('fakultas')->where('fakultas_id',$id)->first();
        return view('fakultas.edit', ['fakultas'=>$query]);
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
        if (Fakultas::where('fakultas_name', '=', $request->get('fakultas'))->count() > 0) {
           // user found
            return redirect()->route('fakultas.index')->with('error', 'Edit fakultas gagal, fakultas sudah ada');
        }
        else
        {
            $ldap_configuration = GH::config();
            $status = GH::loginToLdapServer();
            $ldap_conn = ldap_connect($ldap_configuration['ldap_server']);
            ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
            if($status == 1)
            {
                $ldap_bind = ldap_bind($ldap_conn, $ldap_configuration['ldap_user'], $ldap_configuration['ldap_password']);
                if($ldap_bind)
                {
                    $getNewFakultas = $request->get('fakultas');
                    $getFakultas = Fakultas::where('fakultas_id', $id)->first();
                    $ldap_fakultas_dn_old = "cn=".$getFakultas->fakultas_name.","."cn=fakultas".",".$ldap_configuration['ldap_dn'];
                    $ldap_fakultas_dn_update = "cn=".$getNewFakultas;

                    $result = ldap_rename($ldap_conn, $ldap_fakultas_dn_old, $ldap_fakultas_dn_update, NULL, TRUE);
                    if($result)
                    {
                        Fakultas::where('fakultas_id', $id)
                            ->update(['fakultas_name'=>$getNewFakultas]);
                        return redirect()->route('fakultas.index')->with('success', 'Data fakultas berhasil diupdate');
                    }
                    else
                    {
                        return redirect()->route('fakultas.index')->with('error', 'Data fakultas gagal diupdate');
                    }
                }

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
        echo $id;
        $fakultas = Fakultas::where('fakultas_id', $id);
        
        if($fakultas->delete()){
            return redirect()->route('fakultas.index')->with('success', 'Hapus fakultas berhasil');
        }
        else{
            return redirect()->route('fakultas.index')->with('success', 'Hapus fakultas gagal');   
        }
        
    }
    public function getFakultas()
    {
        // $prodi = DB::table('prodi')->select('*');
        $query = Fakultas::orderBy('fakultas_id','DESC');
        // dd($prodi);
        // return datatables()->of($prodi)->make(true);
        return datatables()->of($query)
            ->addColumn('action', function($data){
                return "
                    <a href=".route('fakultas.edit',$data->fakultas_id)." class='btn btn-info btn-sm'>Edit</a>
                    <form action=".route('fakultas.destroy',$data->fakultas_id)." class='d-inline' onsubmit=return confirm(Hapus User?) method=POST>
                        ".csrf_field()."
                        <input type='hidden' name='_method' value='DELETE'>
                        <input type='submit' value='Hapus' class='btn btn-danger btn-xsm'>
                    </form>
                ";
            })
            ->make(true);
    }


}
