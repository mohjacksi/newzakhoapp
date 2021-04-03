@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.realEstate.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.real-estates.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title_english">{{ trans('cruds.realEstate.fields.title_english') }}</label>
                <input class="form-control {{ $errors->has('title_english') ? 'is-invalid' : '' }}" type="text" name="title_english" id="title_english" value="{{ old('title_english', '') }}">
                @if($errors->has('title_english'))
                    <span class="text-danger">{{ $errors->first('title_english') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.title_english_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="title_arabic">{{ trans('cruds.realEstate.fields.title_arabic') }}</label>
                <input class="form-control {{ $errors->has('title_arabic') ? 'is-invalid' : '' }}" type="text" name="title_arabic" id="title_arabic" value="{{ old('title_arabic', '') }}">
                @if($errors->has('title_arabic'))
                    <span class="text-danger">{{ $errors->first('title_arabic') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.title_arabic_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="title_kurdish">{{ trans('cruds.realEstate.fields.title_kurdish') }}</label>
                <input class="form-control {{ $errors->has('title_kurdish') ? 'is-invalid' : '' }}" type="text" name="title_kurdish" id="title_kurdish" value="{{ old('title_kurdish', '') }}">
                @if($errors->has('title_kurdish'))
                    <span class="text-danger">{{ $errors->first('title_kurdish') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.title_kurdish_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description_english">{{ trans('cruds.realEstate.fields.description_english') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description_english') ? 'is-invalid' : '' }}" name="description_english" id="description_english">{!! old('description_english') !!}</textarea>
                @if($errors->has('description_english'))
                    <span class="text-danger">{{ $errors->first('description_english') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.description_english_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description_arabic">{{ trans('cruds.realEstate.fields.description_arabic') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description_arabic') ? 'is-invalid' : '' }}" name="description_arabic" id="description_arabic">{!! old('description_arabic') !!}</textarea>
                @if($errors->has('description_arabic'))
                    <span class="text-danger">{{ $errors->first('description_arabic') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.description_arabic_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description_kurdish">{{ trans('cruds.realEstate.fields.description_kurdish') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description_kurdish') ? 'is-invalid' : '' }}" name="description_kurdish" id="description_kurdish">{!! old('description_kurdish') !!}</textarea>
                @if($errors->has('description_kurdish'))
                    <span class="text-danger">{{ $errors->first('description_kurdish') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.description_kurdish_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.realEstate.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                @if($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="type_id">{{ trans('cruds.realEstate.fields.type') }}</label>
                <select class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type_id" id="type_id">
                    @foreach($types as $id => $type)
                        <option value="{{ $id }}" {{ old('type_id') == $id ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photos">{{ trans('cruds.realEstate.fields.photos') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photos') ? 'is-invalid' : '' }}" id="photos-dropzone">
                </div>
                @if($errors->has('photos'))
                    <span class="text-danger">{{ $errors->first('photos') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.photos_helper') }}</span>
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

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/admin/real-estates/ckmedia', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $realEstate->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    var uploadedPhotosMap = {}
Dropzone.options.photosDropzone = {
    url: '{{ route('admin.real-estates.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
      uploadedPhotosMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotosMap[file.name]
      }
      $('form').find('input[name="photos[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($realEstate) && $realEstate->photos)
      var files = {!! json_encode($realEstate->photos) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection