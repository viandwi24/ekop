<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CooperativeEstablishmentConfirmAssistance;
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
        $personal_datas = CooperativeEstablishmentPersonalData::all();
        $confirm_assistances = CooperativeEstablishmentConfirmAssistance::all();
        return view('pages.admin.cooperative.establishment.index', compact('personal_datas', 'confirm_assistances'));
    }

    public function action(Request $request, $id)
    {
        $personal_data = CooperativeEstablishmentPersonalData::findOrFail($id);
        $action = $request->get('action', 'confirm');

        $store = null;
        if ($action == 'confirm')
        {
            if (!$personal_data->confirm_assistance)
            {
                $data = [
                    'personal_data_id' => $id,
                    'submission_at' => now(),
                    'mentoring_at' => now(),
                    'location' => '',
                    'client_name' => '',
                    'participant' => 0,
                    'media' => 'offline'
                ];
                $personal_data->confirm_assistance()->create($data);
                $personal_data->refresh();
            }

            return redirect()->route('admin.cooperative.establishment.confirm_show', [$personal_data->confirm_assistance->id])->with('alert', [
                'text' => 'Data berhasil di konfirmasi',
                'type' => 'success',
            ]);
        } else {
            $personal_data->confirm_assistance()->delete();
            return redirect()->back()->with('alert', [
                'text' => 'Data berhasil di batalkan konfirmasi',
                'type' => 'success',
            ]);
        }
    }

    public function confirm_show(Request $request, $id)
    {
        $confirm_assistance = CooperativeEstablishmentConfirmAssistance::findOrFail($id);
        return view('pages.admin.cooperative.establishment.edit', compact('confirm_assistance'));
    }

    public function confirm_update(Request $request, $id)
    {
        $confirm_assistance = CooperativeEstablishmentConfirmAssistance::findOrFail($id);

        DB::transaction(function () use ($confirm_assistance, $request) {
            $confirm_assistance->update($request->only(
                'submission_at',
                'mentoring_at',
                'location',
                'client_name',
                'participant',
                'media',
            ));
            $confirm_assistance->personal_data()->update($request->only(
                'name',
                'address',
                'phone'
            ));
        });

        return redirect()->back()->with('alert', [
            'text' => 'Data berhasil diperbarui',
            'type' => 'success',
        ]);
    }
}
