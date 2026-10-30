<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);

        $this->data['webTitle'] = env('APP_WEB_TITLE') ?: config('app.name');
    }

    public function index(Request $request)
    {
        $this->data['pageTitle'] = 'List Data Pengguna';

        $query = User::whereNotIn('role_id', [88, 99]);

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama_pengguna', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('nama', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('nik', 'LIKE', "%{$searchTerm}%");
            });
        }

        //--Only allow sorting on real columns:
        $allowedSorts = ['nama_pengguna', 'nama', 'role_id', 'is_delete', 'created_at'];
        $sort = $request->input('sort', 'created_at');
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }
        $direction = $request->input('direction') === 'asc' ? 'asc' : 'desc';
        $query->orderBy($sort, $direction);

        $this->data['dtUser'] = $query->paginate(10)->withQueryString();
        $this->data['sort'] = $sort;
        $this->data['direction'] = $direction;

        return view('admin.user.v_index', $this->data);
    }

    public function create()
    {
        $this->data['dtUser'] = null;
        $this->data['pageTitle'] = 'Tambah Data Pengguna';

        return view('admin.user.v_form', $this->data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|max:20|unique:tbl_pengguna,nik',
            'nama' => 'required|max:50',
            'nama_pengguna' => 'required|min:4|max:50|unique:tbl_pengguna,nama_pengguna',
            'no_telepon' => 'nullable|max:20',
            'role_id' => 'required|integer',
            'password' => 'required|min:6|confirmed',
        ]);

        $roleName = $this->roleName((int) $validated['role_id']);

        User::create([
            'nik' => $validated['nik'],
            'nama' => $validated['nama'],
            'nama_pengguna' => $validated['nama_pengguna'],
            'no_telepon' => $validated['no_telepon'] ?: '',
            'role' => $roleName,
            'role_id' => (int) $validated['role_id'],
            'password' => Hash::make($validated['password']),
            'foto' => '',
            'is_delete' => 'N',
        ]);

        return redirect('admin/user')->with('success', 'Data pengguna berhasil ditambahkan.');
    }

    public function show($id)
    {
        $dtUser = User::findOrFail($id);
        $this->data['dtUser'] = $dtUser;
        $this->data['updateID'] = $id;
        $this->data['pageTitle'] = 'Detail Data Pengguna : "' . $dtUser->nama_pengguna . '"';
        return view('admin.user.v_show', $this->data);
    }

    public function edit($id)
    {
        $dtUser = User::findOrFail($id);
        $this->data['dtUser'] = $dtUser;
        $this->data['updateID'] = $id;
        $this->data['pageTitle'] = 'Update Data Pengguna : "' . $dtUser->nama_pengguna . '"';
        return view('admin.user.v_form', $this->data);
    }

    public function update(Request $request, $id)
    {
        $dtUser = User::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|max:50',
            'nama_pengguna' => 'required|min:4|max:50|unique:tbl_pengguna,nama_pengguna,' . $dtUser->id_pengguna . ',id_pengguna',
            'no_telepon' => 'nullable|max:20',
            'role_id' => 'required|integer',
        ]);

        $validated['role'] = $this->roleName((int) $validated['role_id']);
        $validated['no_telepon'] = $validated['no_telepon'] ?: '';
        $validated['updated_at'] = date('Y-m-d H:i:s');

        if ($dtUser->update($validated)) {
            return redirect('admin/user')->with('success', 'Data berhasil diupdate.');
        }

        return redirect()->back()->with('error', 'Error pada saat update data.');
    }

    public function updateStatusUser(Request $request)
    {
        if (!$request->ajax()) {
            abort(400);
        }

        $dtUser = User::find($request->user_id);
        if (!$dtUser) {
            return response()->json(['error' => 'User tidak ditemukan'], 404);
        }

        $newValue = $dtUser->is_delete === 'Y' ? 'N' : 'Y';
        $dtUser->is_delete = $newValue;
        $dtUser->save();

        return response()->json([
            'status' => $newValue === 'N' ? 'Active' : 'Inactive',
            'user_id' => $request->user_id,
        ]);
    }

    public function destroy($id)
    {
        $dtUser = User::findOrFail($id);
        //--Soft delete: keep the record but mark it inactive.
        $dtUser->update(['is_delete' => 'Y']);
        Session::flash('success', 'Data pengguna telah dinonaktifkan.');

        return redirect('admin/user');
    }

    public function hapus($id)
    {
        return $this->destroy($id);
    }

    public function resetPassword($id)
    {
        $dtUser = User::findOrFail($id);
        $dtUser->update([
            'password' => Hash::make('pass123'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect('admin/user')->with('success', 'Password pengguna direset menjadi "pass123".');
    }

    private function roleName(int $roleId): string
    {
        return [
            1 => 'Staf',
            2 => 'Supervisor',
            3 => 'Warga',
            5 => 'Administrator',
            88 => 'Administrator',
            99 => 'Webmaster',
        ][$roleId] ?? 'Pengguna';
    }
}
