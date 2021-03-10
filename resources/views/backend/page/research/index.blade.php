
@extends('backend.layouts.master')
@section('title')
Research Site
@endsection


@section('style')
<style>
.tost {
    position: fixed;
    right: 15px;
    top: 15px;
    z-index: 9999;
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
                    <li><a href="{{url('/admin')}}">Dashboard</a></li>
                    <li><span>My Research site</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- page title area end -->
@endsection

@section('content')

<div class="container tost">
    <div class="row">
      <div class="col-lg-4 ml-auto tost_message">
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
    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <div class="card-group">
                <div class="card">
                    <div class="card-header">
                        <button class="button-one" data-target="#researchModal" data-toggle="modal"><i class="ti-plus mr-2"></i>Create new one</button>
                        <!-- modal -part start -->
                        <div class="modal fade" id="researchModal" role="dialog">
                            <div class="modal-dialog modal-dialog-centered"  role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Research Site</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!--Sub-Category insert form -->
                                        <form class="row" action="{{ route('admin.researchsite.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <!--Sub-Category form item -->
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Research title</label>
                                                    <input type="text" name="research_title" class="form-control" placeholder="Enter Freelance site name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Say something</label>
                                                    <textarea name="research_description" class="form-control" placeholder="Type something.." rows="4" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Research publication link site</label>
                                                    <input type="text" name="research_publication_link" class="form-control" placeholder="Enter Research publication link site" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Research project url</label>
                                                    <input type="text" name="research_project_url" class="form-control" placeholder="Enter Research project url" required>
                                                </div>
                                            </div>
                                            <!--Sub-Category form button -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                   <button type="submit" class="button-one">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!--Sub-Category form end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal -part End -->
                    </div>
                    <div class="card-body">
                        <table id="researchTable" class="table table-bordered">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>Serial</th>
                                    <th>Research Title</th>
                                    <th>Research Description</th>
                                    <th>Research Publication Site</th>
                                    <th>Research Project URL</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($researchsites as $researchsite)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $researchsite->research_title }}</td>
                                        <td>{{ $researchsite->research_description }}</td>
                                        <td>{{ $researchsite->research_publication_link }}</td>
                                        <td>{{ $researchsite->research_project_url }}</td>
                                        <td>
                                            {{ $researchsite->created_at->format('d-M-Y h:i:s A') }}
                                            <br>
                                            {{ $researchsite->created_at->diffForHumans() }}
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/change/status/research/') }}/{{ $researchsite->id }}">
                                                <button type="submit"
                                                    class="
                                                    @if ($researchsite->status == 1)btn btn-sm btn-success
                                                    @else  btn btn-sm btn-danger
                                                    @endif">
                                                    @if ( $researchsite->status == 1)
                                                    Published
                                                    @else Unpublished
                                                    @endif
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="mb-2">
                                                <a href="javascripts:void(0)" class="btn btn-light" data-reaid="{{$researchsite->id}}" data-mytitle="{{$researchsite->research_title}}" data-mydescrip="{{$researchsite->research_description}}" data-relink="{{ $researchsite->research_publication_link }}" data-reurl="{{ $researchsite->research_project_url }}"  data-toggle="modal" data-target="#editresearchModal"><i class="ti-pencil-alt"></i></a>
                                                @include('backend.page.research.edit')
                                            </div>

                                             {{-- delete --}}
                                            <div class="mb-2">
                                                <a href="{{ url('admin/researchsite/delete/') }}/{{ $researchsite->id }}"class="btn btn-light"><i class="ti-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        $(document).ready(function() {
            $('#researchTable').DataTable();
        });
        $('#editresearchModal').on('show.bs.modal', function (event) {
            var a = $(event.relatedTarget)
            var ReTitle = a.data('mytitle')
            var ReLink = a.data('relink')
            var ReId = a.data('reaid')
            var ReUrl = a.data('reurl')
            var ReDescrip = a.data('mydescrip')
            var modal = $(this)
            modal.find('.modal-body #re_id').val(ReId);
            modal.find('.modal-body #research_title').val(ReTitle);
            modal.find('.modal-body #research_description').val(ReDescrip);
            modal.find('.modal-body #research_publication_link').val(ReLink);
            modal.find('.modal-body #research_project_url').val(ReUrl);
        });

    });
</script>
@endsection
