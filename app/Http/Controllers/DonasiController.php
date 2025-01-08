<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Payment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
// use Illuminate\Routing\Controllers\HasMiddleware;
// use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers;
use App\Http\Requests\DonasiRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class DonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donasis = Donasi::with(['category', 'user'])->latest()->get();
        return view('donasi.index',[
            'donasis' => $donasis
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('donasi.create',[
            'categories' => $categories,
            'page_meta' => [
                'url' => route('donasi.store'),
            ]
        ]);
    }

    /**
     * Store a newly creaed resource in storage.
     */
    public function store(DonasiRequest $request)
    {
        $filePath = $request->file('foto')->store('image/donasis');
        $request->user()->donasi()->create([
            ...$request->validated(),
            // ...['foto' => $file->store('image/donasis')]
            'foto' => $filePath,
        ]);
        return to_route('donasi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug_donasis)
    {
        $donasi = Donasi::where('slug_donasis', $slug_donasis)->first();

        $payment = Payment::where('donasi_id', $donasi->id)->get();
        return view('donasi.show', [
            'donasi' => $donasi,
            'payment' => $payment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donasi $donasi)
    {
        // tidak bisa diedit donasi sesuai dengan user yang membuat donasi
        // abort_if($request->user()->isNot($donasi->user), 401);
        Gate::authorize('edit-donasi', $donasi);
        $categories = Category::all();
        $donasi->load(['category', 'user']);
        return view('donasi.edit', [
            'categories' => $categories,
            'donasi' => $donasi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DonasiRequest $request, Donasi $donasi)
    {
        // Pastikan apakah file baru diunggah
            // Hapus file lama jika ada
            
            // $table->string('foto')->nullable();
            // $table->string('name');
            // $table->string('slug_donasis')->unique();
            // $table->text('description');
            // $table->unsignedBigInteger('jumlah_orang')->nullable();
            // $table->unsignedBigInteger('dana_terkumpul')->nullable();
            // $table->unsignedBigInteger('jumlah_target_dana');
            // $table->date('tanggal_batas_donasi');
            // $table->timestamps();

            // Simpan file baru
            // if ($request->hasFile('foto')){
            //     if ($donasi->foto && Storage::exists($donasi->foto)){
            //         Storage::delete($donasi->foto);
            //     }
            //     $filePath = $request->file('foto')->store('image/donasis');
            //     $donasi->foto = $filePath;

            //     $donasi->update([
            //         'name' => $request->name,
            //         'description' => $request->description,
            //         'jumlah_target_dana' => $request->jumlah_target_dana,
            //         'tanggal_batas_donasi' => $request->tanggal_batas_donasi,
            //         'category_id' => $request->category_id,
            //     ]);
            // } else {
            //     $donasi->update([
            //         'name' => $request->name,
            //         'description' => $request->description,
            //         'jumlah_target_dana' => $request->jumlah_target_dana,
            //         'category_id' => $request->category_id,
            //         'tanggal_batas_donasi' => $request->tanggal_batas_donasi,
            //     ]);
            // }
            $filePath = $donasi->foto;
            if ($request->hasFile('foto')){
                if ($donasi->foto && Storage::exists($donasi->foto)){
                    Storage::delete($donasi->foto);
                }
                $filePath = $request->file('foto')->store('image/donasis');
            }
            $donasi->update([
                'foto' => $filePath,
                'name' => $request->name,
                'description' => $request->description,
                'jumlah_target_dana' => $request->jumlah_target_dana,
                'tanggal_batas_donasi' => $request->tanggal_batas_donasi,
                'category_id' => $request->category_id
            ]);
        return redirect()->route('donasi.index')->with('success', 'data donasi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donasi $donasi)
    {
        Gate::authorize('hapus-donasi', $donasi);

        if($donasi->foto && Storage::exists($donasi->foto)){
            Storage::delete($donasi->foto);
        }

        $donasi->delete();

        return redirect()->route('donasi.index')->with('success', 'Data Donasi berhasil dihapus');
    }
}
