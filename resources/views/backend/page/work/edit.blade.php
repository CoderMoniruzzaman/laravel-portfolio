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
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" id="project-create">
                <div class="card-header card-header-info align-item flex">
                    <h3>Project Edit</h3>
                    <ul>
                        <li><a  href="{{ url('admin/work') }}" class="button-one"><i class="ti-plus mr-2"></i>Work list</a></li>
                    </ul>
                </div>

                <div class="card-body">
                    <form action="{{ url('admin/edit/work') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-lg-3">
                                <input type="hidden" name="id" value="{{ $projects_info->id }}">
                                <div class="edit-img mb-3">
                                    <label>Product Image edit</label>
                                    <img  class="card-img-top" src="{{ asset('uploads/ProjectImage/preview/') }}/{{ $projects_info->project_image }}" alt="">
                                </div>
                                <div class="form-group">
                                    <input type="file"  name="project_image" class="form-control">
                                    <small><span class="text-danger">*</span>Project image and max size 2MB</small>
                                </div>
                            </div>

                            <div class="col-lg-9">
                                <div class="row">
                                    <!-- Product input field -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Project Title</label>
                                            <input type="text" name="project_name" class="form-control" value="{{ $projects_info->project_name }}">
                                            <span></span>
                                        </div>
                                    </div>
                                    <!-- Product input field -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Category Name</label>
                                            <select class="form-control" name="category_id" id="category_id">
                                                @foreach($categoreies as $category)
                                                <option value="{{ $category->id }}" {{ $projects_info->category_id == $category->id  ? 'selected' : ''}}>{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                     <!-- Product input field -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Project Link</label>
                                            <input type="text" name="project_link"  class="form-control" value="{{ $projects_info->project_link }}">
                                            <span></span>
                                        </div>
                                    </div>
                                    <!-- Product input field -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Project Video Url</label>
                                            <input type="text" name="project_video_link"  class="form-control" value="{{ $projects_info->project_video_link }}">
                                            <span></span>
                                        </div>
                                    </div>

                                     <!-- Product input field -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Project Client Link</label>
                                            <input type="text" name="client_link"  class="form-control" value="{{ $projects_info->client_link }}">
                                            <span></span>
                                        </div>
                                    </div>
                                    <!-- Product input field -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Assign skill</label>
                                        {{-- @foreach ($projects_info->relationskill as $skill)
                                                <span class="badge badge-primary">{{ $selected[] = $skill->id }}</span>
                                            @endforeach --}}
                                            <select name="skill_id[]" id="skill_id" class="form-control" multiple>
                                                @foreach ($skills as $skill)
                                                    <option value="{{ $skill->id }}" @foreach($projects_info->relationskill as $select){{ $select->id == $skill->id  ? 'selected' : '' }}@endforeach>
                                                        {{ $skill->skill_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Project description input field -->
                        <div class="form-row">
                            <div class="mb-3 col-lg-12">
                                <label for="exampleFormControlTextarea1" class="form-label">Product Description</label>
                                <textarea name="project_description" class="form-control" id="project_description" rows="7">{!! $projects_info->project_description !!}</textarea>
                            </div>
                        </div>
                        <!-- Project multiple image input field -->
                        <div class="form-row mb-3">
                            <div class="col-lg-12">
                                <label>Preview Image</label>
                            </div>
                            @if($multiple_photos)
                            @foreach($multiple_photos as $multiple_photo)
                            <div class="col-lg-3 mb-3">
                                <div class="card">
                                    <img src="{{ asset('uploads/ProjectImage/slider/') }}/{{ $multiple_photo }}" alt="" class="img-fluid">
                                    <div class="card-body">
                                      <div class="form-group">
                                          <input type="file" name="slider_image[]" class="form-control">
                                      </div>
                                      <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="submit" class="btn btn-light btn-sm" formaction="{{ url('admin/edit/work/single')}}/{{ $multiple_photo }}/{{$projects_info->id}}"><i class="ti-pencil-alt mr-1"></i>Update</button>
                                        <a href="{{ url('admin/delete/work/single')}}/{{ $multiple_photo }}/{{$projects_info->id}}" class="btn btn-danger btn-sm"><i class="ti-trash mr-1"></i>Delete</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- Product input field -->
                            <div class="col-lg-3 mb-3">
                                <div class="card">
                                    <img src="{{ asset('uploads/ProjectImage/slider/upload.png')}}" alt="{{ asset('uploads/ProjectImage/slider/upload.png')}}" class="img-fluid">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <input type="file" name="photo_name_new[]" class="form-control"  multiple="">
                                        </div>
                                        <label for="">Upload New Preview image</label>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="form-row">
                            <div class="mb-3 col-lg-12">
                                <button type="submit" class="btn btn-info text-light">Update</button>
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
            $('#category_id').select2();
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

