@extends('atlas::livewire.story')

@section('content')
    @fragment('code')
        <div>
            <span class="isolate inline-flex rounded-md shadow-sm">
              <button type="button" class="relative inline-flex items-center rounded-l-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">Years</button>
                @if($middle)
                    <button type="button" class="relative -ml-px inline-flex items-center bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">Months</button>
                @endif
              <button type="button" class="relative -ml-px inline-flex items-center rounded-r-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">Days</button>
            </span>
        </div>
    @endfragment
@endsection
