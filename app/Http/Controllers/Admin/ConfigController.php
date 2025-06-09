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
        $this->validate($request, [
            'value' => 'required',
        ]);

        $config->value = $request->value;
        $config->save();

        return redirect()->route('admin.config.index')->with('success', 'Konfigurasi berhasil diperbarui.');
    }
}
