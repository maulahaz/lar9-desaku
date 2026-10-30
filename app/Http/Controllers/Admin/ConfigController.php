<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
        
        $this->data['webTitle'] = env('APP_WEB_TITLE');
    }

    public function index()
    {
        $this->data['pageTitle'] = 'Konfigurasi Aplikasi';
        $this->data['configs'] = Config::all();
        return view('admin.konfigurasi.index', $this->data);
    }

    public function edit($id)
    {
        $config = Config::findOrFail($id);
        $this->data['pageTitle'] = 'Edit Konfigurasi';
        $this->data['config'] = $config;
        return view('admin.konfigurasi.edit', $this->data);
    }

    public function update(Request $request, $id)
    {
        $config = Config::findOrFail($id);

        if ($config->type === 'file') {
            $request->validate([
                'value' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($request->hasFile('value')) {
                $file = $request->file('value');
                $newName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('images'), $newName);

                $oldPath = public_path('images/' . $config->value);
                if ($config->value && file_exists($oldPath) && !in_array($config->value, ['logo.png', 'icon.png', 'noimage.jpg'])) {
                    @unlink($oldPath);
                }

                $config->value = $newName;
            }
        } else {
            $this->validate($request, [
                'value' => 'required',
            ]);

            $config->value = $request->value;
        }

        $config->save();

        return redirect()->route('admin.config')->with('success', 'Konfigurasi berhasil diperbarui.');
    }
}
