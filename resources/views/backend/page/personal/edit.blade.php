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
                    <li><span>Personal Information edit my website</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- page title area end -->
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-info align-item flex">
                    <h6>Personal Information edit</h6>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/personalinfo/update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-lg-3">
                                <input type="hidden" name="id" value="{{ $info->id }}">
                                <div class="edit-img mb-4">
                                    <label>Image</label>
                                    <img  class="card-img-top mt-2" src="{{ asset('uploads/mysite/personal') }}/{{  $info->image }}" alt="">
                                </div>
                                <div class="form-group">
                                    <input type="file" name="image" class="form-control ">
                                    <small><span class="text-danger">*</span>Project image and max size 2MB</small>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row">
                                    <!-- Product input field -->
                                    <div class="col-lg-12">
                                        <label>Name</label>
                                        <div class="input-group">
                                            <input type="text" name="name" class="form-control" value="{{ $info->name}}">
                                            <div class="input-group-append">
                                                <div class="input-group-text" id="persons">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Product input field -->
                                    <div class="col-lg-6">
                                        <label>Age</label>
                                        <div class="form-group input-group date" id="datetimepicker4" data-target-input="nearest">
                                            <input type="text" name="age" class="form-control datetimepicker-input" id="datePicker" data-target="#datetimepicker4" autocomplete="off" placeholder="Date" onkeydown="return false" data-original-title="" title="" value="{{ $info->age }}">
                                            <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                                <div class="input-group-text" id="calendar">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <!-- Product input field -->
                                    <div class="col-lg-6">
                                        <label>Mobile Number</label>
                                        <div class="input-group">
                                            <input type="text" name="phone"  class="form-control" value="{{ $info->phone }}" autocomplete="off" placeholder="Your Phone No.">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <i class="fas fa-phone"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Product input field -->
                                    <div class="col-lg-6">
                                        <label>Address</label>
                                        <div class="input-group">
                                            <input type="text" name="address"  class="form-control" value="{{ $info->address }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <i class="fas fa-home"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <!-- Product input field -->
                                    <div class="col-lg-6 " >
                                        <label>Email</label>
                                        <div class="input-group">
                                            <input type="text" name="email"  class="form-control" value="{{ $info->email }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <i class="fas fa-at"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Product input field -->
                                    <div class="col-lg-6 mt-3" >
                                        <label>Change CV</label>
                                        <div class="input-group">
                                            <input type="file" name="cv"  class="form-control" id="cv" value="{{ $info->cv }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text" for="cv">
                                                    <i class="fas fa-file"></i>
                                                </div>
                                            </div>
                                        </div>
                                        {{ $info->cv }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label>Description</label>
                                <div class="input-group">
                                    <textarea class="form-control" rows="3" name="description" id="description_one">{!! $info->description !!}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <button type="submit" class="btn btn-info text-white" name="button">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('script')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        $('#datetimepicker4').datetimepicker({
            format: 'DD-MMM-YYYY'
        });
        $(document).ready(function() {
            $('#description_one').summernote({
                dialogsFade: true,
                tabsize: 2,
                focus: false,
                height: 220,
                toolbar: [
                ['fontsize', ['fontsize']],
                ['font', ['bold', 'underline','strikethrough','subscript','superscript' ,'italic','clear']],
                ['height', ['height']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['fullscreen','undo','redo']]
                ]
            });
        });
    });
</script>
@endsection
