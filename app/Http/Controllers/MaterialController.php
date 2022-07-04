<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FRequest;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data = Material::all();
		$search = FRequest::query('search');
		$tag = FRequest::query('tag');
		if ($search) {
			$query = strtolower($search);
			$search_data = array();
			foreach ($data as $d) {
				if (strpos(strtolower($d->name), $query) !== false) {
					$search_data[] = $d;
					continue;
				}
				if (strpos(strtolower($d->author), $query) !== false) {
					$search_data[] = $d;
					continue;
				}
				if (strpos(strtolower($d->category->name), $query) !== false) {
					$search_data[] = $d;
					continue;
				}		
				$tags = $d->tags->where('name', $query);
				if (!$tags->isEmpty()) {
					$search_data[] = $d;
					continue;
				}
			}
			$data = $search_data;
			return view('list-materials', compact('data', 'search'));
		} else if ($tag) {
			$query = strtolower($tag);
			$search_data = array();
			foreach ($data as $d) {
				$tags = $d->tags->where('name', $query);
				if (!$tags->isEmpty()) {
					$search_data[] = $d;
					continue;
				}					
			}
			$data = $search_data;
			return view('list-materials', compact('data', 'search'));
		}
        else return view('list-materials', compact('data', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::pluck('name','id')->all();
        return view('create-material',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string',
            'author' => 'nullable|string',
			'description' => 'nullable|string',
        ]);
    
        $input = $request->all();
        $material = Material::create($input);
        return redirect()->route('materials.list')->with('success','Материал успешно создан!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material = Material::find($id);
		$tags = $material->tags;
		$all_tags = Tag::pluck('name','id')->all();
		$links = $material->links()->get();
        return view('view-material', compact('material', 'tags', 'links', 'all_tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$category = Category::pluck('name','id')->all();
        $material = Material::find($id);
		return view('edit-material',compact('material', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'type' => 'required',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string',
            'author' => 'nullable|string',
			'description' => 'nullable|string',
        ]);
    
        $input = $request->all();
		
		$material = Material::find($id);
        $material->update($input);
        return redirect()->route('materials.list')->with('success','Материал успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Material::find($id)->delete();
        return redirect()->route('materials.list')->with('success','Материал успешно удален!');
    }
	
	public function add_tag(Request $request, $id)
    {
		$this->validate($request, [
            'tag_id' => 'required|exists:tags,id',
        ]);
        $material = Material::find($id);
		$tag = Tag::find($request->tag_id);
		
		if ($material->tags->contains($tag->id)) return redirect()->route('materials.show', $id)->with('warn','Тег и так присоединен к материалу!');
		
		$material->tags()->attach($tag->id);
        return redirect()->route('materials.show', $id)->with('success','Тег присоединен к материалу!');
    }
	
	public function rm_tag(Request $request, $id)
    {
		$this->validate($request, [
            'tag_id' => 'required|exists:tags,id',
        ]);
        $material = Material::find($id);
		$tag = Tag::find($request->tag_id);
		
		if (!($material->tags->contains($tag->id))) return redirect()->route('materials.show', $id)->with('warn','Тег и так неприсоединен к материалу!');
		
		$material->tags()->detach($tag->id);
        return redirect()->route('materials.show', $id)->with('success','Тег успешно отсоединен от материала!');
    }
	
}
