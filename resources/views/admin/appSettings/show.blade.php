@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.appSetting.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.app-settings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.appSetting.fields.id') }}
                        </th>
                        <td>
                            {{ $appSetting->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appSetting.fields.key') }}
                        </th>
                        <td>
                            {{ $appSetting->key }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appSetting.fields.value_english') }}
                        </th>
                        <td>
                            {{ $appSetting->value_english }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appSetting.fields.value_arabic') }}
                        </th>
                        <td>
                            {{ $appSetting->value_arabic }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appSetting.fields.value_kurdish') }}
                        </th>
                        <td>
                            {{ $appSetting->value_kurdish }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.app-settings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection