<?php

namespace App\Controllers;

use App\Models\Tag;
use App\Authorizable;
use Illuminate\Http\Request;
use App\DataTables\TagsDataTable;
use App\Http\Requests\TagsRequest;

class TagsController extends Controller
{

    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TagsDataTable $dataTable)
    {
        return $dataTable->render('backend.tags.index', [
            'title' => trans('main.show-all') . ' ' . trans('main.tags')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tags.create', [
            'title' => trans('main.add') . ' ' . trans('main.tags'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagsRequest $request)
    {
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->save();
        session()->flash('success', trans('main.added-message'));
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return view('backend.tags.show', [
            'title' => trans('main.show') .' ' . trans('main.tag') . ' : ' . $tag->name,
            'show'  => $tag,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('backend.tags.edit', [
            'title' => trans('main.edit') .' ' . trans('main.tag') . ' : ' . $tag->name,
            'edit'  => $tag,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagsRequest $request, $id)
    {
        $tag = Tag::find($id);
        $tag->name = $request->name;
        $tag->save();
        session()->flash('success', trans('main.updated'));
        return redirect()->route('tags.show', [$tag->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  bool  $redirect
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $redirect = true)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        if ($redirect) {
            session()->flash('success', trans('main.deleted-message'));
            return redirect()->route('tags.index');
        }
    }


    /**
     * Remove the multible resource from storage.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request)
    {
        if (count($request->selected_data)) {
            foreach ($request->selected_data as $id) {
                $this->destroy($id, false);
            }
            session()->flash('success', trans('main.deleted-message'));
            return redirect()->route('tags.index');
        }
    }

}
