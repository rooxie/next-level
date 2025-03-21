@extends('layouts.app')

@section('content')


    <div class="text-center">
        <a href="{{ route('cities.index') }}" class="btn">
            Back
        </a>
    </div>

    <div class="container mt-5">
        <div class="card shadow-sm mb-4">
            <div class="card-body text-center">
                <h2 class="card-title mogra-regular">{{ $city->name }}</h2>
                <p class="card-text"><strong>Country:</strong> {{ $city->country_code }}</p>
                <p class="card-text"><strong>Timezone:</strong> {{ $city->timezone }}</p>
            </div>
        </div>
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-center">Today's Temperature</h5>
                <div class="text-center text-muted">{{ $date->format('d.m.Y') }}</div>
                <canvas id="chart"></canvas>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => Chart.simpleFactory('chart', @json($temperatureReadings)));
    </script>

@endsection
