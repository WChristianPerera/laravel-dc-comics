@extends('layouts.base')

@section('contents')
    <div class="row">
        <div class="col-4 offset-4">
            <div class="card h-100" style="border: 1px solid black">
                <img src={{ $comic->thumb }} class="rounded" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $comic->title }}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Price: {{ $comic->price }} €</li>
                    <li class="list-group-item">Series: {{ $comic->series }}</li>
                    <li class="list-group-item">Sale Date: {{ $comic->sale_date }}</li>
                    <li class="list-group-item">Type: {{ $comic->type }}</li>
                </ul>
                <div class="card-body">
                    <p>{{ $comic->description }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection