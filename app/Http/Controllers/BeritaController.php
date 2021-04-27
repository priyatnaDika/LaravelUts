<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $berita=Berita::with('genre')->latest()->paginate(10) ;
        $title="Daftar Berita";
        return view('admin.berandaberita',compact('title','berita'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title="Input berita";
        $genre= Genre::all();
        return view('admin.inputberita',compact('title', 'genre'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message=[
            'required'=> 'Kolom :attribute Harus lengkap',
            'date'=> 'Kolom :attribute Harus Tanggal',
            'numeric'=> 'Kolom :attribute Harus Angka'
        ];
        $validasi = $request->validate([
            'title'=>'required|unique:beritas|max:255',
            'genre_id'=>'required',
            'description'=>'required',
            'cover'=>'required|mimes:jpg,bmp,png|max:512'
        ],$message);
        //$filename = time().$request->file('cover')->getClientOriginalName();
        $path = $request->file('cover')->store('covers');
        $validasi['user_id']=Auth::id();
        $validasi['cover']=$path;
        Berita::create($validasi);
        return redirect('berita')->with('success','Data berhasil tersimpan');
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
        $genre=Genre::all();
        $berita=Berita::with('genre')->find($id);
        $title="Edit berita";
        return view('admin.inputberita',compact('title','berita','genre'));

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
        $message=[
            'required'=> 'Kolom :attribute Harus lengkap',
            'date'=> 'Kolom :attribute Harus Tanggal',
            'numeric'=> 'Kolom :attribute Harus Angka'
        ];
        $validasi = $request->validate([
            'title'=>'required|max:255',
            'genre_id'=>'required',
            'description'=>'required',
            
        ],$message);
        if($request->hasFile('cover')){
            $filename=time().$request->file('cover')->getClientOriginalName();
            $path = $request->file('cover')->storeAs('covers',$filename);
            $validasi['cover']=$path;
            $berita=Berita::find($id);
            Storage::delete($berita->cover);
        }
        $validasi['user_id']=Auth::id();
        Berita::where('id',$id)->update($validasi);
        return redirect('berita')->with('success','Data berhasil terupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $berita=Berita::find($id);
        if($berita != null){
            Storage::delete($berita->cover);
            $berita=Berita::find($berita->id);
            Berita::where('id',$id)->delete();
        }
        return redirect('berita')->with('success','Data berhasil terhapus');
    }



    public function cari(Request $request){

        $cari = $request->search;  

        $berita = Berita::where('title','like','%'.$cari.'%')->get();        
        return view('admin.berandaberita', ['berita' => $berita]);
    }
}