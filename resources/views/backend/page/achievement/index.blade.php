
@extends('backend.layouts.master')
@section('title')
Achievement Site
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
                    <li><span>My Achievement</span></li>
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
                        <button class="button-one" data-target="#achievementModal" data-toggle="modal"><i class="ti-plus mr-2"></i>Create new one</button>
                        <!-- modal -part start -->
                        <div class="modal fade" id="achievementModal" role="dialog">
                            <div class="modal-dialog modal-dialog-centered"  role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Achievement</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!--Sub-Category insert form -->
                                        <form class="row" action="{{ route('admin.achievementsite.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <!--Sub-Category form item -->
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Achievement title</label>
                                                    <input type="text" name="achievement_title" class="form-control" placeholder="EX: Certified Information Systems Security Professional" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Upload Certificate</label>
                                                    <input type="file" name="achievement_image" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Say something</label>
                                                    <textarea name="achievement_description" class="form-control" placeholder="Type something.." rows="4" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Achievement Certificate link</label>
                                                    <input type="text" name="achievement_url" class="form-control" placeholder="Enter Achievement Certificate link" required>
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
                        <table id="achievementTable" class="table table-bordered">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>Serial</th>
                                    <th>Achievement Title</th>
                                    <th>Achievement Certificate</th>
                                    <th>Description</th>
                                    <th>Certificate Link</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($achievementsites as $achievementsite)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $achievementsite->achievement_title }}</td>
                                    <td><div class="card" style="width: 5rem;">
                                        <img class="card-img-top" src="{{ asset('uploads/achievement') }}/{{ $achievementsite->achievement_image }}" alt="Card image cap">
                                      </div>
                                    </td>
                                    <td>{{ $achievementsite->achievement_description }}</td>
                                    <td>{{ $achievementsite->achievement_url }}</td>
                                    <td>
                                        {{ $achievementsite->created_at->format('d-M-Y h:i:s A') }}
                                        <br>
                                        {{ $achievementsite->created_at->diffForHumans() }}
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/change/status/achievement') }}/{{ $achievementsite->id }}">
                                            <button type="submit"
                                                class="
                                                @if ($achievementsite->status == 1)btn btn-sm btn-success
                                                @else  btn btn-sm btn-danger
                                                @endif">
                                                @if ( $achievementsite->status == 1)
                                                Published
                                                @else Unpublished
                                                @endif
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                    {{-- Edit --}}
                                    <div class="mb-2">
                                        <a href="javascripts:void(0)" class="btn btn-light" data-achiid="{{$achievementsite->id}}" data-mytitle="{{$achievementsite->achievement_title}}" data-myimage="{{ asset('uploads/achievement') }}/{{ $achievementsite->achievement_image }}" data-mydescrip="{{$achievementsite->achievement_description}}" data-achiurl="{{$achievementsite->achievement_url}}" data-toggle="modal" data-target="#editachievementModal"><i class="ti-pencil-alt"></i></a>
                                        @include('backend.page.achievement.edit')
                                    </div>

                                     {{-- delete --}}
                                     <div class="mb-2">
                                        <a href="{{ url('admin/achievementsite/delete/') }}/{{ $achievementsite->id }}"class="btn btn-light"><i class="ti-trash"></i></a>
                                    </div>
                                    </td>
                                </tr>
                                @empty
                                <tr class="text-center text-danger">
                                    <td colspan="12">No Data Available</td>
                                </tr>
                                @endforelse
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
            $('#achievementTable').DataTable();
        });
        $('#editachievementModal').on('show.bs.modal', function (event) {
            var a = $(event.relatedTarget)
            var AchiTitle = a.data('mytitle')
            var AchiImageId = a.data('myimage')
            var AchiId = a.data('achiid')
            var AchiUrl = a.data('achiurl')
            var AchiDescrip = a.data('mydescrip')
            var modal = $(this)
            modal.find('.modal-body #achi_id').val(AchiId);
            modal.find('.modal-body #achievement_title').val(AchiTitle);
            modal.find('.modal-body #myachiImage').attr("src", AchiImageId);
            modal.find('.modal-body #achievement_description').val(AchiDescrip);
            modal.find('.modal-body #achievement_url').val(AchiUrl);
        });

    });
</script>
@endsection
