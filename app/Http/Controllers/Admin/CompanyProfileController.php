<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function edit()
    {
        return view('admin.company.edit', [
            'profile' => CompanyProfile::first() ?? new CompanyProfile(),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name'      => ['required', 'string', 'max:150'],
            'tagline'   => ['nullable', 'string', 'max:255'],
            'about'     => ['nullable', 'string', 'max:5000'],
            'vision'    => ['nullable', 'string', 'max:2000'],
            'mission'   => ['nullable', 'string', 'max:3000'],
            'services'  => ['nullable', 'string', 'max:3000'],
            'address'   => ['nullable', 'string', 'max:255'],
            'email'     => ['nullable', 'email', 'max:150'],
            'phone'     => ['nullable', 'string', 'max:30'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'youtube'   => ['nullable', 'url', 'max:255'],
        ]);

        $profile = CompanyProfile::first() ?? new CompanyProfile();
        $profile->fill([
            'name'         => $data['name'],
            'tagline'      => $data['tagline'] ?? null,
            'about'        => $data['about'] ?? null,
            'vision'       => $data['vision'] ?? null,
            'mission'      => $data['mission'] ?? null,
            'services'     => $data['services'] ?? null,
            'address'      => $data['address'] ?? null,
            'email'        => $data['email'] ?? null,
            'phone'        => $data['phone'] ?? null,
            'social_links' => [
                'instagram' => $data['instagram'] ?? null,
                'youtube'   => $data['youtube'] ?? null,
            ],
        ])->save();

        return redirect()->route('admin.company.edit')
            ->with('success', 'Profil perusahaan berhasil disimpan.');
    }
}