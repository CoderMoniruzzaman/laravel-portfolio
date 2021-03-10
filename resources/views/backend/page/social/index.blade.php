@extends('backend.layouts.master')
@section('title')
Personal Social Link
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
                    <li><span>Personal Social link my website</span></li>
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
            <div class="card-group">

                <div class="card">
                    <div class="card-header">
                        <button class="button-one create_socail" name="create_socail" id="create_socail" data-toggle="modal"><i class="ti-plus mr-2"></i>Create new one</button>
                            <!-- modal -part start -->
                            <div class="modal fade" id="socailModal" role="dialog">
                                <div class="modal-dialog modal-dialog-centered"  role="document">
                                    <div class="modal-content">
                                        {{-- <div class="alert alert-danger" style="display:none"></div> --}}
                                        <div class="modal-header">
                                            <h5 class="modal-title">Create Category</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <!--Sub-Category insert form -->
                                            <form class="row" id="social_form" enctype="multipart/form-data" role="form">
                                                @csrf
                                                <!-- form erors -->
                                                <div class="col-lg-12">
                                                    <span id="formsocial_result"></span>
                                                </div>
                                                <!--Sub-Category form item -->
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Social Name</label>
                                                        <input type="text" name="socail_name" id="socail_name" class="form-control" placeholder="Enter Social Name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Social Link</label>
                                                        <input type="text" name="link" id="link" class="form-control" placeholder="Enter Social Link" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Social Icon</label>
                                                        <input type="text" name="icon" id="icon" class="form-control" placeholder="Enter Social Icon" required>
                                                    </div>
                                                </div>
                                                <!--Sub-Category form button -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="hidden" name="action" id="action_social" value="submit">
                                                        <input type="submit" class="button-one" value="submit">
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
                        <table id="socialTable" class="table table-bordered">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>Serial</th>
                                    <th>Name</th>
                                    <th>Link</th>
                                    <th>Icon</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        @include('backend.page.social.edit')
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
        //get data table
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var t = $('#socialTable').DataTable({
                processing: true,
                serverSide: true,
                method:"GET",
                ajax: {
                    url: "{{ route('admin.sociallink.index') }}",
                },
                columns:[
                    { data: 'id', name: 'id', 'visible': true},
                    { data: 'socail_name', name: 'socail_name' },
                    { data: 'link', name: 'link' },
                    { data: 'icon', name: 'icon' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false},
                ],
                order: [[0, 'desc']],
            });
            t.on( 'draw.dt', function () {
            var PageInfo = $('#socialTable').DataTable().page.info();
                t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                    cell.innerHTML = i + 1 + PageInfo.start;
                } );
            } );

            //Create form
            $('.create_socail').click(function(){
                $('#socailModal').modal('show');
            });
            $('#social_form').on('submit',function(event){
                event.preventDefault();
                var action_url = '';
                if($('#action_social').val() == 'submit'){
                    action_url =  "{{ route('admin.sociallink.store') }}";
                }
                toastr.options = {
                "closeButton": true,
                "newestOnTop": true,
                "positionClass": "toast-top-right",
                "progressBar": true,
                };
                $.ajax({
                    url: action_url,
                    type: 'POST',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'socail_name': $('input[name=socail_name]').val(),
                        'link': $('input[name=link]').val(),
                        'icon': $('input[name=icon]').val(),
                    },
                    success: function(data){
                        var html ='';
                        if ((data.errors)) {
                            html = '<div class="alert alert-danger">';
                            html+='<div class="button"><button type="button" class="close" data-dismiss="alert">×</button></div>';
                            for(var count = 0; count < data.errors.length; count++)
                            {
                            html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        else {
                            $('#socailModal').modal('hide');
                            $('#social_form')[0].reset();
                            $('#socialTable').DataTable().ajax.reload();
                            toastr.success(data.success);
                        }
                        $('#formsocial_result').html(html);
                    },
                });
            });

        });

        //edit get sociallink data
        $(document).on('click', '.open-editsocialmodal', function(){
            var id = $(this).attr('id');
            $.ajax({
                url : "sociallink/"+id+"/edit",
                dataType:"json",
                success:function(data)
                {
                    $('#socailname').val(data.result.socail_name);
                    $('#socaillink').val(data.result.link);
                    $('#socailicon').val(data.result.icon);
                    $('#hiddenid').val(data.result.id);
                    $('.modal-title').text('Edit Record');
                    $('#editsocialModal').modal('show');
                }
            });
        });

        //update sociallink data
        $('#update_socialinsert').on('submit',function(event){
            event.preventDefault();
            var actions_url='';
            var socail_name = $('#socailname').val();
            var link = $('#socaillink').val();
            var icon = $('#socailicon').val();
            var id = $('#hiddenid').val();
            if($('#edit_socialactions').val() == 'submit'){
                actions_url ="{{ route('admin.socail.update') }}";
            }
            toastr.options = {
                "closeButton": true,
                "newestOnTop": true,
                "positionClass": "toast-top-right",
                "progressBar": true,
            };
            $.ajax({
                url :actions_url,
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                success:function(data)
                {
                    var html ='';
                    if ((data.errors)) {
                        html = '<div class="alert alert-danger">';
                        html+='<div class="button"><button type="button" class="close" data-dismiss="alert">×</button></div>';
                        for(var count = 0; count < data.errors.length; count++)
                        {
                        html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    else {
                        $('#editsocialModal').modal('hide');
                        $('#socialTable').DataTable().ajax.reload();
                        toastr.success(data.success);
                    }
                    $('#editsocialErors').html(html);
                }
            });
        });

        //delete category
        $(document).on('click', '.social_delete', function(){
            var so_id = $(this).attr('data-id');

            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed){
                        $.ajax({
                            url:"{{url('admin/sociallink/delete/data/')}}/"+so_id,
                            success:function(data) {
                                if (data.success){
                                    swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        "success"
                                    );
                                    $('#socialTable').DataTable().ajax.reload();
                                }

                            }
                        });
                    }
                } else if (
                result.dismiss === Swal.DismissReason.cancel
                ) {
                swal.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                );
                }
            });

        });

        //change status
        $(document).on('click', '.change_status', function(){
            var so_id = $(this).attr('data-id');
            $.ajax({
                url:"{{url('/admin/sociallink/status/')}}/"+so_id,
                success:function(data) {
                    if (data.info){
                        $('#socialTable').DataTable().ajax.reload();
                        toastr.warning(data.info);
                    }
                    if (data.success){
                        $('#socialTable').DataTable().ajax.reload();
                        toastr.success(data.success);
                    }
                }
            });
        });
    });
</script>
@endsection
