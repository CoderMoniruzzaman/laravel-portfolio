@extends('frontend.layouts.master')

@section('style')
    <style>
        .link-button{
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .button-one{
            background-color: #F68338;
            display: inline-block;
            font-weight: 400;
            color: #fff;
            text-align: center;
            border: 1px solid #F68338;
            padding: 0.375rem 0.75rem;
            -webkit-transition: all linear .3s;
            transition: all linear .3s;
            border-radius: 3px;
        }
        .button-one:hover {
            background-color: #F68338;
            color: #fff;
            text-decoration: none;
        }

        .grid .image figure {
            position: relative;
            overflow: hidden;
        }

    </style>
@endsection

@section('content')
<div class="mccan page">
    <h3 class="title-small">Project</h3>
    <h2 class="title">Tempt Style</h2>
    <div class="content">
        <div class="grid-container">
            <div class="grid-column">
                <div class="row media">
                    @foreach ($multiple_photos as $multiple_photo)
                    <div class="media-sliitem col-lg-12">
                        <a href="#"> <img src="{{ asset('uploads/ProjectImage/slider/') }}/{{ $multiple_photo }}" alt=""> </a>
                    </div>
                    @endforeach
                </div>

                <div class="project-listing">
                    <div class="project">
                        <header class="header">
                            <div class="excerpt">
                                {!! $projects_info->project_description !!}
                                <div class="list">
                                    <ul>
                                        <li><strong>Project Name :</strong> {{ $projects_info->project_name }}
                                        <li><strong>Client :</strong> Tempt Inc.</li>
                                        <li><strong>Programming Skills :</strong>
                                        <span>
                                            @foreach ($projects_info->relationskill as $skill)
                                                <span class="badge badge-light">{{  $skill->skill_name }}</span>
                                            @endforeach
                                        </span>
                                        </li>
                                        <li><strong>Category :</strong > <span class="text-info">{{ $projects_info->relationcategory->category_name  }}</span></li>
                                    </ul>
                                    <div class="link-button">
                                        <a href="{{ $projects_info->project_link }}" target="_blank" class="button-one">Demo</a>
                                    </div>
                                </div>
                            </div>
                        </header>
                    </div>
                </div>
                <div class="row mt-4 mb-4">
                    <div class="col-lg-12">
                        @php
                            $url = $projects_info->project_video_link;
                            parse_str( parse_url( $url, PHP_URL_QUERY ), $youtube_id );
                        @endphp
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $youtube_id['v'] }}"></iframe>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-12 text-center">
                        <h3>Realated work</h3>
                    </div>
                </div>
                <div class="owl-carousel owl-theme owl-loaded related-pro">
                    @forelse($related_products as $related_product)
                    <div class="item">
                        <a href="{{ url('workdetails')}}/{{ $related_product->id}}" class="desc">
                            <div class="project">
                                <img src="{{ asset('uploads/ProjectImage/preview/')}}/{{ $related_product->project_image}}" class="img-fluid" alt="">
                                <div class="desc">
                                    <div class="con">
                                        <h3>{{ $related_product->project_name}}</h3><span>{{ $related_product->relationcategory->category_name}}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @empty
                    <div class="item">
                        No Related Project to show.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
 document.addEventListener('DOMContentLoaded', function() {
    $(document).ready(function() {
        $('.media').slick({
        arrows: false,
        dots: false,
        autoplay: true,
        fade: true,
        autoplaySpeed: 1000,
        speed: 1000,
        slidesToShow: 1,
        slidesToScroll: 1,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 479,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
        });
    });

    $(".related-pro").owlCarousel({
        loop:false,
        margin:10,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:3
            }

        }
    });

 });
</script>
@endsection
