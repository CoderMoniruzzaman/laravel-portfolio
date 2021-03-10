@extends('frontend.layouts.master')
@section('style')
<style>
    .container-skill {
        width: 100%;
        background-color: #ddd;
        margin-bottom: 10px;
    }

    .container-skill .skills {
        text-align: right;

        color: white;

    }

    .container-skill .css {width: 90%; background-color: #2196F3;}
    .container-skill .js {width: 85%; background-color: #F73859;}
    .container-skill .php {width: 80%; background-color: #9b59b6;}
    .container-skill .vue {width: 85%; background-color: #F68338;}
    .container-skill .laravel {width: 80%; background-color: #808080;}
    .info-text p{
        color:#888 !important;
    }
</style>
@endsection
@section('content')
<!-- About Me -->
@php
$infos = App\Models\Personalinfo::all();
@endphp
<div class="mccan page">
    @foreach ($infos as $info)
    <h2 class="title">This Is {{ $info->name }}</h2>
    <div class="content">
        <div class="grid-container">
            <div class="grid-column">
                <div class="info-text">
                    {!! $info->description !!}
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><b>Birthday:</b> {{ $info->age }}</p>
                        <p><b>Address:</b> {{ $info->address }}</p>
                        <p><b>Skype:</b> {{ $info->skype }}</p>

                    </div>
                    <div class="col-md-6">
                        <p><b>Mail:</b> {{ $info->email }}</p>
                        <p><b>Phone:</b> {{ $info->phone }}</p>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('freelance') }}" type="button" class="btn  hire_modal" data-toggle="modal">Hire Me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="divider1"></div>
<!-- skill -->
<div class="mccan page">
    <h3 class="title-small">What I know</h3>
    <h2 class="title">My skill</h2>
    <div class="content">
        <div class="grid-container">
            <div class="grid-column">
                <div class="row">
                    @foreach ($all_skills as $all_skill)
                    <div class="col-md-6">
                        <p>{{ $all_skill->knowledgeskill_name }}</p>
                        <div class="container-skill">
                          <div class="skills html" style="width: {{ $all_skill->percentage }}%; background-color: {{ $all_skill->skill_color }};">{{ $all_skill->percentage }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="divider1"></div>

<!-- Services -->
<div class="mccan page">
    <h3 class="title-small">What I Do</h3>
    <h2 class="title">Services</h2>
    <div class="content">
        <div class="grid-container">
            <div class="grid-column">
                <div class="row">
                    @foreach ($all_services as $all_service)
                        <div class="col-md-6">
                            <div class="feature feature-left">
                                <div class="mccan-icon"> <span class="font-35px"><i class="{{ $all_service->icon }}"></i></span> </div>
                                <div class="mccan-text">
                                    <h3>{{ $all_service->service_name }}</h3>
                                    <p>{{ $all_service->service_description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
     document.addEventListener('DOMContentLoaded', function() {


     });
</script>
@endsection
