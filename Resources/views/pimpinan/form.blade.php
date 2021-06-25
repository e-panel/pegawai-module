<div class="box-typical-body padding-panel">
	<div class="row">
		<div class="col-sm-9">
			<div class="row">
				<div class="col-sm-5">
					<fieldset class="form-group {{ $errors->first('nama', 'form-group-error') }}">
						<label for="nama" class="form-label">
							{!! __('pegawai::form.pimpinan.nama.label') !!} <span class="color-red">*</span>
						</label>
						<div class="form-control-wrapper">
							{!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => __('pegawai::form.pimpinan.nama.placeholder')]) !!}
							{!! $errors->first('nama', '<span class="text-muted"><small>:message</small></span>') !!}
						</div>
					</fieldset>
				</div>
				<div class="col-sm-7">
					<fieldset class="form-group {{ $errors->first('periode', 'form-group-error') }}">
						<label for="periode" class="form-label">
							{!! __('pegawai::form.pimpinan.periode.label') !!} <span class="color-red">*</span>
						</label>
						<div class="form-control-wrapper">
							{!! Form::text('periode', null, ['class' => 'form-control', 'placeholder' => __('pegawai::form.pimpinan.periode.placeholder')]) !!}
							{!! $errors->first('periode', '<span class="text-muted"><small>:message</small></span>') !!}
						</div>
					</fieldset>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-5">
					<fieldset class="form-group {{ $errors->first('mulai_jabatan', 'form-group-error') }}">
						<label for="mulai_jabatan" class="form-label">
							{!! __('pegawai::form.pimpinan.mulai.label') !!} <span class="color-red">*</span>
						</label>
						<div class="form-control-wrapper">
							{!! Form::text('mulai_jabatan', null, ['class' => 'form-control', 'placeholder' => __('pegawai::form.pimpinan.mulai.placeholder')]) !!}
							{!! $errors->first('mulai_jabatan', '<span class="text-muted"><small>:message</small></span>') !!}
						</div>
					</fieldset>
				</div>
				<div class="col-sm-7">
					<fieldset class="form-group {{ $errors->first('akhir_jabatan', 'form-group-error') }}">
						<label for="akhir_jabatan" class="form-label">
							{!! __('pegawai::form.pimpinan.akhir.label') !!} <span class="color-red">*</span>
						</label>
						<div class="form-control-wrapper">
							{!! Form::text('akhir_jabatan', null, ['class' => 'form-control', 'placeholder' => __('pegawai::form.pimpinan.akhir.placeholder')]) !!}
							{!! $errors->first('akhir_jabatan', '<span class="text-muted"><small>:message</small></span>') !!}
						</div>
					</fieldset>
				</div>
			</div>
			
			<fieldset class="form-group">
				<div class="form-control-wrapper">
					<div class="checkbox-toggle -large">
						{!! Form::checkbox('aktif', 1, null, ['id' => 'aktif']) !!}
						{!! Form::label('aktif', __('pegawai::form.pimpinan.aktif.label'), ['class' => 'form-label']) !!}
					</div>
					<p class="small">{!! __('pegawai::form.pimpinan.aktif.placeholder') !!}</p>
				</div>
			</fieldset>
		</div>
		<div class="col-sm-3">
			<fieldset class="form-group {{ $errors->first('foto', 'form-group-error') }}">
				<label for="foto" class="form-label">
					{!! __('pegawai::form.personil.photo.label') !!}
				</label>
				<div class="fileinput fileinput-new" data-provides="fileinput">
					<div class="fileinput-new thumbnail" style="width: 200px; height: 250px;">
						@if(!isset($edit))
							<img data-src="holder.js/400x600/auto" alt="...">
						@else
							<img src="{{ viewImg($edit->foto) }}" alt="{{ $edit->judul }}">
						@endif
					</div>
					<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 250px;"></div>
					<div>
						<span class="btn btn-default btn-file">
							<span class="fileinput-new">{!! __('pegawai::form.personil.photo.select') !!}</span>
							<span class="fileinput-exists">{!! __('pegawai::form.personil.photo.change') !!}</span>
							{!! Form::file('foto', ['class' => 'form-control', 'accept' => 'image/*']) !!}
						</span>
						<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">{!! __('pegawai::form.personil.photo.remove') !!}</a>
					</div>
					{!! $errors->first('foto', '<span class="text-muted"><small>:message</small></span>') !!}
				</div>
			</fieldset>
		</div>
	</div>
</div>