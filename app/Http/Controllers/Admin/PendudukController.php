<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penduduk;

class PendudukController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);

        $this->data['webTitle'] = env('APP_WEB_TITLE');
        // $this->data['currentMenu'] = 'Admin';
        // $this->data['currentSubMenu'] = 'Materi';
    }

    public function index(Request $request)
    {
        $this->data['pageTitle'] = 'Data Penduduk';
        //--Check if reset action is requested:
        if ($request->has('reset')) {
            return redirect()->route('admin.penduduk.index');
        }

        //--Sorting:
        $sort = $request->input('sort', 'nama');
        $direction = $request->input('direction', 'asc');
        $query = Penduduk::query();
        //--Filtering:
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('nama', 'LIKE', "%{$searchTerm}%")
                ->orWhere('nik', 'LIKE', "%{$searchTerm}%")
                ->orWhere('pendidikan', 'LIKE', "%{$searchTerm}%")
                ->orWhere('profesi', 'LIKE', "%{$searchTerm}%");
        }
        //--Apply sorting and pagination:
        $penduduks = $query->orderBy($sort, $direction)->paginate(20);
        //--Prepare data for the view:
        $this->data['penduduks'] = $penduduks;
        $this->data['sort'] = $sort;
        $this->data['direction'] =  $direction;
        $this->data['search'] = $request->input('search', '');

        return view('admin.penduduk.index', $this->data);
    }

    public function create()
    {
        $this->data['pageTitle'] = 'Tambah Data Penduduk';
        $this->data['penduduk'] = new Penduduk(['nik' => $this->generateNIK()]);

        return view('admin.penduduk.form', $this->data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required|unique:penduduks|max:16',
            'nama' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required',
        ]);

        Penduduk::create($validatedData);

        return redirect()->route('admin.penduduk.index')->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    public function edit(Penduduk $penduduk)
    {
        // return view('admin.penduduk.edit', compact('penduduk'));
        $this->data['pageTitle'] = 'Edit Data Penduduk';
        $this->data['penduduk'] = $penduduk;
        return view('admin.penduduk.form', $this->data);
    }

    public function update(Request $request, Penduduk $penduduk)
    {
        $validatedData = $request->validate([
            'nik' => 'required|max:16|unique:penduduks,nik,' . $penduduk->id,
            'nama' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required',
        ]);

        $penduduk->update($validatedData);

        return redirect()->route('admin.penduduk.index')->with('success', 'Data penduduk berhasil diperbarui.');
    }

    public function show(Penduduk $penduduk)
    {
        $this->data['pageTitle'] = 'Data Penduduk';
        $this->data['penduduk'] = $penduduk;
        return view('admin.penduduk.show', $this->data);
    }

    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();

        return redirect()->route('admin.penduduk.index')->with('success', 'Data penduduk berhasil dihapus.');
    }

    private function generateNIK()
    {
        do {
            $nik = '';
            for ($i = 0; $i < 16; $i++) {
                $nik .= mt_rand(0, 9);
            }
        } while (Penduduk::where('nik', $nik)->exists());

        return $nik;
    }
}
