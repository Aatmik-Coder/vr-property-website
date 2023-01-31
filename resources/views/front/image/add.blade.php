@extends('front.layouts.app')
@section('content')

<h3 class="form-title">{!! $title !!}</h3>
@csrf
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
    <input type="text" class="form-control p-4" name="tags" id="tags">
    @error('tags')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

@endsection
@section('js')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet">
<style type="text/css">
.bootstrap-tagsinput .tag {
    margin-right: 2px;
    color: white !important;
    background-color: #0d6efd;
    padding: 0.2rem;
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script>
$('#tags').tagsinput({
    maxTags: 10
});
</script>
@stop
