@if (count($breadcrumbs))

    @if(request()->is('vendor'))
        <h1 class="d-flex flex-column text-dark fw-bold my-0 fs-1">
            {{ __('مرحبا , ') . auth()->user()->name }}
        </h1>
        <span class="breadcrumb-item text-muted">{{ auth()->user()->main_role_name }}</span>
    @else
        <h1 class="d-flex flex-column text-dark fw-bold my-0 fs-1">
            {{ __('Dashboard') }}
        </h1>
        <ul class="breadcrumb breadcrumb-dot fw-semibold fs-base my-1">
            @foreach ($breadcrumbs as $breadcrumb)

                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item text-muted"><a class="text-muted" href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                @else
                    <li class="breadcrumb-item text-dark">{{ $breadcrumb->title }}</li>
                @endif

            @endforeach
        </ul>
    @endif
@endif
