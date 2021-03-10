<!-- Social Media -->
@php
$so_links = App\Models\Socilalink::orderBy('created_at', 'DESC')->where('status', 1)->get();
@endphp
<div id="social-profiles">
    <nav class="social-menu">
        <ul>
            @foreach ($so_links as $so_link)
            <li class="menu-item"><a href="{{ $so_link->link }}" target="_blank"><span class="ti"><i class="{{ $so_link->icon }}"></i></span></a></li>
            @endforeach
        </ul>
    </nav>
</div>
