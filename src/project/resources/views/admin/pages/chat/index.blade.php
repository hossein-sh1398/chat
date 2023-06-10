@extends('admin.theme.master')
@section('admin-toolbar')
    <button type="button" onclick="$('#create-groups-modal').modal('show')" class="btn btn-sm btn-success btn-block btn-hover-rise p-2 fs-8 mb-3">
        <span class="align-text-bottom mx-1">گروه/کانال</span>
        <i class="fas fa-plus fs-7"></i>
    </button>
@endsection
@section('admin-content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div class="card card-xl-stretch shadow-sm mb-5 mb-xl-8 ">
        <div class="card-body py-6">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 col-12 text-center">
                    <h4 class="mb-4">جایگاه نمایش تماس ویدیو</h4>
                    <div id="call-loading" class="spinner-border text-danger d-none" role="status">
                    </div>
                    <div class="peer-to-peer-video d-none video-call-preview mb-10">
                        <div id="remote-video" class="bg-gray-900"></div>
                        <div id="our-video" class="bg-gray-900"></div>
                        <div class="tools-video-peerjs">
                            <span id="btn-finish-call" onclick="closeCall(event)" class="btn btn-danger btn-sm btn-hover-rise p-2 fs-8 mb-3"><i class="fas fa-phone-slash"></i></span>
                            <div class="box-btn-share-screen d-none">
                                <span onclick="shareScreen(event)" class="btn btn-primary btn-sm btn-hover-rise p-2 fs-8 mb-3 d-none btn-share-screen"><i class="fas fa-desktop"></i></span>
                                <span onclick="stopScreenShare(event)" class="btn btn-danger btn-sm btn-hover-rise p-2 fs-8 mb-3 d-none btn-stop-share-screen">قطع اشتراک صفحه</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="p-0">
        <!--begin::Layout-->
        <div class="d-flex flex-column flex-lg-row">
            <!--begin::Sidebar-->
            <div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
                <!--begin::Contacts-->
                <div class="card card-flush" id="myTabContent">
                    <!--begin::Card header-->
                    <div class="card-header pt-7" id="kt_chat_contacts_header">

                        <!--begin::Form-->
                        <form class="w-100 position-relative" autocomplete="off">
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid px-15 search" name="search" value="" placeholder="جستجو با نام کاربری یا ایمیل..." />
                            <!--end::Input-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-5" id="kt_chat_contacts_body">

                        <!--begin::List-->
                        <div class="scroll-y me-n5 pe-5 h-200px h-lg-auto" id="users-list" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_contacts_header" data-kt-scroll-wrappers="#kt_content, #kt_chat_contacts_body" data-kt-scroll-offset="5px">

                        </div>
                        <!--end::List-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Contacts-->
            </div>
            <!--end::Sidebar-->
            <!--begin::Content-->
            <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                <!--begin::Messenger-->
                <div class="card" id="kt_chat_messenger">
                </div>
                <!--end::Messenger-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Layout-->
        @include('admin.pages.chat.group.modal.create-modal', ['groupTypes' => $groupTypes, 'userList' => $userList])
        <div id="modal-box"></div>
    </div>
    <!--end::Content container-->
</div>

<div class="modal fade" tabindex="-1" id="upload-file-chat-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">آپلود فایل</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-1"></span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div id="preview-file"></div>
                <div class="progress">
                    <div class="progress-bars"></div>
                </div>
                <div id="loaded_n_total" class="alert alert-info d-none"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-sm ml-5 btn-hover-rise p-2 fs-8 mb-3 btn-light" onclick="cancelUpload()"><i class="fa fa-cancel"></i></button>
                <button type="button" onclick="$('#form-send-chat-message').submit()" class="btn btn-success btn-sm ml-5 btn-hover-rise p-2 fs-8 mb-3"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
</div>
<!--end::Content-->
@stop
@push('admin-css')
    <link href="{{ url('cdn/theme/admin/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('cdn/theme/admin/css/chat.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('admin-js')
    @include('admin.theme.errors')
    <script src="{{ url('cdn/theme/admin/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{url('cdn/theme/admin/js/widgets.bundle.js')}}"></script>
    <script src="{{url('cdn/theme/admin/js/custom/widgets.js')}}"></script>
    <script src="{{url('cdn/theme/admin/js/custom/apps/chat/chat.js')}}"></script>
    <script src="{{url('cdn/theme/admin/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
    <script src="{{url('cdn/theme/admin/js/custom/utilities/modals/create-app.js')}}"></script>
    <script src="{{url('cdn/theme/admin/js/custom/utilities/modals/users-search.js')}}"></script>
    <script src="{{url('cdn/theme/admin/plugins/custom/fslightbox/fslightbox.bundle.js')}}"></script>
    <script src="{{ url('js/list.min.js') }}"></script>
    <script src="{{ url('js/peerjs.min.js') }}"></script>
    <script src="{{ url('js/app.js') }}"></script>
    <script>
        let page = 1;
        let isCalling = false;
        let isScroll = true;
        let localStream;
        let localShareStream;
        let msgHtml;
        let countUnReadNewMessage = 0;
        let peerId;
        let PeerList = [];
        let currentCall;
        let currentPeer;
        let isScrollTop = false;
        let oldScroll = 0;
        document.body.onbeforeunload= function () {
            return 'true';
        }

        Echo.private('seen-message-channel.{{auth()->id()}}')
        .listen('.ChatSeenMessageEvent', function() {
            $('.box-seen .fa.fa-check').removeClass('icon-unseen')
            $('.box-seen .fa.fa-check').addClass('icon-seen')
        });

        Echo.private('message-channel.' + "{{ auth()->id() }}")
        .listen('.PrivateChatMessage', function(data) {
            if (data.isSeen) {
                if (isScrollTop) {
                    $('.btn-new-message-incoming').removeClass('d-none')
                    $("#chat-messages-list").append(data.message)
                    countUnReadNewMessage++;
                    $('.btn-new-message-incoming span').text(countUnReadNewMessage)
                } else {
                    let objDiv = document.getElementById("chat-messages-list");
                    $("#chat-messages-list").append(data.message)
                    $("#chat-messages-list").scrollTop(document.getElementById("chat-messages-list").scrollHeight);
                }
            } else {
                if (data.countUnseen > 0) {
                    $('#un_read_count_message_' + data.user.id).removeClass('d-none')
                    $('#un_read_count_message_' + data.user.id).text(data.countUnseen)
                }
            }
        })
        .listen('ShareScreenEvent', function(data) {
            $('.box-btn-share-screen').removeClass('d-none')
            $('.btn-share-screen').removeClass('d-none')
        })
        .listen('StartShareScreenEvent', function(data) {
            $('.btn-share-screen').addClass('d-none')
        })
        .listen('StopShareScreenEvent', function(data) {
            $('.box-btn-share-screen').removeClass('d-none')
            $('.btn-share-screen').removeClass('d-none')
            $('.btn-stop-share-screen').addClass('d-none')
        });

        Echo.private('is-confirmed-call-channel.{{auth()->id()}}')
        .listen('AcceptCallEvent', function(data) {
            $('.video-call-preview').removeClass('d-none')
            $('#call-loading').addClass('d-none')

            if (!data.isVideoCall) {
                $('.peer-to-peer-video').css('height', '120px')
                $('#remote-video').css({
                    height: '110px',
                    right: '15px'
                })
            }

           getMessage($('#active-user-sidebar').val());
        });

        Echo.channel('online-user-channel')
        .listen('OnlineUserEvent', function(data) {
            if (data.isOnline) {
                $("#online-user-status-" + data.user.id).removeClass("d-none");
                $("#message-list-online-user-" + data.user.id).removeClass("d-none");
            } else {
                $("#online-user-status-" + data.user.id).addClass("d-none");
                $("#message-list-online-user-" + data.user.id).addClass("d-none");
            }
        });

        Echo.private('end-call-channel.{{auth()->id()}}')
        .listen('CloseVideoAudioCallEvent', (data) => {
            $('.peer-to-peer-video').css('height', '420px')
            $('#remote-video').css({
                height: '400px',
                right: '15px'
            })

            $('.video-call-preview').addClass('d-none')
            $('#call-loading').addClass('d-none')

            if (!currentCall) return;
            // Close the call, and reset the function
            try {
                currentCall.close();
            } catch {}
            currentCall = undefined;

            if (localStream) {
                localStream.getAudioTracks()[0].stop();
                localStream.getVideoTracks()[0].stop();
            }

            if (localShareStream) {
                localShareStream.getVideoTracks()[0].stop();
            }

            PeerList = [];
            peerId = ''
            if (!data.isAnswer) {
                toastr.error('مخاطب پاسخگو نمی باشد')
            }

            getMessage($('#active-user-sidebar').val());
        });


        @foreach($groupsIds as $id)
            Echo.private('channel-message.{{ $id }}.{{ auth()->id() }}')
            .listen('GroupMessageEvent', function(data) {
                let objDiv = document.getElementById("chat-messages-list");
                if (objDiv) {
                    $("#chat-messages-list").append(data.message)
                    $("#chat-messages-list").scrollTop(document.getElementById("chat-messages-list").scrollHeight);
                }
            });

            Echo.channel('delete-message-channel.{{ $id }}')
                .listen('DeleteMessageGroupEvent', function(data) {
                    $('#message-' + data.messageId).remove()
                });
        @endforeach

         function getSidebar() {
             $.ajax({
                url: "{{ route('admin.chat.users') }}",
                type:'post',
                success:(response) => {
                    if (response.status) {
                        $('#users-list').html(response.html);
                        if ($('#active-user-sidebar')) {
                            $('#user-' + $('#active-user-sidebar').val()).addClass('user-active');
                        }
                        if ($('#active-group-sidebar')) {
                            $('#group-' + $('#active-group-sidebar').val()).addClass('group-active');
                        }
                        if ($('#active-channel-sidebar')) {
                            $('#channel-' + $('#active-channel-sidebar').val()).addClass('channel-active');
                        }
                    }
                },
                error: err => {
                }
            });
        }

        getSidebar();

        function savePeerId(_peerId) {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.chat.store.peer.id') }}",
                data: {peerId:_peerId},
                dataType: "json",
                success: function (response) {}
            });
        }


        async function getPeerId(userId, _isVideo) {
            if (userId > 0) {
               await $.ajax({
                    type: "POST",
                    url: "{{ route('admin.chat.get.peer.id') }}",
                    data: {userId, _isVideo},
                    dataType: "json",
                    success: function (response) {
                        if (response.status) {
                            peerId = response.peerId;
                        }
                    },
                    error: err => {
                        peerId = 0;
                        toastr.error(err.message);
                    }
                });
            }
        }

        let peer = new Peer({
            host: "192.168.1.100",
            path: "/myapp",
            port:9003,
            key: "peerjs"
        });

        peer.on('open', _peerId => {
            savePeerId(_peerId);
            toastr.success('امکان تماس صوتی/تصویری برقرار می باشد');
        })

        function setIsCalling(users = {}) {
            $.ajax({
                url: "{{ route('admin.chat.set.is.calling') }}",
                type: "POST",
                data: users,
                success: function (response) {
                    if (response.status) {

                    }
                }
            });
        }

        async function startVideoCall() {
            let userId = $('#active-user-sidebar').val();

            await getPeerId(userId, true)

            if (peerId) {
                $('#call-loading').removeClass('d-none')
                callPeer(peerId);
            }
        }

        async function startVoiceCall(e) {
            $('.box-btn-share-screen').addClass('d-none')
            $('.btn-share-screen').addClass('d-none')
            $('.btn-stop-share-screen').addClass('d-none')

            let userId = $('#active-user-sidebar').val();

            await getPeerId(userId, false)

            if (peerId) {
                $('#call-loading').removeClass('d-none')
                callPeer(peerId, false);
            }
        }

        function shareScreen(e) {
            navigator.mediaDevices.getDisplayMedia({
                video: {
                    cursor: 'always'
                },
                audio: {
                    echoCancellation: true,
                    noiseSuppression: true
                }
            })
            .then(async stream => {
                $('.btn-stop-share-screen').removeClass('d-none')
                $('.btn-share-screen').addClass('d-none')
                localShareStream = stream;
                await $.ajax({
                    url: "{{ route('admin.chat.share.screen.start')}}?userId=" + $('#active-user-sidebar').val(),
                    type:'get'
                });
                let videoTrack = stream.getVideoTracks()[0];
                videoTrack.onended = () => {
                    stopScreenShare()
                }
                let sender = currentPeer.getSenders().find(s => {
                    return s.track.kind == videoTrack.kind
                })
                sender.replaceTrack(videoTrack)
            })
            .catch(err => {
                toastr.error('unable to get display media ' + err)
            })
        }

        function callPeer(id, isVideo = true) {
            navigator.mediaDevices.getUserMedia({video: isVideo, audio:true})
                .then(stream => {
                    addOurVideo(stream);
                    localStream = stream
                    let call = peer.call(id, stream)
                    call.on('stream', remoteStream => {
                        if (!PeerList.includes(call.peer )) {
                            addRemoteVideo(remoteStream)
                            currentPeer = call.peerConnection
                            PeerList.push(call.peer);
                        }
                    })
                    call.on("error", (err) => {
                        closeCall()
                    });
                    call.on('close', () => {
                        closeCall()
                    })

                    currentCall = call;
                }).catch(err => {
                    toastr.error(err + ' unable to get media');
                })
        }

        Echo.private('call-video-channel.' + "{{ auth()->id() }}")
        .listen('VideoAudioCallEvent', (data) => {

            setTimeout(() => {
                if (isCalling == false) {
                    $('.swal2-container.swal2-rtl.swal2-center.swal2-backdrop-show').remove()

                    $.ajax({
                        url: "{{ route('admin.chat.end.call') }}" + '?user='+ data.user.id + '&isAnswer=false',
                        type:'get'
                    });
                }
            }, 10000)
            peer.on('call', (call) => {
                Swal.fire({
                    title: `<strong>${data.user.name}</strong>`,
                    html:`<div class="call-user-avatar"><img src="${data.avatarUrl}" alt="user avatar"/></div>
                    <div><p>${data.user.email}</p></div>`,
                    showCancelButton: true,
                    confirmButtonText: `<i class="fa fa-phone"></i>`,
                    cancelButtonText: `<i class="fa fa-phone-slash"></i>`,
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        isCalling = true;
                        await setIsCalling({from: {{ auth()->id() }}, to: data.user.id, value:true});

                        await $.ajax({
                            url: "{{ route('admin.chat.confirmed.call') }}",
                            type:'post',
                            data: {isVideoCall: data.isVideo, userId: data.user.id}
                        });


                        await getMessage(data.user.id);

                        $('.video-call-preview').removeClass('d-none')
                        if (data.isVideo) {
                            $('.box-btn-share-screen').removeClass('d-none')
                            $('.btn-share-screen').removeClass('d-none')

                            $.ajax({
                                url: "{{ route('admin.chat.show.btn.share.screen')}}?userId=" + data.user.id,
                                type:'get'
                            });

                        } else {
                            $('.peer-to-peer-video').css('height', '120px')
                            $('#remote-video').css({
                                height: '110px',
                                right: '15px'
                            })

                            $('.box-btn-share-screen').addClass('d-none')
                            $('.btn-share-screen').addClass('d-none')
                            $('.btn-stop-share-screen').addClass('d-none')
                        }

                        navigator.mediaDevices.getUserMedia({video: data.isVideo, audio: true})
                            .then( stream => {
                                addOurVideo(stream);
                                localStream = stream;
                                call.answer(stream)
                                currentCall = call;
                                call.on('stream', remoteStream => {
                                    if (!PeerList.includes(call.peer )) {
                                        addRemoteVideo(remoteStream)
                                        currentPeer = call.peerConnection
                                        PeerList.push(call.peer);
                                    }
                                })
                                call.on('close', () => {
                                    closeCall()
                                })
                            }).catch(err => {
                                toastr.error(err + ' unable to get media');
                            })
                    } else {
                        $.ajax({
                            url: "{{ route('admin.chat.end.call') }}" + '?user='+ data.user.id + '&isAnswer=false',
                            type:'get'
                        });
                    }
                })
            })
        });

        function addRemoteVideo(stream) {
            let video = document.createElement("video");
            video.srcObject = stream;
            video.setAttribute('autoplay', true);
            video.setAttribute('controls', "");
            video.play()
            $('#remote-video').html(video)
        }

        function addOurVideo(stream) {
            let video = document.createElement("video");
            video.srcObject = stream;
            video.setAttribute('controls', "");
            video.setAttribute('autoplay', true);
            video.play()
            $('#our-video').html(video)
            $('#our-video video').prop('muted', true)
        }

        function stopScreenShare() {
            if (localShareStream) {
                localShareStream.getVideoTracks()[0].stop();
            }
            let videoTrack = localStream.getVideoTracks()[0]
            var sender = currentPeer.getSenders().find(s => {
                return s.track.kind == videoTrack.kind
            })
            sender.replaceTrack(videoTrack)

            $('.btn-share-screen').removeClass('d-none')
            $('.btn-stop-share-screen').addClass('d-none')
            $.ajax({
                url: "{{ route('admin.chat.share.screen.stop')}}?userId=" + $('#active-user-sidebar').val(),
                type:'get'
            });
        }

        async function closeCall() {
            try {
                $('.peer-to-peer-video').css('height', '420px')
                $('#remote-video').css({
                    height: '400px',
                    right: '15px'
                })

                $('.video-call-preview').addClass('d-none')

                currentCall.close();
                currentCall = undefined;
                localStream.getAudioTracks()[0].stop();
                if (localShareStream) {
                    localShareStream.getVideoTracks()[0].stop();
                }

                localStream.getVideoTracks()[0].stop();
            } catch {
            }

            PeerList = [];
            peerId = ''
            isCalling = false;

            await setIsCalling({from: {{ auth()->id() }}, to: $('#active-user-sidebar').val(), value: false});

            await $.ajax({
                url: "{{ route('admin.chat.end.call') }}" + '?user='+ $('#active-user-sidebar').val() + '&isAnswer=true',
                type:'get'
            });


            await getMessage($('#active-user-sidebar').val());
        }


        function messages(e, url, userId, page) {
            if (e) {
                e.preventDefault()
            }

            if (!isScroll) {
                return ;
            }

            $('.auto-load').show();
             $.ajax({
                url:url+"?page=" + page,
                datatype: "html",
                type:'get',
                success: response => {
                    $('.auto-load').hide();
                    if (response.html == '') {
                        isScroll = false;
                        return;
                    }
                    let el = document.getElementById('chat-messages-list');
                    if (page == 1) {
                        $('#kt_chat_messenger').empty()
                        $('#kt_chat_messenger').append(response.html);
                        $("#chat-messages-list").scrollTop(document.getElementById("chat-messages-list").scrollHeight);
                    } else {
                        let old_height = el.scrollHeight;
                        $('#chat-messages-list').prepend(response.html);
                        let new_height = el.scrollHeight;
                        el.scrollTop = new_height - old_height
                    }

                    $('.user-item').removeClass('user-active')
                    $('.group-item').removeClass('group-active')
                    $('.channel-item').removeClass('channel-active')
                    $('#user-' + userId).addClass('user-active');
                    $('#un_read_count_message_'+ userId).addClass('d-none')
                }
            })
        }

        function getGroupMessage(e, url, groupId, page) {
            e.preventDefault();
            if (!isScroll) {
                return ;
            }
            $('.auto-load').show();
            $.ajax({
                url:url+"?page=" + page,
                datatype: "html",
                type:'get',
                success: response => {
                    let el = document.getElementById('chat-messages-list');
                    $('.auto-load').hide();

                    if (response.html == '') {
                        isScroll = false;
                        return;
                    }

                    if (page == 1) {
                        $('#kt_chat_messenger').empty()
                        $('#kt_chat_messenger').append(response.html);
                        $("#chat-messages-list").scrollTop(document.getElementById("chat-messages-list").scrollHeight);
                    } else {
                        let old_height = el.scrollHeight;
                        $('#chat-messages-list').prepend(response.html);
                        let new_height = el.scrollHeight;
                        el.scrollTop = new_height - old_height
                    }

                    $('.group-item').removeClass('group-active')
                    $('.user-item').removeClass('user-active')
                    $('.channel-item').removeClass('channel-active')
                    $('#group-' + groupId).addClass('group-active');
                }
            })
        }

        function getChannelMessage(e, url, channelId, page) {
            e.preventDefault();

            if (!isScroll) {
                return ;
            }

            $('.auto-load').show();

            $.ajax({
                url:url+"?page=" + page,
                datatype: "html",
                type:'get',
                success: response => {
                    let el = document.getElementById('chat-messages-list');
                    $('.auto-load').hide();

                    if (response.html == '') {
                        isScroll = false;
                        return;
                    }

                    if (page == 1) {
                        $('#kt_chat_messenger').empty()
                        $('#kt_chat_messenger').append(response.html);
                        $("#chat-messages-list").scrollTop(document.getElementById("chat-messages-list").scrollHeight);
                    } else {
                        let old_height = el.scrollHeight;
                        $('#chat-messages-list').prepend(response.html);
                        let new_height = el.scrollHeight;
                        el.scrollTop = new_height - old_height
                    }

                    $('.channel-item').removeClass('channel-active')
                    $('.user-item').removeClass('user-active')
                    $('.group-item').removeClass('group-active')
                    $('#channel-' + channelId).addClass('channel-active');
                }
            })
        }

        function getMessage(_modelId) {
            let _url = "{{ route('admin.chat.messages', ['user'=> 'UI']) }}";
            _url = _url.replace('UI', _modelId)
            page = 1;
            isScroll = true;
            messages(event, _url, _modelId, page)
        }

        function getGroupMessageOnSidebar(_e, _url, _modelId) {
            page = 1;
            isScroll = true;
            getGroupMessage(_e, _url, _modelId, page)
        }

        function getChannelMessageOnSidebar(_e, _url, _modelId) {
            page = 1;
            isScroll = true;
            getChannelMessage(_e, _url, _modelId, page)
        }

        function makeGroup(e) {
            e.preventDefault();
            $("#errors p").addClass('d-none');

            $('#create-groups-modal .modal-footer button[type="submit"]').addClass('d-none')
            $('#create-groups-modal .modal-footer .spinner-border.text-danger').removeClass('d-none')

            let fd = new FormData();
            let files = $('#group_file')[0].files;
            if (files[0]) {
                let size = Math.floor(files[0].size / 1024)
                // 5120kb = 5MB
                if (size > 5120) {
                    toastr.error('فایل انتخاب شده  نباید بیشتر از 5 مگابایت باشد');
                    return false;
                }
                fd.append('photo', files[0])
            }
            fd.append('username', $('#group_username').val())
            fd.append('title', $('#group_title').val())

            let users = []

            const selectAll = $('#create-groups-modal .form-check-input-all');
            const checks = $('#create-groups-modal .form-check-input-single');

            if (selectAll.checked) {
                for (const check of checks) {
                    users = [...users, check.value];
                }
            } else {
                for (const check of checks) {
                    if (check.checked) {
                        users = [...users, check.value];
                    }
                }
            }

            for (let i = 0; i < users.length; i++) {
                fd.append('users[]', users[i])
            }

            fd.append('type', $('#group_type').val())

            $.ajax({
                url: $('#form-create-group').prop('action'),
                data: fd,
                type:'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    $('#create-groups-modal .modal-footer button[type="submit"]').removeClass('d-none')
                    $('#create-groups-modal .modal-footer .spinner-border.text-danger').addClass('d-none')
                    if(files[0]) {
                        let $el = $('#group_file');
                        $el.wrap('<form>').closest('form').get(0).reset();
                        $el.unwrap();
                    }
                    $('#group_username').val('')
                    $('#group_title').val('')
                    $('#create-groups-modal .form-check-input-all').prop('checked', false);
                    $('#create-groups-modal .form-check-input-single').prop('checked', false);
                    $('#create-groups-modal #search').val('')
                    $('#create-groups-modal').modal('hide')
                    getSidebar()
                },
                error:function (er) {
                    $('#create-groups-modal .modal-footer button[type="submit"]').removeClass('d-none')
                    $('#create-groups-modal .modal-footer .spinner-border.text-danger').addClass('d-none')

                    let errors = er.responseJSON.errors;
                    let str = '';
                    for (const key in  errors) {
                        if (Object.hasOwnProperty.call(errors, key)) {
                            str+= errors[key][0] + "<br/>";
                        }
                    }
                    $("#errors p").removeClass('d-none');
                    $("#errors p").html(str);
                }

            })
        }

        function updateGroup(e, modelId) {
            e.preventDefault();
            $("#setting_errors p").addClass('d-none');

            let fd = new FormData();
            let files = $('#setting_group_file')[0].files;
            let $el = $('#file-input');

            if (files[0]) {
                let size = Math.floor(files[0].size / 1024)
                // 5120kb = 5MB
                if (size > 5120) {
                    toastr.error('فایل انتخاب شده  نباید بیشتر از 5 مگابایت باشد');
                    return false;
                }
                fd.append('photo', files[0])
            }

            fd.append('_method', 'patch')
            fd.append('title', $('#setting_group_title').val())
            let users = []

            const selectAll = $('#settings-groups-modal .form-check-input-all');
            const checks = $('#settings-groups-modal .form-check-input-single');

            if (selectAll.checked) {
                for (const check of checks) {
                    users = [...users, check.value];
                }
            } else {
                for (const check of checks) {
                    if (check.checked) {
                        users = [...users, check.value];
                    }
                }
            }
            for (let i = 0; i < users.length; i++) {
                fd.append('users[]', users[i])
            }

            $.ajax({
                url: $('#update-group-form').prop('action'),
                data: fd,
                type:'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    showModalSettingGroup(modelId);
                    getSidebar()
                },
                error:function (er) {
                    let errors = er.responseJSON.errors;
                    let str = '';
                    for (const key in  errors) {
                        if (Object.hasOwnProperty.call(errors, key)) {
                            str+= errors[key][0] + "<br/>";
                        }
                    }
                    $("#setting_errors p").removeClass('d-none');
                    $("#setting_errors p").html(str);
                }
            })
        }

        function removeUserFromGroup(event, url, groupId) {
            event.preventDefault()
            Swal.fire({
                title: "آیا مایل به حذف هستید؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type:'get',
                        success: res => {
                            toastr.success(res.message)
                            showModalSettingGroup(groupId);
                        }
                    });
                }
            });
        }

        function showModalSettingGroup(groupId) {
            $('#myTabContent.myTabContent-setting').empty()
            $.ajax({
                url: "{{ route('admin.chat.group.modal.info.setting') }}",
                type:'post',
                data: {groupId},
                success: res => {
                    if (res.status) {
                        $('#myTabContent.myTabContent-setting').html(res.html)
                    }

                }
            });
        }

        function changeRoleInGroup(_this, groupId) {
            $.ajax({
                url: "{{ route('admin.chat.group.toggle.role') }}",
                type:'post',
                data: {
                    userId: _this.value, groupId: groupId, isAdmin: _this.checked
                },
                success: res => {
                    showModalSettingGroup(groupId);
                }
            });
        }


        function deleteMessage(_url, message) {
            $.ajax({
                type: "POST",
                url: _url,
                dataType: "json",
                data:{
                    _method:'DELETE'
                },
                success: function (response) {
                    if (response.status) {}
                }
            });
        }

        function loadFile(e, _type) {
            $('#upload-file-chat-modal').modal('show')
            $('#preview-file').empty();

            let fuUpload = document.getElementById("file-input");
            let type = fuUpload.files[0].type;

            let html;
            if (type.includes('image/')) {
                html = '<img src="' +URL.createObjectURL(event.target.files[0])+ '">';
            } else if (type.includes('video/')) {
                html = '<video controls>'+
                        '<source src="' + URL.createObjectURL(event.target.files[0]) +'" type="video/mp4">'+
                    '</video>'
            } else if (type.includes('audio/')) {
                html = '<audio controls>'+
                        '<source src="' + URL.createObjectURL(event.target.files[0]) +'" type="'+type+'">'+
                    '</audio>';
            } else {
                html = `<a target="_blank" href="${ URL.createObjectURL(event.target.files[0])}">${fuUpload.files[0].name}</a>`;
            }

            $('#preview-file').append(html);
        }

        function cancelUpload() {
            $('#preview-file').empty();
            let $el = $('#file-input');
            $el.wrap('<form>').closest('form').get(0).reset();
            $el.unwrap();
            $(".progress-bars").width('0%');
            document.getElementById("loaded_n_total").innerHTML = ''
            $('#loaded_n_total').addClass('d-none')
            try {
                $('#upload-file-chat-modal').modal('hide')
            } catch(err) {

            }
        }

        function downloadChatFile(e, _url, name) {
            e.preventDefault();
            var data = '';
            $.ajax({
                type: "POST",
                url: _url,
                data: data,
                xhrFields: {
                    responseType: 'blob'
                },
                success (response) {
                    var blob = new Blob([response]);
                    const link = document.createElement('a');
                    link.setAttribute('href', window.URL.createObjectURL(blob));
                    link.setAttribute('download', name);
                    link.click();
                },
                error (err) {
                    toastr.error('به دلیل خالی بودن فولدر مورد نظر امکان دانلود ممکن نمی باشد');
                }
            });
        }

        let isSendMessage;
        $(document).on('submit', '#form-send-chat-message',  function(event) {
            event.preventDefault();

            if (isSendMessage) return true;

            let fuUpload = document.getElementById("file-input");
            let message = $('#chat-message-input').val();

            if (fuUpload.files[0]) {
                isSendMessage = true;
                let fd = new FormData();
                let size = Math.floor(fuUpload.files[0].size / 1024) // convert byte to kilobyte
                // 5120kb = 5MB
                if (size > 5120) {
                    toastr.error('فایل انتخاب شده  نباید بیشتر از 5 مگابایت باشد');
                    return false;
                }
                fd.append('type', fuUpload.files[0].type);
                fd.append('file', fuUpload.files[0]);
                $('#loaded_n_total').removeClass('d-none')

                $('#upload-file-chat-modal .modal-footer button').addClass('d-none')

                $.ajax({
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = Math.floor(((evt.loaded / evt.total) * 100));
                                $(".progress-bars").width(percentComplete + '%');
                                $(".progress-bars").html(percentComplete+'%');
                                document.getElementById("loaded_n_total").innerHTML = Math.floor(evt.loaded / 1024) + " کیلوبایت از " + Math.floor(evt.total / 1024) + " کیلو بایت آپلود گردیده است";
                            }
                        }, false);
                        return xhr;
                    },
                    url:$(this).attr('action'),
                    type:'POST',
                    contentType: false,
                    processData: false,
                    data: fd,
                    beforeSend: function(){
                        $(".progress-bar").width('0%');
                    },
                    success:(response) => {
                        if (response.status) {
                            isSendMessage = false;
                            $('#preview-file').empty();

                            let $el = $('#file-input');
                            $el.wrap('<form>').closest('form').get(0).reset();
                            $el.unwrap();

                            $(".progress-bars").width('0%');
                            document.getElementById("loaded_n_total").innerHTML = ''
                            $('#loaded_n_total').addClass('d-none')

                            $('#upload-file-chat-modal .modal-footer button').removeClass('d-none')

                            $('#upload-file-chat-modal').modal('hide')

                            $('#chat-messages-list').append(response.message)
                            let objDiv = document.getElementById("chat-messages-list");
                            objDiv.scrollTop = objDiv.scrollHeight;


                            readNewMessage()
                        }
                    },
                    error: err => {
                        toastr.error('خطایی پیش آمده');
                    }
                });
            } else if (message) {
                $('#chat-message-input').val('')
                $('.spinner-border.text-danger').removeClass('d-none')
                $('.form-btn-send-message').addClass('d-none')
                isSendMessage = true;
                 $.ajax({
                    url:$(this).attr('action'),
                    type:'POST',
                    data: {message},
                    success:(response) => {
                        if (response.status) {
                            isSendMessage = false;

                            $('#chat-messages-list').append(response.message)
                            let objDiv = document.getElementById("chat-messages-list");
                            objDiv.scrollTop = objDiv.scrollHeight;
                            $('#chat-message-input').val('')

                            $('.spinner-border.text-danger').addClass('d-none')
                            $('.form-btn-send-message').removeClass('d-none')

                            readNewMessage()
                        }
                    },
                    error: err => {
                        $('#chat-message-input').val(message)
                        toastr.error('خطایی پیش آمده');
                    }
                });
            }
        })


        $(document).on('keyup', '#chat-message-input', function(event) {
            if (event.keyCode == 13 && !event.shiftKey) {
                $('#form-send-chat-message').submit()
            }
        })

        function isTypeing() {
            let userid = $('#active-user-sidebar').val();

            let channel = Echo.join('chat')
            setTimeout( () => {
                channel.whisper('typing', {
                    user: {{ auth()->id() }},
                    to: userid,
                    typing: true
                })
            }, 300)
        }

        Echo.join('chat')
        .listenForWhisper('typing', (e) => {
            if (e.user == $('#active-user-sidebar').val() && e.to == {{ auth()->id() }}) {

                e.typing ? $('.is-typing-icon').removeClass('d-none') : $('.is-typing-icon').addClass('d-none')
                setTimeout( () => {
                    $('.is-typing-icon').addClass('d-none')
                }, 1000)
            }
        })

       function readNewMessage () {
            countUnReadNewMessage = 0;
            isScrollTop = false;
            $("#chat-messages-list").scrollTop(document.getElementById("chat-messages-list").scrollHeight);
            $('.btn-new-message-incoming').addClass('d-none')
        }

        async function scrollChatMessageBox(e, _url, userId) {
            let newScroll = $("#chat-messages-list").scrollTop();
            if (newScroll < oldScroll ) {
                isScrollTop = true;
            }

            oldScroll = newScroll;

            var el = document.getElementById('chat-messages-list');

            let scrollTop = el.scrollTop;
            let scrollHeight = el.scrollHeight;
            let offsetHeight = el.offsetHeight;
            let contentHeight = scrollHeight - offsetHeight;
            if (contentHeight <= scrollTop) {
                readNewMessage()
            }

            if (el.scrollTop == 0 && isScroll) {
                page++;
                messages(e, _url, userId, page)
            }
        }

        function scrollGroupMessageBox(e, _url, groupId) {
            var el = document.getElementById('chat-messages-list');
            if (el.scrollTop == 0 && isScroll) {
                page++
                getGroupMessage(e, _url, groupId, page)
            }
        }

        function scrollChannelMessageBox(e, _url, channleId) {
            var el = document.getElementById('chat-messages-list');
            if (el.scrollTop == 0 && isScroll) {
                page++
                getChannelMessage(e, _url, channleId, page)
            }
        }

        document.addEventListener('visibilitychange', () => {
            if (document.visibilityState === 'hidden') {
                navigator.sendBeacon("{{ route('admin.chat.users.offline')}}");
            }
            if (document.visibilityState === 'visible') {
                navigator.sendBeacon("{{ route('admin.chat.users.online')}}");
            }
        });

        document.body.onload = function () {
            navigator.sendBeacon("{{ route('admin.chat.users.online')}}");

        }

        // Manage group avatar
        function removeAvatarGroup(currentAvatar) {
            let imgInp2 = document.getElementById('setting_group_file');

            const [file] = imgInp2.files
            if (!file) {
                toastr.error('فایلی انتخاب نشده است')
                return
            }

            let $el = $('#setting_group_file');
            $el.wrap('<form>').closest('form').get(0).reset();
            $el.unwrap();

            document.getElementById('preview-avatar-group').src = currentAvatar;
        }

    </script>
@endpush
