@extends('layouts.app')

@section('title', 'Edit Movie')

@section('content')

    <h2 class="mb-4">Edit Movie</h2>
    <form action="{{ route('movies.update', $movie) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Movie Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $movie->title) }}">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="genre_id" class="form-label">Genre</label>
            <select name="genre_id" id="genre_id" class="form-select">
                <option value="">Select Genre</option>

                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}" @selected(old('genre_id', $movie->genre_id) == $genre->id)>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
            @error('genre_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <input type="number" name="rating" id="rating" class="form-control" step="0.1" min="0" max="10"
                value="{{ old('rating', $movie->rating) }}">
            @error('rating')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="release_year" class="form-label">Release Year</label>
            <input type="number" name="release_year" id="release_year" class="form-control"
                value="{{ old('release_year', $movie->release_year) }}">
            @error('release_year')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_available" id="is_available" class="form-check-input" value="1"
                @checked(old('is_available', $movie->is_available))>
            <label for="is_available" class="form-check-label">
                Available
            </label>
        </div>

        <button type="submit" class="btn btn-primary">
            Update Movie
        </button>

        <a href="{{ route('movies.index') }}" class="btn btn-secondary">
            Back to Movies
        </a>

    </form>

@endsection