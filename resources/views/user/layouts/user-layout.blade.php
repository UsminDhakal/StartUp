<x-master-layout>
    @section('sidebar')
        @include('user.layouts.sidebar')
    @endsection

    {{ $slot }}


</x-master-layout>
