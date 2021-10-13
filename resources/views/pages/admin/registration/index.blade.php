@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Menu Registrasi') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    <div>
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th width="15%">Status</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cooperatives as $cooperative)
                                    <tr>
                                        <td>{{ $cooperative->id }}</td>
                                        <td class="text-left">{{ $cooperative->name }}</td>
                                        <td>
                                            {{ ($cooperative->approved_at) ? $cooperative->nik : '-' }}
                                        </td>
                                        <td class="vertical-middle">
                                            <x-badge :type="($cooperative->approved_at) ? 'success' : 'danger'" :text="($cooperative->approved_at) ? 'Sudah Disetujui' : 'Belum Disetujui'" />
                                        </td>
                                        <td>
                                            <x-button tag="a" size="sm" :href="route('admin.registration.show', [$cooperative->id])">
                                                {{ __('Lihat') }}
                                            </x-button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $cooperatives->links() }}
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
