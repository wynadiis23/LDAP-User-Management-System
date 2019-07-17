<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra;
use Illuminate\Support\Facades\DB;
use App\Prodi;
use App\Fakultas;

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
            $prodi->save();            
            return redirect()->route('prodi.create')->with('success', 'Tambah prodi berhasil');
        }    
        

        // $prodi->save();
        // if($prodi->save()){
            
        // }else{
        //     return redirect()->route('prodi.create')->with('error', 'Tambah prodi gagal');
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

        echo $id;
        $prodi = Prodi::where('prodi_id', $id);
        $prodi->delete();

        return redirect()->route('prodi.index')->with('success', 'Hapus prodi berhasil');

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
