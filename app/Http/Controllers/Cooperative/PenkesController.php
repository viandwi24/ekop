<?php

namespace App\Http\Controllers\Cooperative;

use App\Http\Controllers\Controller;
use App\Models\Cooperative;
use App\Models\PenkesPersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenkesController extends Controller
{
    public function index()
    {
        $penkess = PenkesPersonalData::where('cooperative_id', current_auth()->id)->get();
        return view('pages.cooperative.penkes.index', compact('penkess'));
    }

    /**
     * Store
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function store(Request $request)
    {
        $request->validate([
            'health_score' => 'required',
        ]);

        $cooperative = Cooperative::findOrFail(current_auth()->id);

        $store = null;
        DB::transaction(function () use (&$store, $cooperative, $request) {
            $store = $cooperative->penkes()->create($request->only('health_score'));
        });

        return redirect()->back()->with('alert', [
            'text' => 'Data berhasil disubmit ke admin',
            'type' => 'success',
        ]);
    }
}
