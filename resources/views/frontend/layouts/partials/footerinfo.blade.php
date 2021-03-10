<!-- My Info -->
@php
$so_infos = App\Models\Personalinfo::all();
@endphp
<div class="my-info">
    <div class="box">
        @foreach ($so_infos as $so_info)
        <div class="field field-my-info field-separator">
            <h6>Location</h6>
            <p>{{ $so_info->address }}</p>
        </div>
        <div class="field field-my-info field-separator">
            <h6>Mobile No</h6>
            <p>{{ $so_info->phone }}</p>
        </div>
        <div class="field field-my-info field-separator">
            <h6>Email</h6>
            <p>{{ $so_info->email }}</p>
        </div>
        <div class="clear"></div>
        <a class="button-color" href="{{ url('admin/file/download') }}/{{$so_info->id}}"><span class="ti-download"></span> DOWNLOAD CV</a>
        @endforeach
    </div>
</div>
