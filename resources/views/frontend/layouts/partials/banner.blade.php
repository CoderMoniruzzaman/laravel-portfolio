<!-- Media -->
@php
$images = App\Models\Personalinfo::all();
@endphp

<div class="hero-media">
    <div class="owl-carousel" data-expand-duration="800">
        @foreach ($images as $image)
        <div class="item owl-lazy" data-src="{{ asset('uploads/mysite/personal') }}/{{ $image->image }}"></div>
        @endforeach
    </div>
    <span class="overlay"></span> <span class="ti ti-spin ti-loading"></span>
</div>


