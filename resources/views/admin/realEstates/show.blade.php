@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.realEstate.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.real-estates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.id') }}
                        </th>
                        <td>
                            {{ $realEstate->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.title_english') }}
                        </th>
                        <td>
                            {{ $realEstate->title_english }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.title_arabic') }}
                        </th>
                        <td>
                            {{ $realEstate->title_arabic }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.title_kurdish') }}
                        </th>
                        <td>
                            {{ $realEstate->title_kurdish }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.description_english') }}
                        </th>
                        <td>
                            {!! $realEstate->description_english !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.description_arabic') }}
                        </th>
                        <td>
                            {!! $realEstate->description_arabic !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.description_kurdish') }}
                        </th>
                        <td>
                            {!! $realEstate->description_kurdish !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.price') }}
                        </th>
                        <td>
                            {{ $realEstate->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.type') }}
                        </th>
                        <td>
                            {{ $realEstate->type->name_english ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.photos') }}
                        </th>
                        <td>
                            @foreach($realEstate->photos as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.real-estates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection