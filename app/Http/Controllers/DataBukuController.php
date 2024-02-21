<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use PDF;

class DataBukuController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $buku = Buku::query()
                ->where('judul', 'LIKE', "%{$query}%")
                ->orWhere('penulis', 'LIKE', "%{$query}%")
                ->orWhere('penerbit', 'LIKE', "%{$query}%")
                ->orWhere('tahun_terbit', 'LIKE', "%{$query}%")
                ->orWhereHas('kategoriBukuRelasi', function($q) use ($query) {
                    $q->whereHas('kategori', function($subQuery) use ($query) {
                        $subQuery->where('nama_kategori', 'LIKE', "%{$query}%");
                    });
                })
                ->get();
        }

        $buku = Buku::all();
        return view('admin.buku', compact('buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'foto' => 'image|nullable|mimes:png,jpg,gif|max:2048',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required',
        ]);

        if($request->has('foto')){

            $file = $request->file('foto');
            $extension = $file->getClientOriginalName();

            $filename = $extension;

            $path = 'img/';
            $file->move($path, $filename);
        }

        $post=Buku::create([
            'judul' => $request->judul,
            'foto' => $path.$filename,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'stok'     => $request->stok,
        ]);

        if ($post) {
            return redirect()
                ->back()
                ->with([
                    'success'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error'
                ]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'foto' => 'image|nullable|mimes:png,jpg,gif|max:2048',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required',
        ]);

        $buku = Buku::findOrFail($id);

        if ($request->has('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalName();
            $filename = $extension;
            $path = 'img/';
            $file->move($path, $filename);

            if ($buku->foto) {
                unlink(public_path($buku->foto));
            }

            $buku->update([
                'judul' => $request->judul,
                'foto' => $path.$filename,
                'penulis' => $request->penulis,
                'penerbit' => $request->penerbit,
                'tahun_terbit' => $request->tahun_terbit,
                'stok' => $request->stok,
            ]);
        } else {
            $buku->update([
                'judul' => $request->judul,
                'penulis' => $request->penulis,
                'penerbit' => $request->penerbit,
                'tahun_terbit' => $request->tahun_terbit,
                'stok' => $request->stok,
            ]);
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);

        if ($buku->foto) {
            unlink(public_path($buku->foto));
        }

        $buku->delete();

        return redirect()->back();
    }

    public function bukuPDF()
    {
        $no=1;
        $buku = Buku::all();
        $pdf = PDF::loadView('admin.pdf.buku', compact('buku','no'));
        return $pdf->stream('Data Buku ' . now()->format('d-m-Y'));
    }
}
