@extends('front.layouts.app')
@section('content')

<div class="page-title">
    <h4>{!! $title !!}</h3>
</div>
<form class="upload-img-form" id="loginFrm" name="loginFrm" method="POST" action="{{ route('image.store') }}">
    <div class="upload-img-container">
        <div class="upload-view">
            <div class="img-box">
                <div class="circle">
                    <img class="profile-pic" src="{{ asset('assets/common/images/no-img.png') }}" alt="uploaded-img"/>
                </div>
                <div class="p-image">
                    <div class="upload-button">Choose an asset to upload <i class="fas fa-pen"></i></div>
                    <input id="image" class="file-upload @error('image') is-invalid @enderror" name="image" type="file" accept="image/*" />
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-view">
            @csrf
            {{-- <div class="form-group">
                <label for="image" class="form-label">{{ __('Choose an asset to upload:') }}</label>
                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*">
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div> --}}

            <div class="form-group">
                <label for="title" class="form-label mb-0">{{ __('Your Upload Title:') }}</label>
                <input id="title" type="text" class="form-control one-line @error('title') is-invalid @enderror" name="title" value="{!! old('title',$image->title) !!}" placeholder="Your Image Title" autofocus>
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
                {{-- <label for="location" class="form-label">{{ __('Tags:') }}</label> --}}
                <input type="text" name="tags" id="tags" value="{!! old('tags') !!}" placeholder="tags here">
                @error('tags')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <p class="input-info">Enter up to 10 tags so people can find your upload. Separate each with a comma and a space.</p>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-black">
                    {{ __('Pay and Upload Image') }}
                </button>
            </div>
        </div>
    </div>
</form>
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
<script>
    $(document).ready(function () {
        var readURL = function (input) {
            if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(".profile-pic").attr("src", e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
            }
        };

        $(".file-upload").on("change", function () {
            readURL(this);
        });

        $(".upload-button").on("click", function () {
            $(".file-upload").click();
        });
    });

</script>
@stop
