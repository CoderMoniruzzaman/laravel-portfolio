
@extends('backend.layouts.master')
@section('title')
Freelance Site
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
                    <li><span>My freelance site</span></li>
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
                        <button class="button-one" data-target="#feelancesiteModal" data-toggle="modal"><i class="ti-plus mr-2"></i>Create new one</button>
                        <!-- modal -part start -->
                        <div class="modal fade" id="feelancesiteModal" role="dialog">
                            <div class="modal-dialog modal-dialog-centered"  role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Freelance Site</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!--Sub-Category insert form -->
                                        <form class="row" action="{{ route('admin.freelanceesite.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <!--Sub-Category form item -->
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Freelance site name</label>
                                                    <input type="text" name="feelancesite_name" class="form-control" placeholder="Enter Freelance site name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Freelance site icon</label>
                                                    <input type="file" name="feelancesite_image" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Say something</label>
                                                    <textarea name="feelancesite_description" class="form-control" placeholder="Type something.." rows="4" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Freelance site icon</label>
                                                    <input type="text" name="freelance_url" class="form-control" placeholder="Enter Freelance site url" required>
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
                        <table id="freelancesiteTable" class="table table-bordered">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>Serial</th>
                                    <th>Freelance Site name</th>
                                    <th>Freelance Site logo</th>
                                    <th>description</th>
                                    <th>URL</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($freelancessites as $freelancessite)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $freelancessite->feelancesite_name }}</td>
                                    <td><div class="card" style="width: 5rem;">
                                        <img class="card-img-top" src="{{ asset('uploads/freelancesiteIcon') }}/{{ $freelancessite->feelancesite_image }}" alt="Card image cap">
                                      </div>
                                    </td>
                                    <td>{{ $freelancessite->feelancesite_description }}</td>
                                    <td>{{ $freelancessite->freelance_url }}</td>
                                    <td>
                                        {{ $freelancessite->created_at->format('d-M-Y h:i:s A') }}
                                        <br>
                                        {{ $freelancessite->created_at->diffForHumans() }}
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/change/status/freelance') }}/{{ $freelancessite->id }}">
                                            <button type="submit"
                                                class="
                                                @if ($freelancessite->status == 1)btn btn-sm btn-success
                                                @else  btn btn-sm btn-danger
                                                @endif">
                                                @if ( $freelancessite->status == 1)
                                                Published
                                                @else Unpublished
                                                @endif
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                    {{-- Edit --}}
                                    <div class="mb-2">
                                        <a href="javascripts:void(0)" class="btn btn-light" data-freeid="{{$freelancessite->id}}" data-mytitle="{{$freelancessite->feelancesite_name}}" data-myimage="{{ asset('uploads/freelancesiteIcon') }}/{{ $freelancessite->feelancesite_image }}" data-mydescrip="{{$freelancessite->feelancesite_description}}" data-freurl="{{$freelancessite->freelance_url}}" data-toggle="modal" data-target="#editfreelancesiteModal"><i class="ti-pencil-alt"></i></a>
                                        @include('backend.page.freelance.edit')
                                    </div>

                                     {{-- delete --}}
                                     <div class="mb-2">
                                        <a href="{{ url('admin/freelanceesite/delete') }}/{{ $freelancessite->id }}"class="btn btn-light"><i class="ti-trash"></i></a>
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
            $('#freelancesiteTable').DataTable();
        });
        $('#editfreelancesiteModal').on('show.bs.modal', function (event) {
            var a = $(event.relatedTarget)
            var title = a.data('mytitle')
            var myImageId = a.data('myimage')
            var FreeId = a.data('freeid')
            var FreeUrl = a.data('freurl')
            var Descrip = a.data('mydescrip')
            var modal = $(this)
            modal.find('.modal-body #fee_id').val(FreeId);
            modal.find('.modal-body #feelancesite_name').val(title);
            modal.find('.modal-body #myImage').attr("src", myImageId);
            modal.find('.modal-body #feelancesite_description').val(Descrip);
            modal.find('.modal-body #freelance_url').val(FreeUrl);
        });

    });
</script>
@endsection
