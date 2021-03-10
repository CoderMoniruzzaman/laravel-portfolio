@extends('frontend.layouts.master')

@section('content')
<div class="mccan page">
    <h3 class="title-small">Freelance</h3>
    <h2 class="title">I am available in these market places now</h2>
    <div class="content">
        <div class="grid-container">
            <div class="grid-column">
                <div class="row pt-5">
                    @foreach ($all_freelances as $all_freelance)
                    <div class="col-md-6">
                        <a href="{{ $all_freelance->freelance_url }}" target="_blank">
                            <div class="feature feature-left">
                                <div class="mccan-icon-image"> <img src="{{ asset('uploads/freelancesiteIcon/') }}/{{ $all_freelance->feelancesite_image }}" alt="" style="max-width: 140px;"> </div>
                                <div class="mccan-text" style="padding-top: 10px;">
                                    <h3>{{ $all_freelance->feelancesite_name }}</h3>
                                    <p>{{ $all_freelance->feelancesite_description }}</p>
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
