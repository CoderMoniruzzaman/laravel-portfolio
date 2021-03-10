@extends('frontend.layouts.master')


@section('style')
    <style>
        .work{
            margin-bottom:40px;
        }
        .work .filters {
            width: 100%;
            text-align: center;
        }
        .work .filters ul {
            list-style: none !important;
        }
        .work .filters li {
            margin: 0 10px;
            font-size: 14px;
            display: inline-block;
            text-transform: uppercase;
            -webkit-transition: all linear .3s;
            transition: all linear .3s;
        }
        .filters li:hover {
            color: #F68338;
        }
        .filters li.active {
            color: #F68338;
        }
    </style>
@endsection

@section('content')
<div class="mccan page">
    <h3 class="title-small">Take A Look At</h3>
    <h2 class="title">Projects</h2>
    <div class="row mb-50 work">
        <div class="col-lg-12">
            <div class="filters filter-button-group">
                <ul class="list-inline">
                    <li class="active" data-filter="*">All</li>
                    @foreach ($categoreies as $category)
                        <li data-filter=".filter{{$category->id}}">{{$category->category_name}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="grid-container">
            <div class="grid-column">
                <div class="row grid">
                    @foreach ($works as $work)
                    <div class="col-md-6 filter{{ $work->category_id }} grid-item" >
                        <a href="{{ url('workdetails') }}/{{ $work->id }}" class="desc">
                            <div class="project"><img src="{{ asset('uploads/ProjectImage/preview/') }}/{{ $work->project_image }}" class="img-fluid" alt="">
                                <div class="desc">
                                    <div class="con">
                                        <h3>{{ $work->project_name }}</h3>
                                        <span>
                                            {{ $work->relationcategory->category_name }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
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
        $('.grid').isotope({
            itemSelector: '.grid-item',
        });
        // filter items on button click
        $('.filter-button-group').on('click', 'li', function() {
            var filterValue = $(this).attr('data-filter');
            $('.grid').isotope({ filter: filterValue });
            $('.filter-button-group li').removeClass('active');
            $(this).addClass('active');
        });
    });
 });
</script>
@endsection
