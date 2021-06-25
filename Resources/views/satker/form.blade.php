<div class="box-typical-body padding-panel">
	<div class="row">
		<div class="col-sm-12">
			<fieldset class="form-group {{ $errors->first('label', 'form-group-error') }}">
			    <label for="label" class="form-label">
			    	{!! __('pegawai::form.satker.label.label') !!} <span class="color-red">*</span>
			    </label>
			    <div class="form-control-wrapper">
			        {!! Form::text('label', null, ['class' => 'form-control', 'placeholder' => __('pegawai::form.satker.label.placeholder')]) !!}
			        {!! $errors->first('label', '<span class="text-muted"><small>:message</small></span>') !!}
			    </div>
			</fieldset>
		</div>
		<div class="col-sm-6">
			<fieldset class="form-group">
			    <label for="id_parent" class="form-label">
			    	{!! __('pegawai::form.satker.atasan.label') !!}
			    </label>
			    <div class="form-control-wrapper">
			        <select class="select2" name="id_parent" required="required">
			            <option value="0">{!! __('pegawai::form.satker.atasan.placeholder') !!}</option>
			            @foreach(Modules\Pegawai\Entities\Satker::all() as $temp)
			                <option value="{{ $temp->id }}"
			                	@if(isset($edit))
			                		@if($edit->id_parent == $temp->id)
			                			selected="selected" 
			                		@endif
			                	@endif
			                >{{ $temp->label }}</option>
			            @endforeach
			        </select>
			    </div>
			</fieldset>
		</div>
		<div class="col-sm-6">
			<fieldset class="form-group {{ $errors->first('jabatan', 'form-group-error') }}">
			    <label for="jabatan" class="form-label">
			    	{!! __('pegawai::form.satker.jabatan.label') !!} <span class="color-red">*</span>
			    </label>
			    <div class="form-control-wrapper">
			        {!! Form::text('jabatan', null, ['class' => 'form-control', 'placeholder' => __('pegawai::form.satker.jabatan.placeholder')]) !!}
			        {!! $errors->first('jabatan', '<span class="text-muted"><small>:message</small></span>') !!}
			    </div>
			</fieldset>
		</div>
		<div class="col-sm-12">
			<fieldset class="form-group">
				<div class="form-control-wrapper">
					<div class="checkbox-toggle -large">
						{!! Form::checkbox('status_layanan', 1, null, ['id' => 'status_layanan']) !!}
						{!! Form::label('status_layanan', __('pegawai::form.satker.tupoksi.active'), ['class' => 'form-label']) !!}
					</div>
					<p class="small">{!! __('pegawai::form.satker.tupoksi.note') !!}</p>
				</div>
			</fieldset>
		</div>
	</div>

	<fieldset class="form-group {{ $errors->first('tupoksi', 'form-group-error') }}">
		<label for="tupoksi" class="form-label">
			{!! __('pegawai::form.satker.tupoksi.label') !!}
		</label>
		<div class="form-control-wrapper">
			{!! Form::textarea('tupoksi', null, ['class' => 'tinymce']) !!}
			{!! $errors->first('tupoksi', '<span class="text-muted"><small>:message</small></span>') !!}
		</div>
	</fieldset>
</div>