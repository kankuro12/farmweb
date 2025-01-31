@extends('user.components.app')
@section('title', 'Home')

@section('content')


    <main>
        @php
            $data = App\Helper::getHomePageSetting();
            $adata = App\Helper::getAboutPageSettings();
            $sdata = App\Helper::getServicePageSetting();

            function getYouTubeThumbnail($url)
            {
                // Parse the URL to get the query parameters
                parse_str(parse_url($url, PHP_URL_QUERY), $params);

                // Get the video ID
                $videoId = $params['v'] ?? null;

                if ($videoId) {
                    // Construct the thumbnail URL
                    $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
                    return $thumbnailUrl;
                }

                return null;
            }

            $videoUrl = $data->videourl; // Assuming $data->videourl contains the YouTube URL
            $thumbnailUrl = getYouTubeThumbnail($videoUrl);

        @endphp




        <!-- slider-area -->
        <section id="parallax" class="slider-area slider-two fix p-relative">
            <div class="slider-shape ss-four layer" data-depth="0.40">
                <img src="img/bg/slider_shape04.png" alt="shape">
            </div>
            <div class="slider-active">
                @foreach ($sliders as $slider)
                    @php
                        $backgroundStyle = '';
                        $content = '';

                        if ($slider->youtubeurl) {
                            // Extract video ID from YouTube watch URL
                            $videoId = '';
                            parse_str(parse_url($slider->youtubeurl, PHP_URL_QUERY), $params);
                            if (isset($params['v'])) {
                                $videoId = $params['v'];
                            }
                            $content =
                                '<div class="video-background">
                                    <div class="video-foreground">
                                        <iframe src="https://www.youtube.com/embed/' .
                                $videoId .
                                '?autoplay=1&mute=1&loop=1&playlist=' .
                                $videoId .
                                '" frameborder="5" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                    </div>
                                </div>';
                        } elseif ($slider->image) {
                            $backgroundStyle =
                                "background: url('" .
                                asset('slider_images/' . $slider->image) .
                                "') no-repeat; background-size: cover; background-position: center;";
                        }
                    @endphp

                    <div class="single-slider slider-bg slider-bg2 d-flex align-items-center" style="{{ $backgroundStyle }}">
                        <div class="container">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-lg-7 col-md-8">
                                    <div class="slider-content s-slider-content pt-100">
                                        <h5 data-animation="fadeInUp" data-delay=".4s">{{ $slider->subtitle }}</h5>
                                        <h2 data-animation="fadeInUp" data-delay=".4s">{{ $slider->title }}</h2>

                                        <div class="slider-btn mb-200">
                                            <a href="{{ $slider->button_link }}" class="btn mr-15" data-animation="fadeInUp"
                                                data-delay=".4s">
                                                {{ $slider->button_text }} <i class="fal fa-long-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-4">
                                    @if ($slider->youtubeurl)
                                        <div class="video-container">
                                            {!! $content !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>


        <!-- slider-area-end -->
        <!-- service-area -->
        <section class="service-details-three p-relative fix">
            <div class="container">
                <div class="row sbox">
                    @foreach ($features as $feature)
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="services-box mb-30 text-center wow fadeInUp animated" data-animation="fadeInUp"
                                data-delay=".4s">

                                <div class="sr-contner">
                                    <div class="icon">
                                        <img src="{{ asset('blog_images/' . $feature->image1) }}"
                                            alt="{{ $feature->title }}">
                                    </div>
                                    <div class="text">
                                        <h3> <a href="services.html">{{ $feature->title }}</a> </h3>
                                    </div>
                                </div>


                            </div>
                        </div>
                    @endforeach




                </div>
            </div>
        </section>
        <!-- service-details2-area-end -->
        <!-- about-area -->
        <section class="about-area about-p pt-120 pb-120 p-relative fix">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-5 col-md-12 col-sm-12">
                        <div class="about-content s-about-content  wow fadeInRight  animated" data-animation="fadeInRight"
                            data-delay=".4s">
                            <div class="about-title second-title pb-25">
                                <h5>About Us</h5>
                                <h2>{{ $adata->heading1 }}</h2>
                            </div>
                            <p style="text-align: justify;">{{ $adata->desc1 }}
                            </p>


                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12 col-sm-12">
                        <div class="s-about-img p-relative  wow fadeInLeft animated" data-animation="fadeInLeft"
                            data-delay=".4s">
                            <img src="{{ asset($adata->aboutimage1) }}" alt="img">

                            <div class="about-text second-about">
                                <img src="img/features/about-play.png" alt="img">
                            </div>
                        </div>

                    </div>



                </div>
            </div>
        </section>
        <!-- about-area-end -->
        <!-- services-five-area -->
        <section id="services-05" class="services-05 pt-120 pb-100 p-relative fix"
            style="background: url(img/bg/services-bg.png); background-repeat: no-repeat;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="section-title center-align mb-20">
                            <h5>Quick Links</h5>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 text-right  d-none d-lg-block">

                    </div>
                    <div class="col-lg-12">
                        <div class="services">
                            <div class="row">
                                @foreach ($data->quick_links as $link)
                                    <div class="col-lg-3 col-md-6">
                                        <div class="services-box-05 wow fadeInUp animated" data-animation="fadeInUp"
                                            data-delay=".4s">
                                            <a href="{{ $link['url'] }}" class="quick-link-item">
                                                <div class="image-container"
                                                    style="background: url(img/bg/services-bg.png); no-repeat center center;">
                                                    <div class="overlay"></div>
                                                    <div class="text-overlay">
                                                        <h4>{{ $link['title'] }}</h4>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>





                </div>
            </div>
        </section>
        <!-- services-three-area -->
        <!-- steps-area -->
        <section class="steps-area p-relative pb-120">
            <div class="container">

                <div class="row align-items-center">

                    <div class="col-lg-6 col-md-12">
                        <div class="wow fadeInLeft animated" data-animation="fadeInLeft" data-delay=".4s">
                            <img src="{{ asset($adata->aboutimage2) }}" alt="class image">
                        </div>

                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="pl-60">
                            <div class="section-title mb-50 wow fadeInDown animated" data-animation="fadeInDown"
                                data-delay=".4s">
                                <h5>{{ $adata->heading2 }}</h5>
                                <h2>{{ $adata->desc2 }}</h2>
                            </div>

                            <ul>
                                @foreach ($objectives as $objective)
                                    <li>
                                        <div class="step-box wow fadeInUp animated" data-animation="fadeInUp"
                                            data-delay=".4s">
                                            <div class="dnumber">
                                                <div class="date-box"><img
                                                        src="{{ asset('blog_images/' . $objective->image1) }}"
                                                        alt="icon">
                                                </div>
                                            </div>
                                            <div class="text">
                                                <h3>{{ $objective->title }}</h3>
                                                <p>{!! $objective->sdesc !!}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach


                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- steps-area-end -->
        <!-- newslater-area -->
        <section class="newslater-area pt-120 pb-200"
            style="background:url(img/bg/newslater-bg.png); background-repeat: no-repeat; background-size: contain;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-7 col-lg-7">
                        <div class="section-title newslater-title wow fadeInDown  animated" data-animation="fadeInDown"
                            data-delay=".4s">
                            <div class="text">
                                <h5>Newsletter</h5>
                                <h2>{{ $data->newsletterheading }}</h2>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <form name="ajax-form" id="contact-form4" action="#" method="post"
                            class="contact-form newslater wow fadeInDown  animated" data-animation="fadeInDown"
                            data-delay=".4s">
                            <div class="form-group p-relative">
                                <input class="form-control" id="email2" name="email" type="email"
                                    placeholder="Email Address..." value="" required="">
                                <button type="submit" class="btn btn-custom" id="send2">Subscribe Now</button>
                            </div>
                            <!-- /Form-email -->
                        </form>
                    </div>
                </div>

            </div>
        </section>
        <!-- newslater-aread-end -->
        <!-- video-area -->
        <section id="video" class="video-area p-relative wow fadeInUp  animated" data-animation="fadeInUp"
            data-delay=".4s">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="s-video-wrap" style="background-image:url({{ $thumbnailUrl }})">
                            <div class="s-video-content text-center">
                                <h6><a href="{{ $data->videourl }}" class="popup-video mb-50"><img
                                            src="img/bg/play-button2.png" alt="circle_right"></a></h6>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- video-area-end -->
        <!-- gallery-area -->
        <section id="portfolio" class="pt-120 pb-90">
            <div class="container">
                <div class="portfolio ">
                    <div class="row align-items-end mb-50">
                        <div class="col-lg-12">
                            <div class="section-title text-center wow fadeInLeft  animated" data-animation="fadeInLeft"
                                data-delay=".4s">
                                <h5>{{ $data->galleryheading1 }}</h5>
                                <h2>
                                    {{ $data->galleryheading2 }}
                                </h2>

                            </div>

                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            @foreach ($galleryTypes->chunk(3) as $chunk) <!-- Split into rows of 3 -->
                                @foreach ($chunk as $galleryType)
                                    <div class="col-md-4 mb-4">
                                        <div class="gallery-type-card">
                                            <h3 style="text-align: center; color:#fff;">{{ $galleryType->title }}</h3>
                                            <div class="gallery-images">
                                                @foreach ($galleryItems[$galleryType->id]->take(2) as $item)
                                                    <div class="gallery-image">
                                                        @if ($item->youtube_url)
                                                            @php
                                                                // Extract video ID from YouTube watch URL
                                                                $videoId = '';
                                                                parse_str(parse_url($item->youtube_url, PHP_URL_QUERY), $params);
                                                                if (isset($params['v'])) {
                                                                    $videoId = $params['v'];
                                                                }
                                                            @endphp
                                                            <iframe src="https://www.youtube.com/embed/{{ $videoId }}" allowfullscreen></iframe>
                                                        @elseif ($item->image)
                                                            <img src="{{ asset($item->image) }}" alt="{{ $item->title }}">
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>





                </div>
            </div>
        </section>
        <!-- gallery-area-end -->

        <!-- testimonial-area -->
        <section class="testimonial-area pt-120 pb-100 p-relative fix"
            style="background: url(img/bg/services-bg.png); background-repeat: no-repeat;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title mb-50 wow fadeInDown animated text-center" data-animation="fadeInDown"
                            data-delay=".4s">
                            <h5>Our Testimonial</h5>
                            <h2>
                                What Our Clients Says
                            </h2>
                        </div>

                    </div>

                    <div class="col-lg-12">
                        <div class="testimonial-active">

                            @foreach ($testimonial as $testimonial)
                                <div class="single-testimonial">
                                    <div class="testi-author">
                                        <div class="author-image"
                                            style=" width:100px; height: 100px; overflow: hidden; border-radius: 5%; background-color: #f0f0f0;">
                                            <img src="{{ $testimonial->image ? asset('testimonial_images/' . $testimonial->image) : asset('img/testimonial/testi_avatar.png') }}"
                                                alt="{{ $testimonial->name }}"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                        <div class="ta-info">
                                            <h6>{{ $testimonial->name }}</h6>
                                            <span>{{ $testimonial->address }}</span>
                                        </div>
                                    </div>
                                    <p class="pt-10 pb-20"><img src="img/testimonial/review-icon.png" alt="img"></p>
                                    <p style="text-align: justify;">“{!! $testimonial->content !!}”.</p>

                                    <div class="qt-img">
                                        <img src="img/testimonial/qt-icon.png" alt="img">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- testimonial-area-end -->

        <!-- frequently-area -->
        <section class="faq-area pb-120 p-relative fix">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-lg-6">
                        <div class="faq-wrap pr-30 wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                            <div class="accordion" id="accordionExample">
                                @foreach ($faqs as $faq)
                                    <div class="card">
                                        <div class="card-header" id="heading{{ $faq->id }}">
                                            <h2 class="mb-0">
                                                <button class="faq-btn" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $faq->id }}" aria-expanded="true">
                                                    {{ $faq->title }}
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapse{{ $faq->id }}" class="collapse"
                                            aria-labelledby="heading{{ $faq->id }}" data-parent="#accordionExample">
                                            <div class="card-body">
                                                {!! $faq->sdesc !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-title wow fadeInLeft animated mb-20" data-animation="fadeInDown animated"
                            data-delay=".2s">
                            <h5>Our FAQ</h5>
                            <h2>{!! $data->faqheading !!}</h2>
                        </div>
                        <p>{!! $data->faqdesc !!}</p>

                    </div>
                </div>
            </div>
        </section>
        <!-- frequently-area-end -->
        <!-- blog-area -->
        <section id="blog" class="blog-area p-relative fix pt-120 pb-90"
            style="background: url(img/bg/services-bg.png); background-repeat: no-repeat;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="section-title center-align mb-50 text-center wow fadeInDown animated"
                            data-animation="fadeInDown" data-delay=".4s">
                            <h5><i class="fal fa-graduation-cap"></i> Our Blog</h5>
                            <h2>
                                Latest Blog & News
                            </h2>

                        </div>

                    </div>
                </div>
                <div class="row">
                    @php
                        $count = 0;
                    @endphp

                    {{-- Loop through blogs in reverse order --}}
                    @foreach ($blogs->reverse() as $blog)
                        @if ($blogType[0])
                            @php $count++; @endphp
                            @if ($count <= 3)
                                <div class="col-lg-4 col-md-6">
                                    <div class="single-post2 hover-zoomin mb-30 wow fadeInUp animated"
                                        data-animation="fadeInUp" data-delay=".4s">
                                        <div class="blog-thumb2" style="height: 250px; overflow: hidden;">
                                            <a href="{{ route('blog.show', ['blog' => $blog->id]) }}">
                                                <img src="{{ asset('blog_images/' . $blog->image1) }}" alt="img"
                                                    style="width: 100%; height: 100%; object-fit: cover;">
                                            </a>
                                        </div>
                                        <div class="blog-content2">
                                            <div class="date-home">
                                                <i class="fal fa-calendar-alt"></i>
                                                {{ $blog->created_at->format('d F, Y') }}
                                            </div>
                                            <div class="b-meta">
                                                <div class="meta-info">
                                                    <ul>
                                                        <li><i class="fal fa-user"></i> By Admin </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <h4><a
                                                    href="{{ route('blog.show', ['blog' => $blog->id]) }}">{!! substr(strip_tags($blog->title), 0, 25) !!}..</a>
                                            </h4>
                                            <p>{!! substr(strip_tags($blog->content), 0, 90) !!}</p>
                                            <div class="blog-btn"><a
                                                    href="{{ route('blog.show', ['blog' => $blog->id]) }}">Read More <i
                                                        class="fal fa-long-arrow-right"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>




            </div>
        </section>
        <!-- blog-area-end -->

        <!-- brand-area -->
        <div class="brand-area pb-120">
            <div class="container">
                <div class="row brand-active">
                    @foreach ($brands as $brand)
                        <div class="col-xl-2">
                            <div class="single-brand">
                                <img src="{{ asset('blog_images/' . $brand->image1) }}" alt="{{ $brand->title }}"
                                    style="width: 100%; max-width: 100%; max-height: 100px; object-fit: contain;">
                            </div>
                        </div>
                    @endforeach



                </div>
            </div>
        </div>
        <!-- brand-area-end -->

    </main>
@endsection

@section('css')
    <style>
        .services-box-05 {
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);


        }

        .quick-link-item {
            display: block;
            text-decoration: none;
            position: relative;
            color: #fff;
        }

        .image-container {
            position: relative;
            width: 100%;
            height: 100px;
            background-size: cover;
            transition: transform 0.3s ease;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #FDCC0D;
            transition: background-color 0.3s ease;
        }

        .image-container:hover .overlay {
            background-color: #006E2F;
        }

        .text-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            transition: color 0.3s ease;
        }

        .image-container:hover .text-overlay h4 {
            color: #fff;
            /* Change this to the desired color when hovered */
        }

        .text-overlay h4 {
            margin: 0;
            font-size: 1.5em;
            color: #000000;
            /* Original text color */
        }

        .video-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .video-background {
            width: 100%;
            height: 100%;
        }

        .video-foreground {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;

        }

        .video-foreground iframe {
            width: 100%;
            height: 100%;
            object-fit: cover;
            pointer-events: none;
            /* Ensures the video fills the iframe container */
        }

        .gallery-type-card {
            padding: 20px;
            background-color: #00715D;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .gallery-images {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        .gallery-image {
            position: relative;
            padding-bottom: 100%; /* 1:1 aspect ratio for each image */
            overflow: hidden;
        }
        .gallery-image img, .gallery-image iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

    </style>
@endsection
