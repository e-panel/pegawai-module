@extends('core::page.plugin')
@section('inner-title', "$title - ")
@section('mPimpinan', 'opened')

@section('css')
    @include('core::layouts.partials.datatables')
@endsection

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
                    { data: 'foto', name: 'foto', className: 'table-photo' },
                    { data: 'nama', name: 'nama' },
                    { data: 'mulai_jabatan', name: 'mulai_jabatan' },
                    { data: 'akhir_jabatan', name: 'akhir_jabatan' },
                    { data: 'tanggal', name: 'tanggal', className: 'table-date small' },
                    { data: 'aktif', name: 'aktif' },
                    { data: 'aksi', name: 'aksi', className: 'tombol', orderable: false, searchable: false }
                ],
                "fnDrawCallback": function( oSettings ) {
                    @include('core::layouts.components.callback')
                }
            });
        });
        @include('core::layouts.components.hapus')
    </script>
@endsection

@section('content')

    @if(!$data->count())

        @include('core::layouts.components.kosong', [
            'icon' => 'font-icon font-icon-build',
            'judul' => $title,
            'subjudul' => __('core::general.empty', ['attribute' => $title]), 
            'tambah' => route("$prefix.create")
        ])

    @else
        
        {!! Form::open(['method' => 'delete', 'route' => ["$prefix.destroy", 'hapus-all'], 'id' => 'submit-all']) !!}

            @include('core::layouts.components.top', [
                'judul' => $title,
                'subjudul' => __('core::general.subtitle.index'),
                'tambah' => route("$prefix.create"), 
                'hapus' => true
            ])

            <div class="card">
                <div class="card-block table-responsive">
                    <table id="datatable" class="display table table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="table-check"></th>
                                <th></th>
                                <th>{{ __('pegawai::table.pimpinan.biodata') }}</th>
                                <th width="20%"></th>
                                <th width="20%"></th>
                                <th width="5%"></th>
                                <th width="1"></th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            
        {!! Form::close() !!}
    @endif
@endsection
