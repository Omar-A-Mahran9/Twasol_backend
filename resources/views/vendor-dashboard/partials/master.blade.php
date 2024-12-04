<!DOCTYPE html>
<html @if(!isArabic()) lang="en" direction="ltr" style="direction:ltr" @else lang="ar" direction="rtl" style="direction:rtl"  @endif  data-theme-mode="{{ setting('theme_mode') ?? 'light' }}" data-theme="{{ setting('theme_mode') ?? 'light' }}">
	<!--begin::Head-->
	<head>
        @include('vendor-dashboard.partials.head')
        @stack('styles')
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="{{ count(request()->segments()) == 1 ? 'sidebar-enabled' : '' }}">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-theme-mode")) { themeMode = document.documentElement.getAttribute("data-theme-mode"); } else { if ( localStorage.getItem("data-theme") !== null ) { themeMode = localStorage.getItem("data-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Aside-->
				@include('vendor-dashboard.partials.aside')
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--begin::Header-->
					@include('vendor-dashboard.partials.header')
					<!--end::Header-->
                    <!--begin::Content-->
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <!--begin::Container-->
                        <div class="container-xxl" id="kt_content_container">
                            @yield('content')
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Content-->
					<!--begin::Footer-->
					@include('vendor-dashboard.partials.footer')
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
				@yield('sidebar')
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
			<span class="svg-icon">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
				</svg>
			</span>
			<!--end::Svg Icon-->
		</div>
		<!--end::Scrolltop-->

		<!--begin::Toast-->
        <div class="position-fixed bottom-0 sart-0 p-3 " style="z-index: 1090">
            <div id="kt_docs_toast_toggle" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="{{ getImagePathFromDirectory(setting('fav_icon'), "Settings") }}" class="me-2 theme-light-show"  width="20" srcset="">
                    <img src="{{ getImagePathFromDirectory(setting('fav_icon'), "Settings") }}" class="me-2 theme-dark-show"  width="20" srcset="">
                    <strong class="me-auto">{{ __('Platin') }}</strong>
                    <small>{{ __('Now') }}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ __('Successfully done.') }}.
                </div>
            </div>
        </div>

        <audio controls id="notification-sound" style="display: none">
            <source class="sound-source" src="{{asset('assets/dashboard/sounds/new-notification.mp3')}}" type="audio/ogg">
            <source class="sound-source" src="{{asset('assets/dashboard/sounds/new-notification.mp3')}}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
        <audio controls id="success-sound" style="display: none">
            <source class="sound-source" src="{{asset('assets/dashboard/sounds/success.mp3')}}" type="audio/ogg">
            <source class="sound-source" src="{{asset('assets/dashboard/sounds/success.mp3')}}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
        <audio controls id="error-sound" style="display: none">
            <source class="sound-source" src="{{asset('assets/dashboard/sounds/error.mp3')}}" type="audio/ogg">
            <source class="sound-source" src="{{asset('assets/dashboard/sounds/error.mp3')}}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>

		<!--end::Toast-->

		<!--begin::Javascript-->
		@include('vendor-dashboard.partials.foot')

		<!--end::Javascript-->
        <script>
            var sessionHasSuccess = {{ request()->session()->has('success') ? 1 : 0 }};

            if (sessionHasSuccess) {
                showToast()
            }
			$(document).ready(function () {
				let mode = "{{ setting('theme_mode') ?? 'light' }}";
				localStorage.setItem("data-theme", mode);
				localStorage.setItem("data-theme-mode", mode);
			});
        </script>
        <!-- end::Toast -->
    <script>
        var favIconCounter = {{ $unreadNotifications->count() }};
        var favicon;

        $(document).ready(function() {
            favicon = new Favico({
                animation: 'popFade'
            });

            if (favIconCounter > 0)
                favicon.badge(favIconCounter);

            KTLayoutSearch.init();
        });
    </script>
	</body>
	<!--end::Body-->
</html>
