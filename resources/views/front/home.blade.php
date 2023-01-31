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
        {{-- <div ID="ngy2p" data-nanogallery2='{
            "itemsBaseURL": "http://nanogallery2.nanostudio.org/samples/",
            "thumbnailWidth": "200",
            "thumbnailLabel": {
              "position": "overImageOnBottom"
            },
            "thumbnailAlignment": "center",
            "thumbnailOpenImage": true
          }'>
          <a href="{{ asset('assets/common/images/g-img1.png') }}" data-ngthumb="{{ asset('assets/common/images/g-img1.png') }}" data-ngdesc="">Berlin 1</a>
          <a href="{{ asset('assets/common/images/g-img2.png') }}" data-ngthumb="{{ asset('assets/common/images/g-img2.png') }}" data-ngdesc="">Berlin 2</a>
          <a href="{{ asset('assets/common/images/g-img3.png') }}" data-ngthumb="{{ asset('assets/common/images/g-img3.png') }}" data-ngdesc="">Berlin 3</a>
          <a href="{{ asset('assets/common/images/g-img4.png') }}" data-ngthumb="{{ asset('assets/common/images/g-img4.png') }}" data-ngdesc="">Berlin 3</a>
          <a href="{{ asset('assets/common/images/g-img5.png') }}" data-ngthumb="{{ asset('assets/common/images/g-img5.png') }}" data-ngdesc="">Berlin 3</a>
          <a href="{{ asset('assets/common/images/g-img6.png') }}" data-ngthumb="{{ asset('assets/common/images/g-img6.png') }}" data-ngdesc="">Berlin 3</a>
          <a href="{{ asset('assets/common/images/g-img7.png') }}" data-ngthumb="{{ asset('assets/common/images/g-img7.png') }}" data-ngdesc="">Berlin 3</a>
          <a href="{{ asset('assets/common/images/g-img8.png') }}" data-ngthumb="{{ asset('assets/common/images/g-img8.png') }}" data-ngdesc="">Berlin 3</a>
          <a href="{{ asset('assets/common/images/g-img9.png') }}" data-ngthumb="{{ asset('assets/common/images/g-img9.png') }}" data-ngdesc="">Berlin 3</a>
          <a href="{{ asset('assets/common/images/g-img10.png') }}" data-ngthumb="{{ asset('assets/common/images/g-img10.png') }}" data-ngdesc="">Berlin 3</a>
    
        </div> --}}
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


<!-- JavaScript files-->
@section('js')
<script src="{{ asset('assets/front/js/auth.js') }}"></script>
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