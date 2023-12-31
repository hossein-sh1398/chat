@extends('admin.theme.master')
{{--@section('admin-title')--}}

{{--@stop--}}

@section('admin-toolbar')
   {{-- <!--begin::Actions-->

        <!--begin::Filter menu-->
        <div class="m-0">
            <!--begin::Menu toggle-->
            <a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder"
               data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none">
												<path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                                      fill="currentColor"/>
											</svg>
										</span>
                <!--end::Svg Icon-->Filter</a>
            <!--end::Menu toggle-->
            <!--begin::Menu 1-->
            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                 id="kt_menu_6244763d93048">
                <!--begin::Header-->
                <div class="px-7 py-5">
                    <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                </div>
                <!--end::Header-->
                <!--begin::Menu separator-->
                <div class="separator border-gray-200"></div>
                <!--end::Menu separator-->
                <!--begin::Form-->
                <div class="px-7 py-5">
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label fw-bold">Status:</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <div>
                            <select class="form-select form-select-solid" data-kt-select2="true"
                                    data-placeholder="Select option" data-dropdown-parent="#kt_menu_6244763d93048"
                                    data-allow-clear="true">
                                <option></option>
                                <option value="1">Approved</option>
                                <option value="2">Pending</option>
                                <option value="2">In Process</option>
                                <option value="2">Rejected</option>
                            </select>
                        </div>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label fw-bold">Member Type:</label>
                        <!--end::Label-->
                        <!--begin::Options-->
                        <div class="d-flex">
                            <!--begin::Options-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                <input class="form-check-input" type="checkbox" value="1"/>
                                <span class="form-check-label">Author</span>
                            </label>
                            <!--end::Options-->
                            <!--begin::Options-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="2" checked="checked"/>
                                <span class="form-check-label">Customer</span>
                            </label>
                            <!--end::Options-->
                        </div>
                        <!--end::Options-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label fw-bold">Notifications:</label>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="" name="notifications"
                                   checked="checked"/>
                            <label class="form-check-label">Enabled</label>
                        </div>
                        <!--end::Switch-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2"
                                data-kt-menu-dismiss="true">Reset
                        </button>
                        <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply
                        </button>
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Form-->
            </div>
            <!--end::Menu 1-->
        </div>
        <!--end::Filter menu-->
        <!--begin::Secondary button-->
        <!--end::Secondary button-->
        <!--begin::Primary button-->
        <a href="../../demo1/dist/.html" class="btn btn-sm btn-primary" data-bs-toggle="modal"
           data-bs-target="#kt_modal_create_app">Create</a>
        <!--end::Primary button-->

    <!--end::Actions-->--}}
   <a href="#" class="btn btn-sm btn-secondary btn-block btn-hover-rise p-2 fs-8">
       <span class="align-text-bottom mx-1">ذخیره</span>
       <i class="fas fa-save fs-7"></i>
   </a>
   <a href="#" class="btn btn-sm btn-secondary btn-block btn-hover-rise p-2 fs-8">
       <span class="align-text-bottom mx-1">ذخیره و بستن</span>
       <i class="fas fa-save fs-7"></i>
   </a>
   <a href="#" class="btn btn-sm btn-secondary btn-block btn-hover-rise p-2 fs-8">
       <span class="align-text-bottom mx-1">ذخیره و جدید</span>
       <i class="fas fa-save fs-7"></i>
   </a>
   <a href="#" class="btn btn-sm btn-primary btn-block btn-hover-rise p-2 fs-8">
       <span class="align-text-bottom mx-1">بازگشت</span>
       <i class="fas fa-arrow-left fs-7"></i>
       <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->

       <!--end::Svg Icon-->
   </a>

@stop
@section('admin-content')
    <div class="container">
        <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="../../demo1/dist/apps/ecommerce/catalog/products.html">
            <!--begin::Aside column-->
            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                <!--begin::Template settings-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h5>دسته بندی</h5>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Select2-->
                        <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_product_store_template">
                            <option disabled selected="selected">لطفا دسته را انتخاب نمایید</option>
                            <option value="default" >Default template</option>
                            <option value="electronics">Electronics</option>
                            <option value="office">Office stationary</option>
                            <option value="fashion">Fashion</option>
                        </select>
                        <!--end::Select2-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Template settings-->
                <!--begin::Status-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h5>وضعیت</h5>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                        </div>
                        <!--begin::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Select2-->
                        <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_product_status_select">
                            <option></option>
                            <option value="published" selected="selected">انتشار</option>
                            <option value="scheduled">زمان بندی</option>
                            <option value="inactive">عدم انتشار</option>
                        </select>
                        <!--end::Select2-->
                        <!--begin::Datepicker-->
                        <div class="d-none mt-10">
                            <label for="kt_ecommerce_add_product_status_datepicker" class="form-label fs-8">تاریخ مورد نظر را انتخاب نمایید</label>
                            <input class="form-control" id="kt_ecommerce_add_product_status_datepicker" placeholder="Pick date &amp; time" />
                        </div>
                        <!--end::Datepicker-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Status-->
                <!--begin::Thumbnail settings-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h5>تصویر شاخص</h5>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body text-center pt-0">
                        <!--begin::Image input-->
                        <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true" style="background-image: url(cdn/theme/admin/media/svg/files/blank-image.svg)">
                            <!--begin::Preview existing avatar-->
                            <div class="image-input-wrapper w-150px h-150px"></div>
                            <!--end::Preview existing avatar-->
                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <!--begin::Inputs-->
                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="avatar_remove" />
                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->
                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
														<i class="bi bi-x fs-2"></i>
													</span>
                            <!--end::Cancel-->
                            <!--begin::Remove-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
														<i class="bi bi-x fs-2"></i>
													</span>
                            <!--end::Remove-->
                        </div>
                        <!--end::Image input-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Thumbnail settings-->

                <!--begin::Category & tags-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h5>سئو</h5>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Input group-->
                        <!--begin::Label-->
                        <label class="form-label">توضیحات کوتاه</label>
                        <!--end::Label-->
                        <!--begin::Select2-->
                        <textarea class="form-control mb-2"></textarea>
                        <!--end::Select2-->

                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <!--begin::Label-->
                        <label class="form-label d-block">کلمات کلیدی</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input id="kt_ecommerce_add_product_tags" name="kt_ecommerce_add_product_tags" class="form-control mb-2" value="" />
                        <!--end::Input-->
                        <!--end::Input group-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Category & tags-->

            </div>
            <!--end::Aside column-->
            <!--begin::Main column-->
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <!--begin:::Tabs-->
                {{--                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">--}}
                <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x fs-6 mb-n2">
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">عمومی</a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                {{--<li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced">Advanced</a>
                </li>--}}
                <!--end:::Tab item-->
                </ul>
                <!--end:::Tabs-->
                <!--begin::Tab content-->
                <div class="tab-content">
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <!--begin::General options-->
                            <div class="card card-flush py-4">
                                <!--begin::Card body-->
                                <div class="card-body pt-4">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="required form-label">Product Name</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="product_name" class="form-control mb-2" placeholder="Product name" value="" />
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div>
                                        <!--begin::Label-->
                                        <label class="form-label">Description</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <div id="kt_ecommerce_add_product_description" name="kt_ecommerce_add_product_description" class="min-h-200px mb-2"></div>
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Set a description to the product for better visibility.</div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::General options-->
                            <!--begin::Media-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Media</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-2">
                                        <!--begin::Dropzone-->
                                        <div class="dropzone" id="kt_ecommerce_add_product_media">
                                            <!--begin::Message-->
                                            <div class="dz-message needsclick">
                                                <!--begin::Icon-->
                                                <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                                <!--end::Icon-->
                                                <!--begin::Info-->
                                                <div class="ms-4">
                                                    <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                                    <span class="fs-7 fw-bold text-gray-400">Upload up to 10 files</span>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                        </div>
                                        <!--end::Dropzone-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set the product media gallery.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::Media-->
                            <!--begin::Media-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Media</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-2">
                                        <!--begin::Dropzone-->
                                        <div class="dropzone" id="kt_ecommerce_add_product_media">
                                            <!--begin::Message-->
                                            <div class="dz-message needsclick">
                                                <!--begin::Icon-->
                                                <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                                <!--end::Icon-->
                                                <!--begin::Info-->
                                                <div class="ms-4">
                                                    <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                                    <span class="fs-7 fw-bold text-gray-400">Upload up to 10 files</span>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                        </div>
                                        <!--end::Dropzone-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set the product media gallery.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::Media-->
                        </div>
                    </div>
                    <!--end::Tab pane-->
                    <!--begin::Tab pane-->
                {{--<div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <!--begin::Inventory-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Inventory</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">SKU</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="sku" class="form-control mb-2" placeholder="SKU Number" value="" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Enter the product SKU.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">Barcode</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="sku" class="form-control mb-2" placeholder="Barcode Number" value="" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Enter the product barcode number.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">Quantity</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div class="d-flex gap-3">
                                        <input type="number" name="shelf" class="form-control mb-2" placeholder="On shelf" value="" />
                                        <input type="number" name="warehouse" class="form-control mb-2" placeholder="In warehouse" />
                                    </div>
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Enter the product quantity.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row">
                                    <!--begin::Label-->
                                    <label class="form-label">Allow Backorders</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div class="form-check form-check-custom form-check-solid mb-2">
                                        <input class="form-check-input" type="checkbox" value="" />
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Allow customers to purchase products that are out of stock.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::Inventory-->
                        <!--begin::Variations-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Variations</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="" data-kt-ecommerce-catalog-add-product="auto-options">
                                    <!--begin::Label-->
                                    <label class="form-label">Add Product Variations</label>
                                    <!--end::Label-->
                                    <!--begin::Repeater-->
                                    <div id="kt_ecommerce_add_product_options">
                                        <!--begin::Form group-->
                                        <div class="form-group">
                                            <div data-repeater-list="kt_ecommerce_add_product_options" class="d-flex flex-column gap-3">
                                                <div data-repeater-item="" class="form-group d-flex flex-wrap gap-5">
                                                    <!--begin::Select2-->
                                                    <div class="w-100 w-md-200px">
                                                        <select class="form-select" name="product_option" data-placeholder="Select a variation" data-kt-ecommerce-catalog-add-product="product_option">
                                                            <option></option>
                                                            <option value="color">Color</option>
                                                            <option value="size">Size</option>
                                                            <option value="material">Material</option>
                                                            <option value="style">Style</option>
                                                        </select>
                                                    </div>
                                                    <!--end::Select2-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control mw-100 w-200px" name="product_option_value" placeholder="Variation" />
                                                    <!--end::Input-->
                                                    <button type="button" data-repeater-delete="" class="btn btn-sm btn-icon btn-light-danger">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr088.svg-->
                                                        <span class="svg-icon svg-icon-2">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor" />
                                                                                <rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor" />
                                                                            </svg>
                                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Form group-->
                                        <!--begin::Form group-->
                                        <div class="form-group mt-5">
                                            <button type="button" data-repeater-create="" class="btn btn-sm btn-light-primary">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                                                                    <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                <!--end::Svg Icon-->Add another variation</button>
                                        </div>
                                        <!--end::Form group-->
                                    </div>
                                    <!--end::Repeater-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::Variations-->
                        <!--begin::Shipping-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Shipping</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="fv-row">
                                    <!--begin::Input-->
                                    <div class="form-check form-check-custom form-check-solid mb-2">
                                        <input class="form-check-input" type="checkbox" id="kt_ecommerce_add_product_shipping_checkbox" value="1" />
                                        <label class="form-check-label">This is a physical product</label>
                                    </div>
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set if the product is a physical or digital item. Physical products may require shipping.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Shipping form-->
                                <div id="kt_ecommerce_add_product_shipping" class="d-none mt-10">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="form-label">Weight</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <input type="text" name="weight" class="form-control mb-2" placeholder="Product weight" value="" />
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Set a product weight in kilograms (kg).</div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row">
                                        <!--begin::Label-->
                                        <label class="form-label">Dimension</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div class="d-flex flex-wrap flex-sm-nowrap gap-3">
                                            <input type="number" name="width" class="form-control mb-2" placeholder="Width (w)" value="" />
                                            <input type="number" name="height" class="form-control mb-2" placeholder="Height (h)" value="" />
                                            <input type="number" name="length" class="form-control mb-2" placeholder="Lengtn (l)" value="" />
                                        </div>
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Enter the product dimensions in centimeters (cm).</div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Shipping form-->
                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::Shipping-->
                        <!--begin::Meta options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Meta Options</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label">Meta Tag Title</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="meta_title" placeholder="Meta tag name" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set a meta tag title. Recommended to be simple and precise keywords.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label">Meta Tag Description</label>
                                    <!--end::Label-->
                                    <!--begin::Editor-->
                                    <div id="kt_ecommerce_add_product_meta_description" name="kt_ecommerce_add_product_meta_description" class="min-h-100px mb-2"></div>
                                    <!--end::Editor-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set a meta tag description to the product for increased SEO ranking.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div>
                                    <!--begin::Label-->
                                    <label class="form-label">Meta Tag Keywords</label>
                                    <!--end::Label-->
                                    <!--begin::Editor-->
                                    <input id="kt_ecommerce_add_product_meta_keywords" name="kt_ecommerce_add_product_meta_keywords" class="form-control mb-2" />
                                    <!--end::Editor-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set a list of keywords that the product is related to. Separate the keywords by adding a comma
                                        <code>,</code>between each keyword.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::Meta options-->
                    </div>
                </div>--}}
                <!--end::Tab pane-->
                </div>
            </div>
            <!--end::Main column-->
        </form>

    </div>
{{--    <div class="card card-xl-stretch shadow-lg mb-5 mb-xl-8">--}}
{{--        <!--begin::Header-->--}}
{{--        <div class="card-header border-1 pt-3 pb-3">--}}
{{--            <h3 class="card-title align-items-start flex-column">--}}
{{--                <span class="card-label fw-bolder fs-3 mb-1">--}}
{{--                    <i class="fas fa-plus-square fs-3 text-success"></i>--}}
{{--                    <span> ایجاد مطالب </span>--}}
{{--                </span>--}}
{{--            </h3>--}}
{{--            <div class="card-toolbar">--}}
{{--                <a href="#" class="btn btn-sm btn-primary btn-block px-5 fs-7">--}}

{{--                    <span class="align-text-bottom mx-1">بازگشت</span>--}}
{{--                    <i class="fas fa-arrow-left fs-7"></i>--}}
{{--                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->--}}

{{--                    <!--end::Svg Icon-->--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!--end::Header-->--}}
{{--        <!--begin::Body-->--}}
{{--        <div class="card-body bg-light">--}}
{{--            <div class="container">--}}
{{--                <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="../../demo1/dist/apps/ecommerce/catalog/products.html">--}}
{{--                    <!--begin::Aside column-->--}}
{{--                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">--}}
{{--                        <!--begin::Template settings-->--}}
{{--                        <div class="card card-flush py-4">--}}
{{--                            <!--begin::Card header-->--}}
{{--                            <div class="card-header">--}}
{{--                                <!--begin::Card title-->--}}
{{--                                <div class="card-title">--}}
{{--                                    <h5>دسته بندی</h5>--}}
{{--                                </div>--}}
{{--                                <!--end::Card title-->--}}
{{--                            </div>--}}
{{--                            <!--end::Card header-->--}}
{{--                            <!--begin::Card body-->--}}
{{--                            <div class="card-body pt-0">--}}
{{--                                <!--begin::Select2-->--}}
{{--                                <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_product_store_template">--}}
{{--                                    <option disabled selected="selected">لطفا دسته را انتخاب نمایید</option>--}}
{{--                                    <option value="default" >Default template</option>--}}
{{--                                    <option value="electronics">Electronics</option>--}}
{{--                                    <option value="office">Office stationary</option>--}}
{{--                                    <option value="fashion">Fashion</option>--}}
{{--                                </select>--}}
{{--                                <!--end::Select2-->--}}
{{--                            </div>--}}
{{--                            <!--end::Card body-->--}}
{{--                        </div>--}}
{{--                        <!--end::Template settings-->--}}
{{--                        <!--begin::Status-->--}}
{{--                        <div class="card card-flush py-4">--}}
{{--                            <!--begin::Card header-->--}}
{{--                            <div class="card-header">--}}
{{--                                <!--begin::Card title-->--}}
{{--                                <div class="card-title">--}}
{{--                                    <h5>وضعیت</h5>--}}
{{--                                </div>--}}
{{--                                <!--end::Card title-->--}}
{{--                                <!--begin::Card toolbar-->--}}
{{--                                <div class="card-toolbar">--}}
{{--                                    <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>--}}
{{--                                </div>--}}
{{--                                <!--begin::Card toolbar-->--}}
{{--                            </div>--}}
{{--                            <!--end::Card header-->--}}
{{--                            <!--begin::Card body-->--}}
{{--                            <div class="card-body pt-0">--}}
{{--                                <!--begin::Select2-->--}}
{{--                                <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_product_status_select">--}}
{{--                                    <option></option>--}}
{{--                                    <option value="published" selected="selected">انتشار</option>--}}
{{--                                    <option value="scheduled">زمان بندی</option>--}}
{{--                                    <option value="inactive">عدم انتشار</option>--}}
{{--                                </select>--}}
{{--                                <!--end::Select2-->--}}
{{--                                <!--begin::Datepicker-->--}}
{{--                                <div class="d-none mt-10">--}}
{{--                                    <label for="kt_ecommerce_add_product_status_datepicker" class="form-label fs-8">تاریخ مورد نظر را انتخاب نمایید</label>--}}
{{--                                    <input class="form-control" id="kt_ecommerce_add_product_status_datepicker" placeholder="Pick date &amp; time" />--}}
{{--                                </div>--}}
{{--                                <!--end::Datepicker-->--}}
{{--                            </div>--}}
{{--                            <!--end::Card body-->--}}
{{--                        </div>--}}
{{--                        <!--end::Status-->--}}
{{--                        <!--begin::Thumbnail settings-->--}}
{{--                        <div class="card card-flush py-4">--}}
{{--                            <!--begin::Card header-->--}}
{{--                            <div class="card-header">--}}
{{--                                <!--begin::Card title-->--}}
{{--                                <div class="card-title">--}}
{{--                                    <h5>تصویر شاخص</h5>--}}
{{--                                </div>--}}
{{--                                <!--end::Card title-->--}}
{{--                            </div>--}}
{{--                            <!--end::Card header-->--}}
{{--                            <!--begin::Card body-->--}}
{{--                            <div class="card-body text-center pt-0">--}}
{{--                                <!--begin::Image input-->--}}
{{--                                <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true" style="background-image: url(cdn/theme/admin/media/svg/files/blank-image.svg)">--}}
{{--                                    <!--begin::Preview existing avatar-->--}}
{{--                                    <div class="image-input-wrapper w-150px h-150px"></div>--}}
{{--                                    <!--end::Preview existing avatar-->--}}
{{--                                    <!--begin::Label-->--}}
{{--                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">--}}
{{--                                        <i class="bi bi-pencil-fill fs-7"></i>--}}
{{--                                        <!--begin::Inputs-->--}}
{{--                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />--}}
{{--                                        <input type="hidden" name="avatar_remove" />--}}
{{--                                        <!--end::Inputs-->--}}
{{--                                    </label>--}}
{{--                                    <!--end::Label-->--}}
{{--                                    <!--begin::Cancel-->--}}
{{--                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">--}}
{{--														<i class="bi bi-x fs-2"></i>--}}
{{--													</span>--}}
{{--                                    <!--end::Cancel-->--}}
{{--                                    <!--begin::Remove-->--}}
{{--                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">--}}
{{--														<i class="bi bi-x fs-2"></i>--}}
{{--													</span>--}}
{{--                                    <!--end::Remove-->--}}
{{--                                </div>--}}
{{--                                <!--end::Image input-->--}}
{{--                                <!--begin::Description-->--}}
{{--                                <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>--}}
{{--                                <!--end::Description-->--}}
{{--                            </div>--}}
{{--                            <!--end::Card body-->--}}
{{--                        </div>--}}
{{--                        <!--end::Thumbnail settings-->--}}

{{--                        <!--begin::Category & tags-->--}}
{{--                        <div class="card card-flush py-4">--}}
{{--                            <!--begin::Card header-->--}}
{{--                            <div class="card-header">--}}
{{--                                <!--begin::Card title-->--}}
{{--                                <div class="card-title">--}}
{{--                                    <h5>سئو</h5>--}}
{{--                                </div>--}}
{{--                                <!--end::Card title-->--}}
{{--                            </div>--}}
{{--                            <!--end::Card header-->--}}
{{--                            <!--begin::Card body-->--}}
{{--                            <div class="card-body pt-0">--}}
{{--                                <!--begin::Input group-->--}}
{{--                                <!--begin::Label-->--}}
{{--                                <label class="form-label">توضیحات کوتاه</label>--}}
{{--                                <!--end::Label-->--}}
{{--                                <!--begin::Select2-->--}}
{{--                                <textarea class="form-control mb-2"></textarea>--}}
{{--                                <!--end::Select2-->--}}

{{--                                <!--end::Input group-->--}}

{{--                                <!--begin::Input group-->--}}
{{--                                <!--begin::Label-->--}}
{{--                                <label class="form-label d-block">کلمات کلیدی</label>--}}
{{--                                <!--end::Label-->--}}
{{--                                <!--begin::Input-->--}}
{{--                                <input id="kt_ecommerce_add_product_tags" name="kt_ecommerce_add_product_tags" class="form-control mb-2" value="" />--}}
{{--                                <!--end::Input-->--}}
{{--                                <!--end::Input group-->--}}
{{--                            </div>--}}
{{--                            <!--end::Card body-->--}}
{{--                        </div>--}}
{{--                        <!--end::Category & tags-->--}}

{{--                    </div>--}}
{{--                    <!--end::Aside column-->--}}
{{--                    <!--begin::Main column-->--}}
{{--                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">--}}
{{--                        <!--begin:::Tabs-->--}}
{{--                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">--}}
{{--                        <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x fs-6 mb-n2">--}}
{{--                            <!--begin:::Tab item-->--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">عمومی</a>--}}
{{--                            </li>--}}
{{--                            <!--end:::Tab item-->--}}
{{--                            <!--begin:::Tab item-->--}}
{{--                            --}}{{--<li class="nav-item">--}}
{{--                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced">Advanced</a>--}}
{{--                            </li>--}}
{{--                            <!--end:::Tab item-->--}}
{{--                        </ul>--}}
{{--                        <!--end:::Tabs-->--}}
{{--                        <!--begin::Tab content-->--}}
{{--                        <div class="tab-content">--}}
{{--                            <!--begin::Tab pane-->--}}
{{--                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">--}}
{{--                                <div class="d-flex flex-column gap-7 gap-lg-10">--}}
{{--                                    <!--begin::General options-->--}}
{{--                                    <div class="card card-flush py-4">--}}
{{--                                        <!--begin::Card body-->--}}
{{--                                        <div class="card-body pt-4">--}}
{{--                                            <!--begin::Input group-->--}}
{{--                                            <div class="mb-10 fv-row">--}}
{{--                                                <!--begin::Label-->--}}
{{--                                                <label class="required form-label">Product Name</label>--}}
{{--                                                <!--end::Label-->--}}
{{--                                                <!--begin::Input-->--}}
{{--                                                <input type="text" name="product_name" class="form-control mb-2" placeholder="Product name" value="" />--}}
{{--                                                <!--end::Input-->--}}
{{--                                                <!--begin::Description-->--}}
{{--                                                <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>--}}
{{--                                                <!--end::Description-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Input group-->--}}
{{--                                            <!--begin::Input group-->--}}
{{--                                            <div>--}}
{{--                                                <!--begin::Label-->--}}
{{--                                                <label class="form-label">Description</label>--}}
{{--                                                <!--end::Label-->--}}
{{--                                                <!--begin::Editor-->--}}
{{--                                                <div id="kt_ecommerce_add_product_description" name="kt_ecommerce_add_product_description" class="min-h-200px mb-2"></div>--}}
{{--                                                <!--end::Editor-->--}}
{{--                                                <!--begin::Description-->--}}
{{--                                                <div class="text-muted fs-7">Set a description to the product for better visibility.</div>--}}
{{--                                                <!--end::Description-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Input group-->--}}
{{--                                        </div>--}}
{{--                                        <!--end::Card header-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::General options-->--}}
{{--                                    <!--begin::Media-->--}}
{{--                                    <div class="card card-flush py-4">--}}
{{--                                        <!--begin::Card header-->--}}
{{--                                        <div class="card-header">--}}
{{--                                            <div class="card-title">--}}
{{--                                                <h2>Media</h2>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Card header-->--}}
{{--                                        <!--begin::Card body-->--}}
{{--                                        <div class="card-body pt-0">--}}
{{--                                            <!--begin::Input group-->--}}
{{--                                            <div class="fv-row mb-2">--}}
{{--                                                <!--begin::Dropzone-->--}}
{{--                                                <div class="dropzone" id="kt_ecommerce_add_product_media">--}}
{{--                                                    <!--begin::Message-->--}}
{{--                                                    <div class="dz-message needsclick">--}}
{{--                                                        <!--begin::Icon-->--}}
{{--                                                        <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>--}}
{{--                                                        <!--end::Icon-->--}}
{{--                                                        <!--begin::Info-->--}}
{{--                                                        <div class="ms-4">--}}
{{--                                                            <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Drop files here or click to upload.</h3>--}}
{{--                                                            <span class="fs-7 fw-bold text-gray-400">Upload up to 10 files</span>--}}
{{--                                                        </div>--}}
{{--                                                        <!--end::Info-->--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <!--end::Dropzone-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Input group-->--}}
{{--                                            <!--begin::Description-->--}}
{{--                                            <div class="text-muted fs-7">Set the product media gallery.</div>--}}
{{--                                            <!--end::Description-->--}}
{{--                                        </div>--}}
{{--                                        <!--end::Card header-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Media-->--}}
{{--                                    <!--begin::Media-->--}}
{{--                                    <div class="card card-flush py-4">--}}
{{--                                        <!--begin::Card header-->--}}
{{--                                        <div class="card-header">--}}
{{--                                            <div class="card-title">--}}
{{--                                                <h2>Media</h2>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Card header-->--}}
{{--                                        <!--begin::Card body-->--}}
{{--                                        <div class="card-body pt-0">--}}
{{--                                            <!--begin::Input group-->--}}
{{--                                            <div class="fv-row mb-2">--}}
{{--                                                <!--begin::Dropzone-->--}}
{{--                                                <div class="dropzone" id="kt_ecommerce_add_product_media">--}}
{{--                                                    <!--begin::Message-->--}}
{{--                                                    <div class="dz-message needsclick">--}}
{{--                                                        <!--begin::Icon-->--}}
{{--                                                        <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>--}}
{{--                                                        <!--end::Icon-->--}}
{{--                                                        <!--begin::Info-->--}}
{{--                                                        <div class="ms-4">--}}
{{--                                                            <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Drop files here or click to upload.</h3>--}}
{{--                                                            <span class="fs-7 fw-bold text-gray-400">Upload up to 10 files</span>--}}
{{--                                                        </div>--}}
{{--                                                        <!--end::Info-->--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <!--end::Dropzone-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Input group-->--}}
{{--                                            <!--begin::Description-->--}}
{{--                                            <div class="text-muted fs-7">Set the product media gallery.</div>--}}
{{--                                            <!--end::Description-->--}}
{{--                                        </div>--}}
{{--                                        <!--end::Card header-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Media-->--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!--end::Tab pane-->--}}
{{--                            <!--begin::Tab pane-->--}}
{{--                            --}}{{--<div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">--}}
{{--                                <div class="d-flex flex-column gap-7 gap-lg-10">--}}
{{--                                    <!--begin::Inventory-->--}}
{{--                                    <div class="card card-flush py-4">--}}
{{--                                        <!--begin::Card header-->--}}
{{--                                        <div class="card-header">--}}
{{--                                            <div class="card-title">--}}
{{--                                                <h2>Inventory</h2>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Card header-->--}}
{{--                                        <!--begin::Card body-->--}}
{{--                                        <div class="card-body pt-0">--}}
{{--                                            <!--begin::Input group-->--}}
{{--                                            <div class="mb-10 fv-row">--}}
{{--                                                <!--begin::Label-->--}}
{{--                                                <label class="required form-label">SKU</label>--}}
{{--                                                <!--end::Label-->--}}
{{--                                                <!--begin::Input-->--}}
{{--                                                <input type="text" name="sku" class="form-control mb-2" placeholder="SKU Number" value="" />--}}
{{--                                                <!--end::Input-->--}}
{{--                                                <!--begin::Description-->--}}
{{--                                                <div class="text-muted fs-7">Enter the product SKU.</div>--}}
{{--                                                <!--end::Description-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Input group-->--}}
{{--                                            <!--begin::Input group-->--}}
{{--                                            <div class="mb-10 fv-row">--}}
{{--                                                <!--begin::Label-->--}}
{{--                                                <label class="required form-label">Barcode</label>--}}
{{--                                                <!--end::Label-->--}}
{{--                                                <!--begin::Input-->--}}
{{--                                                <input type="text" name="sku" class="form-control mb-2" placeholder="Barcode Number" value="" />--}}
{{--                                                <!--end::Input-->--}}
{{--                                                <!--begin::Description-->--}}
{{--                                                <div class="text-muted fs-7">Enter the product barcode number.</div>--}}
{{--                                                <!--end::Description-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Input group-->--}}
{{--                                            <!--begin::Input group-->--}}
{{--                                            <div class="mb-10 fv-row">--}}
{{--                                                <!--begin::Label-->--}}
{{--                                                <label class="required form-label">Quantity</label>--}}
{{--                                                <!--end::Label-->--}}
{{--                                                <!--begin::Input-->--}}
{{--                                                <div class="d-flex gap-3">--}}
{{--                                                    <input type="number" name="shelf" class="form-control mb-2" placeholder="On shelf" value="" />--}}
{{--                                                    <input type="number" name="warehouse" class="form-control mb-2" placeholder="In warehouse" />--}}
{{--                                                </div>--}}
{{--                                                <!--end::Input-->--}}
{{--                                                <!--begin::Description-->--}}
{{--                                                <div class="text-muted fs-7">Enter the product quantity.</div>--}}
{{--                                                <!--end::Description-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Input group-->--}}
{{--                                            <!--begin::Input group-->--}}
{{--                                            <div class="fv-row">--}}
{{--                                                <!--begin::Label-->--}}
{{--                                                <label class="form-label">Allow Backorders</label>--}}
{{--                                                <!--end::Label-->--}}
{{--                                                <!--begin::Input-->--}}
{{--                                                <div class="form-check form-check-custom form-check-solid mb-2">--}}
{{--                                                    <input class="form-check-input" type="checkbox" value="" />--}}
{{--                                                    <label class="form-check-label">Yes</label>--}}
{{--                                                </div>--}}
{{--                                                <!--end::Input-->--}}
{{--                                                <!--begin::Description-->--}}
{{--                                                <div class="text-muted fs-7">Allow customers to purchase products that are out of stock.</div>--}}
{{--                                                <!--end::Description-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Input group-->--}}
{{--                                        </div>--}}
{{--                                        <!--end::Card header-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Inventory-->--}}
{{--                                    <!--begin::Variations-->--}}
{{--                                    <div class="card card-flush py-4">--}}
{{--                                        <!--begin::Card header-->--}}
{{--                                        <div class="card-header">--}}
{{--                                            <div class="card-title">--}}
{{--                                                <h2>Variations</h2>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Card header-->--}}
{{--                                        <!--begin::Card body-->--}}
{{--                                        <div class="card-body pt-0">--}}
{{--                                            <!--begin::Input group-->--}}
{{--                                            <div class="" data-kt-ecommerce-catalog-add-product="auto-options">--}}
{{--                                                <!--begin::Label-->--}}
{{--                                                <label class="form-label">Add Product Variations</label>--}}
{{--                                                <!--end::Label-->--}}
{{--                                                <!--begin::Repeater-->--}}
{{--                                                <div id="kt_ecommerce_add_product_options">--}}
{{--                                                    <!--begin::Form group-->--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <div data-repeater-list="kt_ecommerce_add_product_options" class="d-flex flex-column gap-3">--}}
{{--                                                            <div data-repeater-item="" class="form-group d-flex flex-wrap gap-5">--}}
{{--                                                                <!--begin::Select2-->--}}
{{--                                                                <div class="w-100 w-md-200px">--}}
{{--                                                                    <select class="form-select" name="product_option" data-placeholder="Select a variation" data-kt-ecommerce-catalog-add-product="product_option">--}}
{{--                                                                        <option></option>--}}
{{--                                                                        <option value="color">Color</option>--}}
{{--                                                                        <option value="size">Size</option>--}}
{{--                                                                        <option value="material">Material</option>--}}
{{--                                                                        <option value="style">Style</option>--}}
{{--                                                                    </select>--}}
{{--                                                                </div>--}}
{{--                                                                <!--end::Select2-->--}}
{{--                                                                <!--begin::Input-->--}}
{{--                                                                <input type="text" class="form-control mw-100 w-200px" name="product_option_value" placeholder="Variation" />--}}
{{--                                                                <!--end::Input-->--}}
{{--                                                                <button type="button" data-repeater-delete="" class="btn btn-sm btn-icon btn-light-danger">--}}
{{--                                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr088.svg-->--}}
{{--                                                                    <span class="svg-icon svg-icon-2">--}}
{{--																						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--																							<rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor" />--}}
{{--																							<rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor" />--}}
{{--																						</svg>--}}
{{--																					</span>--}}
{{--                                                                    <!--end::Svg Icon-->--}}
{{--                                                                </button>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <!--end::Form group-->--}}
{{--                                                    <!--begin::Form group-->--}}
{{--                                                    <div class="form-group mt-5">--}}
{{--                                                        <button type="button" data-repeater-create="" class="btn btn-sm btn-light-primary">--}}
{{--                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->--}}
{{--                                                            <span class="svg-icon svg-icon-2">--}}
{{--																			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--																				<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />--}}
{{--																				<rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />--}}
{{--																			</svg>--}}
{{--																		</span>--}}
{{--                                                            <!--end::Svg Icon-->Add another variation</button>--}}
{{--                                                    </div>--}}
{{--                                                    <!--end::Form group-->--}}
{{--                                                </div>--}}
{{--                                                <!--end::Repeater-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Input group-->--}}
{{--                                        </div>--}}
{{--                                        <!--end::Card header-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Variations-->--}}
{{--                                    <!--begin::Shipping-->--}}
{{--                                    <div class="card card-flush py-4">--}}
{{--                                        <!--begin::Card header-->--}}
{{--                                        <div class="card-header">--}}
{{--                                            <div class="card-title">--}}
{{--                                                <h2>Shipping</h2>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Card header-->--}}
{{--                                        <!--begin::Card body-->--}}
{{--                                        <div class="card-body pt-0">--}}
{{--                                            <!--begin::Input group-->--}}
{{--                                            <div class="fv-row">--}}
{{--                                                <!--begin::Input-->--}}
{{--                                                <div class="form-check form-check-custom form-check-solid mb-2">--}}
{{--                                                    <input class="form-check-input" type="checkbox" id="kt_ecommerce_add_product_shipping_checkbox" value="1" />--}}
{{--                                                    <label class="form-check-label">This is a physical product</label>--}}
{{--                                                </div>--}}
{{--                                                <!--end::Input-->--}}
{{--                                                <!--begin::Description-->--}}
{{--                                                <div class="text-muted fs-7">Set if the product is a physical or digital item. Physical products may require shipping.</div>--}}
{{--                                                <!--end::Description-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Input group-->--}}
{{--                                            <!--begin::Shipping form-->--}}
{{--                                            <div id="kt_ecommerce_add_product_shipping" class="d-none mt-10">--}}
{{--                                                <!--begin::Input group-->--}}
{{--                                                <div class="mb-10 fv-row">--}}
{{--                                                    <!--begin::Label-->--}}
{{--                                                    <label class="form-label">Weight</label>--}}
{{--                                                    <!--end::Label-->--}}
{{--                                                    <!--begin::Editor-->--}}
{{--                                                    <input type="text" name="weight" class="form-control mb-2" placeholder="Product weight" value="" />--}}
{{--                                                    <!--end::Editor-->--}}
{{--                                                    <!--begin::Description-->--}}
{{--                                                    <div class="text-muted fs-7">Set a product weight in kilograms (kg).</div>--}}
{{--                                                    <!--end::Description-->--}}
{{--                                                </div>--}}
{{--                                                <!--end::Input group-->--}}
{{--                                                <!--begin::Input group-->--}}
{{--                                                <div class="fv-row">--}}
{{--                                                    <!--begin::Label-->--}}
{{--                                                    <label class="form-label">Dimension</label>--}}
{{--                                                    <!--end::Label-->--}}
{{--                                                    <!--begin::Input-->--}}
{{--                                                    <div class="d-flex flex-wrap flex-sm-nowrap gap-3">--}}
{{--                                                        <input type="number" name="width" class="form-control mb-2" placeholder="Width (w)" value="" />--}}
{{--                                                        <input type="number" name="height" class="form-control mb-2" placeholder="Height (h)" value="" />--}}
{{--                                                        <input type="number" name="length" class="form-control mb-2" placeholder="Lengtn (l)" value="" />--}}
{{--                                                    </div>--}}
{{--                                                    <!--end::Input-->--}}
{{--                                                    <!--begin::Description-->--}}
{{--                                                    <div class="text-muted fs-7">Enter the product dimensions in centimeters (cm).</div>--}}
{{--                                                    <!--end::Description-->--}}
{{--                                                </div>--}}
{{--                                                <!--end::Input group-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Shipping form-->--}}
{{--                                        </div>--}}
{{--                                        <!--end::Card header-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Shipping-->--}}
{{--                                    <!--begin::Meta options-->--}}
{{--                                    <div class="card card-flush py-4">--}}
{{--                                        <!--begin::Card header-->--}}
{{--                                        <div class="card-header">--}}
{{--                                            <div class="card-title">--}}
{{--                                                <h2>Meta Options</h2>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Card header-->--}}
{{--                                        <!--begin::Card body-->--}}
{{--                                        <div class="card-body pt-0">--}}
{{--                                            <!--begin::Input group-->--}}
{{--                                            <div class="mb-10">--}}
{{--                                                <!--begin::Label-->--}}
{{--                                                <label class="form-label">Meta Tag Title</label>--}}
{{--                                                <!--end::Label-->--}}
{{--                                                <!--begin::Input-->--}}
{{--                                                <input type="text" class="form-control mb-2" name="meta_title" placeholder="Meta tag name" />--}}
{{--                                                <!--end::Input-->--}}
{{--                                                <!--begin::Description-->--}}
{{--                                                <div class="text-muted fs-7">Set a meta tag title. Recommended to be simple and precise keywords.</div>--}}
{{--                                                <!--end::Description-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Input group-->--}}
{{--                                            <!--begin::Input group-->--}}
{{--                                            <div class="mb-10">--}}
{{--                                                <!--begin::Label-->--}}
{{--                                                <label class="form-label">Meta Tag Description</label>--}}
{{--                                                <!--end::Label-->--}}
{{--                                                <!--begin::Editor-->--}}
{{--                                                <div id="kt_ecommerce_add_product_meta_description" name="kt_ecommerce_add_product_meta_description" class="min-h-100px mb-2"></div>--}}
{{--                                                <!--end::Editor-->--}}
{{--                                                <!--begin::Description-->--}}
{{--                                                <div class="text-muted fs-7">Set a meta tag description to the product for increased SEO ranking.</div>--}}
{{--                                                <!--end::Description-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Input group-->--}}
{{--                                            <!--begin::Input group-->--}}
{{--                                            <div>--}}
{{--                                                <!--begin::Label-->--}}
{{--                                                <label class="form-label">Meta Tag Keywords</label>--}}
{{--                                                <!--end::Label-->--}}
{{--                                                <!--begin::Editor-->--}}
{{--                                                <input id="kt_ecommerce_add_product_meta_keywords" name="kt_ecommerce_add_product_meta_keywords" class="form-control mb-2" />--}}
{{--                                                <!--end::Editor-->--}}
{{--                                                <!--begin::Description-->--}}
{{--                                                <div class="text-muted fs-7">Set a list of keywords that the product is related to. Separate the keywords by adding a comma--}}
{{--                                                    <code>,</code>between each keyword.</div>--}}
{{--                                                <!--end::Description-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Input group-->--}}
{{--                                        </div>--}}
{{--                                        <!--end::Card header-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Meta options-->--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!--end::Tab pane-->--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!--end::Main column-->--}}
{{--                </form>--}}

{{--            </div>--}}




{{--        </div>--}}
{{--        <!--begin::Body-->--}}
{{--        <div class="card-footer col-12 text-end">--}}
{{--            <a href="#" class="btn btn-sm btn-warning btn-block btn-hover-rise px-4 fs-8">--}}
{{--                <span class="align-text-bottom mx-1">ذخیره</span>--}}
{{--                <i class="fas fa-save fs-7"></i>--}}
{{--            </a>--}}
{{--            <a href="#" class="btn btn-sm btn-primary btn-block btn-hover-rise px-4 fs-8">--}}
{{--                <span class="align-text-bottom mx-1">ذخیره و بستن</span>--}}
{{--                <i class="fas fa-save fs-7"></i>--}}
{{--            </a>--}}
{{--            <a href="#" class="btn btn-sm btn-success btn-block btn-hover-rise px-4 fs-8">--}}
{{--                <span class="align-text-bottom mx-1">ذخیره و جدید</span>--}}
{{--                <i class="fas fa-save fs-7"></i>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
@stop
@push('admin-css')
@endpush
@push('admin-js')
    @include('admin.theme.errors')
@endpush

