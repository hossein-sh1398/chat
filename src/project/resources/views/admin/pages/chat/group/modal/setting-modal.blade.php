<div class="modal modal-lg fade" tabindex="-1" id="settings-groups-modal">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تنظیمات گروه</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#setting-users">کاربران</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#manage-roles-group">دسترسی</a>
                    </li>
                </ul>
                <div class="tab-content myTabContent-setting" id="myTabContent">
                    @include('admin.pages.chat.group.modal.setting-modal-content', ['users' => $users, 'group' => $group, 'groupUser' => $groupUsers])
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-ligth btn-block btn-hover-rise p-2 fs-8 mb-3 btn-sm btn-sm" data-bs-dismiss="modal"><i class="fa fa-close"></i></button>
            </div>
        </div>
    </div>
</div>

