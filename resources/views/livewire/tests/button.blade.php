@extends('atlas::livewire.story')

@section('content')
    @fragment('code')
<button
    type="button"
    @class([
        'rounded bg-indigo-600 px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' => $size === 'xs',
        'rounded bg-indigo-600 px-2 py-1 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' => $size === 'sm'
    ])>
    {{ $text }}
</button>
    @endfragment
@endsection
