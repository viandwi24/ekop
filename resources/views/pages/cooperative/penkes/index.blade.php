@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Menu Penkes') }}
    </h2>
@endsection

@section('content')
    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-validation-errors />
                    <form method="POST" action="{{ route('cooperative.penkes.store') }}">
                        @csrf
                        <div class="text-xl font-semibold mb-2">
                            FORMULIR
                        </div>
                        <div class="mb-2">
                            <x-label for="health_score" :value="__('Nilai Kesehatan')" />
                            <x-input id="health_score" class="block mt-1 w-full" type="number" min="0" name="health_score" :value="old('health_score', 0)" required />
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
                                <th>Nilai Kesehatan</th>
                                <th>Pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penkess as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->cooperative->name }}</td>
                                    <td>{{ $item->cooperative->address }}</td>
                                    <td>{{ $item->cooperative->phone_hp }}</td>
                                    <td>{{ $item->health_score }}</td>
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
