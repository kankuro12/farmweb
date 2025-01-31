@extends('user.components.app')
@section('title', 'Gallery')
@section('content')
    <main>
        @php

            $data = App\Helper::getOtherPageSetting();
        @endphp

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area d-flex  p-relative align-items-center"
            style="background-image:url({{ Storage::url($data->g_image) }})">

            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-12 col-lg-12">
                        <div class="breadcrumb-wrap text-left">
                            <div class="breadcrumb-title">
                                <h2>Our Gallery</h2>
                                <div class="breadcrumb-wrap">

                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Our Gallery</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->
        <!-- gallery-area -->
        <section id="portfolio" class="pt-120 pb-90">
            <div class="container">
                <div class="portfolio">
                    <div class="row align-items-end mb-50">
                        <div class="col-lg-12">
                            <div class="my-masonry text-center wow fadeInRight animated" data-animation="fadeInRight"
                                data-delay=".4s">
                                <div class="button-group filter-button-group">
                                    <button class="active" data-filter="*">View All</button>
                                    @foreach ($galleryTypes as $galleryType)
                                        <button data-filter=".{{ Str::slug($galleryType->title) }}">{{ $galleryType->title }}</button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid col3 wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                        @foreach ($galleryTypes as $galleryType)
                            @foreach ($galleryItems[$galleryType->id] as $item)
                                <div class="grid-item {{ Str::slug($galleryType->title) }}">
                                    <a href="single-projects.html">
                                        <figure class="gallery-image">
                                            @if ($item->youtube_url)
                                                @php
                                                    // Extract video ID from YouTube watch URL
                                                    $videoId = '';
                                                    parse_str(parse_url($item->youtube_url, PHP_URL_QUERY), $params);
                                                    if (isset($params['v'])) {
                                                        $videoId = $params['v'];
                                                    }
                                                @endphp
                                                <div class="video-wrapper">
                                                    <iframe class="iframe-video" height="280px;" style="padding: 0;" src="https://www.youtube.com/embed/{{ $videoId }}" allowfullscreen></iframe>
                                                </div>
                                            @elseif ($item->image)
                                                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" class="img">
                                            @endif
                                        </figure>
                                    </a>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- gallery-area-end -->


    </main>
@endsection
