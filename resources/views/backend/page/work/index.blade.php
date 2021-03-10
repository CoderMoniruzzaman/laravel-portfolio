@extends('backend.layouts.master')
@section('title')
Project
@endsection


@section('style')
<style>
#project-list .card-header-info h3 {
    color: #48465b;
    font-size: 16px;
    font-weight: 600;
    margin-top: 10px;
    float: left;
}

#project-list .card-header-info ul {
    list-style-type: none;
    margin: 0px;
    padding: 0px;
    float: right;
}

#project-list .card-header-info ul li {
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
                    <li><span>All Project List</span></li>
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
            <div class="card" id="project-list">
                <div class="card-header card-header-info align-item flex">
                    <h3>Project List</h3>
                    <ul>
                        <li><a  href="{{ url('admin/work/create') }}" class="button-one"><i class="ti-plus mr-2"></i>Add New one</a></li>
                    </ul>
                </div>

                <div class="card-body table-responsive">
                    <table id="projectTable" class="table table-bordered">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Serial</th>
                                <th>Project name</th>
                                <th>Project Description</th>
                                <th>Project Image</th>
                                <th>Project Slider</th>
                                <th>Project Type</th>
                                <th>Project Skill</th>
                                <th>Project Link</th>
                                <th>Project Video link</th>
                                <th>Project Client link</th>
                                <th>status</th>
                                <th>Created_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td>{{ $project->project_name }}</td>
                                <td>
                                    <div>
                                        {!! Str::limit($project->project_description, 25) !!}
                                    </div>
                                </td>
                                <td><img src="{{ asset('uploads/ProjectImage/preview/') }}/{{ $project->project_image }}" alt="not found" width="100"></td>
                                <td>
                                    <?php foreach (json_decode($project->slider_image)as $slider) { ?>
                                        <div class="pb-2 mr-3">
                                            <img src="{{ asset('uploads/ProjectImage/slider/') }}/{{ $slider }}" alt="not found" width="100">
                                        </div>
                                    <?php } ?>
                                </td>
                                <td>{{ $project->relationcategory->category_name }}</td>
                                <td>
                                    @foreach ($project->relationskill as $skill)
                                    <span class="badge badge-primary">{{ $skill->skill_name }}</span>
                                    @endforeach

                                </td>
                                <td>{{ $project->project_link }}</td>
                                <td>{{ $project->project_video_link }}</td>
                                <td>{{ $project->client_link }}</td>
                                <td>
                                    <a href="{{ url('admin/change/status/project') }}/{{ $project->id }}">
                                        <button type="submit"
                                            class="
                                            @if ($project->project_status == 1)btn btn-sm btn-success
                                            @else  btn btn-sm btn-danger
                                            @endif">
                                            @if ( $project->project_status == 1)
                                            Published
                                            @else Unpublished
                                            @endif
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    {{ $project->created_at }}
                                </td>
                                <td>
                                    {{--View --}}
                                    <div class="mb-2">
                                        <a href=""class="btn btn-light"><i class="ti-eye"></i></a>
                                    </div>

                                    {{-- Edit --}}
                                    <div class="mb-2">
                                        <a href="{{route('admin.work.edit',$project->id)}}"class="btn btn-light"><i class="ti-pencil-alt"></i></a>
                                    </div>

                                     {{-- delete --}}
                                     <div class="mb-2">
                                        <a href="{{url('admin/project/delete')}}/{{$project->id }}"class="btn btn-light"><i class="ti-trash"></i></a>
                                    </div>

                                </td>
                            </tr>
                            @empty
                            <tr class="text-center text-danger">
                                <td colspan="13">No Data Available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        $('#projectTable').DataTable();


    });
</script>
@endsection

