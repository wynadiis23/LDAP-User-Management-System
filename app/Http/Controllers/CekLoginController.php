<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GH;

class CekLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginView(){
        $ldap_configuration = GH::config();

        return view('auth.login', ['ldap_configuration'=>$ldap_configuration]);
    }

    public function index(Request $request)
    {
        $ldap_configuration = GH::config();
        $ldap_server = $ldap_configuration['ldap_server'];
        $status = GH::loginToLdapServer();
        if($status == 1){
            return redirect()->route('home.index')->with('success', 'Bind Berhasil');
        }else{
            return redirect()->route('login')->with('error', 'Invalid Credentials');
        }


        // $ldap_conn = ldap_connect($ldap_server);
        // ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);

        // if(ldap_bind($ldap_conn, $ldap_dn, $ldap_password)){
        //     return redirect()->route('home.index',['server'=>$ldap_server, 'dn'=>$ldap_dn])->with('success', 'Bind Berhasil');
        // }else{
        //     return view('auth.login');
        // }
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
