@extends('layouts.base')

@section('contents')

    @if (session('delete_success'))
        @php $comic = session('delete_success') @endphp
        <div class="alert alert-danger">
            Comic '{{ $comic->title }}' has been deleted
            <form action="{{ route("comics.restore", ['comic' => $comic]) }}" method="POST">
                @csrf
                <button class="btn btn-warning">Restore</button>
            </form>
        </div>
    @endif

    @if (session('restore_success'))
        @php $comic = session('restore_success') @endphp
        <div class="alert alert-success">
            Comic '{{ $comic->title }}' has been restored
        </div>
    @endif
    
    <div class="row row-cols-3 p-4">
        
        @foreach ($comics as $comic)
            <div class="col mb-3">
                <div class="card h-100" style="border: 1px solid black">
                    
                    <img src={{ $comic->thumb }} class="rounded" alt="...">
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $comic->title }}</h5>
                    </div>


                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Price: {{ $comic->price }} €</li>
                    </ul>
                    
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('comics.show', ['comic' => $comic->id]) }}">Details</a>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-warning" href="{{ route('comics.edit', ['comic' => $comic->id]) }}">Edit</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('comics.destroy', ['comic' => $comic->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $comics->links() }}
@endsection