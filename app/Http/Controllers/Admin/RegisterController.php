<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cooperative;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Index
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $cooperatives = Cooperative::paginate(10);
        return view('pages.admin.registration.index', compact('cooperatives'));
    }

    /**
     * Show
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(Cooperative $cooperative)
    {
        return view('pages.admin.registration.view', compact('cooperative'));
    }

    /**
     * Update
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function update(Request $request, Cooperative $cooperative)
    {
        $request->validate([
            'action' => ['required']
        ]);

        if ($request->action == 'approve')
        {
            $approve = $cooperative->update([
                'nik' => $request->nik,
                'approved_at' => now()
            ]);
            return redirect()->route('admin.registration')->with('alert', [
                'text' => 'Data berhasil disetujui',
                'type' => 'success',
            ]);
        } else {
            $disapprove = $cooperative->update([
                'nik' => null,
                'approved_at' => null
            ]);
            return redirect()->route('admin.registration')->with('alert', [
                'text' => 'Data berhasil dibatalsetujui',
                'type' => 'success',
            ]);
        }
    }
}
