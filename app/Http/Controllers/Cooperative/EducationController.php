<?php

namespace App\Http\Controllers\Cooperative;

use App\Http\Controllers\Controller;
use App\Models\EducationPersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EducationController extends Controller
{
    /**
     * Index
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('pages.cooperative_education');
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
            'problem' => 'required',
            'reason' => 'required',
        ]);

        $store = null;
        DB::transaction(function () use (&$store, $request) {
            $store = EducationPersonalData::create($request->only('name', 'address', 'phone', 'problem', 'reason'));
        });

        return redirect()->back()->with('alert', [
            'text' => 'Data berhasil disubmit ke admin',
            'type' => 'success',
        ]);
    }
}
