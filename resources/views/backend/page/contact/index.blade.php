@extends('backend.layouts.master')
@section('title')
Project
@endsection
@section('style')
<style>
    .bg_message{
  background: #EEEEEE !important;
  font-weight:700 !important;
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
                    <li><span>All messsage list</span></li>
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
                    <h6>All messsage list</h6>
                </div>

                <div class="card-body table-responsive">
                    <table id="cantactTable" class="table table-bordered">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Serial</th>
                                <th>name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($all_mails as $all_mail)
                            <tr class= "{{ ($all_mail -> readstatus == 1)?"bg_message":"" }}" style="color:#2B2624; font-weight:400; background:#ffffff;">
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $all_mail->name }}</td>
                                <td>{{ $all_mail->email }}</td>
                                <td>{{ $all_mail->Subject }}</td>
                                <td>{{ Str::limit($all_mail->message, 50) }}</td>
                                <td>
                                    {{ $all_mail->created_at->format('d-M-Y h:i:s A')}}
                                    <br>
                                    {{ $all_mail->created_at->diffForHumans() }}
                                </td>
                                <td>
                                    @php
                                    if ($all_mail->readstatus == 1){
                                        echo "Unread";
                                    }
                                    else {
                                        echo "Seen";
                                    }
                                    @endphp
                                </td>

                                <td>
                                    {{--View --}}
                                    <div class="mb-2">
                                        <a href="{{url('admin/contact/emailview/') }}/{{$all_mail->id }}"class="btn-sm btn-light"><i class="ti-eye"></i> <span style="font-size: 13px">Open</span></a>
                                    </div>

                                     {{-- delete --}}
                                     <div class="mb-2">
                                        <a href=""class="btn-sm btn-light"><i class="ti-trash"></i> <span style="font-size: 13px">Delete</span></a>
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

        $('#cantactTable').DataTable();

    });
</script>
@endsection

