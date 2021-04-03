@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.realEstateType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.real-estate-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstateType.fields.id') }}
                        </th>
                        <td>
                            {{ $realEstateType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstateType.fields.name_english') }}
                        </th>
                        <td>
                            {{ $realEstateType->name_english }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstateType.fields.name_arabic') }}
                        </th>
                        <td>
                            {{ $realEstateType->name_arabic }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstateType.fields.name_kurdish') }}
                        </th>
                        <td>
                            {{ $realEstateType->name_kurdish }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.real-estate-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#type_real_estates" role="tab" data-toggle="tab">
                {{ trans('cruds.realEstate.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="type_real_estates">
            @includeIf('admin.realEstateTypes.relationships.typeRealEstates', ['realEstates' => $realEstateType->typeRealEstates])
        </div>
    </div>
</div>

@endsection