@extends('backend.layouts.master')
@section('title')
Project
@endsection

@section('style')
<style>
.form-group small{
    font-size: 13px;
    margin-top: 10px;
}
#project-create .card-header-info h3 {
    color: #48465b;
    font-size: 16px;
    font-weight: 600;
    margin-top: 10px;
    float: left;
}

#project-create .card-header-info ul {
    list-style-type: none;
    margin: 0px;
    padding: 0px;
    float: right;
}

#project-create .card-header-info ul li {
    display: inline-block;
}

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
                    <li><span>Project create</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- page title area end -->
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 ml-auto">
          @if (count($errors) > 0)
           <div class="alert alert-danger">
              <div class="button">
                <button type="button" class="close" data-dismiss="alert">×</button>
              </div>
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
               </ul>
           </div>
         @endif
        </div>
      </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" id="project-create">
                <div class="card-header card-header-info align-item flex">
                    <h3>Project List</h3>
                    <ul>
                        <li><a  href="{{ url('admin/work') }}" class="button-one"><i class="ti-plus mr-2"></i>Work list</a></li>
                    </ul>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.work.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <!-- Product input field -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Project Title</label>
                                    <input type="text" name="project_name" class="form-control" placeholder="Super shop management">
                                    <span></span>
                                </div>
                            </div>
                            <!-- Product input field -->
                            <div class="form-group col-lg-6">
                                <label>Category Name</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option  value="">-- Select Category --</option>
                                    @foreach($categoreies as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                <span class="categoryErr"></span>
                            </div>
                        </div>

                        <div class="form-row">
                             <!-- Product input field -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Assign skill</label>
                                    <select name="skill_id[]" id="skill_id" class="form-control" multiple>
                                        @foreach ($skills as $skill)
                                            <option value="{{ $skill->id }}">{{ $skill->skill_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Product input field -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Project Link</label>
                                    <input type="text" name="project_link"  class="form-control" placeholder="http://example.com">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <!-- Product input field -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Project Video Url</label>
                                    <input type="text" name="project_video_link"  class="form-control" placeholder="https://www.youtube.com/watch">
                                    <span></span>
                                </div>
                            </div>
                            <!-- Product input field -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Project Client Link</label>
                                    <input type="text" name="client_link"  class="form-control" placeholder="http://example.com">
                                    <span></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="mb-3 col-lg-6">
                                <div class="form-group">
                                    <label>Project Image</label>
                                    <input type="file" name="project_image" class="form-control" id="project_image">
                                    <small><span class="text-danger">*</span>Project image and max size 2MB</small>
                                </div>
                            </div>
                            <div class="mb-3 col-lg-6">
                                <div class="form-group">
                                    <label>Preview Image</label>
                                    <input type="file" class="form-control" name="slider_image[]" id="slider_image" multiple>
                                    <small><span class="text-danger">*</span>Select all project preview image and max size 2MB</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="mb-3 col-lg-12">
                                <label for="exampleFormControlTextarea1" class="form-label">Product Description</label>
                                <textarea name="project_description" class="form-control" id="project_description" rows="7"></textarea>
                            </div>
                            <div class="mb-3 col-lg-12">
                                <div class="form-check">
                                    <input class="form-check-input" name="project_status" type="checkbox" value="1" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Publish now
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3 col-lg-12">
                                <button type="submit" class="btn btn-info text-light">Submit</button>
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
        "use strict";
        $(document).ready(function() {
            $('#skill_id').select2();
            $('#project_description').summernote({
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

