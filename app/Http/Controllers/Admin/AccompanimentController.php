<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\AccompanimentPersonalData;
use App\Models\AccompanimentConfirmAssistance;

class AccompanimentController extends Controller
{
    /**
     * Index
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $personal_datas = AccompanimentPersonalData::all();
        $confirm_assistances = AccompanimentConfirmAssistance::all();
        return view('pages.admin.cooperative.accompaniment.index', compact('personal_datas', 'confirm_assistances'));
    }

    public function action(Request $request, $id)
    {
        $personal_data = AccompanimentPersonalData::findOrFail($id);
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
                    'media' => 'offline',
                    'solution' => '',
                    'final_decision' => '',
                ];
                $personal_data->confirm_assistance()->create($data);
                $personal_data->refresh();
            }

            return redirect()->route('admin.cooperative.accompaniment.confirm_show', [$personal_data->confirm_assistance->id])->with('alert', [
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
        $confirm_assistance = AccompanimentConfirmAssistance::findOrFail($id);
        return view('pages.admin.cooperative.accompaniment.edit', compact('confirm_assistance'));
    }

    public function confirm_update(Request $request, $id)
    {
        $confirm_assistance = AccompanimentConfirmAssistance::findOrFail($id);

        DB::transaction(function () use ($confirm_assistance, $request) {
            $confirm_assistance->update($request->only(
                'submission_at',
                'mentoring_at',
                'location',
                'client_name',
                'participant',
                'media',
                'solution',
                'final_decision',
            ));
            $confirm_assistance->personal_data()->update($request->only(
                'problem',
                'reason',
            ));
        });

        return redirect()->back()->with('alert', [
            'text' => 'Data berhasil diperbarui',
            'type' => 'success',
        ]);
    }
}
