@extends('front.layouts.app')
@section('content')

<div class="">
    <div class="form-view">
        <form class="login-form" id="loginFrm" name="loginFrm" method="POST" action="{{ route('image.store') }}">
            <h3 class="form-title">{!! $title !!}</h3>
            @csrf
            <div class="form-group">
                <label for="image" class="form-label">{{ __('Choose an asset to upload:') }}</label>
                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*">
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="title" class="form-label">{{ __('Your Upload Title:') }}</label>
                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{!! old('title',$image->title) !!}" placeholder="Your Image Title" autofocus>
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">{{ __('Describe your upload:') }}</label>
                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Type a description of your upload, so that viewers know what it is.">{!! old('description',$image->description) !!}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="location" class="form-label">{{ __('Location:') }}</label>
                <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{!! old('location',$image->location) !!}" placeholder="Enter a city name">
                @error('location')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="location" class="form-label">{{ __('Tags:') }}</label>
                <input type="text" class="form-control" name="tags" id="tags" value="{!! old('tags') !!}">
                @error('tags')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-outline-gredient mb-3">
                    {{ __('Pay and Upload Image') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
@section('js')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script>
$('#tags').tagsinput({
    maxTags: 10
});
</script>
@stop
