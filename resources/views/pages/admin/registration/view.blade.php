@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Detail Registrasi') }} > {{ $cooperative->name }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    <x-textarea class="w-full" rows="17" disabled>Nama : {{ $cooperative->name }}
NIK : {{ ($cooperative->nik) ? $cooperative->nik : '-' }}
Nomor Badan Hukum : {{ $cooperative->legal_entity_number }}
Tanggal Badan Hukum : {{ $cooperative->legal_entity_date }}
Badan Hukum Yang Menyetujui : {{ $cooperative->legal_entity_approval }}
Domisili : {{ $cooperative->cooperative_domicile }}
Notaris : {{ $cooperative->notary }}
NPWP : {{ $cooperative->npwp }}
Alamat : {{ $cooperative->address }}
No Telepon Seluler : {{ $cooperative->phone_hp }}
No Telepon Kantor : {{ $cooperative->phone_company }}
Faxmail : {{ $cooperative->facsimile }}
E-Mail : {{ $cooperative->email }}
Website : {{ $cooperative->website }}
Catatan : {{ $cooperative->note }}
Status : {{ ($cooperative->status) ? 'Aktif' : 'Tidak Aktif' }}
Skala Besar : {{ ($cooperative->isbig) ? 'Iya' : 'Tidak' }}
                    </x-textarea>

                    <!-- Form -->
                    <div class="mt-4 container mx-auto sm:px-32 md:px-52 lg:px-72 xl:px-96">
                        <form method="POST" action="{{ route('admin.registration.update', [$cooperative->id]) }}">
                            @csrf
                            @method('PUT')
                            @if ($cooperative->approved_at)
                                <input type="hidden" name="action" value="disapprove">
                                <x-button>
                                    {{ __('Batal Setujui') }}
                                </x-button>
                            @else
                                <input type="hidden" name="action" value="approve">
                                <div class="mb-2">
                                    <x-label for="nik" :value="__('Berikan NIK')" />
                                    <x-input id="nik" class="block mt-1 w-full" type="text" name="nik" :value="old('nik')" required />
                                </div>
                                <x-button>
                                    {{ __('Setujui') }}
                                </x-button>
                            @endif
                        </form>
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
