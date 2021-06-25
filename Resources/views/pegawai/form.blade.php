<div class="box-typical-body padding-panel">
	<div class="row">
		<div class="col-sm-9">
			<div class="row">
				<div class="col-sm-5">
					<fieldset class="form-group {{ $errors->first('nip', 'form-group-error') }}">
						<label for="nip" class="form-label">
							{!! __('pegawai::form.personil.nip.label') !!} <span class="color-red">*</span>
						</label>
						<div class="form-control-wrapper">
							{!! Form::text('nip', null, ['class' => 'form-control', 'placeholder' => __('pegawai::form.personil.nip.placeholder')]) !!}
							{!! $errors->first('nip', '<span class="text-muted"><small>:message</small></span>') !!}
						</div>
					</fieldset>
				</div>
				<div class="col-sm-7">
					<fieldset class="form-group {{ $errors->first('nama', 'form-group-error') }}">
						<label for="nama" class="form-label">
							{!! __('pegawai::form.personil.name.label') !!} <span class="color-red">*</span>
						</label>
						<div class="form-control-wrapper">
							{!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => __('pegawai::form.personil.name.placeholder')]) !!}
							{!! $errors->first('nama', '<span class="text-muted"><small>:message</small></span>') !!}
						</div>
					</fieldset>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-5">
					<fieldset class="form-group">
						<label for="telepon" class="form-label">
							{!! __('pegawai::form.personil.phone.label') !!}
						</label>
						<div class="form-control-wrapper">
							{!! Form::text('telepon', null, ['class' => 'form-control', 'placeholder' => __('pegawai::form.personil.phone.placeholder')]) !!}
						</div>
					</fieldset>
				</div>
				<div class="col-sm-7">
					<fieldset class="form-group">
						<label for="email" class="form-label">
							{!! __('pegawai::form.personil.email.label') !!}
						</label>
						<div class="form-control-wrapper">
							{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('pegawai::form.personil.email.placeholder')]) !!}
						</div>
					</fieldset>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-5">
					<fieldset class="form-group">
						<label for="golongan" class="form-label">
							{!! __('pegawai::form.personil.golongan.label') !!}
						</label>
						<div class="form-control-wrapper">
							{!! Form::text('golongan', null, ['class' => 'form-control', 'placeholder' => __('pegawai::form.personil.golongan.placeholder')]) !!}
						</div>
					</fieldset>
				</div>
				<div class="col-sm-7">
					<fieldset class="form-group">
						<label for="id_bidang" class="form-label">
							{!! __('pegawai::form.personil.field.label') !!}
						</label>
						<div class="form-control-wrapper">
							{!! Form::select('id_bidang', Modules\Pegawai\Entities\Satker::pluck('label', 'id'), null, ['class' => 'select2', config('pegawai.personil.lock') ? 'disabled' : '']) !!}
						</div>
					</fieldset>
				</div>
			</div>
			<fieldset class="form-group">
				<label for="alamat" class="form-label">
					{!! __('pegawai::form.personil.address.label') !!}
				</label>
				<div class="form-control-wrapper">
					{!! Form::textarea('alamat', null, ['class' => 'form-control', 'rows' => 3]) !!}
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