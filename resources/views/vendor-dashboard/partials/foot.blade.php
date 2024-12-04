<script>
    var locale = 'ar';
    var soundStatus = '{{ setting('sound_status') }}';
    var notificationSoundOn = {{ setting('notification_status') ?? 0 }};
    var faviconPath = '{{ asset(getImagePathFromDirectory(setting('fav_icon'), 'Settings')) }}';
</script>
<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('assets/vendor-dashboard/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor-dashboard/js/scripts.bundle.js') }}?v=0"></script>
<script src="{{ asset('assets/vendor-dashboard/js/global/scripts.js') }}"></script>
<script src="{{ asset('assets/vendor-dashboard/js/global/translations.js') }}"></script>
<script src="{{ asset('assets/vendor-dashboard/js/favicon-badge.js') }}"></script>
<!--end::Global Javascript Bundle-->

@stack('scripts')



