<?php

namespace App\Http\Controllers;

use App\Models\Cooperative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /**
     * Index
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('pages.registration');
    }

    /**
     * Store
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function store(Request $request)
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

        $store = null;
        DB::transaction(function () use (&$store, $request) {
            $store = Cooperative::create($request->only(
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

        return redirect()->route('registration.success')->with('alert', [
            'text' => 'Data berhasil disimpan',
            'type' => 'success',
        ]);
    }

    /**
     * Success
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function success()
    {
        return view('pages.registration_success');
    }
}
