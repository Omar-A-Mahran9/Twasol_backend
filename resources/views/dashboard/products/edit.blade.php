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
                        <h3 class="stepper-title">{{ __('Product data') }}</h3>
                    </div>
                    <!--end::Step 1-->
                    <!--begin::Step 2-->
                    <div class="stepper-item" data-kt-stepper-element="nav">
                        <h3 class="stepper-title">{{ __('Product Variations') }}</h3>
                    </div>
                    <!--end::Step 2-->
                    <!--begin::Step 3-->
                    <div class="stepper-item" data-kt-stepper-element="nav">
                        <h3 class="stepper-title">{{ __('Product images') }}</h3>
                    </div>
                    <!--end::Step 3-->
                </div>
                <!--end::Nav-->
                <!--begin::Form-->
                <form action="{{ route('dashboard.products.update', $product) }}" method="POST" novalidate="novalidate"
                    id="kt_create_account_form">
                    <div class="current" data-kt-stepper-element="content">
                        @method('put')
                        <!--begin::Main column-->
                        <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">
                            <!--begin::Order details-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{ __('Product Details') }}</h2>
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
                                                <label class="required form-label">{{ __('Category') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Select2-->
                                                <select class="form-select form-select-solid product_name_comination_class"
                                                    onchange="handleInputChange()" data-control="select2"
                                                    multiple="multiple" name="categories[]" id="categories_inp"
                                                    data-placeholder="{{ __('Choose the category') }}"
                                                    data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            @foreach ($product->categories as $productCategory) {{ $productCategory->id == $category->id ? 'selected' : '' }} @endforeach>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <!--end::Select2-->
                                                <div class="fv-plugins-message-container invalid-feedback" id="categories">
                                                </div>
                                            </div>
                                            <div class="fv-row flex-row-fluid" id="subcategories_div">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{ __('Subcategories') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Select2-->
                                                <select class="form-select form-select-solid product_name_comination_class"
                                                    onchange="handleInputChange()" data-control="select2"
                                                    name="subcategories[]" id="subcategories_inp"
                                                    data-placeholder="{{ __('Choose the subcategories') }}"
                                                    data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                                    @foreach ($subcategories as $subcategory)
                                                        @if ($product->categoriesNew[0]->pivot->sub_category_id == $subcategory->id)
                                                            <option value="{{ $subcategory->id }}"
                                                                {{ $product->categoriesNew[0]->pivot->sub_category_id == $subcategory->id ? 'selected' : '' }}>
                                                                {{ $subcategory->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <!--end::Select2-->
                                                <div class="fv-plugins-message-container invalid-feedback"
                                                    id="subcategories"></div>
                                            </div>
                                            <div class="fv-row flex-row-fluid">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{ __('Tags') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Select2-->
                                                <select class="form-select form-select-solid" data-control="select2"
                                                    multiple="multiple" name="tags[]" id="tags_inp"
                                                    data-placeholder="{{ __('Choose the tags') }}"
                                                    data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                                    @foreach ($tags as $tag)
                                                        <option value="{{ $tag->id }}"
                                                            @foreach ($product->tags as $productTag) {{ $productTag->id == $tag->id ? 'selected' : '' }} @endforeach>
                                                            {{ $tag->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <!--end::Select2-->
                                                <div class="fv-plugins-message-container invalid-feedback" id="tags">
                                                </div>
                                            </div>
                                            <div class="fv-row flex-row-fluid">
                                                <!--begin::Label-->
                                                <label class=" form-label">{{ __('Brand') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Select2-->
                                                <select class="form-select form-select-solid" data-control="select2"
                                                    name="brand_id" id="brand_id_inp"
                                                    data-placeholder="{{ __('Choose the brand') }}"
                                                    data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                                    <option value="" selected></option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}"
                                                            @if ($brand->id == $product->brand?->id) selected @endif>
                                                            {{ $brand->name }} </option>
                                                    @endforeach
                                                </select>
                                                <!--end::Select2-->
                                                <div class="fv-plugins-message-container invalid-feedback" id="brand_id">
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column flex-md-row gap-5">
                                            <div class="fv-row flex-row-fluid">
                                                <!--begin::Label-->
                                                <label class="form-label">{{ __('Design type') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Select2-->
                                                <select class="form-select form-select-solid" data-control="select2"
                                                    onchange="handleInputChange()" name="design_type_id"
                                                    id="design_type_id_inp"
                                                    data-placeholder="{{ __('Choose design type') }}"
                                                    data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                                    <option value="" selected></option>
                                                    @foreach ($designTypes as $designType)
                                                        <option value="{{ $designType->id }}"
                                                            {{ isset($product->designType) && $designType->id == $product->designType->id ? 'selected' : '' }}>
                                                            {{ $designType->name }} </option>
                                                    @endforeach
                                                </select>
                                                <!--end::Select2-->
                                                <div class="fv-plugins-message-container invalid-feedback"
                                                    id="design_type_id"></div>
                                            </div>
                                            <div class="fv-row flex-row-fluid">
                                                <!--begin::Label-->
                                                <label class="form-label">{{ __('Color') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-lg form-control-solid"
                                                    type="text" value="{{ $product->color }}" name="color"
                                                    id="color_inp" placeholder="{{ __('enter color') }}" />
                                                <!--end::Input-->
                                                <div class="fv-plugins-message-container invalid-feedback" id="color">
                                                </div>
                                            </div>
                                            <div class="fv-row flex-row-fluid" id="caliber_div">
                                                <!--begin::Label-->
                                                <label class="form-label">{{ __('Caliber') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Select2-->
                                                {{--  @dd($product->caliber)  --}}
                                                <select class="form-select form-select-solid product_name_comination_class"
                                                    data-control="select2" onchange="handleInputChange()" name="caliber"
                                                    id="caliber_inp" data-placeholder="{{ __('Choose the caliber') }}"
                                                    data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                                    @if ($product->caliber)
                                                        <option value="{{ $product->caliber }}" selected>
                                                            {{ $product->caliber . ' ' . __('Caliber') }}</option>
                                                    @endif
                                                </select>
                                                <!--end::Select2-->
                                                <div class="fv-plugins-message-container invalid-feedback" id="caliber">
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column flex-md-row gap-5">
                                            <div class="fv-row flex-row-fluid">
                                                <!--begin::Label-->
                                                <label class="form-label">{{ __('Main stone') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-lg form-control-solid"
                                                    type="text" value="{{ $product->main_stone }}" name="main_stone"
                                                    id="main_stone_inp"
                                                    placeholder="{{ __('enter main stone field') }}" />
                                                <!--end::Input-->
                                                <div class="fv-plugins-message-container invalid-feedback"
                                                    id="main_stone"></div>
                                            </div>
                                            <div class="fv-row flex-row-fluid">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{ __('Type') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Select2-->
                                                <select class="form-select form-select-solid" data-control="select2"
                                                    name="type" id="type_inp"
                                                    data-placeholder="{{ __('Choose the type') }}"
                                                    data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                                    <option value="" selected></option>
                                                    <option value="Used"
                                                        @if ($product->type == 'Used') selected @endif>
                                                        {{ __('Used') }} </option>
                                                    <option value="New"
                                                        @if ($product->type == 'New') selected @endif>
                                                        {{ __('New') }} </option>
                                                </select>
                                                <!--end::Select2-->
                                                <div class="fv-plugins-message-container invalid-feedback" id="type">
                                                </div>
                                            </div>
                                            {{--  <div class="fv-row flex-row-fluid">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{ __('Status') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Select2-->
                                                <select class="form-select form-select-solid" data-control="select2"
                                                    name="status" id="status_inp"
                                                    data-placeholder="{{ __('Choose the status') }}"
                                                    data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                                    <option value="" selected></option>
                                                    <option value="In Stock"
                                                        @if ($product->status == 'In Stock') selected @endif>
                                                        {{ __('In Stock') }} </option>
                                                    <option value="Out Stock"
                                                        @if ($product->status == 'Out Stock') selected @endif>
                                                        {{ __('Out Stock') }} </option>
                                                </select>
                                                <!--end::Select2-->
                                                <div class="fv-plugins-message-container invalid-feedback" id="status">
                                                </div>
                                            </div>  --}}
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
                                        <h2>{{ __('Media and vendor information') }}</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column flex-md-row gap-5">
                                        <div class="fv-row flex-row-fluid">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('Video link') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-lg form-control-solid"
                                                name="video_link" value="{{ $product->video_link }}" id="video_link_inp"
                                                placeholder="{{ __('video link') }}" />
                                            <!--end::Input-->
                                            <div class="fv-plugins-message-container invalid-feedback" id="video_link">
                                            </div>
                                        </div>
                                        <div class="fv-row flex-row-fluid">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('Vendors') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Select2-->
                                            <select class="form-select form-select-solid" data-control="select2"
                                                id="vendor_id_inp" data-placeholder="{{ __('Choose the vendor') }}"
                                                name="vendor_id" data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                                @foreach ($vendors as $vendor)
                                                    <option value="{{ $vendor->id }}"
                                                        {{ $product->vendor->id == $vendor->id ? 'selected' : '' }}>
                                                        {{ $vendor->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <!--end::Select2-->
                                            <div class="fv-plugins-message-container invalid-feedback" id="vendor_id">
                                            </div>
                                        </div>
                                        <div class="fv-row flex-row-fluid" id="cities_div">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('Cities') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Select2-->
                                            <select class="form-select form-select-solid" multiple="multiple"
                                                data-control="select2" id="cities_inp"
                                                data-placeholder="{{ __('Choose the cities') }}" name="cities[]"
                                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                            </select>
                                            <!--end::Select2-->
                                            <div class="fv-plugins-message-container invalid-feedback" id="cities">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{ __('Additional information') }}</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column flex-md-row gap-5">
                                        <div class="fv-row flex-row-fluid">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('Maintenance and care') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-lg form-control-solid" type="text"
                                                value="{{ $product->maintenance_and_care }}" name="maintenance_and_care"
                                                id="maintenance_and_care_inp"
                                                placeholder="{{ __('enter maintenance and care field') }}" />
                                            <!--end::Input-->
                                            <div class="fv-plugins-message-container invalid-feedback"
                                                id="maintenance_and_care"></div>
                                        </div>
                                        <div class="fv-row flex-row-fluid">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('Packaging') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-lg form-control-solid" type="text"
                                                value="{{ $product->packaging }}" name="packaging" id="packaging_inp"
                                                placeholder="{{ __('enter packaging field') }}" />
                                            <!--end::Input-->
                                            <div class="fv-plugins-message-container invalid-feedback" id="packaging">
                                            </div>
                                        </div>
                                        <div class="fv-row flex-row-fluid">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('Sustainable assets') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-lg form-control-solid" type="text"
                                                value="{{ $product->sustainable_assets }}" name="sustainable_assets"
                                                id="sustainable_assets_inp"
                                                placeholder="{{ __('enter sustainable assets field') }}" />
                                            <!--end::Input-->
                                            <div class="fv-plugins-message-container invalid-feedback"
                                                id="sustainable_assets"></div>
                                        </div>
                                        <div class="fv-row flex-row-fluid">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('Guarantee') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-lg form-control-solid" type="text"
                                                value="{{ $product->guarantee }}" name="guarantee" id="guarantee_inp"
                                                placeholder="{{ __('enter guarantee field') }}" />
                                            <!--end::Input-->
                                            <div class="fv-plugins-message-container invalid-feedback" id="guarantee">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{ __('SEO') }}</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column flex-md-row gap-5">
                                        <div class="fv-row flex-row-fluid">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('Meta tag keywords') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input id="meta_tag_key_words_inp" name="meta_tag_key_words"
                                                value="{{ $product->meta_tag_key_words }}"
                                                class="form-control form-control-lg form-control-solid "placeholder="{{ __('Meta tag keywords') }}" />
                                            <!--end::Input-->
                                            <div class="fv-plugins-message-container invalid-feedback"
                                                id="meta_tag_key_words"></div>
                                        </div>
                                        <div class="fv-row flex-row-fluid">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('Meta tag key description') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-lg form-control-solid"
                                                value="{{ $product->meta_tag_key_description }}"
                                                name="meta_tag_key_description" id="meta_tag_key_description_inp"
                                                placeholder="{{ __('Meta tag key description') }}" />
                                            <!--end::Input-->
                                            <div class="fv-plugins-message-container invalid-feedback"
                                                id="meta_tag_key_description"></div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
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
                                                    name="name_ar" value="{{ $product->name_ar }}" id="name_ar_inp"
                                                    placeholder="{{ __('name ar') }}" />
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
                                                    name="name_en" value="{{ $product->name_en }}" id="name_en_inp"
                                                    placeholder="{{ __('name en') }}" />
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
                                                <textarea class="form-control form-control-lg form-control-solid" name="description_ar" data-kt-autosize="true"
                                                    id="description_ar_inp" placeholder="{{ __('description ar') }}">{{ $product->description_ar }}</textarea>
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
                                                <textarea class="form-control form-control-lg form-control-solid" name="description_en" data-kt-autosize="true"
                                                    value="{{ $product->description_en }}" id="description_en_inp" placeholder="{{ __('description en') }}">{{ $product->description_ar }}</textarea>
                                                <!--end::Input-->
                                                <div class="fv-plugins-message-container invalid-feedback"
                                                    id="description_en"></div>
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
                    <!--begin::step 2-->
                    <div class="" data-kt-stepper-element="content">
                        <!--begin::Main column-->
                        <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">
                            <!--begin::Order details-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{ __('Product Variations') }}</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Product Details-->
                                    <div class="d-flex flex-column gap-5 gap-md-7">
                                        <!--begin::Input group-->
                                        <div class="fv-row">
                                            <div class="d-flex flex-stack">
                                                <!--begin::Label-->
                                                <div class="me-5">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold">{{ __('Accept change') }}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <div class="fs-7 fw-semibold text-muted">
                                                        {{ __('Do you want the prices to be updated automatically if the price per gram for the selected category changes?') }}
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Label-->
                                                <!--begin::Switch-->
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <!--begin::Input-->
                                                    <input class="form-check-input" name="price_change" type="checkbox"
                                                        value="1" {{ $product->price_change == 1 ? 'checked' : '' }}
                                                        id="kt_modal_update_address_billing">
                                                    <!--end::Input-->
                                                </label>
                                                <!--end::Switch-->
                                            </div>
                                        </div>
                                        <!--end::Input group-->

                                    </div>
                                    <!--end::Product Details-->
                                </div>
                                <!--end::Card body-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Product Details-->
                                    <div class="d-flex flex-column gap-5 gap-md-7">
                                        <!--begin::Input group-->
                                        <!--begin::Repeater-->
                                        <input type="text" hidden name='deletedVariations[]'
                                            id='deletedVariationsInput'>
                                        <div id="variations">
                                            <!--begin::Form group-->

                                            <div class="form-group">
                                                <div data-repeater-list="variations" class="d-flex flex-column gap-3">
                                                    @forelse ($product->specifications ?? [] as $specification)
                                                        <div data-repeater-item>
                                                            <div class="form-group row">
                                                                <div class="d-flex flex-column flex-md-row gap-5">
                                                                    <input type="text" name="id"
                                                                        value="{{ $specification->id }}" hidden>
                                                                    <div class="fv-row flex-row-fluid" id="size_dev">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                            class="required form-label">{{ __('Size') . ' ' . __('( Arabic )') }}
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid no-arrow size_inp"
                                                                            type="number" step="0.1" min="1"
                                                                            name="size" id="size_inp" required
                                                                            value="{{ $specification->size }}"
                                                                            placeholder="{{ __('Size') . ' ' . __('( Arabic )') }}" />
                                                                        <!--end::Input-->
                                                                        <div class="fv-plugins-message-container invalid-feedback"
                                                                            id="size">
                                                                        </div>
                                                                    </div>
                                                                    <div class="fv-row flex-row-fluid" id="weight_dev">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                            class="required form-label">{{ __('Weight') }}</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid no-arrow size_inp"
                                                                            onchange="handleInputChange()" type="number"
                                                                            step="0.1" name="weight" min="1"
                                                                            value="{{ $specification->weight }}"
                                                                            id="weight_inp" required
                                                                            placeholder="{{ __('enter weight in grams') }}" />
                                                                        <!--end::Input-->
                                                                        <div class="fv-plugins-message-container invalid-feedback"
                                                                            id="weight">
                                                                        </div>
                                                                    </div>
                                                                    <div class="fv-row flex-row-fluid">
                                                                        <label
                                                                            class="required form-label">{{ __('Price') }}</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid no-arrow size_inp"
                                                                            type="number" step="0.1" min="1"
                                                                            name="price" id="price_inp" required
                                                                            value="{{ $specification->price }}"
                                                                            placeholder="{{ __('price') }}" />
                                                                        <!--end::Input-->
                                                                        <div class="fv-plugins-message-container invalid-feedback"
                                                                            id="price">
                                                                        </div>
                                                                    </div>
                                                                    <div class="fv-row flex-row-fluid">
                                                                        <label
                                                                            class="required form-label">{{ __('Stock') }}</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid no-arrow size_inp"
                                                                            type="number" min="1" name="stock"
                                                                            value="{{ $specification->stock }}"
                                                                            id="stock_inp" required
                                                                            placeholder="{{ __('stock') }}" />
                                                                        <!--end::Input-->
                                                                        <div class="fv-plugins-message-container invalid-feedback"
                                                                            id="stock">
                                                                        </div>
                                                                    </div>
                                                                    <div class="fv-row flex-row-fluid">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                            class="form-label">{{ __('Discount Price') }}</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid no-arrow size_inp"
                                                                            type="number" step="0.1"
                                                                            name="discount_price" id="discount_price_inp"
                                                                            value="{{ $specification->discount_price }}"
                                                                            placeholder="{{ __('discount price') }}" />
                                                                        <!--end::Input-->
                                                                        <div class="fv-plugins-message-container invalid-feedback"
                                                                            id="discount_price">
                                                                        </div>
                                                                    </div>
                                                                    <div class="fv-row flex-row-fluid">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                            class="form-label">{{ __('Discount From') }}</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <div class="input-group" id="discount_from_date">
                                                                            <input type="text" name="discount_from"
                                                                                id="discount_from_inp"
                                                                                value="{{ $specification->discount_from }}"
                                                                                placeholder="{{ __('Pick date & time') }}"
                                                                                class="form-control form-control datepicker size_inp" />
                                                                            <span class="input-group-text"
                                                                                data-td-target="#discount_from_date"
                                                                                data-td-toggle="datetimepicker">
                                                                                <i class="bi bi-calendar-check fs-2"><span
                                                                                        class="path1"></span><span
                                                                                        class="path2"></span></i>
                                                                            </span>
                                                                        </div>
                                                                        <!--end::Input-->
                                                                        <div class="fv-plugins-message-container invalid-feedback"
                                                                            id="discount_from">
                                                                        </div>
                                                                    </div>
                                                                    <div class="fv-row flex-row-fluid">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                            class="form-label">{{ __('Discount To') }}</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <div class="input-group" id="discount_to_date">
                                                                            <input type="text" name="discount_to"
                                                                                id="discount_to_inp"
                                                                                value="{{ $specification->discount_to }}"
                                                                                placeholder="{{ __('Pick date & time') }}"
                                                                                class="form-control form-control datepicker size_inp" />
                                                                            <span class="input-group-text"
                                                                                data-td-target="#discount_to_date"
                                                                                data-td-toggle="datetimepicker">
                                                                                <i class="bi bi-calendar-check fs-2"><span
                                                                                        class="path1"></span><span
                                                                                        class="path2"></span></i>
                                                                            </span>
                                                                        </div>
                                                                        <!--end::Input-->
                                                                        <div class="fv-plugins-message-container invalid-feedback"
                                                                            id="discount_to">
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <a href="javascript:;" data-repeater-delete
                                                                            onclick="deleteId('{{ $specification['id'] }}')"
                                                                            class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                            <span class="svg-icon svg-icon-1">
                                                                                <svg width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <rect opacity="0.5" x="7.05025"
                                                                                        y="15.5356" width="12"
                                                                                        height="2" rx="1"
                                                                                        transform="rotate(-45 7.05025 15.5356)"
                                                                                        fill="currentColor" />
                                                                                    <rect x="8.46447" y="7.05029"
                                                                                        width="12" height="2"
                                                                                        rx="1"
                                                                                        transform="rotate(45 8.46447 7.05029)"
                                                                                        fill="currentColor" />
                                                                                </svg>
                                                                            </span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div data-repeater-item>
                                                            <div class="form-group row">
                                                                <div class="d-flex flex-column flex-md-row gap-5">
                                                                    <div class="fv-row flex-row-fluid" id="size_dev">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                            class="required form-label">{{ __('Size') }}</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid size_inp"
                                                                            type="number" step="0.1" min="1"
                                                                            name="size" id="size_inp" required
                                                                            placeholder="{{ __('size') }}" />
                                                                        <!--end::Input-->
                                                                        <div class="fv-plugins-message-container invalid-feedback"
                                                                            id="size">
                                                                        </div>
                                                                    </div>
                                                                    <div class="fv-row flex-row-fluid" id="weight_dev">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                            class="required form-label">{{ __('Weight') }}</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid size_inp"
                                                                            onchange="handleInputChange()" type="number"
                                                                            step="0.1" name="weight" min="1"
                                                                            id="weight_inp" required
                                                                            placeholder="{{ __('enter weight in grams') }}" />
                                                                        <!--end::Input-->
                                                                        <div class="fv-plugins-message-container invalid-feedback"
                                                                            id="weight">
                                                                        </div>
                                                                    </div>
                                                                    <div class="fv-row flex-row-fluid">
                                                                        <label
                                                                            class="required form-label">{{ __('Price') }}</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid size_inp"
                                                                            type="number" step="0.1" min="1"
                                                                            name="price" id="price_inp" required
                                                                            placeholder="{{ __('price') }}" />
                                                                        <!--end::Input-->
                                                                        <div class="fv-plugins-message-container invalid-feedback"
                                                                            id="price">
                                                                        </div>
                                                                    </div>
                                                                    <div class="fv-row flex-row-fluid">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                            class="form-label">{{ __('Discount Price') }}</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid size_inp"
                                                                            type="number" step="0.1"
                                                                            name="discount_price" id="discount_price_inp"
                                                                            placeholder="{{ __('discount price') }}" />
                                                                        <!--end::Input-->
                                                                        <div class="fv-plugins-message-container invalid-feedback"
                                                                            id="discount_price">
                                                                        </div>
                                                                    </div>
                                                                    <div class="fv-row flex-row-fluid">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                            class="form-label">{{ __('Discount From') }}</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <div class="input-group" id="discount_from_date">
                                                                            <input type="text" name="discount_from"
                                                                                id="discount_from_inp"
                                                                                placeholder="{{ __('Pick date & time') }}"
                                                                                class="form-control form-control datepicker size_inp" />
                                                                            <span class="input-group-text"
                                                                                data-td-target="#discount_from_date"
                                                                                data-td-toggle="datetimepicker">
                                                                                <i class="bi bi-calendar-check fs-2"><span
                                                                                        class="path1"></span><span
                                                                                        class="path2"></span></i>
                                                                            </span>
                                                                        </div>
                                                                        <!--end::Input-->
                                                                        <div class="fv-plugins-message-container invalid-feedback"
                                                                            id="discount_from">
                                                                        </div>
                                                                    </div>
                                                                    <div class="fv-row flex-row-fluid">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                            class="form-label">{{ __('Discount To') }}</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <div class="input-group" id="discount_to_date">
                                                                            <input type="text" name="discount_to"
                                                                                id="discount_to_inp"
                                                                                placeholder="{{ __('Pick date & time') }}"
                                                                                class="form-control form-control datepicker size_inp" />
                                                                            <span class="input-group-text"
                                                                                data-td-target="#discount_to_date"
                                                                                data-td-toggle="datetimepicker">
                                                                                <i class="bi bi-calendar-check fs-2"><span
                                                                                        class="path1"></span><span
                                                                                        class="path2"></span></i>
                                                                            </span>
                                                                        </div>
                                                                        <!--end::Input-->
                                                                        <div class="fv-plugins-message-container invalid-feedback"
                                                                            id="discount_to">
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <a href="javascript:;" data-repeater-delete
                                                                            class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                            <span class="svg-icon svg-icon-1">
                                                                                <svg width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <rect opacity="0.5" x="7.05025"
                                                                                        y="15.5356" width="12"
                                                                                        height="2" rx="1"
                                                                                        transform="rotate(-45 7.05025 15.5356)"
                                                                                        fill="currentColor" />
                                                                                    <rect x="8.46447" y="7.05029"
                                                                                        width="12" height="2"
                                                                                        rx="1"
                                                                                        transform="rotate(45 8.46447 7.05029)"
                                                                                        fill="currentColor" />
                                                                                </svg>
                                                                            </span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                            <!--end::Form group-->

                                            <!--begin::Form group-->
                                            <div class="form-group mt-5" id='add_dev'>
                                                <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                                    <span class="svg-icon svg-icon-2">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="11" y="18" width="12"
                                                                height="2" rx="1"
                                                                transform="rotate(-90 11 18)" fill="currentColor" />
                                                            <rect x="6" y="11" width="12" height="2"
                                                                rx="1" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->{{ __('Add another variation') }}
                                                </a>
                                            </div>
                                            <!--end::Form group-->
                                        </div>
                                        <!--end::Repeater-->
                                    </div>
                                    <!--end::Product Details-->
                                </div>
                                <!--end::Card body-->
                            </div>

                        </div>
                        <!--end::Main column-->
                    </div>
                    <!--end::Step 2-->

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
                                        <input class="d-none" type="text" id="deleted_images" name="deleted_images"
                                            value="[]">
                                    </div>
                                    <!--end::Dropzone-->
                                    <div class="fv-plugins-message-container invalid-feedback" id="images"></div>
                                </div>
                                <!--end::Dropzone input-->
                                <div class="fv-plugins-message-container text-center invalid-feedback" id="clinic_image">
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
        var designTypes = @json($designTypes);
        var subCategories = @json($subcategories);
        var goldGramsPrices = @json($goldGramsPrices);
        var silverGramsPrices = @json($silverGramsPrices);
        var product = @json($product);
        let caliber = @json($product->caliber);

        var inlaidCategories = [];


        function calculateGramPrice() {
            /*
                -- output: weight * gram price ( caliber of gold or silver ) = product price
                -- processing: based on selected category select goldGramsPrices or silverGramsPrics to loop on it
                    and get selected caliber price and then multiply it in weight and assign this value to price field
                -- input: first category + selected caliber
            */
            const categoriesSelect = document.getElementById('categories_inp');
            const selectedCategoryId = categoriesSelect.value; // Get the selected category ID
            const selectedCategory = categories.find(category => category.id == selectedCategoryId);
            const selectedCaliber = document.getElementById('caliber_inp').value;
            const repeaterItems = document.querySelectorAll('[data-repeater-item]');

            repeaterItems.forEach((item, index) => {
                const weightInput = item.querySelector(`input[id="variations_${index}_weight_inp"]`);
                const priceInput = item.querySelector(`input[id="variations_${index}_price_inp"]`);
                const weight = parseFloat(weightInput.value) || 0;
                const keyToSearch = selectedCaliber;
                const goldResult = searchKey(goldGramsPrices, keyToSearch);
                const silverResult = searchKey(silverGramsPrices, keyToSearch);
                const sizeDev = $(item).find('#size_dev');
                const weightDev = $(item).find('#weight_dev');
                {{--  console.log(selectedCategoryId);  --}}
                if (selectedCategoryId == 1 || selectedCategoryId == 2) {
                    weightDev.fadeIn();
                    sizeDev.fadeIn();
                } else if (selectedCategoryId == 3 || selectedCategoryId == 5) {
                    sizeDev.fadeOut();
                    weightDev.fadeIn();
                } else {
                    sizeDev.fadeOut();
                    weightDev.fadeOut();
                }
                if (goldResult) {
                    priceInput.value = weight * goldResult.value;
                } else if (silverResult) {
                    priceInput.value = weight * silverResult.value;
                }
            });
        }

        // Ensure that the DOM is fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Attach change event handler
            handleInputChange()
            $('#categories_inp').on('change', function() {
                const categoriesSelect = document.getElementById('categories_inp');
                const selectedCategoryId = categoriesSelect.value; // Get the selected category ID
                const calibersSelect = document.getElementById('caliber_inp');
                const repeaterItems = document.querySelectorAll('.size_inp');
                if (!product.categories.some(category => category.id == selectedCategoryId)) {
                    repeaterItems.forEach((ele) => {
                        ele.value = '';
                    });
                }
                if (selectedCategoryId == 1) {
                    calibersSelect.innerHTML = '';
                    // Add options for gold category
                    const options = [{
                            value: '',
                            text: '',
                            selected: true
                        },
                        {
                            value: '9',
                            text: '09 ' + __('Caliber')
                        },
                        {
                            value: '12',
                            text: '12 ' + __('Caliber')
                        },
                        {
                            value: '14',
                            text: '14 ' + __('Caliber')
                        },
                        {
                            value: '18',
                            text: '18 ' + __('Caliber')
                        },
                        {
                            value: '21',
                            text: '21 ' + __('Caliber')
                        },
                        {
                            value: '24',
                            text: '24 ' + __('Caliber')
                        }
                    ];

                    options.forEach(option => {
                        const opt = document.createElement('option');
                        opt.value = option.value;
                        opt.textContent = option.text;
                        if (caliber && option.value == caliber) {
                            opt.selected = true;
                        }
                        calibersSelect.appendChild(opt);
                    });
                } else if (selectedCategoryId == 2) {
                    calibersSelect.innerHTML = '';
                    // Add options for silver category
                    const options = [{
                            value: '',
                            text: '',
                            selected: true
                        },
                        {
                            value: '999',
                            text: '999 ' + __('Caliber')
                        },
                        {
                            value: '960',
                            text: '960 ' + __('Caliber')
                        },
                        {
                            value: '958',
                            text: '958 ' + __('Caliber')
                        },
                        {
                            value: '950',
                            text: '950 ' + __('Caliber')
                        },
                        {
                            value: '947',
                            text: '947 ' + __('Caliber')
                        },
                        {
                            value: '925',
                            text: '925 ' + __('Caliber')
                        },
                        {
                            value: '800',
                            text: '800 ' + __('Caliber')
                        }
                    ];

                    options.forEach(option => {
                        const opt = document.createElement('option');
                        opt.value = option.value;
                        opt.textContent = option.text;
                        if (caliber && option.value == caliber) {
                            opt.selected = true;
                        }
                        calibersSelect.appendChild(opt);
                    });
                } else {
                    calibersSelect.innerHTML = '';
                }
            });
        });

        function handleInputChange() {
            calculateGramPrice();

            // Store previous selected values
            let previousSelection = $('#categories_inp').val() || [];

            const categoriesSelect = document.getElementById('categories_inp');
            const subcategoriesSelect = document.getElementById('subcategories_inp');
            const designTypeSelect = document.getElementById('design_type_id_inp');
            const selectedCategoryId = categoriesSelect.value; // Get the selected category ID
            const selectedDesignTypeId = designTypeSelect.value; // Get the selected design type ID
            const selectedSubCategoryId = subcategoriesSelect.value;

            // Find the selected category object from the categories array
            const selectedCategory = categories.find(category => category.id == selectedCategoryId);
            const selectedDesignType = designTypes.find(designType => designType.id == selectedDesignTypeId);
            const selectedSubCategory = subCategories.find(subCategory => subCategory.id == selectedSubCategoryId);
            {{--  console.log(selectedCategory)  --}}
            if (selectedSubCategory?.size_applicable == 1) {
                $('#size_dev').fadeIn();
            } else {
                $('#size_dev').fadeOut();
            }
            if (selectedCategoryId == 1 || selectedCategoryId == 2) {
                $("#caliber_div").fadeIn();
            } else if (selectedCategoryId == 3 || selectedCategoryId == 5) {
                $("#caliber_div").fadeIn();
            } else {
                $("#caliber_div").fadeOut();
            }
            if (selectedCategoryId == 4) {
                $("#add_dev").fadeOut();
            } else {
                $("#add_dev").fadeIn();
            }
            {{--  if (selectedCategoryId == 1) {
                $("#weight_dev").fadeIn();
            } else if (selectedCategoryId == 2) {
                $("#weight_dev").fadeIn();
            } else {
                $("#weight_dev").fadeOut();
            }

            if (selectedCategoryId == 4) {
                $("#size_dev").fadeOut();
            } else {
                $("#size_dev").fadeIn();
            }  --}}


            // Check if a category is selected
            if (selectedCategory && selectedSubCategory) {

                let inlaidCategoriesStringAr = '';
                let inlaidCategoriesStringEn = '';
                // Example: Update name based on selected category
                const caliberSelect = document.getElementById('caliber_inp');
                const selectedSubCategoriesTexts = Array.from(subcategoriesSelect.selectedOptions).map(option => option
                    .text);
                const selectedCategoriesTexts = Array.from(categoriesSelect.selectedOptions).map(option => option.text);

                if (selectedCategoriesTexts.length > 1) {
                    for (let i = 1; i < selectedCategoriesTexts.length; i++) {
                        if (!inlaidCategories.includes(selectedCategoriesTexts[i])) {
                            inlaidCategories.push(selectedCategoriesTexts[i]);
                        }
                    }
                }
                if (selectedCategoriesTexts.length == 1) {
                    inlaidCategories = [];
                }

                if (inlaidCategories.length > 1) {
                    for (let i = 0; i < inlaidCategories.length; i++) {
                        if (inlaidCategoriesStringAr != '') {
                            inlaidCategoriesStringAr = categories.find(category => category.name_ar == inlaidCategories[
                                    i] || category.name_en == inlaidCategories[i]).name_ar + ' و ' +
                                inlaidCategoriesStringAr;
                        } else {
                            inlaidCategoriesStringAr = categories.find(category => category.name_ar == inlaidCategories[
                                i] || category.name_en == inlaidCategories[i]).name_ar
                        }

                        if (inlaidCategoriesStringEn != '') {
                            inlaidCategoriesStringEn = categories.find(category => category.name_ar == inlaidCategories[
                                    i] || category.name_en == inlaidCategories[i]).name_en + ' And ' +
                                inlaidCategoriesStringEn;
                        } else {
                            inlaidCategoriesStringEn = categories.find(category => category.name_ar == inlaidCategories[
                                i] || category.name_en == inlaidCategories[i]).name_en
                        }
                    }
                } else if (inlaidCategories.length == 1) {
                    if (inlaidCategoriesStringAr != '') {
                        inlaidCategoriesStringAr = categories.find(category => category.name_ar == inlaidCategories[0] ||
                            category.name_en == inlaidCategories[0]).name_ar + ' و ' + inlaidCategoriesStringAr;
                    } else {
                        inlaidCategoriesStringAr = categories.find(category => category.name_ar == inlaidCategories[0] ||
                            category.name_en == inlaidCategories[0]).name_ar
                    }

                    if (inlaidCategoriesStringEn != '') {
                        inlaidCategoriesStringEn = categories.find(category => category.name_ar == inlaidCategories[0] ||
                            category.name_en == inlaidCategories[0]).name_en + ' And ' + inlaidCategoriesStringEn;
                    } else {
                        inlaidCategoriesStringEn = categories.find(category => category.name_ar == inlaidCategories[0] ||
                            category.name_en == inlaidCategories[0]).name_en
                    }
                }
                if (selectedSubCategoriesTexts[0] === selectedSubCategory.name_ar || selectedSubCategoriesTexts[0] ===
                    selectedSubCategory.name_en) {
                    const productNameArMainCombination = selectedDesignType ? selectedSubCategory.name_ar + ' ' +
                        selectedCategory.name_ar + ' ' + selectedDesignType.name_ar : selectedSubCategory.name_ar + ' ' +
                        selectedCategory.name_ar;
                    const productNameEnMainCombination = selectedDesignType ? selectedSubCategory.name_en + ' ' +
                        selectedCategory.name_en + ' ' + selectedDesignType.name_en : selectedSubCategory.name_en + ' ' +
                        selectedCategory.name_en;

                    if (!productNameArMainCombination.includes(undefined)) {
                        if (caliberSelect.value > 0) {
                            document.getElementById('name_ar_inp').value = productNameArMainCombination + ' ' + 'عيار' +
                                ' ' + caliberSelect.value;
                        } else {
                            document.getElementById('name_ar_inp').value = productNameArMainCombination;
                        }

                        if (inlaidCategoriesStringAr) {
                            if (caliberSelect.value > 0) {
                                document.getElementById('name_ar_inp').value = productNameArMainCombination + ' ' + 'عيار' +
                                    ' ' + caliberSelect.value + ' مرصع ب' + inlaidCategoriesStringAr;
                            } else {
                                document.getElementById('name_ar_inp').value = productNameArMainCombination +
                                    ' ' + caliberSelect.value + ' مرصع ب' + inlaidCategoriesStringAr;
                            }

                        }
                    } else {
                        document.getElementById('name_ar_inp').value = '';
                    }

                    if (!productNameEnMainCombination.includes(undefined)) {
                        if (caliberSelect.value > 0) {
                            document.getElementById('name_en_inp').value = productNameEnMainCombination + ' ' + 'caliber' +
                                ' ' + caliberSelect.value;
                        } else {
                            document.getElementById('name_en_inp').value = productNameEnMainCombination;
                        }

                        if (inlaidCategoriesStringEn) {
                            if (caliberSelect.value > 0) {
                                document.getElementById('name_en_inp').value = productNameEnMainCombination + ' ' +
                                    'caliber' +
                                    ' ' + caliberSelect.value + ' inlaid with ' + inlaidCategoriesStringEn;
                            } else {
                                document.getElementById('name_en_inp').value = productNameEnMainCombination +
                                    ' ' + caliberSelect.value + ' inlaid with ' + inlaidCategoriesStringEn;
                            }
                        }
                    } else {
                        document.getElementById('name_en_inp').value = '';
                    }
                }

                // Event listener for changes in selection
                $('#categories_inp').on('select2:unselecting', function(event) {
                    document.getElementById('name_ar_inp').value = '';
                    document.getElementById('name_en_inp').value = '';
                });
            } else {
                // No category selected
                document.getElementById('name_ar_inp').value = product.name_ar;
                document.getElementById('name_en_inp').value = product.name_ar;
            }
        }
    </script>

    <script>
        function setDropzoneImages(dropzone) {
            $.ajax({
                url: '/dashboard/products/{{ $product->id }}/images',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(key, value) {
                        var file = {
                            name: value.name,
                            size: value.size,
                            type: 'image/jpeg',
                            status: 'success',
                            url: value.path,
                            is_stored_before: true
                        };
                        dropzone.options.addedfile.call(dropzone, file);
                        dropzone.options.thumbnail.call(dropzone, file, value.path);
                        dropzone.emit("complete", file);
                    });

                    $('.dz-image>img').css({
                        "width": "100%",
                        "height": "100%"
                    });
                }
            });
        }
        $(document).ready(function() {
            // Event listener for changes in the categories select box
            $('#categories_inp').change(function() {
                var selectedCategories = $(this).val();
                var selectedSubCategories = $('#subcategories_inp').val();
                var valuesAfterRemovingUnselected = [];

                // Check if selectedCategories is empty
                if (selectedCategories.length === 0) {
                    // Hide the subcategories_div and remove selected options
                    $('#subcategories_div').hide();
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
                        // Convert values from int to string using the map function
                        const subcategories = $.map(data.subcategories || [], function(value) {
                            return value.toString();
                        });

                        // Get values that are unique to subcategories (The values that should be removed from selected subcategories)
                        const valuesToRemove = $.grep(selectedSubCategories || [], function(
                            value) {
                            return $.inArray(value, subcategories) === -1;
                        });

                        $('#subcategories_inp option').each(function() {
                            // Get values after removing the valuesToRemove
                            valuesAfterRemovingUnselected = $.grep(
                                selectedSubCategories || [],
                                function(value) {
                                    return $.inArray(value, valuesToRemove) === -1;
                                });
                            $(this).remove();
                        })



                        // Update subcategories select box with new options
                        $('#subcategories_inp').html(data.options);

                        // Show the subcategories_div
                        if (data.subcategories.length != 0) {
                            console.log(data.subcategories.length);
                            $('#subcategories_div').fadeIn();
                        }

                        valuesAfterRemovingUnselected = $.grep(valuesAfterRemovingUnselected,
                            function(value) {
                                return $.inArray(value, data.subcategories) === -1;
                            });

                        $.each(valuesAfterRemovingUnselected, function(index, sub) {
                            $(`#subcategories_inp`).val(sub).attr('selected', true);
                            $(`#subcategories_inp`).trigger('change');
                        })

                    },
                    error: function(error) {
                        console.error('Error fetching subcategories:', error);
                    }
                });
            });
            $('#categories_inp').trigger('change')

            // Event listener for changes in the vendors select box
            $('#vendor_id_inp').change(function() {
                var selectedVendor = $(this).val();
                var selectedCities = $('#cities_inp').val();
                var valuesAfterRemovingUnselected = [];
                console.log(valuesAfterRemovingUnselected);
                // Check if selectedVendor is empty
                if (selectedVendor.length === 0 || selectedVendor.length === 1) {
                    // Hide the cities_div and remove selected options
                    $('#cities_div').hide();
                    $('#cities_inp option').each(function() {
                        $(this).remove();
                    })
                }

                // Make AJAX request
                $.ajax({
                    url: '/dashboard/select2-ajax/vendor-cities',
                    method: 'POST', // Adjust the HTTP method if needed
                    data: {
                        vendor: selectedVendor,
                        productId: {{ $product->id }}
                    },
                    success: function(data) {
                        $.each(data.vendorCities, function(key, vendorCity) {
                            $('#cities_inp').append('<option value="' + vendorCity
                                .city_id + '">' + vendorCity.city.name + '</option>'
                            );
                        });
                        $.each(data.productCities, function(key, productCity) {
                            $("#cities_inp option").each(function() {
                                //Select old selected cities with product
                                if ($(this).val() == productCity.city_id) {
                                    $(this).prop("selected", true);
                                }
                            });
                        });
                        // Show the cities_div
                        if (data.vendorCities.length != 0) {
                            $('#cities_div').fadeIn();
                        }

                        if (data.vendorCities.length === 0) {
                            $('#cities_div').fadeOut();
                        }


                    },
                    error: function(error) {
                        console.error('Error fetching vendorCities:', error);
                    }
                });
            });
            $('#vendor_id_inp').trigger('change')
        });
    </script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/ar.js"></script>
    <script src="{{ asset('assets/dashboard/js/forms/products/wizzard-form.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/components/dropzone.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/components/select2-ajax.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script>
        $('#variations').repeater({
            initEmpty: false,
            isFirstItemUndeletable: true,
            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    </script>
    <script>
        let deletedIds = [];

        function deleteId(itemId) {
            deletedIds.push(itemId);
            const deletedVariationsInput = document.getElementById('deletedVariationsInput');
            const deletedIdsString = deletedIds.join(',');
            deletedVariationsInput.value = deletedIdsString;
        }
        $(document).ready(() => {

            new Tagify(document.getElementById('meta_tag_key_words_inp'), {
                originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
            });
        });
    </script>
@endpush
