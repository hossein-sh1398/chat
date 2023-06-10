<ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_4">کاربران</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_5">گروه</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_6">کانال</a>
    </li>
</ul>
<div class="tab-content" >
    <div class="tab-pane fade show active list" id="kt_tab_pane_4" role="tabpanel">
        @foreach ($users as $user)
            <!--begin::User-->
            <div class="d-flex flex-stack py-4 user-item" id="user-{{ $user->id }}">
                <!--begin::Details-->
                <div class="d-flex align-items-center">
                    <!--begin::Avatar-->
                    <div class="symbol symbol-45px symbol-circle" id="user-avatar-{{ $user->id }}">
                        <img src="{{ url($user->avatar()) }}" alt="{{ $user->name }}">
                        <div id="online-user-status-{{ $user->id }}" class="symbol-badge bg-success start-100 top-100 border-4 h-15px w-15px ms-n2 mt-n2 {{ $user->chatStatus && $user->chatStatus->is_online ? '' : 'd-none'}}"></div>
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Details-->
                    <div class="ms-5">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2 user-name-tag name" onclick="getMessage({{ $user->id }})">{{ $user->name }}</a>
                        <div class=" fw-semibold text-muted user-item-email email">{{ $user->email }}</div>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Details-->
                <!--begin::Lat seen-->
                <div class="d-flex flex-column align-items-end ms-2">
                    <span class="text-muted fs-7 mb-1">{{ $user->last_login }}</span>
                    <span class="badge badge-sm badge-circle badge-success {{ $user->un_read_count ? '' : 'd-none' }}" id="un_read_count_message_{{ $user->id }}">{{ $user->un_read_count }}</span>
                </div>
                <!--end::Lat seen-->
            </div>
            <!--end::User-->
            <!--begin::Separator-->
            <div class="separator separator-dashed d-none"></div>
            <!--end::Separator-->
        @endforeach
    </div>
    <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
        @foreach ($groups as $group)
            <!--begin::User-->
            <div class="d-flex flex-stack py-4 group-item" id="group-{{ $group->id }}">
                <!--begin::Details-->
                <div class="d-flex align-items-center">
                    <!--begin::Avatar-->
                    <div class="symbol symbol-45px symbol-circle" id="group-avatar-{{ $group->id }}">
                        <img src="{{ url($group->getAvatar()) }}" alt="{{ $group->title }}">
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Details-->
                    <div class="ms-5">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2"
                            onclick="getGroupMessageOnSidebar(event, '{{ route('admin.chat.group.messages', ['group'=> $group->id]) }}', {{ $group->id }})">
                            {{ $group->title }} <span class="badge badge-primary {{ $group->type == 3 ? '' : 'd-none' }}">{{ $group->type == 3 ? 'میتینگ' : '' }}</span>
                        </a>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Details-->
                <!--begin::Lat seen-->
                <div class="d-flex flex-column align-items-end ms-2">
                    <span class="text-muted fs-7 mb-1">{{ $group->updated_at }}</span>
                </div>
                <!--end::Lat seen-->
            </div>
            <!--end::User-->
            <!--begin::Separator-->
            <div class="separator separator-dashed d-none"></div>
            <!--end::Separator-->
        @endforeach
    </div>
    <div class="tab-pane fade" id="kt_tab_pane_6" role="tabpanel">
        @foreach ($channels as $channel)
            <!--begin::User-->
            <div class="d-flex flex-stack py-4 channel-item" id="channel-{{ $channel->id }}">
                <!--begin::Details-->
                <div class="d-flex align-items-center">
                    <!--begin::Avatar-->
                    <div class="symbol symbol-45px symbol-circle" id="channel-avatar-{{ $channel->id }}">
                        <img src="{{ url($channel->getAvatar()) }}" alt="{{ $channel->title }}">
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Details-->
                    <div class="ms-5">
                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2" onclick="getChannelMessageOnSidebar(event, '{{ route('admin.chat.group.messages', ['group'=> $channel->id]) }}', {{ $channel->id }})">{{ $channel->title }}</a>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Details-->
                <!--begin::Lat seen-->
                <div class="d-flex flex-column align-items-end ms-2">
                    <span class="text-muted fs-7 mb-1">{{ $channel->updated_at }}</span>
                </div>
                <!--end::Lat seen-->
            </div>
            <!--end::User-->
            <!--begin::Separator-->
            <div class="separator separator-dashed d-none"></div>
            <!--end::Separator-->
        @endforeach
    </div>
</div>
<script>
    var options = {
        valueNames: [ 'name', 'email' ]
    };

    var userList = new List('myTabContent', options)
</script>
