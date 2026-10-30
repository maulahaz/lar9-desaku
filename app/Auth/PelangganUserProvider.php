<?php

namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;

class PelangganUserProvider extends EloquentUserProvider
{
    /**
     * Look the user up by the app's legacy username column (nama_pengguna)
     * or by NIK, ignoring the password key.
     */
    public function retrieveByCredentials(array $credentials)
    {
        $credentials = array_filter(
            $credentials,
            fn ($key) => ! str_contains($key, 'password'),
            ARRAY_FILTER_USE_KEY
        );

        if (empty($credentials)) {
            return null;
        }

        $query = $this->createModel()->newQuery();

        $username = $credentials['username'] ?? null;

        if ($username !== null) {
            $query->where(function ($q) use ($username) {
                $q->where('nama_pengguna', $username)
                  ->orWhere('nik', $username);
            });
        }

        foreach ($credentials as $key => $value) {
            if ($key === 'username') {
                continue;
            }
            $query->where($key, $value);
        }

        return $query->first();
    }
}