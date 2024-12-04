@extends('dashboard.partials.master')
@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body" id="card-body">
            <!--begin::Stepper-->
            <div class="stepper stepper-links d-flex flex-column pt-15" id="kt_create_account_stepper">
                <!--begin::Nav-->
                <div class="stepper-nav mb-5">
                    <!--begin::Step 1-->
                    <div class="stepper-item current" data-kt-stepper-element="nav">
                        <h3 class="stepper-title">{{ __('Car data') }}</h3>
                    </div>
                    <!--end::Step 1-->

                    <!--begin::Step 3-->
                    <div class="stepper-item" data-kt-stepper-element="nav">
                        <h3 class="stepper-title">{{ __('Car images') }}</h3>
                    </div>
                    <!--end::Step 3-->
                </div>
                <!--end::Nav-->
                <!--begin::Form-->
                {{-- {{ route('dashboard.cars.store') }} --}}
                <form action="{{ route('dashboard.cars.store') }}" method="POST" novalidate="novalidate"
                    id="kt_create_account_form">
                    <div class="current" data-kt-stepper-element="content">
                        <!--begin::Main column-->
                        <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">
                            <!--begin::Order details-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{ __('Car Details') }}</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Product Details-->
                                    <div class="d-flex flex-column gap-5 gap-md-7">
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column flex-md-row gap-5">
                                            <div class="fv-row flex-row-fluid">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{ __('Categories') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Select2-->
                                                <select class="form-select form-select-solid product_name_comination_class"
                                                    onchange="handleInputChange()" data-control="select2" name="category_id"
                                                    id="categories_inp" data-placeholder="{{ __('Choose the categories') }}"
                                                    data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                                    <option value="" selected></option>

                                                    @foreach ($categories as $categroy)
                                                        <option value="{{ $categroy->id }}"> {{ $categroy->name }} </option>
                                                    @endforeach
                                                </select>
                                                <!--end::Select2-->
                                                <div class="fv-plugins-message-container invalid-feedback" id="category_id">
                                                </div>
                                            </div>


                                            <div class="fv-row flex-row-fluid">
                                                <!--begin::Label-->
                                                <label class="form-label">{{ __('Brand') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Select2-->
                                                <select class="form-select form-select-solid" data-control="select2"
                                                    name="brand_id" id="brand_id_inp"
                                                    data-placeholder="{{ __('Choose the brand') }}"
                                                    data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                                    <option value="" selected></option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}"> {{ $brand->name }} </option>
                                                    @endforeach
                                                </select>
                                                <!--end::Select2-->
                                                <div class="fv-plugins-message-container invalid-feedback" id="brand_id">
                                                </div>
                                            </div>
                                        </div>


                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Product Details-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{ __('Basic information') }}</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Basic Information-->
                                    <div class="d-flex flex-column gap-5 gap-md-7">
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column flex-md-row gap-5">
                                            <div class="fv-row flex-row-fluid">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{ __('Name In Arabic') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-lg form-control-solid"
                                                    name="name_ar" id="name_ar_inp" placeholder="{{ __('name ar') }}" />
                                                <!--end::Input-->
                                                <div class="fv-plugins-message-container invalid-feedback" id="name_ar">
                                                </div>
                                            </div>
                                            <div class="fv-row flex-row-fluid">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{ __('Name In English') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-lg form-control-solid"
                                                    name="name_en" id="name_en_inp" placeholder="{{ __('name en') }}" />
                                                <!--end::Input-->
                                                <div class="fv-plugins-message-container invalid-feedback" id="name_en">
                                                </div>
                                            </div>
                                            <div class="fv-row flex-row-fluid">
                                                <!--begin::Label-->
                                                <label
                                                    class="required form-label">{{ __('Description In Arabic') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <textarea class="form-control form-control-lg form-control-solid" name="description_ar" id="description_ar_inp"
                                                    data-kt-autosize="true" placeholder="{{ __('description ar') }}"></textarea>
                                                <!--end::Input-->
                                                <div class="fv-plugins-message-container invalid-feedback"
                                                    id="description_ar"></div>
                                            </div>
                                            <div class="fv-row flex-row-fluid">
                                                <!--begin::Label-->
                                                <label
                                                    class="required form-label">{{ __('Description In English') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <textarea class="form-control form-control-lg form-control-solid" name="description_en" id="description_en_inp"
                                                    data-kt-autosize="true" placeholder="{{ __('description en') }}"></textarea>
                                                <!--end::Input-->
                                                <div class="fv-plugins-message-container invalid-feedback"
                                                    id="description_en"></div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column flex-md-row gap-5">
                                            <div class="fv-row flex-row-fluid">
                                                <label class="required form-label">{{ __('Price') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input
                                                    class="form-control form-control-lg form-control-solid no-arrow size_inp"
                                                    type="number" step="0.1" min="1" name="price"
                                                    id="price_inp" required placeholder="{{ __('price') }}" />
                                                <!--end::Input-->
                                                <div class="fv-plugins-message-container invalid-feedback" id="price">
                                                </div>
                                            </div>
                                            <div class="fv-row flex-row-fluid">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{ __('Bags counts') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input
                                                    class="form-control form-control-lg form-control-solid no-arrow size_inp"
                                                    type="number" min="1" name="bags_counts"
                                                    id="bags_counts_inp" placeholder="{{ __('Bags counts') }}" />
                                                <!--end::Input-->
                                                <div class="fv-plugins-message-container invalid-feedback"
                                                    id="bags_counts">
                                                </div>
                                            </div>
                                            <div class="fv-row flex-row-fluid">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{ __('Passengers counts') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input
                                                    class="form-control form-control-lg form-control-solid no-arrow size_inp"
                                                    type="number" min="1" name="passengers_counts"
                                                    id="passengers_counts_inp"
                                                    placeholder="{{ __('Passengers counts') }}" />
                                                <!--end::Input-->
                                                <div class="fv-plugins-message-container invalid-feedback"
                                                    id="passengers_counts">
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Basic Information-->
                                </div>
                                <!--end::Card body-->
                            </div>
                        </div>
                        <!--end::Main column-->
                    </div>

                    <!--begin::Step 3-->
                    <div class="" data-kt-stepper-element="content">
                        <!--begin::Wrapper-->
                        <div class="w-100">
                            <div class="clinic both">
                                <div class="py-10">
                                    <!--begin::Title-->
                                    <h2 class="fw-bold d-flex align-items-center text-dark">{{ __('Product images') }}
                                    </h2>
                                    <!--end::Title-->
                                </div>
                                <!--begin::Dropzone input-->
                                <div class="fv-row">
                                    <!--begin::Dropzone-->
                                    <div class="dropzone" id="dropzone_input" style="background-color: #f1faff">
                                        <!--begin::Message-->
                                        <div class="dz-message needsclick">
                                            <!--begin::Icon-->
                                            <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                            <!--end::Icon-->

                                            <!--begin::Info-->
                                            <div class="ms-4">
                                                <h3 class="fs-5 fw-bold text-gray-900 mb-1">
                                                    {{ __('Drop images here or click to download') }}</h3>
                                                <span
                                                    class="fs-7 fw-semibold text-gray-400">{{ __('Allow only 5 photos') }}</span>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <input class="d-none" type="file" id="images_input" name="images[]" multiple>
                                    </div>
                                    <!--end::Dropzone-->
                                    <div class="fv-plugins-message-container invalid-feedback" id="images"></div>
                                </div>
                                <!--end::Dropzone input-->
                                <div class="fv-plugins-message-container text-center invalid-feedback" id="image">
                                </div>
                            </div>
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Step 3-->
                    <!--begin::Actions-->
                    <div class="d-flex flex-stack pt-15">
                        <!--begin::Wrapper-->
                        <div class="mr-2">
                            <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="previous">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
                                <span class="svg-icon svg-icon-4 ms-1 me-0" style="color: #ffffff">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1"
                                            transform="rotate(-180 18 13)" fill="currentColor" />
                                        @if (isArabic())
                                            <path
                                                d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                fill="currentColor" />
                                        @else
                                            <path
                                                d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z"
                                                fill="currentColor" />
                                        @endif
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->{{ __('Previous') }}</button>
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Wrapper-->
                        <div>
                            <button type="button" class="btn btn-lg btn-success me-3" data-kt-stepper-action="submit">
                                <span class="indicator-label" style="color: #ffffff">{{ __('Save') }}
                                </span>
                                <span class="indicator-progress">{{ __('Please wait ...') }}
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <button type="button" class="btn btn-lg btn-primary"
                                data-kt-stepper-action="next">{{ __('Next') }}
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                <span class="svg-icon svg-icon-4 me-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1"
                                            fill="currentColor" />
                                        @if (isArabic())
                                            <path
                                                d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z"
                                                fill="currentColor" />
                                        @else
                                            <path
                                                d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                fill="currentColor" />
                                        @endif
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </button>
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Stepper-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
@endsection
@push('scripts')
    <script></script>
    <script>
        function searchKey(obj, key) {
            if (obj.hasOwnProperty(key)) {
                return {
                    key: key,
                    value: obj[key]
                };
            } else {
                return null;
            }
        }

        var categories = @json($categories);


        function calculateGramPrice() {
            /*
                -- output: weight * gram price ( caliber of gold or silver ) = product price
                -- processing: based on selected category select goldGramsPrices or silverGramsPrics to loop on it
                    and get selected caliber price and then multiply it in weight and assign this value to price field
                -- input: first category + selected caliber
            */
            const categoriesSelect = document.getElementById('categories_inp');
            const subcategoriesSelect = document.getElementById('subcategories_inp');
            const selectedCategoryId = categoriesSelect.value; // Get the selected category ID
            const selectedSubCategoryId = subcategoriesSelect.value;
            const selectedCategory = categories.find(category => category.id == selectedCategoryId);
            const selectedSubCategory = subCategories.find(subCategory => subCategory.id == selectedSubCategoryId);
            const selectedCaliber = document.getElementById('caliber_inp').value;
            const repeaterItems = document.querySelectorAll('[data-repeater-item]');

        }




        $(document).ready(function() {
            $("#categories_inp").on("select2:select", function(evt) {
                var element = evt.params.data.element;
                var $element = $(element);
                if ($("#categories_inp").find(":selected").length > 1) {
                    var $second = $("#categories_inp").find(":selected").eq(-2);
                    $element.detach();
                    $second.after($element);
                } else {
                    $element.detach();
                    $("#categories_inp").prepend($element);
                }
                $("#categories_inp").trigger("change");
            });

            $("#categories_inp").on("select2:unselect", function(evt) {
                var element = evt.params.data.element;
                $("#categories_inp").find(":selected").after($element);
            });

            $('#categories_inp').change(function() {
                var selectedCategories = $(this).val();
                var selectedSubCategories = $('#subcategories_inp').val();
                var valuesAfterRemovingUnselected = [];

                // Check if selectedCategories is empty
                if (selectedCategories.length === 0) {
                    // remove selected options
                    $('#subcategories_inp option').each(function() {
                        $(this).remove();
                    })
                    return;
                }
                // Make AJAX request
                $.ajax({
                    url: '/dashboard/select2-ajax/subcategories',
                    method: 'POST', // Adjust the HTTP method if needed
                    data: {
                        categories: selectedCategories,
                    },
                    success: function(data) {
                        const subcategories = $.map(data.subcategories, function(value) {
                            return value.toString();
                        });
                        // Get values that are unique to subcategories (The values that should be removed from selected subcategories)
                        const valuesToRemove = $.grep(data, function(
                            value) {
                            return $.inArray(value, subcategories) === -1;
                        });

                        $('#subcategories_inp option').each(function() {
                            // Get values after removing the valuesToRemove
                            valuesAfterRemovingUnselected = $.grep(
                                selectedSubCategories,
                                function(value) {
                                    return $.inArray(value, valuesToRemove) ===
                                        -1;
                                });
                            $(this).remove();
                        })

                        // Update subcategories select box with new options
                        $('#subcategories_inp').html(data.options);

                        // Show the subcategories_div
                        if (data.subcategories.length != 0) {
                            $('#subcategories_div').fadeIn();
                        }

                        valuesAfterRemovingUnselected = $.grep(
                            valuesAfterRemovingUnselected,
                            function(value) {
                                return $.inArray(value, data.subcategories) === -1;
                            });
                        $.each(valuesAfterRemovingUnselected, function(index, sub) {
                            $(`#subcategories_inp`).val(sub).attr('selected', true);
                            $(`#subcategories_inp`).trigger('change');
                        })
                        data.options.forEach((option) => {
                            var opt = document.createElement('option');
                            opt.value = option.id;
                            opt.text = option.name

                            $('#subcategories_inp').append(opt);
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching subcategories:', error);
                    }
                });
            });



        });
    </script>

    <script src="https://npmcdn.com/flatpickr/dist/l10n/ar.js"></script>
    <script src="{{ asset('assets/dashboard/js/forms/cars/wizzard-form.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/components/dropzone.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/components/select2-ajax.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
@endpush
