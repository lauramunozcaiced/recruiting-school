<div>
    @if (count($messages) > 0)
        @foreach ($messages as $message)
            <x-messages.messagesPreview :message="$message" :mode="$mode" />
        @endforeach
    @else
        <div class="text-center">
            <h5>Your {{ $mode }} folder is empty</h5>
            @if ($mode == 'inbox')
                <span>Personal messages received will be shown here.</span>
            @else
                <span>Personal messages sent will be shown here.</span>
            @endif
        </div>
    @endif
    
</div>
