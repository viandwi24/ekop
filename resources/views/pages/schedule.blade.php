@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Jadwal pembinaan koperasi') }}
    </h2>
@endsection

@php
    $groups = [
        [
            'title' => 'Pendirian Koperasi',
            'eloquent' => \App\Models\CooperativeEstablishmentConfirmAssistance::all(),
        ],
        [
            'title' => 'Advokasi Koperasi',
            'eloquent' => \App\Models\AdvocacyConfirmAssistance::all(),
        ],
        [
            'title' => 'Pendampingan Koperasi',
            'eloquent' => \App\Models\AccompanimentConfirmAssistance::all(),
        ],
        [
            'title' => 'Penilaian Kesehatan',
            'eloquent' => \App\Models\PenkesConfirmAssistance::all(),
        ],
        [
            'title' => 'Pendidikan Koperasi',
            'eloquent' => \App\Models\EducationConfirmAssistance::all(),
        ],
    ];
@endphp

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($groups as $group)
                <div class="bg-white overflow-hidden mb-4 shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-2xl mb-2 font-semibold">
                            {{ $group['title'] }}
                        </h2>
                        <hr>
                        <table class="table table-sm table-striped table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Lokasi</th>
                                    <th>Pada</th>
                                    <th>Jumlah Partisipasi</th>
                                    <th>Media</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($group['eloquent']->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            {{ __('Tidak ada data') }}
                                        </td>
                                    </tr>
                                @else
                                    @php
                                        $eq = $group['eloquent'];
                                    @endphp
                                    @foreach ($eq as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{-- @if ($item->client_name)
                                                    {{ $item->client_name }} --}}
                                                @if ($item->personal_data->cooperative)
                                                    {{ $item->personal_data->cooperative->name }}
                                                @else
                                                    {{ $item->personal_data->name }}
                                                @endif
                                            </td>
                                            <td>{{ $item->location }}</td>
                                            <td>{{ $item->mentoring_at->format('d/m/y') }}</td>
                                            <td>{{ $item->participant }}</td>
                                            <td>{{ $item->media }}</td>
                                        </tr>                                        
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection