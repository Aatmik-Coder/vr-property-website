@extends('front.layouts.app')
@section('content')

<div class="page-title">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4>{!! $title !!}</h3>
        </div>
        <div class="col-sm-6 text-end">
            <button type="button" class="btn btn-dark">Delete Selected <i class="fas fa-trash-can ms-1"></i></button>
        </div>
        <div class="col-sm-6 mt-4">
            <select name="#" id="#" class="form-select">
                <option value="1">All Uploads</option>
                <option value="2">One</option>
                <option value="3">Two</option>
                <option value="4">Three</option>
                <option value="5">Four</option>
            </select>
        </div>
        <div class="col-sm-6 text-end mt-4">
            <div class="sort-group">
                <label for="sort">Sort by:</label>
                <div class="select-wrap">
                    <select class="form-select">
                        <option selected>Date</option>
                        <option value="1">Month</option>
                        <option value="2">Year</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="my-imgs-container">
    <label class="my-imgs-label">Active Images</label>
    <div class="gallery-container">
        <div class="row gallery-container">
            <div class="col">
                <div class="myImgsBox" for="flexCheckDefault1">
                    <img alt="layers of blue." class="w-100" src="{{ asset('assets/common/images/g-img1.png') }}" />
                    <input class="form-check-input" type="checkbox" id="flexCheckDefault1">
                    <div class="content">
                        <h6>Business card: 001</h6>
                        <p>30/12/22</p>
                        <p>Expires in 10 days</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="myImgsBox">
                    <img alt="layers of blue." class="w-100" src="{{ asset('assets/common/images/g-img2.png') }}" />
                    <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                    <div class="content">
                        <h6>Business card: 001</h6>
                        <p>30/12/22</p>
                        <p>Expires in 10 days</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="myImgsBox">
                    <img alt="layers of blue." class="w-100" src="{{ asset('assets/common/images/g-img3.png') }}" />
                    <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                    <div class="content">
                        <h6>Business card: 001</h6>
                        <p>30/12/22</p>
                        <p>Expires in 10 days</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="myImgsBox">
                    <img alt="layers of blue." class="w-100" src="{{ asset('assets/common/images/g-img4.png') }}" />
                    <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                    <div class="content">
                        <h6>Business card: 001</h6>
                        <p>30/12/22</p>
                        <p>Expires in 10 days</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="myImgsBox">
                    <img alt="layers of blue." class="w-100" src="{{ asset('assets/common/images/g-img5.png') }}" />
                    <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                    <div class="content">
                        <h6>Business card: 001</h6>
                        <p>30/12/22</p>
                        <p>Expires in 10 days</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <label class="my-imgs-label">Inactive Images <span>(Images deleted after 28 days of inactivity)</span></label>
    <div class="gallery-container">
        <div class="row gallery-container">
            <div class="col">
                <div class="myImgsBox">
                    <img alt="layers of blue." class="w-100" src="{{ asset('assets/common/images/g-img6.png') }}" />
                    <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                    <div class="content">
                        <h6>Business card: 001</h6>
                        <p>30/12/22</p>
                        <p>Expires in 10 days</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="myImgsBox">
                    <img alt="layers of blue." class="w-100" src="{{ asset('assets/common/images/g-img7.png') }}" />
                    <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                    <div class="content">
                        <h6>Business card: 001</h6>
                        <p>30/12/22</p>
                        <p>Expires in 10 days</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="myImgsBox">
                    <img alt="layers of blue." class="w-100" src="{{ asset('assets/common/images/g-img8.png') }}" />
                    <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                    <div class="content">
                        <h6>Business card: 001</h6>
                        <p>30/12/22</p>
                        <p>Expires in 10 days</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="myImgsBox">
                    <img alt="layers of blue." class="w-100" src="{{ asset('assets/common/images/g-img9.png') }}" />
                    <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                    <div class="content">
                        <h6>Business card: 001</h6>
                        <p>30/12/22</p>
                        <p>Expires in 10 days</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="myImgsBox">
                    <img alt="layers of blue." class="w-100" src="{{ asset('assets/common/images/g-img10.png') }}" />
                    <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                    <div class="content">
                        <h6>Business card: 001</h6>
                        <p>30/12/22</p>
                        <p>Expires in 10 days</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="gallery-container" id="myActiveImgs">
        <a data-lg-size="1600-1067" class="gallery-item" data-src="{{ asset('assets/common/images/g-img1.png') }}">
            <img alt="layers of blue." class="img-responsive" src="{{ asset('assets/common/images/g-img1.png') }}" />
            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
            <div class="content">
                <h6>Business card: 001</h6>
                <p>30/12/22</p>
                <p>Expires in 10 days</p>
            </div>
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
    </div> --}}
</div>

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lightgallery.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lg-zoom.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/justifiedGallery@3.8.1/dist/css/justifiedGallery.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lg-thumbnail.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
@stop
@section('js')

{{-- START IMAGE GALLERY JS --}}
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/lightgallery.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/plugins/zoom/lg-zoom.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/justifiedGallery@3.8.1/dist/js/jquery.justifiedGallery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/plugins/thumbnail/lg-thumbnail.umd.js"></script>
<script  src="https://cdpn.io/cpe/boomboom/pen.js?key=pen.js-b74d9ab5-00d9-9cf5-a933-7d39452ea19d" crossorigin></script>
{{-- START IMAGE GALLERY JS --}}
<script>
    jQuery("#myActiveImgs")
  .justifiedGallery({
    captions: false,
    lastRow: "hide",
    rowHeight: 270,
    margins: 15
  })
  .on("jg.complete", function () {
    window.lightGallery(
      document.getElementById("myActiveImgs"),
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

