<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Auth;
use Hash;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);

        $this->data['webTitle'] = env('APP_WEB_TITLE') ?: config('app.name');
    }

    public function dashboard()
    {
        $this->data['pageTitle'] = 'Dashboard';

        $this->data['jumlahPenduduk'] = DB::table('tbl_penduduk')->count();
        $this->data['jumlahKeluarga'] = DB::table('tbl_keluarga')->count();
        $this->data['jumlahKelahiran'] = DB::table('kelahirans')->count();
        $this->data['jumlahKematian'] = DB::table('kematians')->count();
        $this->data['jumlahPerpindahan'] = DB::table('perpindahans')->count();

        $pemasukan = DB::table('keuangans')->where('jenis', 'Pemasukan')->sum('jumlah');
        $pengeluaran = DB::table('keuangans')->where('jenis', 'Pengeluaran')->sum('jumlah');
        $this->data['totalPemasukan'] = $pemasukan;
        $this->data['totalPengeluaran'] = $pengeluaran;
        $this->data['saldo'] = $pemasukan - $pengeluaran;

        $this->data['pendudukTerbaru'] = DB::table('penduduks')->orderByDesc('created_at')->limit(5)->get();

        $this->data['canManage'] = in_array((int) Auth::user()->role_id, [1, 2, 88, 99], true);

        return view('account.v_dashboard', $this->data);
    }

    public function profile()
    {
        $idUser = Auth::user()->getAuthIdentifier();
        $dtUser = User::findOrFail($idUser);
        $this->data['dtUser'] = $dtUser;
        $this->data['pageTitle'] = 'Profil Pengguna';

        return view('account.v_profile', $this->data);
    }

    public function update(Request $request, $id)
    {
        //--Hanya boleh mengubah data akun sendiri.
        $id = Auth::user()->getAuthIdentifier();

        $this->validate($request, [
            'nama' => 'required|max:50',
            'no_telepon' => 'nullable|max:20',
        ]);

        $postedData = [
            'nama' => $request->nama,
            'no_telepon' => $request->no_telepon ?: '',
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $dtUser = User::findOrFail($id);
        if ($dtUser->update($postedData)) {
            return redirect('account/profile')->with('success', 'Well done, Data has been updated.');
        }

        return redirect()->back()->with('error', 'Error during update. Please contact Administrator');
    }

    public function changepass(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'old_pwd' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if (!Hash::check($value, Auth::user()->getAuthPassword())) {
                            $fail('Password lama tidak sesuai');
                        }
                    },
                ],
                'password' => 'required|confirmed|min:6|different:old_pwd',
            ]);

            $postedData = [
                'password' => Hash::make($request->password),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $idUser = Auth::user()->getAuthIdentifier();
            $dtUser = User::findOrFail($idUser);
            if ($dtUser->update($postedData)) {
                return redirect('account/profile')->with('success', 'Well done, Password has been changed.');
            }

            return redirect()->back()->with('error', 'Error during change password. Please contact Administrator');
        }

        $this->data['pageTitle'] = 'Rubah Password';
        return view('account.v_changepass', $this->data);
    }

    public function uploadFile(Request $request, $id)
    {
        //--Hanya boleh mengganti foto akun sendiri.
        $id = Auth::user()->getAuthIdentifier();

        $this->validate($request, [
            'foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($request->has('foto')) {
            $image = $request->file('foto');
            $newImage = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('uploads/user'), $newImage);

            $dtUser = User::findOrFail($id);
            if ($dtUser->update(['foto' => $newImage])) {
                return redirect()->back()->with('success', 'File gambar berhasil diupload.');
            }

            return redirect()->back()->with('error', 'Error pada saat upload file gambar.');
        }

        return redirect()->back()->with('error', 'Tidak ada file yang diupload.');
    }

    public function removeFile($id)
    {
        //--Hanya boleh menghapus foto akun sendiri.
        $id = Auth::user()->getAuthIdentifier();

        $dtUser = User::findOrFail($id);
        $foto = $dtUser->foto;
        $file_path = public_path() . '/uploads/user/' . $foto;

        if ($dtUser->update(['foto' => ''])) {
            if ($foto && file_exists($file_path)) {
                unlink($file_path);
            }
            return redirect()->back()->with('success', 'File gambar berhasil di hapus.');
        }

        return redirect()->back()->with('error', 'Error pada saat hapus file gambar.');
    }
}
