<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $donasis = Donasi::with(['category', 'user'])->latest()->get();
        return view('home', [
            'donasis' => $donasis
        ]);
    }
}
