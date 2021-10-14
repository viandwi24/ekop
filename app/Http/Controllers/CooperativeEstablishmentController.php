<?php

namespace App\Http\Controllers;

use App\Models\CooperativeEstablishmentPersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CooperativeEstablishmentController extends Controller
{
    /**
     * Index
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('pages.cooperative_establishment');
    }

    /**
     * Store
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $store = null;
        DB::transaction(function () use (&$store, $request) {
            $store = CooperativeEstablishmentPersonalData::create($request->only('name', 'address', 'phone'));
        });

        return redirect()->back()->with('alert', [
            'text' => 'Data berhasil disubmit ke admin',
            'type' => 'success',
        ]);
    }
}
