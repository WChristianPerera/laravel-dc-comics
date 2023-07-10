<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use Illuminate\Http\Request;

class ComicController extends Controller
{
    private $validations = [
        'title' => 'required|string|max:255',
        'thumb' => 'required|string|max:1000',
        'price' => 'required|integer|max:255',
        'series' => 'required|string|max:255',
        'sale_date' => 'required|date',
        'type' => 'required|string|max:255',
        'description' => 'required|min:3|max:1000',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comics = Comic::paginate(3);


        return view('index', compact('comics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validations);

        $data = $request->all();

        $newComic = new Comic();
        
        $newComic->title = $data['title'];
        $newComic->thumb = $data['thumb'];
        $newComic->price = $data['price'];
        $newComic->series = $data['series'];
        $newComic->sale_date = $data['sale_date'];
        $newComic->type = $data['type'];
        $newComic->description = $data['description'];
        
        $newComic->save();

        
        return redirect()->route('comics.show', ['comic' => $newComic->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function show(Comic $comic)
    {
        return view('comics.show', compact('comic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function edit(Comic $comic)
    {
        return view('comics.edit', compact('comic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comic $comic)
    {
        $request->validate($this->validations);

        $data = $request->all();

        $comic->title = $data['title'];
        $comic->thumb = $data['thumb'];
        $comic->price = $data['price'];
        $comic->series = $data['series'];
        $comic->sale_date = $data['sale_date'];
        $comic->type = $data['type'];
        $comic->description = $data['description'];

        $comic->update();

        return to_route('comics.show', ['comic' => $comic->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comic $comic)
    {
        $comic->delete();
        
        return to_route('comics.index')->with('delete_success', $comic);
    }

    public function restore($id) 
    {
        Comic::withTrashed()->where('id', $id)->restore();

        $comic = Comic::find($id);

        return to_route('comics.index')->with('restore_success', $comic);
    }

    public function trashed()
    {
        $trashedComics = Comic::onlyTrashed()->paginate(5);

        return view('comics.trashed', compact('trashedComics'));
    }

    public function harddelete($id)
    {
        $comic = Comic::withTrashed()->find($id);
        $comic->forceDelete();

        return to_route('comics.trashed')->with('delete_success', $comic);
    }
    
}
