@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Menu Pendirian Koperasi') }}
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
                                ['key' => 'permohonan', 'text' => 'Permohonan'],
                                ['key' => 'konfirmasi-pendampingan', 'text' => 'Konfirmasi Pendampingan']
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
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->address }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>{{ ($confirmed) ? 'Terkonfirmasi' : '-' }}</td>
                                                <td>
                                                    <x-button tag="a" size="sm" :href="route('admin.cooperative.establishment.action', [$item->id, 'action' => ($confirmed ? 'disconfirm' : 'confirm')])">
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
                                            <th>Alamat</th>
                                            <th>No Telepon</th>
                                            <th>TGL Pengajuan</th>
                                            <th>TGL Pendampingan</th>
                                            <th>Lokasi Pendampingan</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($confirm_assistances as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->personal_data->name }}</td>
                                                <td>{{ $item->personal_data->address }}</td>
                                                <td>{{ $item->personal_data->phone }}</td>
                                                <td>{{ $item->submission_at->format('d/m/Y') }}</td>
                                                <td>{{ $item->mentoring_at->format('d/m/Y') }}</td>
                                                <td>{{ $item->location }}</td>
                                                <td>
                                                    <x-button tag="a" size="sm" :href="route('admin.cooperative.establishment.confirm_show', [$item->id])">
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
