@extends('core::page.plugin')
@section('inner-title', "$title - ")
@section('mPegawai', 'opened')

@section('css')
    @include('core::layouts.partials.datatables')
@stop

@section('js') 
    <script src="https://cdn.enterwind.com/template/epanel/js/lib/datatables-net/datatables.min.js"></script>
    <script>
        $(function() {
            $('#datatable').DataTable({
                order: [[ 0, "asc" ]], 
                processing: true,
                serverSide: true,
                ajax : '{!! request()->fullUrl() !!}?datatable=true', 
                columns: [
                    { data: 'pilihan', name: 'pilihan', className: 'table-check' },
                    { data: 'name', name: 'name' },
                    { data: 'phone', name: 'phone' },
                    { data: 'email', name: 'email' },
                    { data: 'golongan', name: 'golongan' },
                    { data: 'field', name: 'field' },
                    { data: 'aksi', name: 'aksi', className: 'tombol', orderable: false, searchable: false }
                ],
                "fnDrawCallback": function( oSettings ) {
                    @include('core::layouts.components.callback')
                }
            });
        });
        @include('core::layouts.components.hapus')
    </script>
@stop

@section('content')

    @if(!$data->count())

        @if(config('pegawai.personil.lock'))

            <div class="text-center">
                <a href="{{ route("$prefix.index") }}?import=true" class="btn btn-success">Import from Satuan Kerja</a>
            </div>

            @include('core::layouts.components.kosong', [
                'icon' => 'font-icon font-icon-users',
                'judul' => $title,
                'subjudul' => __('core::general.empty', ['attribute' => $title])
            ])
        @else
            @include('core::layouts.components.kosong', [
                'icon' => 'font-icon font-icon-users',
                'judul' => $title,
                'subjudul' => __('core::general.empty', ['attribute' => $title]), 
                'tambah' => route("$prefix.create")
            ])
        @endif

    @else
        
        {!! Form::open(['method' => 'delete', 'route' => ["$prefix.destroy", 'hapus-all'], 'id' => 'submit-all']) !!}

            @if(config('pegawai.personil.lock'))
                @include('core::layouts.components.top', [
                    'judul' => $title,
                    'subjudul' => __('core::general.subtitle.index')
                ])
            @else
                @include('core::layouts.components.top', [
                    'judul' => $title,
                    'subjudul' => __('core::general.subtitle.index'),
                    'tambah' => route("$prefix.create"), 
                    'hapus' => true
                ])
            @endif

            <div class="card">
                <div class="card-block table-responsive">
                    <table id="datatable" class="display table table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="table-check"></th>
                                <th>{{ __('pegawai::table.personil.name') }}</th>
                                <th>{{ __('pegawai::table.personil.phone') }}</th>
                                <th>{{ __('pegawai::table.personil.email') }}</th>
                                <th>{{ __('pegawai::table.personil.golongan') }}</th>
                                <th>{{ __('pegawai::table.personil.field') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            
        {!! Form::close() !!}
    @endif
@endsection
