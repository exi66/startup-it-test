<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = Tag::all();
        return view('tag.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
            ]
        );
        $input = $request->all();
        Tag::create($input);
        return redirect()->route('tags.list')->with('success', 'Тег успешно создан!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
            ]
        );
        $tag = Tag::find($id);
        $tag->update($request->all());
        return redirect()->route('tags.list')->with('success', 'Тег успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        if (!$tag->materials->isEmpty()) {
            return redirect()->route('tags.list')->with(
                'warn',
                'Тег, который используется в материалах не может быть удален!'
            );
        }
        $tag->delete();
        return redirect()->route('tags.list')->with('success', 'Тег успешно удален!');
    }
}
