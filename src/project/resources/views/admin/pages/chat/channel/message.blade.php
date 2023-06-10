@foreach($lists as $message)
    <!--begin::Message(in)-->
     @include('admin.pages.chat.channel.in-message', ['message' => $message, 'canDelete' => $canDelete])
     <!--end::Message(in)-->
@endforeach

