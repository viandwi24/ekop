<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Formulir') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-validation-errors />
                    <form method="POST" action="{{ route('cooperative.form.update', [$cooperative->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="text-xl font-semibold mb-2">
                            A. IDENTITAS KOPERASI :
                        </div>
                        <div class="mb-2">
                            <x-label for="name" :value="__('Nama')" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$cooperative->name" required />
                        </div>
                        <div class="mb-2">
                            <x-label for="legal_entity_number" :value="__('Nomor Badan Hukum')" />
                            <x-input id="legal_entity_number" class="block mt-1 w-full" type="text" name="legal_entity_number" :value="$cooperative->legal_entity_number" required />
                        </div>
                        <div class="mb-2">
                            <x-label for="legal_entity_date" :value="__('Tanggal Badan Hukum')" />
                            <x-input id="legal_entity_date" class="block mt-1 w-full" type="date" name="legal_entity_date" :value="$cooperative->legal_entity_date->format('Y-m-d')" required />
                        </div>
                        <div class="mb-2">
                            <x-label :value="__('Pengesahan Badan Hukum Oleh')" />
                            <div>
                                <div class="mt-1">
                                    <x-input id="legal_entity_approval_1" type="radio" name="legal_entity_approval" value="1" required :checked="$cooperative->legal_entity_approval == '1'" />
                                    <x-label for="legal_entity_approval_1" value="Deputi Bidang Kelembagaan KUKM atas Nama Menteri" class="inline-block text-sm ml-1" />
                                </div>
                                <div class="mt-1">
                                    <x-input id="legal_entity_approval_2" type="radio" name="legal_entity_approval" value="2" required :checked="$cooperative->legal_entity_approval == '2'" />
                                    <x-label for="legal_entity_approval_2" value="Gubernur atas Nama Menteri" class="inline-block text-sm ml-1" />
                                </div>
                                <div class="mt-1">
                                    <x-input id="legal_entity_approval_3" type="radio" name="legal_entity_approval" value="3" required :checked="$cooperative->legal_entity_approval == '3'" />
                                    <x-label for="legal_entity_approval_3" value="Bupati/Walikota atas Nama Menteri" class="inline-block text-sm ml-1" />
                                </div>
                                <div class="mt-1">
                                    <x-input id="legal_entity_approval_4" type="radio" name="legal_entity_approval" value="4" required :checked="$cooperative->legal_entity_approval == '4'" />
                                    <x-label for="legal_entity_approval_4" value="Tidak Tahu" class="inline-block text-sm ml-1" />
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <x-label for="cooperative_domicile" :value="__('Tempat Kedudukan Koperasi')" />
                            <x-input id="cooperative_domicile" class="block mt-1 w-full" type="text" name="cooperative_domicile" :value="$cooperative->cooperative_domicile" required />
                        </div>
                        <div class="mb-2">
                            <x-label for="notary" :value="__('Notaris')" />
                            <x-input id="notary" class="block mt-1 w-full" type="text" name="notary" :value="$cooperative->notary" required />
                        </div>
                        <div class="mb-2">
                            <x-label for="npwp" :value="__('NPWP Koperasi')" />
                            <x-input id="npwp" class="block mt-1 w-full" type="text" name="npwp" :value="$cooperative->npwp" required />
                        </div>
                        <div class="mb-2">
                            <x-label for="address" :value="__('Alamat')" />
                            <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="$cooperative->address" required />
                        </div>
                        <div class="mb-2">
                            <x-label for="phone_hp" :value="__('No. Selular (HP)')" />
                            <x-input id="phone_hp" class="block mt-1 w-full" type="text" name="phone_hp" :value="$cooperative->phone_hp" required />
                        </div>
                        <div class="mb-2">
                            <x-label for="phone_company" :value="__('Telp. Kantor')" />
                            <x-input id="phone_company" class="block mt-1 w-full" type="text" name="phone_company" :value="$cooperative->phone_company" required />
                        </div>
                        <div class="mb-2">
                            <x-label for="facsimile" :value="__('No. Faximili')" />
                            <x-input id="facsimile" class="block mt-1 w-full" type="text" name="facsimile" :value="$cooperative->facsimile" required />
                        </div>
                        <div class="mb-2">
                            <x-label for="email" :value="__('Email')" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$cooperative->email" required />
                        </div>
                        <div class="mb-2">
                            <x-label for="website" :value="__('Website')" />
                            <x-input id="website" class="block mt-1 w-full" type="text" name="website" :value="$cooperative->website" required />
                        </div>
                        <div class="mb-2">
                            <x-label for="note" :value="__('Catatan')" />
                            <x-input id="note" class="block mt-1 w-full" type="text" name="note" :value="$cooperative->note" required />
                        </div>
                        <div class="mb-2">
                            <x-label :value="__('Status Koperasi')" />
                            <div>
                                <div class="mt-1">
                                    <x-input id="status_1" type="radio" name="status" value="1" required :checked="$cooperative->status == '1'" />
                                    <x-label for="status_1" :value="__('Aktif')" class="inline-block text-sm ml-1" />
                                </div>
                                <div class="mt-1">
                                    <x-input id="status_2" type="radio" name="status" value="0" required :checked="$cooperative->status == '0'" />
                                    <x-label for="status_2" :value="__('Tidak Aktif')" class="inline-block text-sm ml-1" />
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <x-label :value="__('Skala Besar')" />
                            <div>
                                <div class="mt-1">
                                    <x-input id="isbig_1" type="radio" name="isbig" value="1" required :checked="$cooperative->isbig == '1'" />
                                    <x-label for="isbig_1" :value="__('Iya')" class="inline-block text-sm ml-1" />
                                </div>
                                <div class="mt-1">
                                    <x-input id="isbig_2" type="radio" name="isbig" value="0" required :checked="$cooperative->isbig == '0'" />
                                    <x-label for="isbig_2" :value="__('Tidak')" class="inline-block text-sm ml-1" />
                                </div>
                            </div>
                        </div>
                        <x-button class="w-full justify-center">
                            {{ __('Register') }}
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
