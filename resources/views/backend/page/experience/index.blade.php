
@extends('backend.layouts.master')
@section('title')
Experience
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
                    <li><span>My experience</span></li>
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
                        <button class="button-one create_experience" name="create_experience" id="create_experience" data-toggle="modal"><i class="ti-plus mr-2"></i>Create new one</button>
                            <!-- modal -part start -->
                            <div class="modal fade" id="experienceModal" role="dialog">
                                <div class="modal-dialog modal-dialog-centered"  role="document">
                                    <div class="modal-content">
                                        {{-- <div class="alert alert-danger" style="display:none"></div> --}}
                                        <div class="modal-header">
                                            <h5 class="modal-title">Experience</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!--Sub-Category insert form -->
                                            <form class="row" id="experience_form" enctype="multipart/form-data" role="form">
                                                @csrf
                                                <!-- form erors -->
                                                <div class="col-lg-12">
                                                    <span id="formexperience_result"></span>
                                                </div>
                                                <!--Sub-Category form item -->
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Company Name</label>
                                                        <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Enter Company Name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Position</label>
                                                        <input type="text" name="position" id="position" class="form-control" placeholder="EX: Team leader" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Duration</label>
                                                        <input type="text" name="job_year" id="job_year" class="form-control" placeholder="EX: 2014-2018" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea name="job_description" class="form-control" id="job_description" cols="30" rows="4" placeholder="" required></textarea>
                                                    </div>
                                                </div>
                                                <!--Sub-Category form button -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="hidden" name="action" id="action_experience" value="submit">
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
                        <table id="experienceTable" class="table table-bordered">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>Serial</th>
                                    <th>Company Name</th>
                                    <th>position</th>
                                    <th>Duration</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        @include('backend.page.experience.edit')
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
            var t = $('#experienceTable').DataTable({
                processing: true,
                serverSide: true,
                method:"GET",
                ajax: {
                    url: "{{ route('admin.experience.index') }}",
                },
                columns:[
                    { data: 'id', name: 'id', 'visible': true},
                    { data: 'company_name', name: 'company_name' },
                    { data: 'position', name: 'position' },
                    { data: 'job_year', name: 'job_year' },
                    { data: 'job_description', name: 'job_description' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false},
                ],
                order: [[0, 'desc']],
            });
            t.on( 'draw.dt', function () {
            var PageInfo = $('#experienceTable').DataTable().page.info();
                t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                    cell.innerHTML = i + 1 + PageInfo.start;
                } );
            } );

            //Create form
            $('.create_experience').click(function(){
                $('#experienceModal').modal('show');
            });
            $('#experience_form').on('submit',function(event){
                event.preventDefault();
                var action_url = '';
                if($('#action_experience').val() == 'submit'){
                    action_url =  "{{ route('admin.experience.store') }}";
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
                            $('#experienceModal').modal('hide');
                            $('#experience_form')[0].reset();
                            $('#experienceTable').DataTable().ajax.reload();
                            toastr.success(data.success);
                        }
                        $('#formexperience_result').html(html);
                    },
                });
            });
        });

        //edit get experience data
        $(document).on('click', '.open-editexperiencemodal', function(){
            var id = $(this).attr('id');
            $.ajax({
                url : "experience/"+id+"/edit",
                dataType:"json",
                success:function(data)
                {
                    $('#companyname').val(data.result.company_name);
                    $('#positiondata').val(data.result.position);
                    $('#jobyear').val(data.result.job_year);
                    $('#jobdescription').val(data.result.job_description);
                    $('#exp_id').val(data.result.id);
                    $('.modal-title').text('Edit Record');
                    $('#editexperienceModal').modal('show');
                }
            });
        });
        //update experience data
        $('#update_experienceinsert').on('submit',function(event){
            event.preventDefault();
            var actions_url='';
            var id = $('#exp_id').val();
            if($('#edit_exp').val() == 'submit'){
                actions_url ="{{ route('admin.experiencedata.update') }}";
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
                        $('#editexperienceModal').modal('hide');
                        $('#experienceTable').DataTable().ajax.reload();
                        toastr.info(data.success);
                    }
                    $('#editexperienceErors').html(html);
                }
            });
        });

        //delete experience
        $(document).on('click', '.experience_delete', function(){
            var exp_id = $(this).attr('data-id');

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
                            url:"{{url('admin/experience/delete/data/')}}/"+exp_id,
                            success:function(data) {
                                if (data.success){
                                    swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        "success"
                                    );
                                    $('#experienceTable').DataTable().ajax.reload();
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
            var exp_id = $(this).attr('data-id');
            $.ajax({
                url:"{{url('/admin/experience/status/')}}/"+exp_id,
                success:function(data) {
                    if (data.info){
                        $('#experienceTable').DataTable().ajax.reload();
                        toastr.warning(data.info);
                    }
                    if (data.success){
                        $('#experienceTable').DataTable().ajax.reload();
                        toastr.info(data.success);
                    }
                }
            });
        });





    });
</script>
@endsection
