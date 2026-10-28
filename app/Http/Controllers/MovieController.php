<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;

class MovieController extends Controller
{
    /**
     * Display the list of movies.
     */
    public function index(Request $request)
    {
        $genre = $request->query('genre_id');
        $rating = $request->query('rating');

        $genres = Genre::all();

        $moviesQuery = Movie::query()->with('genre');

        if ($genre !== null && $genre !== '') {
            $moviesQuery->where('genre_id', $genre);
        }

        if ($rating !== null && $rating !== '') {
            $moviesQuery->where('rating', '>=', (float) $rating);
        }

        $movies = $moviesQuery->get();

        return view('movies.index', compact(
            'movies',
            'genres',
            'genre',
            'rating'
        ));
    }

    /**
     * Show the form for creating a movie.
     */
    public function create()
    {
        $genres = Genre::all();

        return view('movies.create', compact('genres'));
    }

    /**
     * Store a newly created movie.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'rating' => 'required|numeric|min:0|max:10',
            'is_available' => 'sometimes|boolean',
            'release_year' => 'nullable|integer|min:1888|max:2100',
        ]);

        $validated['is_available'] = $request->boolean('is_available');

        Movie::create($validated);

        return redirect()
            ->route('movies.index')
            ->with('success', 'Movie added successfully!');
    }

    /**
     * Display the specified movie.
     */
    public function show(Movie $movie)
    {
        $movie->load('genre');

        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing a movie.
     */
    public function edit(Movie $movie)
    {
        $genres = Genre::all();

        return view('movies.edit', compact('movie', 'genres'));
    }

    /**
     * Update the specified movie.
     */
    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'rating' => 'required|numeric|min:0|max:10',
            'is_available' => 'sometimes|boolean',
            'release_year' => 'nullable|integer|min:1888|max:2100',
        ]);

        $validated['is_available'] = $request->boolean('is_available');

        $movie->update($validated);

        return redirect()
            ->route('movies.index')
            ->with('success', 'Movie updated successfully!');
    }

    /**
     * Delete the specified movie.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()
            ->route('movies.index')
            ->with('success', 'Movie deleted successfully!');
    }

    /**
     * Display a featured movie.
     */
    public function featured()
    {
        $movie = Movie::firstOrFail();

        return view('movies.featured', compact('movie'));
    }
}