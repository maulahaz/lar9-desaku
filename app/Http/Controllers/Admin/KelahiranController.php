<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelahiran;

class KelahiranController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->data['webTitle'] = env('APP_WEB_TITLE');
    }

    public function index(Request $request)
    {
        $this->data['pageTitle'] = 'Data Kelahiran';
        if ($request->has('reset')) {
            return redirect()->route('admin.kelahiran.index');
        }

        $sort = $request->input('sort', 'tanggal_lahir');
        $direction = $request->input('direction', 'desc');
        $query = Kelahiran::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('nama', 'LIKE', "%{$searchTerm}%")
                ->orWhere('ayah', 'LIKE', "%{$searchTerm}%")
                ->orWhere('ibu', 'LIKE', "%{$searchTerm}%");
        }

        $kelahirans = $query->orderBy($sort, $direction)->paginate(20);
        $this->data['kelahirans'] = $kelahirans;
        $this->data['sort'] = $sort;
        $this->data['direction'] = $direction;
        $this->data['search'] = $request->input('search', '');

        return view('admin.kelahiran.index', $this->data);
    }

    public function create()
    {
        $this->data['pageTitle'] = 'Tambah Data Kelahiran';
        $this->data['kelahiran'] = new Kelahiran();
        return view('admin.kelahiran.form', $this->data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|date',
            'jam_lahir' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'panjang' => 'required|numeric',
            'berat' => 'required|numeric',
            'ayah' => 'required|max:255',
            'ibu' => 'required|max:255',
            'anak_ke' => 'required|integer',
            'jenis_kelahiran' => 'required',
            'penolong_kelahiran' => 'required',
        ]);

        Kelahiran::create($validatedData);

        return redirect()->route('admin.kelahiran.index')->with('success', 'Data kelahiran berhasil ditambahkan.');
    }

    public function edit(Kelahiran $kelahiran)
    {
        $this->data['pageTitle'] = 'Edit Data Kelahiran';
        $this->data['kelahiran'] = $kelahiran;
        return view('admin.kelahiran.form', $this->data);
    }

    public function update(Request $request, Kelahiran $kelahiran)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|date',
            'jam_lahir' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'panjang' => 'required|numeric',
            'berat' => 'required|numeric',
            'ayah' => 'required|max:255',
            'ibu' => 'required|max:255',
            'anak_ke' => 'required|integer',
            'jenis_kelahiran' => 'required',
            'penolong_kelahiran' => 'required',
        ]);

        $kelahiran->update($validatedData);

        return redirect()->route('admin.kelahiran.index')->with('success', 'Data kelahiran berhasil diperbarui.');
    }

    public function show(Kelahiran $kelahiran)
    {
        $this->data['pageTitle'] = 'Detail Kelahiran';
        $this->data['kelahiran'] = $kelahiran;
        return view('admin.kelahiran.show', $this->data);
    }

    public function destroy(Kelahiran $kelahiran)
    {
        $kelahiran->delete();
        return redirect()->route('admin.kelahiran.index')->with('success', 'Data kelahiran berhasil dihapus.');
    }
}