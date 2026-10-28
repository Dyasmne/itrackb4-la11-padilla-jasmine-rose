@extends('layouts.app')

@section('content')

    <h2>Movie List</h2>

    <a href="{{ route('movies.create') }}" class="btn btn-primary mb-3">Add Movie</a>

    <div class="alert alert-secondary">No filters applied.</div>

    <div class="mb-3">
        <strong>Filter by Genre:</strong>
        @foreach($genres as $genre)
            <a href="{{ route('movies.index', ['genre_id' => $genre->id]) }}"
               class="btn btn-sm btn-outline-primary">
                {{ $genre->name }}
            </a>
        @endforeach
    </div>

    <div class="mb-3">
        <strong>Filter by Rating:</strong>
        <a href="{{ route('movies.index', ['rating' => 8]) }}" class="btn btn-sm btn-outline-success">8.0+</a>
        <a href="{{ route('movies.index', ['rating' => 8.4]) }}" class="btn btn-sm btn-outline-success">8.4+</a>
        <a href="{{ route('movies.index', ['rating' => 8.5]) }}" class="btn btn-sm btn-outline-success">8.5+</a>
    </div>

    <div class="mb-4">
        <a href="{{ route('movies.index') }}" class="btn btn-secondary">Clear All Filters</a>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Genre</th>
                <th>Rating</th>
                <th style="width: 150px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movies as $movie)
                <tr>
                    <td>{{ $movie->id }}</td>
                    <td>
                        <a href="{{ route('movies.show', $movie) }}">{{ $movie->title }}</a>
                    </td>
                    <td>{{ $movie->genre->name ?? '' }}</td>
                    <td>
                        {{ $movie->rating }}
                        @if($movie->rating >= 8.5)
                            <span class="badge bg-warning text-dark">Top Rated</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('movies.edit', $movie) }}" class="btn btn-primary btn-sm">Edit</a>

                        <form action="{{ route('movies.destroy', $movie) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this movie?');"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection