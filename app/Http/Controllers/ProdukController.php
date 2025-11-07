<?php
// ...existing code...

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;

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

        \Log::info($request->all());

        $data = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|max:2048',
        ]);

        // Remove gambar from data if no new file was uploaded
        try {
            // Handle image upload separately
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                \Log::info('New image path: ' . $data['gambar']);

                // Validate file
                if ($file->isValid()) {
                    // Delete old image if exists
                    if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                        Storage::disk('public')->delete($produk->gambar);
                    }

                    // Store new image
                    $data['gambar'] = $file->store('product-images', 'public');

                    \Log::info('File uploaded: ' . $request->file('gambar')->getClientOriginalName());
                    \Log::info('Image path stored: ' . $data['gambar']);

                }
            }

            // Remove gambar from data if no new file
            if (!isset($data['gambar'])) {
                unset($data['gambar']);
            }

            $produk->update($data);

            return redirect()->route('product')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            \Log::info('No file uploaded.');
            return back()->withErrors(['error' => 'Error uploading image: ' . $e->getMessage()])->withInput();
        }
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
