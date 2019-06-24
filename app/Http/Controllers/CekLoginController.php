<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CekLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $ldap_server = $request->get('server');
        $ldap_dn = $request->get('cn');
        $ldap_password = $request->get('password');

        // $newPassword = '"' . $ldap_password . '"';
        // $newPass = iconv( 'UTF-8', 'UTF-16LE', $newPassword );
        // $ldaprecord["unicodepwd"] = $newPass;
        // dd($ldap_password);

        $ldap_conn = ldap_connect($ldap_server);
        ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);

        if(ldap_bind($ldap_conn, $ldap_dn, $ldap_password)){
            return redirect()->route('home.index',['server'=>$ldap_server, 'dn'=>$ldap_dn])->with('success', 'Bind Berhasil');
        }else{
            return view('auth.login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }
}
