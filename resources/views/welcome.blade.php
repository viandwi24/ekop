@extends('layouts.app')

@php
    $cooperatives = \App\Models\StaticCooperative::all();
    $villages = \App\Models\StaticCooperative::select('village')->distinct()->get()->pluck('village');
    $districts = \App\Models\StaticCooperative::select('districts')->distinct()->get()->pluck('districts');
    $groups = \App\Models\StaticCooperative::select('group')->distinct()->get()->pluck('group');
@endphp

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden mb-4 shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    Selamat Datang di Aplikasi
                    <strong>{{ config('app.name') }}</strong>!
                    Bagi Masyarakat Umum Bisa langsung akses menu Publik.
                </div>
            </div>
            <div class="bg-white overflow-hidden mb-4 shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl mb-2 font-semibold">
                        Daftar Koperasi
                    </h2>
                    <hr>
                    <div class="flex space-x-6 my-6">
                        <div class="w-1/2 flex flex-col space-y-2">
                            <div class="flex">
                                <x-label for="village" :value="__('Desa')" class="w-1/3" />
                                <select name="village" id="village" class="filter-input w-2/3 text-xs rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="all">Semua</option>
                                    @foreach($villages as $village)
                                        <option value="{{ $village }}">{{ $village }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex">
                                <x-label for="districts" :value="__('Kecamatan')" class="w-1/3" />
                                <select name="districts" id="districts" class="filter-input w-2/3 text-xs rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="all">Semua</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district }}">{{ $district }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="w-1/2 flex flex-col space-y-2">
                            <div class="flex">
                                <x-label for="active" :value="__('Aktif')" class="w-1/3" />
                                <select name="active" id="active" class="filter-input w-2/3 text-xs rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="all">Semua</option>
                                    <option value="Ya">Aktif</option>
                                    <option value="Tidak">Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="flex">
                                <x-label for="group" :value="__('Kelompok')" class="w-1/3" />
                                <select name="group" id="group" class="filter-input w-2/3 text-xs rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="all">Semua</option>
                                    @foreach($groups as $group)
                                        <option value="{{ $group }}">{{ $group }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-4">
                        <table id="list-cooperatives">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th data-name="name">Nama Koperasi</th>
                                    <th data-name="village">Desa</th>
                                    <th data-name="districts">Kecamatan</th>
                                    <th data-name="active">Aktif</th>
                                    <th data-name="type">Jenis Koperasi</th>
                                    <th data-name="group">Kelompok Koperasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cooperatives as $cooperative)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $cooperative->name }}</td>
                                        <td>
                                            @if ($cooperative->village)
                                                {{ $cooperative->village }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($cooperative->districts)
                                                {{ $cooperative->districts }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $cooperative->active === 'TRUE' ? 'Ya' : 'Tidak' }}</td>
                                        <td>{{ $cooperative->type }}</td>
                                        <td>{{ $cooperative->group }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <style>
    thead input {
        width: 100%;
    }
    </style>
@endpush

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        function main() {
            $(document).ready(function () {
                let datatable

                $('.filter-input').on('change', function (e) {
                    const el = $(this)
                    const name = el.attr('name')
                    const th = $('#list-cooperatives thead tr').eq(1).find('th[data-name="' + name + '"]')
                    const input = th.find('input')
                    const event = new Event('input')
                    if (el.val() !== 'all') {
                        const a = el.val().split('')
                        if (a[a.length-1] === ' ') {
                            // remove last char
                            a.pop()
                        }
                        input.val(a.join(''))
                    } else {
                        input.val('')
                    }
                    input.get(0).dispatchEvent(event)
                    input.keyup()
                    // datatable.clear().draw()
                    // datatable.reload()
                });

                $('#list-cooperatives thead tr')
                    .clone(true)
                    .addClass('filters')
                    .appendTo('#list-cooperatives thead');
                    
                datatable = $('#list-cooperatives').DataTable({
                    orderCellsTop: true,
                    fixedHeader: true,
                    initComplete: function () {
                        var api = this.api();
            
                        // For each column
                        api
                            .columns()
                            .eq(0)
                            .each(function (colIdx) {
                                // alert($(api.column(colIdx).header()))

                                // Set the header cell to contain the input element
                                var cell = $('.filters th').eq(
                                    $(api.column(colIdx).header()).index()
                                );
                                var title = $(cell).text();

                                if ($(api.column(colIdx).header()).index() == 0) return $(cell).html('');

                                $(cell).html('<input data-name="' + title + '" type="text" placeholder="' + title + '" />');

                                // On every keypress in this input
                                $(
                                    'input',
                                    $('.filters th').eq($(api.column(colIdx).header()).index())
                                )
                                    .off('keyup change')
                                    .on('keyup change', function (e) {
                                        e.stopPropagation();
            
                                        // Get the search value
                                        $(this).attr('title', $(this).val());
                                        var regexr = '({search})'; //$(this).parents('th').find('select').val();
            
                                        var cursorPosition = this.selectionStart;
                                        // Search the column for that value
                                        api
                                            .column(colIdx)
                                            .search(
                                                this.value != ''
                                                    ? regexr.replace('{search}', '(((' + this.value + ')))')
                                                    : '',
                                                this.value != '',
                                                this.value == ''
                                            )
                                            .draw();
            
                                        $(this)
                                            .focus()[0]
                                            .setSelectionRange(cursorPosition, cursorPosition);
                                    });
                            });
                    },
                });
            });
        }
        document.addEventListener('DOMContentLoaded', main)
    </script>
@endpush

