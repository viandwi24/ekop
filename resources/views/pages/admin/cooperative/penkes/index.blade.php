@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Menu Penkes') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    <div>
                        @php
                            $headers = [
                                ['key' => 'permohonan', 'text' => 'Pengaduan'],
                                ['key' => 'konfirmasi-pendampingan', 'text' => 'Tabel Masalah (OUTPUT)']
                            ];
                        @endphp
                        <x-tabs :headers="$headers">
                            <x-tab :active="true" key="permohonan">
                                <table class="table table-sm table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>No Telepon</th>
                                            <th>Nilai Kesehatan</th>
                                            <th>Status</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($personal_datas as $item)
                                            @php
                                                $confirmed = $item->confirm_assistance;
                                            @endphp
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->cooperative->name }}</td>
                                                <td>{{ $item->cooperative->address }}</td>
                                                <td>{{ $item->cooperative->phone_hp }}</td>
                                                <td>{{ $item->health_score }}</td>
                                                <td>{{ ($confirmed) ? 'Terkonfirmasi' : '-' }}</td>
                                                <td>
                                                    <x-button tag="a" size="sm" :href="route('admin.cooperative.penkes.action', [$item->id, 'action' => ($confirmed ? 'disconfirm' : 'confirm')])">
                                                        {{ __($confirmed ? 'Batalkan' : 'Konfirmasi') }}
                                                    </x-button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </x-tab>
                            <x-tab key="konfirmasi-pendampingan">
                                <table class="table table-sm table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th>Nama</th>
                                            <th>Nilai Kesehatan</th>
                                            <th>Kategori</th>
                                            <th>Solusi</th>
                                            <th>Keputusan Akhir</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($confirm_assistances as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->personal_data->cooperative->name }}</td>
                                                <td>{{ $item->personal_data->health_score }}</td>
                                                <td>
                                                    @if ($item->personal_data->health_score > 3)
                                                    <span class="text-red-500">Tidak Sehat</span>
                                                    @elseif ($item->personal_data->health_score > 2)
                                                        <span class="text-yellow-500">Kurang Sehat</span>
                                                    @elseif ($item->personal_data->health_score > 1)
                                                        <span class="text-green-400">Cukup Sehat</span>
                                                    @else
                                                        <span class="text-green-600">Sehat</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->solution }}</td>
                                                <td>{{ $item->final_decision }}</td>
                                                <td>
                                                    <x-button tag="a" size="sm" :href="route('admin.cooperative.penkes.confirm_show', [$item->id])">
                                                        {{ __('Lihat') }}
                                                    </x-button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </x-tab>
                        </x-tabs>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function main() {
        }
        document.addEventListener('DOMContentLoaded', main)
    </script>
@endpush
