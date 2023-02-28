<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModal">New
        Message</button>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <x-messages.create :users="$users" :mode="$mode" />
                </div>
            </div>
        </div>
    </div>

    <div class="messagesFolder pt-4">
        <a @if ($mode == 'inbox') class="messageSelected" @endif
            href="{{ route('messages.index', 'inbox') }}">
            <i class="ri-mail-line" style="margin-right: 15px;"></i>
            Inbox
        </a>
        <a @if ($mode == 'sent') class="messageSelected" @endif
            href="{{ route('messages.index', 'sent') }}">
            <i class="ri-mail-send-line" style="margin-right: 15px;"></i>
            Sent
        </a>
    </div>
</div>
