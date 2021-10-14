@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Menu Pendampingan') }}
    </h2>
@endsection

@section('content')
    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-validation-errors />
                    <form method="POST" action="{{ route('cooperative.accompaniment.store') }}">
                        @csrf
                        <div class="text-xl font-semibold mb-2">
                            FORMULIR
                        </div>
                        <div class="mb-2">
                            <x-label for="problem" :value="__('Masalah')" />
                            <x-input id="problem" class="block mt-1 w-full" type="text" name="problem" :value="old('problem')" required />
                        </div>
                        <div class="mb-2">
                            <x-label for="reason" :value="__('Penyebab')" />
                            <x-input id="reason" class="block mt-1 w-full" type="text" name="reason" :value="old('reason')" required />
                        </div>
                        <x-button class="w-full justify-center">
                            {{ __('Submit') }}
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="text-xl font-semibold mb-2">
                        Riwayat Pengaduan
                    </div>
                    <table class="table table-sm table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Koperasi</th>
                                <th>Alamat</th>
                                <th>No Telepon</th>
                                <th>Masalah</th>
                                <th>Penyebab</th>
                                <th>Pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accompaniments as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->cooperative->name }}</td>
                                    <td>{{ $item->cooperative->address }}</td>
                                    <td>{{ $item->cooperative->phone_hp }}</td>
                                    <td>{{ $item->problem }}</td>
                                    <td>{{ $item->reason }}</td>
                                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
