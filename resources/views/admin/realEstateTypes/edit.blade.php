@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.realEstateType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.real-estate-types.update", [$realEstateType->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name_english">{{ trans('cruds.realEstateType.fields.name_english') }}</label>
                <input class="form-control {{ $errors->has('name_english') ? 'is-invalid' : '' }}" type="text" name="name_english" id="name_english" value="{{ old('name_english', $realEstateType->name_english) }}">
                @if($errors->has('name_english'))
                    <span class="text-danger">{{ $errors->first('name_english') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.realEstateType.fields.name_english_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name_arabic">{{ trans('cruds.realEstateType.fields.name_arabic') }}</label>
                <input class="form-control {{ $errors->has('name_arabic') ? 'is-invalid' : '' }}" type="text" name="name_arabic" id="name_arabic" value="{{ old('name_arabic', $realEstateType->name_arabic) }}">
                @if($errors->has('name_arabic'))
                    <span class="text-danger">{{ $errors->first('name_arabic') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.realEstateType.fields.name_arabic_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name_kurdish">{{ trans('cruds.realEstateType.fields.name_kurdish') }}</label>
                <input class="form-control {{ $errors->has('name_kurdish') ? 'is-invalid' : '' }}" type="text" name="name_kurdish" id="name_kurdish" value="{{ old('name_kurdish', $realEstateType->name_kurdish) }}">
                @if($errors->has('name_kurdish'))
                    <span class="text-danger">{{ $errors->first('name_kurdish') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.realEstateType.fields.name_kurdish_helper') }}</span>
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