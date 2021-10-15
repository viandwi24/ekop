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
            'file' => 'required|file|mimes:xlx,xls,xlsx',
        ]);

        $cooperative = Cooperative::findOrFail(current_auth()->id);

        $name = $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->store('public/files/penkes');
        $data = array_merge(
            $request->only('health_score'),
            [
                'file_path' => $path,
                'file_name' => $name,
            ]
        );

        $store = null;
        DB::transaction(function () use (&$store, $cooperative, $data) {
            $store = $cooperative->penkes()->create($data);
        });

        return redirect()->back()->with('alert', [
            'text' => 'Data berhasil disubmit ke admin',
            'type' => 'success',
        ]);
    }
}
