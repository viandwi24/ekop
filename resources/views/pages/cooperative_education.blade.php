@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Pendidikan Koperasi') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-validation-errors />
                    <form method="POST" action="{{ route('cooperative.education.store') }}">
                        @csrf
                        <div class="text-xl font-semibold mb-2">
                            FORMULIR DATA DIRI
                        </div>
                        <div class="mb-2">
                            <x-label for="name" :value="__('Nama')" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                        </div>
                        <div class="mb-2">
                            <x-label for="address" :value="__('Alamat')" />
                            <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />
                        </div>
                        <div class="mb-2">
                            <x-label for="phone" :value="__('Nomor Telepon Aktif')" />
                            <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
                        </div>
                        <div class="mb-2">
                            <x-label for="problem" :value="__('Masalah')" />
                            <select name="problem" id="problem" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">--Pilih Masalah--</option>
                                @php
                                    $problems = [
                                        'PENYULUHAN KOPERASI',
                                        'BIMBINGAN & KAJIAN TEKNIS',
                                        'NARASUMBER',
                                    ];
                                @endphp
                                @foreach ($problems as $key => $val)
                                    <option value="{{ $val }}">{{ $val }}</option>
                                @endforeach
                            </select>
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
@endsection
