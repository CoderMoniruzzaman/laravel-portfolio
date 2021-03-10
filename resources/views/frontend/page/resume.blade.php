@extends('frontend.layouts.master')

@section('style')
<style>
    .timeline-content p{
        margin-bottom : 15px !important;
    }
    .mccan .title-m{
         color: #F68338;
    }
    .timeline-content h6{
        font-size: 13px;
        padding-top: 10px;
        padding-bottom: 5px;
        color: #F68338;
    }
</style>
@endsection
@section('content')
<div class="mccan page">
    <h2 class="title title-m">Experience</h2>
    <div class="content">
        <div class="grid-container">
            <div class="grid-column">
                <ul class="timeline">
                    @foreach ($all_experiences as $all_experience)
                    <li>
                        <div class="timeline-content">
                            <h4>{{ $all_experience->company_name }}</h4>
                            <h6>{{ $all_experience->position}}</h6>
                            <span class="timeline-date">{{ $all_experience->job_year }}</span>
                            <p>{{ $all_experience->job_description }}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="divider1"></div>
<div class="mccan page">
    <h2 class="title title-m">Education</h2>
    <div class="content">
        <div class="grid-container">
            <div class="grid-column">
                <ul class="timeline">
                    @foreach ($all_educations as $all_education)
                    <li>
                        <div class="timeline-content">
                            <h4>{{ $all_education->institute_degree }}</h4>
                            <h6>{{ $all_education->institute_name}}</h6>
                            <span class="timeline-date">{{ $all_education->degree_year }}</span>
                            <p>{{ $all_education->education_description }}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="divider1"></div>
<div class="mccan page">
    <h2 class="title title-m">ACHIEVEMENTS</h2>
    <div class="content">
        <div class="grid-container">
            <div class="grid-column">
                @foreach ($all_achievements as $all_achievement)
                <div class="row mb-3">
                    <div class="col-md-4">
                        <img src="{{ asset('/uploads/achievement') }}/{{ $all_achievement->achievement_image }}" alt="" class="img-thumbnail mx-auto d-block">
                    </div>
                    <div class="col-md-8">
                        <ul class="timeline">
                            <li>
                                <div class="timeline-content">
                                    <h4>{{ $all_achievement->achievement_title }}</h4>
                                    <p>{{ $all_achievement->achievement_description }}</p>
                                    <a href="{{ $all_achievement->achievement_url }}">View Certificate</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="divider1"></div>
<div class="mccan page">
    <h2 class="title title-m">RESEARCH & DEVELOPMENTS</h2>
    <div class="content">
        <div class="grid-container">
            <div class="grid-column">
                <ul class="timeline">
                    @foreach ($all_researchs as $all_research)
                    <li>
                        <div class="timeline-content">
                            <h4>{{ $all_research->research_title }}</h4>
                            <p>{{ $all_research->research_description }}</p>
                            <a href="{{ $all_research->research_publication_link }}">See Publication</a>
                            <div>
                                <a href="{{ $all_research->research_project_url }}">View Project</a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
