
@extends('backend.layouts.master')
@section('title')
Service
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
                    <li><span>My Service</span></li>
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
                        <button class="button-one create_service" name="create_service" id="create_service" data-toggle="modal"><i class="ti-plus mr-2"></i>Create new one</button>
                            <!-- modal -part start -->
                            <div class="modal fade" id="serviceModal" role="dialog">
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
                                            <form class="row" id="service_form" enctype="multipart/form-data" role="form">
                                                @csrf
                                                <!-- form erors -->
                                                <div class="col-lg-12">
                                                    <span id="formservice_result"></span>
                                                </div>
                                                <!--Sub-Category form item -->
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Service Name</label>
                                                        <input type="text" name="service_name" id="service_name" class="form-control" placeholder="Enter Service Name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Service Icon</label>
                                                        <input type="text" name="icon" id="icon" class="form-control" placeholder="Enter Service Icon" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Service Description</label>
                                                        <textarea name="service_description" class="form-control" id="service_description" id="service_description" cols="30" rows="4" placeholder="Type Service Description" required></textarea>
                                                    </div>
                                                </div>
                                                <!--Sub-Category form button -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="hidden" name="action" id="action_service" value="submit">
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
                        <table id="serviceTable" class="table table-bordered">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>Serial</th>
                                    <th>Name</th>
                                    <th>Icon</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        @include('backend.page.service.edit')
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
            var t = $('#serviceTable').DataTable({
                processing: true,
                serverSide: true,
                method:"GET",
                ajax: {
                    url: "{{ route('admin.service.index') }}",
                },
                columns:[
                    { data: 'id', name: 'id', 'visible': true},
                    { data: 'service_name', name: 'service_name' },
                    { data: 'icon', name: 'icon' },
                    { data: 'service_description', name: 'service_description' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false},
                ],
                order: [[0, 'desc']],
            });
            t.on( 'draw.dt', function () {
            var PageInfo = $('#serviceTable').DataTable().page.info();
                t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                    cell.innerHTML = i + 1 + PageInfo.start;
                } );
            } );

            //Create form
             $('.create_service').click(function(){
                $('#serviceModal').modal('show');
            });

            $('#service_form').on('submit',function(event){
                event.preventDefault();
                var action_url = '';
                if($('#action_service').val() == 'submit'){
                    action_url =  "{{ route('admin.service.store') }}";
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
                    data:$(this).serialize(),
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
                            $('#serviceModal').modal('hide');
                            $('#service_form')[0].reset();
                            $('#serviceTable').DataTable().ajax.reload();
                            toastr.success(data.success);
                        }
                        $('#formservice_result').html(html);
                    },
                });
            });
        });
        //edit get service data
        $(document).on('click', '.open-editservicemodal', function(){
            var id = $(this).attr('id');
            $.ajax({
                url : "service/"+id+"/edit",
                dataType:"json",
                success:function(data)
                {
                    $('#servicename').val(data.result.service_name);
                    $('#serviceicon').val(data.result.icon);
                    $('#servicedescription').val(data.result.service_description);
                    $('#service_id').val(data.result.id);
                    $('.modal-title').text('Edit Record');
                    $('#editserviceModal').modal('show');
                }
            });
        });
        //update service data
        $('#update_serviceinsert').on('submit',function(event){
            event.preventDefault();
            var actions_url='';
            var socail_name = $('#servicename').val();
            var icon = $('#serviceicon').val();
            var description = $('#servicedescription').val();
            var id = $('#service_id').val();
            if($('#edit_serviceactions').val() == 'submit'){
                actions_url ="{{ route('admin.servicedata.update') }}";
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
                        $('#editserviceModal').modal('hide');
                        $('#serviceTable').DataTable().ajax.reload();
                        toastr.info(data.success);
                    }
                    $('#editserviceErors').html(html);
                }
            });
        });

        //delete service
        $(document).on('click', '.service_delete', function(){
            var sa_id = $(this).attr('data-id');

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
                            url:"{{url('admin/service/delete/data/')}}/"+sa_id,
                            success:function(data) {
                                if (data.success){
                                    swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        "success"
                                    );
                                    $('#serviceTable').DataTable().ajax.reload();
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
            var sa_id = $(this).attr('data-id');
            $.ajax({
                url:"{{url('/admin/service/status/')}}/"+sa_id,
                success:function(data) {
                    if (data.info){
                        $('#serviceTable').DataTable().ajax.reload();
                        toastr.warning(data.info);
                    }
                    if (data.success){
                        $('#serviceTable').DataTable().ajax.reload();
                        toastr.success(data.success);
                    }
                }
            });
        });





    });
</script>
@endsection
