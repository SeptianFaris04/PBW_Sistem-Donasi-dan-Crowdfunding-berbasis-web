<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\UrunDana;
use Illuminate\Http\Request;
use App\Http\Requests\UrunDanaRequest;
use Illuminate\Support\Facades\Storage;

class UrunDanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $urundanas = UrunDana::with(['category', 'user'])->latest()->get();
        return view('urundana.index', [
            'urundanas' => $urundanas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $table->foreignId('user_id')->constrained(
        //     table: 'users',
        //     indexName: 'urundanas_user_id'
        // );
        // $table->foreignId('category_id')->constrained(
        //     table: 'categories',
        //     indexName: 'urundanas_categories_id'
        // );
        // $table->string('foto')->nullable();
        // $table->string('name');
        // $table->string('slug_urundana')->unique();
        // $table->text('description');
        // $table->unsignedBigInteger('jumlah_orang');
        // $table->unsignedBigInteger('dana_terkumpul');
        // $table->unsignedBigInteger('jumlah_target_dana');
        // $table->date('tanggal_batas_urundana');
        // $table->timestamps();

        $categories = Category::all();
        return view('urundana.create',[
            'categories' => $categories,
            'page_meta' => [
                'url' => route('urundana.store'),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UrunDanaRequest $request)
    {
        $filePath = $request->file('foto')->store('image/urundana');
        $request->user()->urundana()->create([
            ...$request->validated(),
            'foto' => $filePath,
        ]);
        return to_route('urundana.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(UrunDana $urunDana)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UrunDana $urundana)
    {
        $categories = Category::all();
        $urundana->load(['category', 'user']);
        return view('urundana.edit', [
            'urundana' => $urundana,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UrunDanaRequest $request, UrunDana $urundana)
    {
        $filePath = $urundana->foto;
            if ($request->hasFile('foto')){
                if ($urundana->foto && Storage::exists($urundana->foto)){
                    Storage::delete($urundana->foto);
                }
                $filePath = $request->file('foto')->store('image/urundana');
            }
            $urundana->update([
                'foto' => $filePath,
                'name' => $request->name,
                'description' => $request->description,
                'jumlah_target_dana' => $request->jumlah_target_dana,
                'tanggal_batas_urundana' => $request->tanggal_batas_urundana,
                'category_id' => $request->category_id
            ]);
        return redirect()->route('urundana.index')->with('success', 'data donasi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UrunDana $urunDana)
    {
        //
    }
}
