@extends('backend.layouts.master')
@section('title')
Project
@endsection


@section('style')
<style>

</style>
@endsection



@section('breadcum')
<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{url('#')}}">Dashboard</a></li>
                    <li><span>Personal Information my website</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- page title area end -->
@endsection

@section('content')
<div class="container-fluid">
    @foreach ($infos as $info)
    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <div class="card-group">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('uploads/mysite/personal') }}/{{ $info->image }}" alt="Card image cap">
                    <div class="card-body">
                        <a href="{{url('admin/personalinfo/edit')}}/{{$info->id}}" class="btn btn-primary">Edit Information</a>
                        <a href="{{ url('admin/file/download') }}/{{$info->id}}" class="btn btn-primary">My CV</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                      Information
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $info->name }}</h5>
                        <div class="card-text">{!! $info->description !!}</div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Age <span class="pl-1">:</span><span class="pr-2"></span>{{ $info->age }} </li>
                            <li class="list-group-item">Address <span class="pl-1">:</span><span class="pr-2"></span> {{ $info->address }}</li>
                            <li class="list-group-item">Email <span class="pl-1">:</span><span class="pr-2"></span> {{ $info->email }}</li>
                            <li class="list-group-item">Phone <span class="pl-1">:</span><span class="pr-2"></span> {{ $info->phone }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
@section('script')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {



    });
</script>
@endsection
