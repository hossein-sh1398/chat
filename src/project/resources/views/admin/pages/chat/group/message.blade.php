@foreach($lists as $message)
    @if ($message->from_id == auth()->id())
        <!--begin::Message(in)-->
        @include('admin.pages.chat.group.in-message', ['message' => $message, 'canDelete' => $canDelete])
        <!--end::Message(in)-->
    @else
        <!--begin::Message(out)-->
        @include('admin.pages.chat.group.out-message', ['message' => $message, 'canDelete' => $canDelete])
        <!--end::Message(out)-->
    @endif
@endforeach

