<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fakultas;

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
        $fakultas = new Fakultas;
        $fakultas->fakultas_name = $request->get('fakultas');

        $fakultas->save();

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
