@extends('layouts.admin')

@section('content')
    <script>
        window.location.href = "{{ route('admin.settings.edit') }}";
    </script>
@endsection
