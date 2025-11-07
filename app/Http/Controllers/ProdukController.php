<?php
// ...existing code...

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    // ...existing code...

    public function show()
    {
        $produk = Produk::all();
        return view('product', compact('produk'));
    }

    public function showdetail()
    {
        $produk = Produk::all();
        return view('detail-product', compact('produk'));
    }

    // show create form
    public function create()
    {
        return view('produk.create');
    }

    // store new product
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');

            // ensure uploaded file is valid before storing
            if ($file && $file->isValid()) {
                $path = $file->store('product-image', 'public');
                $data['gambar'] = $path;
            } else {
                return back()->withErrors(['gambar' => 'Uploaded image is invalid.'])->withInput();
            }
        }

        Produk::create($data);

        return redirect()->route('product')->with('success', 'Product created.');
    }
    // optional edit page (not required by modal, but kept)
    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    // update product (handles file replace)
    public function update(Request $request, Produk $produk)
    {
        $data = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|max:5120',
        ]);

        // handle image manually to avoid FilesystemAdapter fopen('') issue
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');

            if ($file && $file->isValid() && $file->getRealPath()) {
                // delete old image if exists
                if (!empty($produk->gambar) && Storage::disk('public')->exists($produk->gambar)) {
                    Storage::disk('public')->delete($produk->gambar);
                }

                // ensure destination folder exists
                $dest = storage_path('app/public/product-images');
                if (!is_dir($dest)) {
                    mkdir($dest, 0755, true);
                }

                $filename = time() . '_' . \Illuminate\Support\Str::random(8) . '.' . $file->getClientOriginalExtension();
                $file->move($dest, $filename);

                // store relative path used with asset('storage/...')
                $data['gambar'] = 'product-images/' . $filename;
            } else {
                return back()->withErrors(['gambar' => 'Uploaded image is invalid or temporary file missing.'])->withInput();
            }
        } else {
            // keep existing image path when no new file uploaded
            $data['gambar'] = $produk->gambar;
        }

        $produk->update($data);

        return redirect()->route('product')->with('success', 'Product updated.');
    }
    public function destroy(Produk $produk)
    {
        $existing = (string) $produk->gambar;
        if (trim($existing) !== '' && Storage::disk('public')->exists($existing)) {
            Storage::disk('public')->delete($existing);
        }

        $produk->delete();

        return redirect()->route('product')->with('success', 'Product deleted.');
    }
}
