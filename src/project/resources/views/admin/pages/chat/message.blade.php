@foreach($lists as $message)
    @if ($message->from_id == auth()->id())
        <!--begin::Message(in)-->
        @include('admin.pages.chat.in-message', ['message' => $message])
        <!--end::Message(in)-->
    @else
    <!--begin::Message(out)-->
        @include('admin.pages.chat.out-message', ['message' => $message])
        <!--end::Message(out)-->
    @endif
@endforeach

