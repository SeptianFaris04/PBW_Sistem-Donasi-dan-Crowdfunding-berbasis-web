<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $donasis = Donasi::with(['category', 'user'])->latest()->paginate(3);
        return view('home', [
            'donasis' => $donasis
        ]);
    }
}
