<?php

namespace App\Http\Controllers\Cooperative;

use App\Http\Controllers\Controller;
use App\Models\AdvocacyPersonalData;
use App\Models\Cooperative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdvocacyController extends Controller
{
    public function index()
    {
        $advocacys = AdvocacyPersonalData::where('cooperative_id', current_auth()->id)->get();
        return view('pages.cooperative.advocacy.index', compact('advocacys'));
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
            $store = $cooperative->advocacy()->create($request->only('address', 'phone', 'problem', 'reason'));
        });

        return redirect()->back()->with('alert', [
            'text' => 'Data berhasil disubmit ke admin',
            'type' => 'success',
        ]);
    }
}
