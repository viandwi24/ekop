<?php

namespace App\Http\Controllers\Cooperative;

use App\Http\Controllers\Controller;
use App\Models\Cooperative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    public function edit()
    {
        $cooperative = current_auth();
        return view('pages.cooperative.form_edit', compact('cooperative'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'legal_entity_number' => ['required', 'string', 'min:3'],
            'legal_entity_date' => ['required', 'date'],
            'legal_entity_approval' => ['required', 'in:1,2,3,4'],
            'cooperative_domicile' => ['required', 'string', 'min:3'],
            'notary' => ['required', 'string', 'min:3'],
            'npwp' => ['required', 'string', 'min:3'],
            'address' => ['required', 'string', 'min:3'],
            'phone_hp' => ['required', 'string', 'min:3'],
            'phone_company' => ['required', 'string', 'min:3'],
            'facsimile' => ['required', 'string', 'min:3'],
            'email' => ['required', 'string', 'email'],
            'website' => ['required', 'string', 'min:3'],
            'note' => ['required', 'string', 'min:3'],
            'status' => ['required', 'boolean'],
            'isbig' => ['required', 'boolean'],
        ]);

        $update = null;
        DB::transaction(function () use (&$update, $request) {
            $update = current_auth()->update($request->only(
                'name',
                'legal_entity_number',
                'legal_entity_date',
                'legal_entity_approval',
                'cooperative_domicile',
                'notary',
                'npwp',
                'address',
                'phone_hp',
                'phone_company',
                'facsimile',
                'email',
                'website',
                'note',
                'status',
                'isbig'
            ));
        });

        return redirect()->back()->with('alert', [
            'text' => 'Data berhasil disimpan',
            'type' => 'success',
        ]);
    }
}
