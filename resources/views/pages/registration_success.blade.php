@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Registration Success') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-green-300">
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    {{ __('Registrasi Berhasil, Silahkan Tunggu Formulir Anda Disetujui Admin dan Anda Dapat Login Menggunakan Nomor NIK (Nomer Induk Koperasi)') }}
                </div>
            </div>
        </div>
    </div>
@endsection
