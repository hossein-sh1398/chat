<div class="tab-pane fade show active" id="setting-users" role="tabpanel">
    <div class="mt-10">
        <form action="{{ route('admin.chat.group.update', ['group' => $group->id]) }}" id="update-group-form" onsubmit="updateGroup(event, {{ $group->id }})" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row">
                <div class="mb-10 fv-row col-md-6">
                    <label class="form-label">نام کاربری</label>
                    <input autocomplete="off" value="{{ $group->username }}" type="text" dir="ltr" disabled="true" class="form-control mb-2"/>
                </div>
                <div class="mb-10 fv-row col-md-6">
                    <label class="required form-label">عنوان</label>
                    <input autocomplete="off" type="text" dir="rtl" value="{{ $group->title }}" id="setting_group_title" class="form-control mb-2"/>
                </div>
            </div>
            <div class="row text-center">
                <div class="mb-10 fv-row col-md-12 form-group-avatar">
                    <i class="fa fa-trash btn-remove-avatar-group" onclick="removeAvatarGroup('{{ url($group->getAvatar()) }}')"></i>
                    <!--begin::Image input-->
                    <input type="file" id="setting_group_file" class="d-none" accept=".png, .jpg, .jpeg"/>
                    <img onclick="document.getElementById('setting_group_file').click()" src="{{ url($group->getAvatar()) }}"  id="preview-avatar-group" alt="{{ $group->title }}">
                    <!--end::Image input-->
                    <!--begin::Hint-->
                    <div class="form-text">تصاویر قابل استفاده : png, jpg, jpeg</div>
                    <!--end::Hint-->
                </div>
            </div>
            <div class="row mt-5" id="users">
                <div class="col col-md-4">
                    <label class="required form-label">اعضا گروه/کانال</label>
                </div>
                <div class="col-md-12" id="userList">
                    <div class="row">
                        <div class="col col-md-4">
                            <input class="form-control form-control-sm search" name="search" type="text" id="search" placeholder="جستجو ...">
                        </div>
                    </div>
                    <div class="mt-10 table">
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
                            @foreach($users as $key => $user)
                                <div class="d-flex justify-content-between align-items-center mb-3" style="border-bottom: 1px solid #e3e0e0;padding:15px 0">
                                    <div class="w-25px">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input form-check-input-single widget-9-check w-15px h-15px" {{ in_array($user->id, $group->users->pluck('id')->toArray()) ? 'checked' : '' }} type="checkbox" value="{{ $user->id }}"/>
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
                <div class="col-md-12 text-left btn-box-update-group">
                    <button type="submit" class="btn-update-group btn btn-primary btn-block btn-hover-rise p-2 fs-8 mb-3 btn-sm btn-sm">
                        <i class="fa fa-save"></i>
                    </button>
                </div>
            </div>
            <div class="row mt-4">
                <div id="setting_errors">
                    <p class="alert alert-danger d-none"></p>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="tab-pane fade" id="manage-roles-group" role="tabpanel">
    <div class="mt-10">
        <div class="row mt-5">
                <div class="col col-md-4">
                    <label class="required form-label">اعضا گروه/کانال</label>
                </div>
                <div class="col-md-12" id="users-group-channel">
                    <div class="row">
                        <div class="col col-md-4">
                            <input class="form-control form-control-sm mx-3 search" name="search" type="text" id="search" placeholder="جستجو ...">
                        </div>
                    </div>
                    <div class="mt-10 table">
                        <div class="fw-bolder text-muted d-flex justify-content-between align-items-center">
                            <div class="min-w-150px cursor-default text-center"><strong>نام</strong></div>
                            <div class="min-w-200px cursor-default text-center"><strong>ایمیل</strong></div>
                            <div class="min-w-150px cursor-default text-center"><strong>دسترسی</strong></div>
                            <div class="min-w-150px cursor-default text-center"><strong>عملیات</strong></div>
                        </div>

                        <div class="list mt-5" style="height: 300px;overflow-y:scroll">
                            @foreach($groupUsers as $key => $user)
                                <div class="d-flex justify-content-between align-items-center mb-3" style="border-bottom: 1px solid #e3e0e0;padding:15px 0">
                                    <div class="name min-w-150px text-center">{{ $user->name }}</div>
                                    <div class="email min-w-200px text-center">{{ $user->email }}</div>
                                    <div class="name min-w-150px text-center">
                                        <span class="badge {{ $user->pivot->role == 1 ? 'badge-success' : 'badge-info'}}">
                                            {{ \App\Enums\GroupRole::getTitle($user->pivot->role) }}
                                        </span>
                                    </div>
                                    <div class="min-w-150px">
                                        <div class="d-flex justify-content-end align-center" style="gap:15px">
                                            <a href="#" onclick="removeUserFromGroup(event, '{{ route('admin.chat.remove.user.in.group', ['user' => $user->id, 'group' => $group->id]) }}', {{ $group->id }})" class="btn btn-danger btn-block btn-hover-rise p-2 fs-8 mb-3 btn-sm btn-sm"><i class="fa fa-trash"></i></a>
                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input h-20px w-30px" onchange="changeRoleInGroup(this, {{ $group->id }})" {{ $user->pivot->role == 1 ? "checked" : '' }} type="checkbox" value="{{ $user->id }}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
        </div>
        <div class="row mb-10">
            <div id="role_group_setting_errors">
                <p class="alert alert-danger d-none"></p>
            </div>
        </div>
    </div>
</div>
<script src="{{ url('js/list.min.js') }}"></script>
<script>
    var _options = {
        valueNames: [ 'name', 'email' ]
    };
    var user_List = new List('userList', _options)

    @if ($group->users->count())
        var userGroup = new List('users-group-channel', _options)
    @endif


    document.getElementById('setting_group_file').onchange = evt => {
        const [file] = document.getElementById('setting_group_file').files
        if (file) {
            document.getElementById('preview-avatar-group').src = URL.createObjectURL(file)
        }
    }
</script>
