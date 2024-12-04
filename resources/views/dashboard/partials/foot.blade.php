<script>
    let imagesBasePath = "{{ asset('/storage/Images') }}";
    let locale = "{{ app()->getLocale() }}";
    let soundStatus = 'start';
</script>

<!--begin::Javascript-->
<script>var hostUrl = "{{asset('assets/dashboard/')}}";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('assets/dashboard/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{ asset('assets/dashboard/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
<script src="{{ asset('assets/dashboard/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
@stack('pre_scripts')
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{asset('assets/dashboard/js/widgets.bundle.js')}}"></script>
<script src="{{asset('assets/dashboard/js/custom/widgets.js')}}"></script>
<script src="{{asset('assets/dashboard/js/custom/utilities/modals/users-search.js')}}"></script>
<script src="{{ asset("assets/shared/js/global.js") }}"></script>
<script src="{{asset('assets/dashboard/js/global/translations.js') }}"></script>
<script src="{{asset('assets/dashboard/js/global/scripts.js')}}"></script>
<script src="{{ asset('assets/dashboard/js/favicon-badge.js') }}"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->

@stack('scripts')
<!--end::Custom Javascript-->
<!--end::Javascript-->
