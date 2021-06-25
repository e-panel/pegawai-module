@extends('core::page.plugin')
@section('inner-title', "$detail->nama - ")
@section('mPimpinan', 'opened')

@section('content')
    <section class="box-typical">

        @include('core::layouts.components.top', [
            'judul' => $detail->nama,
            'subjudul' => 'Kelola detail profil lengkap pimpinan berikut.',
            'kembali' => route("$prefix.index")
        ])

        <div class="card">
            <div class="box-typical-body padding-panel">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(['route' => ["$prefix.profile.store", $detail->uuid], 'autocomplete' => 'off']) !!}
                            <fieldset class="form-group {{ $errors->first('nama', 'form-group-error') }}">
                                {!! Form::text('nama', $detail->nama, ['class' => 'form-control', 'readonly']) !!}
                                {!! $errors->first('nama', '<span class="text-muted"><small>:message</small></span>') !!}
                            </fieldset>
                            <fieldset class="form-group {{ $errors->first('sambutan', 'form-group-error') }}">
                                <label for="sambutan" class="form-label">Quote <span class="color-red">*</span></label>
                                {!! Form::textarea('sambutan', $detail->sambutan, ['class' => 'form-control', 'rows' => 5]) !!}
                                {!! $errors->first('sambutan', '<span class="text-muted"><small>:message</small></span>') !!}
                            </fieldset>
                            <button type="submit" class="btn btn-rounded btn-primary pull-right">Simpan</button>
                            {!! Form::hidden('purpose', 'overview') !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-6">

                        {!! Form::open(['route' => ["$prefix.profile.store", $detail->uuid], 'autocomplete' => 'off']) !!}
                            <h5>
                                <i class="font-icon font-icon-learn"></i> <b>Pendidikan</b>
                                <a href="#" class="btn btn-sm pull-right btn-default" id="addPendidikan">
                                    <i class="fa fa-plus"></i> TAMBAH
                                </a>
                            </h5>
                            <table class="table table-xs">
                                <tbody id="itemsPendidikan">
                                    @foreach($detail->pendidikan as $temp)
                                    <tr>
                                        <td>
                                            <div class="form-control-wrapper">
                                                {!! Form::text('pendidikan[]', $temp->label, ['class' => 'form-control']) !!}
                                                {!! $errors->first('pendidikan[]', '<div class="form-tooltip-error sm">:message</div>') !!}
                                            </div>
                                        </td>
                                        </td><td><a class="delete"><i class="font-icon font-icon-del"></i></a></div></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-rounded btn-primary pull-right">Simpan</button>
                            {!! Form::hidden('purpose', 'pendidikan') !!}
                        {!! Form::close() !!}

                    </div>
                    <div class="col-md-6">
                        {!! Form::open(['route' => ["$prefix.profile.store", $detail->uuid], 'autocomplete' => 'off']) !!}
                            <h5>
                                <i class="font-icon font-icon-zigzag"></i> <b>Karir</b>
                                <a href="#" class="btn btn-sm pull-right btn-default" id="addKarir">
                                    <i class="fa fa-plus"></i> TAMBAH
                                </a>
                            </h5>
                            <table class="table table-xs">
                                <tbody id="items">
                                    @forelse($detail->karir as $temp)
                                    <tr>
                                        <td width="30%">
                                            <div class="form-control-wrapper">
                                                {!! Form::text('periode[]', $temp->periode, ['class' => 'form-control', 'placeholder' => 'Periode', 'required']) !!}
                                            </div>
                                        </td>
                                        <td width="70%">
                                            <div class="form-control-wrapper">
                                                {!! Form::text('label[]', $temp->label, ['class' => 'form-control', 'placeholder' => 'Jabatan', 'required']) !!}
                                            </div>
                                        </td>
                                        </td><td><a class="delete"><i class="font-icon font-icon-del"></i></a></div></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td width="30%">
                                            <div class="form-control-wrapper">
                                                {!! Form::text('periode[]', null, ['class' => 'form-control', 'placeholder' => 'Periode', 'required']) !!}
                                            </div>
                                        </td>
                                        <td width="70%">
                                            <div class="form-control-wrapper">
                                                {!! Form::text('label[]', null, ['class' => 'form-control', 'placeholder' => 'Jabatan', 'required']) !!}
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-rounded btn-primary pull-right">Simpan</button>
                            {!! Form::hidden('purpose', 'karir') !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(function() {
            $("#addKarir").click(function (e) {
                var $div = $('<tr>'+
                    '<td>'+
                        '<div class="form-control-wrapper">'+
                            '{!! Form::text("periode[]", null, ["class" => "form-control", "placeholder" => "Periode", "required"]) !!}'+
                        '</div>'+
                    '</td>'+
                    '<td>'+
                        '<div class="form-control-wrapper">'+
                            '{!! Form::text("label[]", null, ["class" => "form-control", "placeholder" => "Jabatan", "required"]) !!}'+
                        '</div>'+
                    '</td>'+
                    '</td><td><a class="delete"><i class="font-icon font-icon-del"></i></a></div></td>'+
                '</tr>');
                $("#items").append($div);
            });
            $("#addPendidikan").click(function (e) {
                var $div = $('<tr>'+
                    '<td>'+
                        '<div class="form-control-wrapper">'+
                            '{!! Form::text("pendidikan[]", null, ["class" => "form-control"]) !!}'+
                        '</div>'+
                    '</td>'+
                    '</td><td><a class="delete"><i class="font-icon font-icon-del"></i></a></div></td>'+
                '</tr>');
                $("#itemsPendidikan").append($div);
            });
            $("body").on("click", ".delete", function (e) {
                $(this).parent().parent().remove();
            });
        });
    </script>
@endsection