<x-master-layout>

    @section('sidebar')
        @include('admin.layouts.include.sidebar')
    @endsection


    {{ $slot }}


</x-master-layout>
