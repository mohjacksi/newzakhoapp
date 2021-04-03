@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.appSetting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.app-settings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="key">{{ trans('cruds.appSetting.fields.key') }}</label>
                <input class="form-control {{ $errors->has('key') ? 'is-invalid' : '' }}" type="text" name="key" id="key" value="{{ old('key', '') }}" required>
                @if($errors->has('key'))
                    <span class="text-danger">{{ $errors->first('key') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appSetting.fields.key_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="value_english">{{ trans('cruds.appSetting.fields.value_english') }}</label>
                <input class="form-control {{ $errors->has('value_english') ? 'is-invalid' : '' }}" type="text" name="value_english" id="value_english" value="{{ old('value_english', '') }}">
                @if($errors->has('value_english'))
                    <span class="text-danger">{{ $errors->first('value_english') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appSetting.fields.value_english_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="value_arabic">{{ trans('cruds.appSetting.fields.value_arabic') }}</label>
                <input class="form-control {{ $errors->has('value_arabic') ? 'is-invalid' : '' }}" type="text" name="value_arabic" id="value_arabic" value="{{ old('value_arabic', '') }}">
                @if($errors->has('value_arabic'))
                    <span class="text-danger">{{ $errors->first('value_arabic') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appSetting.fields.value_arabic_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="value_kurdish">{{ trans('cruds.appSetting.fields.value_kurdish') }}</label>
                <input class="form-control {{ $errors->has('value_kurdish') ? 'is-invalid' : '' }}" type="text" name="value_kurdish" id="value_kurdish" value="{{ old('value_kurdish', '') }}">
                @if($errors->has('value_kurdish'))
                    <span class="text-danger">{{ $errors->first('value_kurdish') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appSetting.fields.value_kurdish_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection