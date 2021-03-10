
@extends('backend.layouts.master')
@section('title')
Education
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
                    <li><span>My Education</span></li>
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
                        <button class="button-one create_education" name="create_education" id="create_education" data-toggle="modal"><i class="ti-plus mr-2"></i>Create new one</button>
                            <!-- modal -part start -->
                            <div class="modal fade" id="educationModal" role="dialog">
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
                                            <form class="row" id="education_form" enctype="multipart/form-data" role="form">
                                                @csrf
                                                <!-- form erors -->
                                                <div class="col-lg-12">
                                                    <span id="formeducation_result"></span>
                                                </div>
                                                <!--Sub-Category form item -->
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>institute Name</label>
                                                        <input type="text" name="institute_name" id="institute_name" class="form-control" placeholder="Enter institute Name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Degree</label>
                                                        <input type="text" name="institute_degree" id="institute_degree" class="form-control" placeholder="EX: Bsc in CSE" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Session</label>
                                                        <input type="text" name="degree_year" id="degree_year" class="form-control" placeholder="EX: 2014-2018" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea name="education_description" class="form-control" id="education_description" cols="30" rows="4" placeholder="" required></textarea>
                                                    </div>
                                                </div>
                                                <!--Sub-Category form button -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="hidden" name="action" id="action_education" value="submit">
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
                        <table id="educationTable" class="table table-bordered">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>Serial</th>
                                    <th>Institute Name</th>
                                    <th>Degree</th>
                                    <th>Year</th>
                                    <th>Education Description</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        @include('backend.page.education.edit')
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
            var t = $('#educationTable').DataTable({
                processing: true,
                serverSide: true,
                method:"GET",
                ajax: {
                    url: "{{ route('admin.education.index') }}",
                },
                columns:[
                    { data: 'id', name: 'id', 'visible': true},
                    { data: 'institute_name', name: 'institute_name' },
                    { data: 'institute_degree', name: 'institute_degree' },
                    { data: 'degree_year', name: 'degree_year' },
                    { data: 'education_description', name: 'education_description' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false},
                ],
                order: [[0, 'desc']],
            });
            t.on( 'draw.dt', function () {
            var PageInfo = $('#educationTable').DataTable().page.info();
                t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                    cell.innerHTML = i + 1 + PageInfo.start;
                } );
            } );

            //Create form
            $('.create_education').click(function(){
                $('#educationModal').modal('show');
            });
            $('#education_form').on('submit',function(event){
                event.preventDefault();
                var action_url = '';
                if($('#action_education').val() == 'submit'){
                    action_url =  "{{ route('admin.education.store') }}";
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
                            $('#educationModal').modal('hide');
                            $('#education_form')[0].reset();
                            $('#educationTable').DataTable().ajax.reload();
                            toastr.success(data.success);
                        }
                        $('#formeducation_result').html(html);
                    },
                });
            });
        });
        //edit get education data
        $(document).on('click', '.open-editeducationmodal', function(){
            var id = $(this).attr('id');
            $.ajax({
                url : "education/"+id+"/edit",
                dataType:"json",
                success:function(data)
                {
                    $('#institutename').val(data.result.institute_name);
                    $('#institutedegree').val(data.result.institute_degree);
                    $('#degreeyear').val(data.result.degree_year);
                    $('#educationdescription').val(data.result.education_description);
                    $('#education_id').val(data.result.id);
                    $('.modal-title').text('Edit Record');
                    $('#editeducationModal').modal('show');
                }
            });
        });
        //update education data
        $('#update_educationinsert').on('submit',function(event){
            event.preventDefault();
            var actions_url='';
            var id = $('#education_id').val();
            if($('#edit_education').val() == 'submit'){
                actions_url ="{{ route('admin.educationdata.update') }}";
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
                        $('#editeducationModal').modal('hide');
                        $('#educationTable').DataTable().ajax.reload();
                        toastr.info(data.success);
                    }
                    $('#editeducationErors').html(html);
                }
            });
        });

        //delete education
        $(document).on('click', '.education_delete', function(){
            var edu_id = $(this).attr('data-id');

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
                            url:"{{url('admin/education/delete/data/')}}/"+edu_id,
                            success:function(data) {
                                if (data.success){
                                    swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        "success"
                                    );
                                    $('#educationTable').DataTable().ajax.reload();
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
            var edu_id = $(this).attr('data-id');
            $.ajax({
                url:"{{url('/admin/education/status/')}}/"+edu_id,
                success:function(data) {
                    if (data.info){
                        $('#educationTable').DataTable().ajax.reload();
                        toastr.warning(data.info);
                    }
                    if (data.success){
                        $('#educationTable').DataTable().ajax.reload();
                        toastr.info(data.success);
                    }
                }
            });
        });





    });
</script>
@endsection
