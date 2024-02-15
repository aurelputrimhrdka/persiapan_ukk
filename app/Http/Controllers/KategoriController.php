<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $rsetKategori = Kategori::all();
        return view('vkategori.index',compact('rsetKategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vkategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kategori'              => 'required',
            'jenis'              => 'required'
        ]);
        //upload image
        // $foto = $request->file('foto');
        // $foto->storeAs('public/foto', $foto->hashName());
        //create post
        Kategori::create([
            'kategori'              => $request->kategori,
            'jenis'              => $request->jenis
        ]);

        //redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsetKategori = Kategori::find($id);
        return view('vkategori.show', compact('rsetKategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $akategori = array(
        'blank' => 'Pilih Kategori',
        'M' => 'M',
        'A' => 'A',
        'BHP' => 'BHP',
        'BTHP' => 'BTHP'
    );

    $rsetKategori = Kategori::find($id);
    return view('vkategori.edit', compact('rsetKategori', 'akategori'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $this->validate($request, [
        'kategori' => 'required',
        'jenis' => 'required',
    ]);

    $rsetKategori = Kategori::find($id);

    $rsetKategori->update([
        'kategori' => $request->kategori,
        'jenis' => $request->jenis,
        // other fields...
    ]);

    return redirect()->route('kategori.index')->with(['success' => 'Data Kategori Berhasil Diubah!']);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $rsetKategori = Kategori::find($id);

    // Check if there are related items (barang)
    if ($rsetKategori->barang()->exists()) {
        return redirect()->route('kategori.index')->with(['error' => 'Kategori tidak dapat dihapus karena masih memiliki barang terkait.']);
    }

    // Jika tidak ada barang terkait, lakukan penghapusan
    $rsetKategori->delete();

    return redirect()->route('kategori.index')->with(['success' => 'Data Kategori Berhasil Dihapus.']);
}
}
