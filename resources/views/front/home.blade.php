@extends('front.layouts.app')
@section('content')

<div class="search-sec">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
        <button class="btn btn-dark" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
    </div>
</div>

<div class="ad-black">
    <div class="ad-box">
        <p>Ad Space</p>
    </div>
</div>

<div class="sort-view">
    <div class="container">
        <div class="sort-group">
            <label for="sort">Sort by:</label>
            <div class="select-wrap">
                <select class="form-select">
                    <option selected>Most Recent</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="image-gallery-sec">
    <div class="container">
        <div class="gallery-container" id="animated-thumbnails-gallery">
            <a data-lg-size="1600-1067" class="gallery-item" data-src="{{ asset('assets/common/images/g-img1.png') }}">
                <img alt="layers of blue." class="img-responsive" src="{{ asset('assets/common/images/g-img1.png') }}" />
            </a>
            <a data-lg-size="1600-2400" data-pinterest-text="Pin it2" data-tweet-text="lightGallery slide  2" class="gallery-item" data-src="{{ asset('assets/common/images/g-img2.png') }}">
            <img class="img-responsive" src="{{ asset('assets/common/images/g-img2.png') }}" />
            </a>
            <a data-lg-size="1600-2400" data-pinterest-text="Pin it3" data-tweet-text="lightGallery slide  4" class="gallery-item" data-src="{{ asset('assets/common/images/g-img3.png') }}">
            <img class="img-responsive" src="{{ asset('assets/common/images/g-img3.png') }}" />
            </a>
            <a data-lg-size="1600-2398" data-pinterest-text="Pin it3" data-tweet-text="lightGallery slide  4" class="gallery-item" data-src="{{ asset('assets/common/images/g-img4.png') }}">
            <img class="img-responsive" src="{{ asset('assets/common/images/g-img4.png') }}" />
            </a>
            <a data-lg-size="1600-1067" data-pinterest-text="Pin it3" data-tweet-text="lightGallery slide  4" class="gallery-item" data-src="{{ asset('assets/common/images/g-img5.png') }}">
            <img class="img-responsive" src="{{ asset('assets/common/images/g-img5.png') }}" />
            </a>
            <a data-lg-size="1600-1067" data-pinterest-text="Pin it3" data-tweet-text="lightGallery slide  4" class="gallery-item" data-src="{{ asset('assets/common/images/g-img6.png') }}">
            <img class="img-responsive" src="{{ asset('assets/common/images/g-img6.png') }}" />
            </a>
            <a data-lg-size="1600-1126" data-pinterest-text="Pin it3" data-tweet-text="lightGallery slide  4" class="gallery-item" data-src="{{ asset('assets/common/images/g-img7.png') }}">
            <img class="img-responsive" src="{{ asset('assets/common/images/g-img7.png') }}" />
            </a>
            <a data-lg-size="1600-1063" data-pinterest-text="Pin it3" data-tweet-text="lightGallery slide  4" class="gallery-item" data-src="{{ asset('assets/common/images/g-img8.png') }}">
            <img class="img-responsive" src="{{ asset('assets/common/images/g-img8.png') }}" />
            </a>
            <a data-lg-size="1600-2400" data-pinterest-text="Pin it3" data-tweet-text="lightGallery slide  4" class="gallery-item" data-src="{{ asset('assets/common/images/g-img9.png') }}">
            <img class="img-responsive" src="{{ asset('assets/common/images/g-img9.png') }}" />
            </a>
            <a data-lg-size="1600-1144" data-pinterest-text="Pin it3" data-tweet-text="lightGallery slide  4" class="gallery-item" data-src="{{ asset('assets/common/images/g-img10.png') }}">
                <img class="img-responsive" src="{{ asset('assets/common/images/g-img10.png') }}" />
            </a>
        </div>
    </div>
</div>

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lightgallery.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lg-zoom.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/justifiedGallery@3.8.1/dist/css/justifiedGallery.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lg-thumbnail.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
@stop
<!-- JavaScript files-->
@section('js')

{{-- START IMAGE GALLERY JS --}}
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/lightgallery.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/plugins/zoom/lg-zoom.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/justifiedGallery@3.8.1/dist/js/jquery.justifiedGallery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/plugins/thumbnail/lg-thumbnail.umd.js"></script>
<script  src="https://cdpn.io/cpe/boomboom/pen.js?key=pen.js-b74d9ab5-00d9-9cf5-a933-7d39452ea19d" crossorigin></script>
{{-- START IMAGE GALLERY JS --}}
<script>
    jQuery("#animated-thumbnails-gallery")
  .justifiedGallery({
    captions: false,
    lastRow: "hide",
    rowHeight: 300,
    margins: 10
  })
  .on("jg.complete", function () {
    window.lightGallery(
      document.getElementById("animated-thumbnails-gallery"),
      {
        autoplayFirstVideo: false,
        pager: false,
        galleryId: "nature",
        plugins: [lgZoom, lgThumbnail],
        mobileSettings: {
          controls: false,
          showCloseIcon: false,
          download: false,
          rotate: false
        }
      }
    );
  });

</script>
@stop
@endsection
