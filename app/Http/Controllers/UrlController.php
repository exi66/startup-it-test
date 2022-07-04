<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
			'material_id' => 'required|exists:materials,id',
			'url' => 'required|url',
            'name' => 'nullable|string',
        ])->validateWithBag('links');
		
		$validator->validated();
		
        $input = $request->all();
		$id = $request['material_id'];
        $url = Url::create($input);
        return redirect()->route('materials.show', $id)->with('success','Ссылка успешено создана!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$url = Url::find($id);
	    return response()->json([
	      'data' => $url
	    ]);
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
		$validator = Validator::make($request->all(), [
			'material_id' => 'required|exists:materials,id',
			'url' => 'required|url',
            'name' => 'nullable|string',
        ]);
		
		if ($validator->fails()) {
			return response()->json([
				'errors' => $validator->errors()
			]);
        }
		
		$validator->validated();
		
        $url = Url::find($id);
		$url->update($request->all());
		
		return response()->json([
			'success' => 'Ссылка успешно обновлена!'
		]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $url = Url::find($id);
		$id = $url->material_id;
		$url->delete();
        return redirect()->route('materials.show', $id)->with('success','Ссылка успешно удалена!');
    }
}
