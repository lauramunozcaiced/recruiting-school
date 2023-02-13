@if (count($positions) > 0)
    @foreach ($positions as $position)
        @if (Auth::user()->role != 'administrator' && Auth::user()->role != 'data entry')
            @if ($position->visible == 'active')
                <x-positions.card :position="$position" :customers="$customers" />
            @endif
        @else
            <x-positions.list :position="$position" :customers="$customers" />
        @endif
    @endforeach
@else
    <p>Nothing to show</p>
@endif
