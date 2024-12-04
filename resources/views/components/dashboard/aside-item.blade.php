@props(['slug', 'route', 'title'])
<div class="menu-item {{ getClassIfUrlContains('here', $slug) }} show menu-accordion hover-scale">
    <!--begin:Menu link-->
    <a class="menu-link" href="{{ $route }}">
        <span class="menu-icon">
            {!! $slot !!}
        </span>
        <span class="menu-title">{{ $title }}</span>
    </a>
    <!--end:Menu link-->
</div>
