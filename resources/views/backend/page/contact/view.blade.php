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
                    <li><span>Messsage from</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- page title area end -->
@endsection

@section('content')
<div class="container">
    <div class="col-lg-12 m-auto">
        <div class="card">
            <div class="card-header">
                <div>
                    {{ $single_contact_info->created_at->format('d-M-Y h:i:s A') }} ( {{ $single_contact_info -> created_at->diffForHumans() }})
                </div>
                <b>Email From <span style="color:green;">{{ $single_contact_info->email }}</span></b>
            </div>
            <div class="card-body">
            <h6 style="text-align:left; font-size:16px; font-weight:600;">{{ $single_contact_info->Subject }}<h6>
            <br>
            <p class="card-text" style="text-align:left; font-size:16px;" ><span>{{ $single_contact_info->message }}</p>
            </div>
            <div class="card-footer text-muted">
                <div>
                    <a href="{{ route('admin.contact.index')}}" class="btn btn-primary mt-3">Go Back</a>
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
