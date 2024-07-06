<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    //

    function __construct(Request $request)
    {
        parent::__construct($request);
        // set permission
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!empty(session()->get('master_filter'))) {
            $master_filter = $request->session()->get('master_filter');
        } else {
            $master_filter = date('Y');
        }

        $filter = $request->input('filter');
        $status = $request->input('status');

        $imageQuery = Image::sortable()->latest();
        if (!empty($filter) || !empty($status)  || !empty($master_filter)) {

            $imageQuery = $imageQuery->where('title', 'like', '%' . $filter . '%');
             
            if (!empty($status)) {
                $imageQuery = $imageQuery->where('status',  $status);
            }
            if ($master_filter !== 'null') {
                $imageQuery = $imageQuery->where('created_at', 'like', '%' . $master_filter . '%');
            }
        }
        $data = $imageQuery->paginate(env('DEFAULT_PAGINATION', 10))->withQueryString();

        return view('admin.images.index', compact('data','filter','status'))->with('i', ($request->input('page', 1) - 1) *  env('DEFAULT_PAGINATION', 10));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.images.create');
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'btn_text' => 'required',
            'btn_link' => 'required',
            'image' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();
        // dd($input);
        $imagesResponse = Image::create($input);
        if ($request->file('image')) {
            $fileName = $request->image->getClientOriginalName();
            $filePath = $request->file('image')->move(public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $imagesResponse->id . DIRECTORY_SEPARATOR, $fileName);
            $imagesResponse->image =  $fileName;
            $imagesResponse->save();
          }
        return redirect()->route('admin.images.index')->with('success', 'Image created successfully');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function show($id)
    {
        $image = Image::find($id);
        return view('admin.images.show', compact('image'));
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function edit($id)
    {
        $image = Image::find($id);

        return view('admin.images.edit', compact('image'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'btn_text' => 'required',
            'btn_link' => 'required',
            'status' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $validationRules['image'] = 'required';
        }
        $input = $request->all();
        $images = Image::find($id);
        if ($request->hasFile('image')) {
            $fileName = $request->image->getClientOriginalName();
            $filePath = $request->file('image')->move(public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $id. DIRECTORY_SEPARATOR, $fileName);
            
            $input['image'] =  $fileName;
          }
        unset($input['previous_url']);
        if ($images->update($input)) {
        }
        return redirect()->to($request->get('previous_url'))->with('success', 'Image updated successfully');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy($id)
    {
        Image::find($id)->delete();
        return redirect()->route('admin.images.index')->with('success', 'Image deleted successfully');
    }

    
    public function showImage(Image $images){
        $imagePath = public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $images->id. DIRECTORY_SEPARATOR . $images->image;
        return response()->file($imagePath);
        // return view('admin.images.image',compact('images'));
    }
}
