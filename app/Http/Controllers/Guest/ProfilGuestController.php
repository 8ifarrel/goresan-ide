<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilGuestController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $page_title = 'Profil Saya';
        $page_description = 'Edit profil pengguna';
        $page_meta_description = 'Edit profil pengguna';

        return view('guest.pages.profil.edit', compact('user', 'page_title', 'page_description', 'page_meta_description'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Jika request untuk ubah password
        if ($request->has('change_password')) {
            $data = $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ], [
                'old_password.required' => 'Password lama wajib diisi.',
                'new_password.required' => 'Password baru wajib diisi.',
                'new_password.min' => 'Password baru minimal 8 karakter.',
                'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            ]);

            if (!\Hash::check($data['old_password'], $user->password)) {
                return back()->withErrors(['old_password' => 'Password lama salah.'])->withInput();
            }

            $user->password = \Hash::make($data['new_password']);
            $user->save();

            return redirect()->route('guest.profil.edit')->with('success', 'Password berhasil diubah.');
        }

        $data = $request->validate([
            'fullname' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'about' => 'nullable|string|max:120',
            'profile_picture' => 'nullable|image|max:2048',
        ], [
            'fullname.required' => 'Nama lengkap wajib diisi.',
            'fullname.max' => 'Nama lengkap maksimal 100 karakter.',
            'username.required' => 'Username wajib diisi.',
            'username.max' => 'Username maksimal 50 karakter.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'email.unique' => 'Email sudah terdaftar.',
            'about.max' => 'Tentang maksimal 120 karakter.',
            'profile_picture.image' => 'Foto profil harus berupa gambar.',
            'profile_picture.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama jika ada
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $file = $request->file('profile_picture');
            $path = "users/{$user->id}/profile-picture/{$user->id}." . $file->getClientOriginalExtension();
            Storage::disk('public')->put($path, file_get_contents($file));
            $data['profile_picture'] = $path;
        }

        $user->update($data);

        return redirect()->route('guest.profil.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
