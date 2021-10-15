<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenkesConfirmAssistance;
use App\Models\PenkesPersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenkesController extends Controller
{
    /**
     * Index
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $personal_datas = PenkesPersonalData::all();
        $confirm_assistances = PenkesConfirmAssistance::all();
        return view('pages.admin.cooperative.penkes.index', compact('personal_datas', 'confirm_assistances'));
    }

    public function action(Request $request, $id)
    {
        $personal_data = PenkesPersonalData::findOrFail($id);
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
                    'participant' => 0,
                    'media' => 'offline',
                    'solution' => '',
                    'final_decision' => '',
                ];
                $personal_data->confirm_assistance()->create($data);
                $personal_data->refresh();
            }

            return redirect()->route('admin.cooperative.penkes.confirm_show', [$personal_data->confirm_assistance->id])->with('alert', [
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
        $confirm_assistance = PenkesConfirmAssistance::findOrFail($id);
        return view('pages.admin.cooperative.penkes.edit', compact('confirm_assistance'));
    }

    public function confirm_update(Request $request, $id)
    {
        $confirm_assistance = PenkesConfirmAssistance::findOrFail($id);

        DB::transaction(function () use ($confirm_assistance, $request) {
            $confirm_assistance->update($request->only(
                'submission_at',
                'mentoring_at',
                'location',
                'participant',
                'media',
                'solution',
                'final_decision',
            ));
            $confirm_assistance->personal_data()->update($request->only(
                'health_score',
            ));
        });

        return redirect()->back()->with('alert', [
            'text' => 'Data berhasil diperbarui',
            'type' => 'success',
        ]);
    }
}
