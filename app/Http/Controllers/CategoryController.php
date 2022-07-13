<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::all();
        return view('category.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
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
        Category::create($input);
        return redirect()->route('categories.list')->with('success', 'Категория успешно создана!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
            ]
        );
        $category = Category::find($id);
        $category->update($request->all());
        return redirect()->route('categories.list')->with('success', 'Категория успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category->materials->isEmpty()) {
            return redirect()->route('categories.list')->with(
                'warn',
                'Категория, используемая материалом, не может быть удалена!'
            );
        }
        $category->delete();
        return redirect()->route('categories.list')->with('success', 'Категория успешно удалена!');
    }
}
