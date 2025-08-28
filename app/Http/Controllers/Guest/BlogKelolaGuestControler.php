<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategoryMaster;
use App\Models\BlogCategory;
use App\Models\BlogImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogKelolaGuestControler extends Controller
{
    public function index(Request $request)
    {
        $page_title = 'Blog Saya';
        $page_description = 'Daftar blog yang Anda tulis.';
        $page_meta_description = 'Kelola blog pribadi Anda di Goresan Ide.';

        $blogs = Blog::with(['primaryImage', 'categories.master'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('guest.pages.blog.kelola.index', compact(
            'blogs',
            'page_title',
            'page_description',
            'page_meta_description'
        ));
    }

    public function create()
    {
        $page_title = 'Buat Blog';
        $page_description = 'Tulis blog baru dan bagikan inspirasimu.';
        $page_meta_description = 'Formulir pembuatan blog baru di Goresan Ide.';

        $categories = BlogCategoryMaster::all();
        return view('guest.pages.blog.kelola.create', compact(
            'categories',
            'page_title',
            'page_description',
            'page_meta_description'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255|unique:blogs,title',
            'summary' => 'required|string|max:155',
            'body' => 'required|string',
            'read_duration' => 'required|integer|min:1|max:60',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:blog_categories_master,id',
            'primary_image' => 'required|image|max:2048',
            'images.*' => 'nullable|image|max:2048',
        ], [
            'title.required' => 'Judul wajib diisi.',
            'title.string' => 'Judul harus berupa teks.',
            'title.max' => 'Judul maksimal 255 karakter.',
            'title.unique' => 'Judul sudah digunakan.',
            'summary.required' => 'Ringkasan wajib diisi.',
            'summary.string' => 'Ringkasan harus berupa teks.',
            'summary.max' => 'Ringkasan maksimal 155 karakter.',
            'body.required' => 'Isi blog wajib diisi.',
            'body.string' => 'Isi blog harus berupa teks.',
            'read_duration.required' => 'Durasi baca wajib diisi.',
            'read_duration.integer' => 'Durasi baca harus berupa angka.',
            'read_duration.min' => 'Durasi baca minimal 1 menit.',
            'read_duration.max' => 'Durasi baca maksimal 60 menit.',
            'categories.required' => 'Pilih minimal 1 kategori.',
            'categories.array' => 'Format kategori tidak valid.',
            'categories.min' => 'Pilih minimal 1 kategori.',
            'categories.*.exists' => 'Kategori yang dipilih tidak valid.',
            'primary_image.required' => 'Gambar utama wajib diunggah.',
            'primary_image.image' => 'Gambar utama harus berupa file gambar.',
            'primary_image.max' => 'Ukuran gambar utama maksimal 2 MB.',
            'images.*.image' => 'Setiap gambar tambahan harus berupa file gambar.',
            'images.*.max' => 'Ukuran gambar tambahan maksimal 2 MB.',
        ]);

        DB::beginTransaction();
        try {
            $slug = Str::slug($data['title']);
            $blog = Blog::create([
                'user_id' => auth()->id(),
                'title' => $data['title'],
                'slug' => $slug,
                'summary' => $data['summary'],
                'body' => $data['body'],
                'read_duration' => $data['read_duration'],
                'view_count' => 0,
            ]);

            // Primary image
            $primary = $request->file('primary_image');
            $primaryPath = "blogs/{$blog->id}/primary/{$slug}." . $primary->getClientOriginalExtension();
            Storage::disk('public')->put($primaryPath, file_get_contents($primary));
            BlogImage::create([
                'blog_id' => $blog->id,
                'is_primary' => true,
                'image' => $primaryPath,
            ]);

            // Non-primary images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $idx => $img) {
                    $imgPath = "blogs/{$blog->id}/{$slug}-" . ($idx + 1) . '.' . $img->getClientOriginalExtension();
                    Storage::disk('public')->put($imgPath, file_get_contents($img));
                    BlogImage::create([
                        'blog_id' => $blog->id,
                        'is_primary' => false,
                        'image' => $imgPath,
                    ]);
                }
            }

            // Categories
            foreach ($data['categories'] as $catId) {
                BlogCategory::create([
                    'blog_id' => $blog->id,
                    'blog_category_master_id' => $catId,
                ]);
            }

            DB::commit();
            return redirect()->route('guest.blog.kelola.index')->with('success', 'Blog berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['msg' => 'Gagal membuat blog: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit(Blog $blog)
    {
        abort_if($blog->user_id !== auth()->id(), 403);

        $page_title = 'Edit Blog';
        $page_description = 'Edit blog yang sudah Anda tulis.';
        $page_meta_description = 'Formulir edit blog di Goresan Ide.';

        $categories = BlogCategoryMaster::all();
        $selectedCategories = $blog->categories->pluck('blog_category_master_id')->toArray();
        return view('guest.pages.blog.kelola.edit', compact(
            'blog',
            'categories',
            'selectedCategories',
            'page_title',
            'page_description',
            'page_meta_description'
        ));
    }

    public function update(Request $request, Blog $blog)
    {
        abort_if($blog->user_id !== auth()->id(), 403);

        $data = $request->validate([
            'title' => 'required|string|max:255|unique:blogs,title,' . $blog->id,
            'summary' => 'required|string|max:155',
            'body' => 'required|string',
            'read_duration' => 'required|integer|min:1|max:60',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:blog_categories_master,id',
            'primary_image' => 'nullable|image|max:2048',
            'images.*' => 'nullable|image|max:2048',
        ], [
            'title.required' => 'Judul wajib diisi.',
            'title.string' => 'Judul harus berupa teks.',
            'title.max' => 'Judul maksimal 255 karakter.',
            'title.unique' => 'Judul sudah digunakan.',
            'summary.required' => 'Ringkasan wajib diisi.',
            'summary.string' => 'Ringkasan harus berupa teks.',
            'summary.max' => 'Ringkasan maksimal 155 karakter.',
            'body.required' => 'Isi blog wajib diisi.',
            'body.string' => 'Isi blog harus berupa teks.',
            'read_duration.required' => 'Durasi baca wajib diisi.',
            'read_duration.integer' => 'Durasi baca harus berupa angka.',
            'read_duration.min' => 'Durasi baca minimal 1 menit.',
            'read_duration.max' => 'Durasi baca maksimal 60 menit.',
            'categories.required' => 'Pilih minimal 1 kategori.',
            'categories.array' => 'Format kategori tidak valid.',
            'categories.min' => 'Pilih minimal 1 kategori.',
            'categories.*.exists' => 'Kategori yang dipilih tidak valid.',
            'primary_image.image' => 'Gambar utama harus berupa file gambar.',
            'primary_image.max' => 'Ukuran gambar utama maksimal 2 MB.',
            'images.*.image' => 'Setiap gambar tambahan harus berupa file gambar.',
            'images.*.max' => 'Ukuran gambar tambahan maksimal 2 MB.',
        ]);

        DB::beginTransaction();
        try {
            $slug = Str::slug($data['title']);
            $blog->update([
                'title' => $data['title'],
                'slug' => $slug,
                'summary' => $data['summary'],
                'body' => $data['body'],
                'read_duration' => $data['read_duration'],
            ]);

            // Update primary image if uploaded
            if ($request->hasFile('primary_image')) {
                $primary = $request->file('primary_image');
                $primaryPath = "blogs/{$blog->id}/primary/{$slug}." . $primary->getClientOriginalExtension();
                Storage::disk('public')->put($primaryPath, file_get_contents($primary));
                $blog->primaryImage()->updateOrCreate(
                    ['blog_id' => $blog->id],
                    ['is_primary' => true, 'image' => $primaryPath]
                );
            }

            // Add new non-primary images if uploaded
            if ($request->hasFile('images')) {
                $existingCount = $blog->images()->where('is_primary', false)->count();
                foreach ($request->file('images') as $idx => $img) {
                    $imgPath = "blogs/{$blog->id}/{$slug}-" . ($existingCount + $idx + 1) . '.' . $img->getClientOriginalExtension();
                    Storage::disk('public')->put($imgPath, file_get_contents($img));
                    BlogImage::create([
                        'blog_id' => $blog->id,
                        'is_primary' => false,
                        'image' => $imgPath,
                    ]);
                }
            }

            // Sync categories
            $blog->categories()->delete();
            foreach ($data['categories'] as $catId) {
                BlogCategory::create([
                    'blog_id' => $blog->id,
                    'blog_category_master_id' => $catId,
                ]);
            }

            DB::commit();
            return redirect()->route('guest.blog.kelola.index')->with('success', 'Blog berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['msg' => 'Gagal update blog: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Blog $blog)
    {
        abort_if($blog->user_id !== auth()->id(), 403);
        $blog->delete();
        return redirect()->route('guest.blog.kelola.index')->with('success', 'Blog berhasil dihapus.');
    }
}
