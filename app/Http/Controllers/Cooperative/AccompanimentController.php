<?php

namespace App\Http\Controllers\Cooperative;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AccompanimentPersonalData;
use App\Models\AccompanimentConfirmAssistance;
use App\Models\Cooperative;
use Illuminate\Support\Facades\DB;

class AccompanimentController extends Controller
{
    public function index()
    {
        $accompaniments = AccompanimentPersonalData::where('cooperative_id', current_auth()->id)->get();
        return view('pages.cooperative.accompaniment.index', compact('accompaniments'));
    }

    /**
     * Store
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function store(Request $request)
    {
        $request->validate([
            'problem' => 'required',
            'reason' => 'required',
        ]);

        $cooperative = Cooperative::findOrFail(current_auth()->id);

        $store = null;
        DB::transaction(function () use (&$store, $cooperative, $request) {
            $store = $cooperative->accompaniment()->create($request->only('address', 'phone', 'problem', 'reason'));
        });

        return redirect()->back()->with('alert', [
            'text' => 'Data berhasil disubmit ke admin',
            'type' => 'success',
        ]);
    }
}
