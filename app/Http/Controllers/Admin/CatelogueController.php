<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catelogue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatelogueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const  PATH_VIEW = 'admin.catelogues.';
    public function index()
    {
        $data = Catelogue::query()->latest('id')->paginate(5);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->isMethod('POST')){
            $request->validate([
                // 'title' => 'bail|required|unique:posts|max:255',
                // 'title' => 'bail|required|unique:posts|max:255',
                // 'title' => 'bail|required|unique:posts|max:255',
                // 'title' => 'bail|required|unique:posts|max:255',
                // 'title' => 'bail|required|unique:posts|max:255',
                // 'title' => 'bail|required|unique:posts|max:255',
               
            ]);
        }

        $data = $request->except('cover');
        $data['is_active'] ??=  0;
        //   dd($data);
        if ($request->hasFile('cover')) {
            $data['cover'] = Storage::put('uploads/catelogues', $request->file('cover'));
        }
        //   dd( $data);
        Catelogue::query()->create($data);
        return redirect()->route('admin.catelogue.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = Catelogue::query()->findOrFail($id);
        $model = $model->toArray();
        return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Catelogue::query()->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = Catelogue::query()->findOrFail($id);
        $data = $request->except('cover');
        $data['is_active'] ??=  0;
        //   dd($data);
        if ($request->hasFile('cover')) {
            $data['cover'] = Storage::put('uploads/catelogues', $request->file('cover'));
        }
        $img = $model->cover;
        $model->update($data);
        if ($img &&  Storage::exists($img)) {
            Storage::delete($img);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Catelogue::query()->findOrFail($id);
        $model->delete();
        
        if ($model->cover &&  Storage::exists($model->cover)) {
            Storage::delete($model->cover);
        }

        return back();
    }
}
