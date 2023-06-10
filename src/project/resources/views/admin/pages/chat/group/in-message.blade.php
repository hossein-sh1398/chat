<div id="message-{{ $message->id }}" class="message-item">
    <div class="d-flex justify-content-start mb-10">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column align-items-start">
            <!--begin::User-->
            <div class="d-flex align-items-center mb-2">
                <!--begin::Avatar-->
                <div class="symbol symbol-35px symbol-circle">
                    <img alt="Pic" src="{{ url($message->user->avatar()) }}" />
                </div>
                <!--end::Avatar-->
                <!--begin::Details-->
                <div class="ms-3">
                    <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">{{ $message->user->name }}</a>
                    <span class="text-muted fs-7 mb-1 d-block">{{ $message->created_at }}</span>
                </div>
                <!--end::Details-->
                @if ($canDelete)
                    <div class="trash-message">
                        <span class="fa fa-trash"  title="حذف پیام" onclick="deleteMessage('{{ route('admin.chat.group.message.delete', $message->id) }}', {{ $message->toJson() }})"></span>
                    </div>
                @endif
            </div>
            <!--end::User-->
            <!--begin::Text-->
            <div>
                <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start box-chat-file" data-kt-element="message-text">
                    @if ($message->message)
                        {{ $message->message }}
                    @else
                        @if ($message->image)
                            <a href="#" class="btn-download" onclick="downloadChatFile(event, '{{ route('admin.chat.download', ['path' => $message->image->url . '/' . $message->image->name]) }}', '{{$message->image->name}}')"><span class="fas fa-download"></span></a>
                            <a data-fslightbox="lightbox-basic" href="{{ url($message->image->getUrl()) }}" class="d-block m-10px">
                                <img src="{{ url($message->image->getUrl()) }}" class="preview-image">
                            </a>
                        @elseif ($message->video)
                            <a href="#" class="btn-download" onclick="downloadChatFile(event, '{{ route('admin.chat.download', ['path' => $message->video->url . '/' . $message->video->name]) }}', '{{$message->video->name}}')"><span class="fas fa-download"></span></a>
                            <a data-fslightbox="lightbox-html5" class="video-play-link"  href="{{ url($message->video->getUrl()) }}">
                                <div class="btn-play-video">
                                    <span></span>
                                </div>
                                <!--begin::Icon-->
                                <video class="preview-image d-block m-10px" disabled="true">
                                    <source src="{{ url($message->video->getUrl()) }}" type="{{ $message->video->mimeType }}">
                                </video>
                                <!--end::Icon-->
                            </a>
                        @elseif ($message->audio)
                            <a href="#" class="btn-download" onclick="downloadChatFile(event, '{{ route('admin.chat.download', ['path' => $message->audio->url . '/' . $message->audio->name]) }}', '{{$message->audio->name}}')"><span class="fas fa-download"></span></a>
                            <audio class="d-block m-10px" controls>
                                <source src="{{ url($message->audio->getUrl()) }}" type="{{ $message->audio->mimeType }}">
                            </audio>
                        @elseif ($message->otherMedia)
                            <a href="#" class="btn-download" onclick="downloadChatFile(event, '{{ route('admin.chat.download', ['path' => $message->otherMedia->url . '/' . $message->otherMedia->name]) }}', '{{$message->otherMedia->name}}')"><span class="fas fa-download"></span></a>
                            <a class="d-block m-10px" onclick="downloadChatFile(event, '{{ route('admin.chat.download', ['path' => $message->otherMedia->url . '/' . $message->otherMedia->name]) }}', '{{$message->otherMedia->name}}')" href="#">{{ $message->otherMedia->name }}</a>
                        @endif
                    @endif
                </div>
            </div>
            <!--end::Text-->
        </div>
        <!--end::Wrapper-->
    </div>
</div>
<script src="{{url('cdn/theme/admin/plugins/custom/fslightbox/fslightbox.bundle.js')}}"></script>
