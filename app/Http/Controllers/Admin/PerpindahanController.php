<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perpindahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerpindahanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);

        $this->data['webTitle'] = env('APP_WEB_TITLE');
        // $this->data['currentMenu'] = 'Admin';
        // $this->data['currentSubMenu'] = 'Materi';
    }

    protected $data = [
        'pageTitle' => 'Data Perpindahan'
    ];

    public function index(Request $request)
    {
        $query = Perpindahan::query();

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nik', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('nama', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('alamat_asal', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('alamat_tujuan', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Sorting
        $sort = $request->input('sort', 'tanggal_perpindahan');
        $direction = $request->input('direction', 'desc');
        $query->orderBy($sort, $direction);

        $perpindahans = $query->paginate(10);

        $this->data['perpindahans'] = $perpindahans;
        $this->data['sort'] = $sort;
        $this->data['direction'] = $direction;

        return view('admin.perpindahan.index', $this->data);
    }

    public function create()
    {
        $this->data['pageTitle'] = 'Tambah Data Perpindahan';
        return view('admin.perpindahan.form', $this->data);
    }

    public function store(Request $request)
    {
        $validatedData = $this->validatePerpindahan($request);
        $validatedData['created_by'] = Auth::id();

        Perpindahan::create($validatedData);

        return redirect()->route('admin.perpindahan.index')->with('success', 'Data perpindahan berhasil ditambahkan.');
    }

    public function show(Perpindahan $perpindahan)
    {
        $this->data['pageTitle'] = 'Detail Perpindahan';
        $this->data['perpindahan'] = $perpindahan;
        return view('admin.perpindahan.show', $this->data);
    }

    public function edit(Perpindahan $perpindahan)
    {
        $this->data['pageTitle'] = 'Edit Data Perpindahan';
        $this->data['perpindahan'] = $perpindahan;
        return view('admin.perpindahan.form', $this->data);
    }

    public function update(Request $request, Perpindahan $perpindahan)
    {
        $validatedData = $this->validatePerpindahan($request);
        $validatedData['updated_by'] = Auth::id();

        $perpindahan->update($validatedData);

        return redirect()->route('admin.perpindahan.index')->with('success', 'Data perpindahan berhasil diperbarui.');
    }

    public function destroy(Perpindahan $perpindahan)
    {
        $perpindahan->delete();

        return redirect()->route('admin.perpindahan.index')->with('success', 'Data perpindahan berhasil dihapus.');
    }

    protected function validatePerpindahan(Request $request)
    {
        return $request->validate([
            'nik' => 'required|string|max:16',
            'nama' => 'required|string|max:255',
            'alamat_asal' => 'required|string',
            'alamat_tujuan' => 'required|string',
            'tanggal_perpindahan' => 'required|date',
            'jenis_perpindahan' => 'required|string|max:255',
            'sebab_perpindahan' => 'required|string|max:255'
        ]);
    }
}