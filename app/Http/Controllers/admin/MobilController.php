<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MobilController extends Controller
{
    public function index()
    {
        $mobil = Mobil::latest()->paginate(10);
        return view('admin.mobil.index', compact('mobil'));
    }

    public function create()
    {
        return view('admin.mobil.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_mobil' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'tahun' => 'required|string|max:4',
            'plat_nomor' => 'required|string|max:15|unique:mobil',
            'harga_per_hari' => 'required|numeric|min:0',
            'status' => 'required|in:tersedia,disewa,maintenance',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('mobil', 'public');
        }

        Mobil::create($data);

        return redirect()->route('admin.mobil.index')
            ->with('success', 'Data mobil berhasil ditambahkan');
    }

    public function show(Mobil $mobil)
    {
        return view('admin.mobil.show', compact('mobil'));
    }

    public function edit(Mobil $mobil)
    {
        return view('admin.mobil.edit', compact('mobil'));
    }

    public function update(Request $request, Mobil $mobil)
    {
        $validator = Validator::make($request->all(), [
            'nama_mobil' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'tahun' => 'required|string|max:4',
            'plat_nomor' => 'required|string|max:15|unique:mobil,plat_nomor,' . $mobil->id,
            'harga_per_hari' => 'required|numeric|min:0',
            'status' => 'required|in:tersedia,disewa,maintenance',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($mobil->foto) {
                Storage::disk('public')->delete($mobil->foto);
            }
            $data['foto'] = $request->file('foto')->store('mobil', 'public');
        }

        $mobil->update($data);

        return redirect()->route('admin.mobil.index')
            ->with('success', 'Data mobil berhasil diperbarui');
    }

    public function destroy(Mobil $mobil)
    {
        if ($mobil->foto) {
            Storage::disk('public')->delete($mobil->foto);
        }

        $mobil->delete();

        return redirect()->route('admin.mobil.index')
            ->with('success', 'Data mobil berhasil dihapus');
    }
}
