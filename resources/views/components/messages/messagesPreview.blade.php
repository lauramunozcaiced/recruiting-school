<div>
    <a href="{{ route('messages.show', $message) }}">
        @php
        ($mode == 'inbox')? $person = $message->senderUser : $person = $message->receiverUser;
        @endphp
        <div class="messagesPreview d-flex align-items-center justify-content-between">
            <div class="image__profile d-flex align-items-center ">
                <div class="userImage"
                    @if ($person->logo != null) style="background-image: url('{{ asset($person->logo) }}');" 
                    @else style="background-image: url('{{ asset('/images/default-user-image.jpg') }}');" @endif>
                </div>
                <h6 style="margin-left: 15px" class="messagesPreview-person">
                    @if ($mode == 'sent')
                        To:
                    @endif{{ $person->name }}
                </h6>
                <p class="messagesPreview-subject">{{ $message->subject }}</p>
            </div>
            <div class="messagesPreview-date">
                @if (date("F j, Y") == date_format($message->created_at,"F j, Y"))
                    {{ date_format($message->created_at,"g:i a") }}
                @else 
                    @if (date("Y") == date_format($message->created_at,"Y"))
                        {{ date_format($message->created_at,"F j") }}
                    @else
                        {{ date_format($message->created_at,"Y-m-d") }}
                    @endif
                @endif
                
            </div>
        </div>
    </a>
</div>
