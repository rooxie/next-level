@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <h1 class="text-center mb-4 mogra-regular ">Cities</h1>

        <div class="table-responsive">
            <table class="table table-bordered">
                <colgroup>
                    <col class="w-100">
                    <col class="w-auto">
                </colgroup>
                <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($cities as $city)
                    <tr>
                        <td>{{ $city->name }}</td>
                        <td>
                            <a href="{{ route('cities.show', $city) }}" class="btn btn-sm btn-primary">View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3 pagination-wrapper">
            {{ $cities->links('pagination::bootstrap-5') }}
        </div>

    </div>

@endsection
