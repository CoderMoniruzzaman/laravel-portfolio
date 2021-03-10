@extends('frontend.layouts.master')
@section('content')
<div class="mccan page">
    <h3 class="title-small">LOCATION</h3>
    <h2 class="title">Contact Me</h2>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <p>If you’d like to talk about a project, our work or anything else then get in touch.</p>
                <div class="list">
                    <ul>
                        @php
                        $infos = App\Models\Personalinfo::all();
                        @endphp
                         @foreach ($infos as $info)
                        <li><strong>Phone :</strong> {{ $info->phone }}</li>
                        <li><strong>Email :</strong> {{ $info->email }}</li>
                        <li><strong>Address :</strong> {{ $info->address }}</li>
                        <li><strong>Map :</strong> <a href="" target="_blank">via Google Maps</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="divider1"></div>
        <div class="row">
            <div class="col-md-8">
                <h6 class="mb-20"><strong>Get in touch</strong></h6>
                <form action="{{ url('contact/send') }}" method="POST">
                    @csrf
                    @if ($message = Session::get('status'))
                        <div class="alert alert-info alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong class="text-dark">{{ $message }}</strong>
                        </div>
                    @endif
                    <label for="name" class="screen-reader-text">Name</label>
                    <input type="text" name="name" id="name" placeholder="Name *" required="">
                    <label for="name" class="screen-reader-text">Name</label>
                    <input type="text" name="subject" id="subject" placeholder="Subject *" required="">
                    <label for="email" class="screen-reader-text">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email *" required="">
                    <label for="message" class="screen-reader-text">Message</label>
                    <textarea name="message" id="message" cols="30" rows="5" placeholder="Message *" required=""></textarea>
                    <input type="submit" class="btn ajax" value="Send">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
