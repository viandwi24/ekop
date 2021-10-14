@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Menu Advokasi') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-validation-errors />
                    <form method="POST" action="{{ route('admin.cooperative.advocacy.confirm_show', [$confirm_assistance->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="text-xl font-semibold mb-2">
                            FORMULIR
                        </div>
                        <div class="mb-2">
                            <x-label for="problem" :value="__('Masalah')" />
                            <x-input id="problem" class="block mt-1 w-full" type="text" name="problem" :value="$confirm_assistance->personal_data->problem" required />
                        </div>
                        <div class="mb-2">
                            <x-label for="reason" :value="__('Penyebab')" />
                            <x-input id="reason" class="block mt-1 w-full" type="text" name="reason" :value="$confirm_assistance->personal_data->reason" required />
                        </div>
                        <div class="text-xl font-semibold mt-6 mb-2">
                            KONFIRMASI PENDAMPINGAN
                        </div>
                        <div class="mb-2">
                            <x-label for="solution" :value="__('Masalah')" />
                            <x-input id="solution" class="block mt-1 w-full" type="text" name="solution" :value="$confirm_assistance->solution" required />
                        </div>
                        <div class="mb-2">
                            <x-label for="final_decision" :value="__('Keputusan Akhir')" />
                            <x-input id="final_decision" class="block mt-1 w-full" type="text" name="final_decision" :value="$confirm_assistance->final_decision" required />
                        </div>
                        <div class="mb-2">
                            <x-label for="submission_at" :value="__('Tanggal Pengajuan')" />
                            <x-input id="submission_at" class="block mt-1 w-full" type="date" name="submission_at" :value="$confirm_assistance->submission_at->format('Y-m-d')" required />
                        </div>
                        <div class="mb-2">
                            <x-label for="mentoring_at" :value="__('Tanggal Pendampingan')" />
                            <x-input id="mentoring_at" class="block mt-1 w-full" type="date" name="mentoring_at" :value="$confirm_assistance->mentoring_at->format('Y-m-d')" required />
                        </div>
                        <div class="mb-2">
                            <x-label for="location" :value="__('Lokasi')" />
                            <x-input id="location" class="block mt-1 w-full" type="text" name="location" :value="$confirm_assistance->location" required />
                        </div>
                        <div class="mb-2">
                            <x-label for="participant" :value="__('Jumlah Peserta')" />
                            <x-input id="participant" class="block mt-1 w-full" type="text" name="participant" :value="$confirm_assistance->participant" required />
                        </div>
                        <div class="mb-2">
                            <x-label :value="__('Media')" />
                            <div>
                                <div class="mt-1">
                                    <x-input id="media_1" type="radio" name="media" value="offline" required :checked="$confirm_assistance->media == 'offline'" />
                                    <x-label for="media_1" :value="__('offline')" class="inline-block text-sm ml-1" />
                                </div>
                                <div class="mt-1">
                                    <x-input id="media_2" type="radio" name="media" value="zoom" required :checked="$confirm_assistance->media == 'zoom'" />
                                    <x-label for="media_2" :value="__('zoom')" class="inline-block text-sm ml-1" />
                                </div>
                                <div class="mt-1">
                                    <x-input id="media_3" type="radio" name="media" value="gmeet" required :checked="$confirm_assistance->media == 'gmeet'" />
                                    <x-label for="media_3" :value="__('gmeet')" class="inline-block text-sm ml-1" />
                                </div>
                            </div>
                        </div>
                        <x-button class="w-full justify-center">
                            {{ __('Simpan') }}
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
