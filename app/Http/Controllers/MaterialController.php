<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FRequest;
use DB;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $search = strtolower(FRequest::query('search'));
        $tag = strtolower(FRequest::query('tag'));
        if ($search) {
            $search_data = DB::table('materials')
                ->join('materials_tags', 'materials.id', '=', 'materials_tags.material_id')
                ->join('categories', 'categories.id', '=', 'materials.category_id')
                ->join('tags', 'tags.id', '=', 'materials_tags.tag_id')
                ->where('materials.name', 'like', '%' . $search . '%')
                ->orWhere('materials.author', 'like', '%' . $search . '%')
                ->orWhere('categories.name', 'like', '%' . $search . '%')
                ->orwhere('tags.name', 'like', '%' . $search . '%')
                ->pluck('materials.id')
                ->toArray();
            $data = Material::whereIn('id', $search_data)->get();
            return view('material.list', compact('data', 'search'));
        } elseif ($tag) {
            $search_data = DB::table('tags')
                ->join('materials_tags', 'tags.id', '=', 'materials_tags.tag_id')
                ->where('name', $tag)
                ->pluck('material_id')
                ->toArray();
            $data = Material::whereIn('id', $search_data)->get();
            return view('material.list', compact('data', 'search'));
        } else {
            $data = Material::all();
            return view('material.list', compact('data', 'search'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::pluck('name', 'id')->all();
        return view('material.create', compact('category'));
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
                'type' => 'required',
                'category_id' => 'required|exists:categories,id',
                'name' => 'required|string',
                'author' => 'nullable|string',
                'description' => 'nullable|string',
            ]
        );

        $input = $request->all();
        Material::create($input);
        return redirect()->route('materials.list')->with('success', 'Материал успешно создан!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $material = Material::find($id);
        $tags = $material->tags;
        $all_tags = Tag::pluck('name', 'id')->all();
        $links = $material->links()->get();
        return view('material.view', compact('material', 'tags', 'links', 'all_tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::pluck('name', 'id')->all();
        $material = Material::find($id);
        return view('material.edit', compact('material', 'category'));
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
                'type' => 'required',
                'category_id' => 'required|exists:categories,id',
                'name' => 'required|string',
                'author' => 'nullable|string',
                'description' => 'nullable|string',
            ]
        );

        $input = $request->all();

        $material = Material::find($id);
        $material->update($input);
        return redirect()->route('materials.list')->with('success', 'Материал успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Material::find($id)->delete();
        return redirect()->route('materials.list')->with('success', 'Материал успешно удален!');
    }

    /**
     * Attach the specified tag.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function add_tag(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'tag_id' => 'required|exists:tags,id',
            ]
        );
        $material = Material::find($id);
        $tag = Tag::find($request->tag_id);

        if ($material->tags->contains($tag->id)) {
            return redirect()->route('materials.show', $id)->with('warn', 'Тег и так присоединен к материалу!');
        }

        $material->tags()->attach($tag->id);
        return redirect()->route('materials.show', $id)->with('success', 'Тег присоединен к материалу!');
    }

    /**
     * Detach the specified tag.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function rm_tag(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'tag_id' => 'required|exists:tags,id',
            ]
        );
        $material = Material::find($id);
        $tag = Tag::find($request->tag_id);

        if (!$material->tags->contains($tag->id)) {
            return redirect()->route('materials.show', $id)->with('warn', 'Тег и так неприсоединен к материалу!');
        }

        $material->tags()->detach($tag->id);
        return redirect()->route('materials.show', $id)->with('success', 'Тег успешно отсоединен от материала!');
    }

}
