<p class="text-muted">
    {{-- Added {{ $post->created_at->diffForHumans() }} --}}
    {{-- by {{ $post->user->name }} --}}
    {{-- {{ empty(trim($slot) ? 'Added': $slot) }} {{ $date->diffForHumans() }} --}}
    @if(isset($name))
    by   {{ $name }}
    @endif
</p>