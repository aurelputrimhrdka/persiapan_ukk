<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use DB;

class BarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        $rsetBarangKeluar = BarangKeluar::with('barang')->latest()->paginate(10);
        return view('vbarangkeluar.index', compact('rsetBarangKeluar'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    
    public function create()
    {
        $abarangkeluar = Barang::all();
        return view('vbarangkeluar.create',compact('abarangkeluar'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'tgl_keluar'     => 'required',
            'qty_keluar'     => 'required',
            'barang_id'     => 'required',
        ]);

        $barang = Barang::find($request->barang_id);

        //Validasi jika jumlah qty_keluar lebih besar dari stok saat itu maka muncul pesan eror
        if ($request->qty_keluar > $barang->stok) {
            return redirect()->back()->withInput()->withErrors(['qty_keluar' => 'Jumlah barang keluar melebihi stok!']);
        }
        

        //create post
        BarangKeluar::create([
            'tgl_keluar'        => $request->tgl_keluar,
            'qty_keluar'        => $request->qty_keluar,
            'barang_id'        => $request->barang_id,
        ]);
        

        return redirect()->route('vbarangkeluar.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    public function show($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);
        return view('vbarangkeluar.show', compact('barangKeluar'));
    }
    public function edit($id)
    {
        // Find the BarangKeluar record by ID
        $barangKeluar = BarangKeluar::findOrFail($id);

        // Fetch all available barang for the dropdown
        $abarangkeluar = Barang::all();

        // Return the edit view with the data
        return view('vbarangkeluar.edit', compact('barangKeluar', 'abarangkeluar'));
    }

    public function update(Request $request, $id)
{
    $this->validate($request, [
        'tgl_keluar' => 'required',
        'qty_keluar' => 'required|numeric|min:1',
        'barang_id'  => 'required|exists:barang,id',
    ]);

    $barang = Barang::find($request->barang_id);

        //Validasi jika jumlah qty_keluar lebih besar dari stok saat itu maka muncul pesan eror
        if ($request->qty_keluar > $barang->stok) {
            return redirect()->back()->withInput()->withErrors(['qty_keluar' => 'Jumlah barang keluar melebihi stok!']);
        }
        

    // Find the BarangKeluar record by ID
    $barangKeluar = BarangKeluar::findOrFail($id);

    // Update the record with the new values
    $barangKeluar->update([
        'tgl_keluar' => $request->tgl_keluar,
        'qty_keluar' => $request->qty_keluar,
        'barang_id'  => $request->barang_id,
    ]);

    // Redirect to the index page with a success message
    return redirect()->route('vbarangkeluar.index')->with(['success' => 'Data Berhasil Diubah!']);
}
    

    //delete record di tambel barangkeluar tanpa memengaruhi stok di tabel barang
    public function destroy($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);
        $barangKeluar->delete();

        return redirect()->route('vbarangkeluar.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}
