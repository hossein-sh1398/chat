<div class="modal modal-lg fade" tabindex="-1" id="create-groups-modal">
    <div class="modal-dialog modal-dialog-scrollable">
        <form action="{{ route('admin.chat.group.make') }}" onsubmit="makeGroup(event)" id="form-create-group" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">ایجاد کانال/گروه</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="mb-10 fv-row col-md-6">
                            <label class="required form-label">نام کاربری</label>
                            <input autocomplete="off" type="text" dir="ltr" id="group_username" class="form-control mb-2"/>
                        </div>
                        <div class="mb-10 fv-row col-md-6">
                            <label class="required form-label">عنوان</label>
                            <input autocomplete="off" type="text" dir="rtl" id="group_title" class="form-control mb-2"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-10 fv-row col-md-6">
                            <!--begin::Image input-->
                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                    style="">
                                <!--begin::Preview existing avatar-->
                                <div class="image-input-wrapper w-125px h-125px"
                                        style="background-position: center;background-size: 100% 100%;background-image: url({{ url('/cdn/theme/admin/media/avatars/blank.png') }})"></div>
                                <!--end::Preview existing avatar-->

                                <!--begin::Label-->
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        title="Change avatar">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <!--begin::Inputs-->
                                    <input type="file" name="file" id="group_file" accept=".png, .jpg, .jpeg"/>
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Label-->
                                <!--begin::Cancel-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                        title="Cancel avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Cancel-->
                                <!--begin::Remove-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                        title="Remove avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Remove-->
                            </div>
                            <!--end::Image input-->
                            <!--begin::Hint-->
                            <div class="form-text">تصاویر قابل استفاده : png, jpg, jpeg</div>
                            <!--end::Hint-->
                        </div>
                        <div class="mb-10 fv-row col-md-6">
                            <label class="required form-label">نوع</label>
                            <select class="form-select form-select-solid" id="group_type" data-close-on-select="false" data-placeholder="لطفا انتخاب نمایید">
                                @foreach ($groupTypes as $type)
                                    <option value="{{ $type['id'] }}" >
                                        <span>{{ $type['title'] }}</span>
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-5" id="users">
                        <div class="col col-md-4">
                            <label class="required form-label">اعضا گروه/کانال</label>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col col-md-4">
                                    <input class="form-control form-control-sm search" name="search" type="text" id="search" placeholder="جستجو ...">
                                </div>
                            </div>

                            <div class="mt-8 table">
                                <div class="fw-bolder text-muted d-flex justify-content-between align-items-center">
                                    <div class="w-25px">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input form-check-input-all w-15px h-15px" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".widget-9-check"/>
                                        </div>
                                    </div>
                                    <div class="min-w-150px cursor-default"><strong>نام</strong></div>
                                    <div class="min-w-150px cursor-default"><strong>ایمیل</strong></div>
                                </div>
                                <div class="list mt-5" style="height: 300px;overflow-y:scroll">
                                    @foreach($userList as $key => $user)
                                        <div class="d-flex justify-content-between align-items-center mt-3" style="border-bottom: 1px solid #e3e0e0;padding:15px 0">
                                            <div class="w-25px">
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input form-check-input-single widget-9-check w-15px h-15px" type="checkbox" value="{{ $user->id }}"/>
                                                </div>
                                            </div>
                                            <div class="name min-w-150px">{{ $user->name }}</div>
                                            <div class="email min-w-200px">{{ $user->email }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-8">
                        <div class="col" id="errors">
                            <p class="alert alert-danger d-none"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light btn-block btn-hover-rise p-2 fs-8 mb-3 btn-sm" data-bs-dismiss="modal"><i class="fa fa-close"></i></button>
                    <button type="submit" class="btn btn-sm btn-primary btn-block btn-hover-rise p-2 fs-8 mb-3 btn-sm"><i class="fa fa-save"></i></button>
                    <div class="spinner-border text-danger d-none" role="status">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="{{ url('js/list.min.js') }}"></script>
<script>
    var options = {
        valueNames: [ 'name', 'email' ]
    };

    var userList = new List('users', options)
</script>
