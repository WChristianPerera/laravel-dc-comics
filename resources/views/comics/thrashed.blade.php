@extends('layouts.base')

@section('contents')
    <h1 class="text-warning text-center">Comics Bin</h1>

    @if (session('delete_success'))
        @php $comic = session('delete_success') @endphp
        <div class="alert alert-danger">
            Comic "{{ $comic->title }}" has been permanently deleted
        </div>
    @endif

    <div class="row row-cols-3 p-4">
        @foreach ($trashedComics as $comic)
            <div class="col mb-3">
                <div class="card h-100" style="border: 1px solid black">
                    <img src={{ $comic->thumb }} class="image-fluid" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $comic->title }}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Price: {{ $comic->price }} €</li>
                    </ul>
                    <div class="card-body">
                        <form action="{{ route('comics.harddelete', ['comic' => $comic->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger hard_delete">Hard Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $trashedComics->links() }}
@endsection