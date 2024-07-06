<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class PagesController extends Controller
{

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

    $pageQuery = Page::sortable()->latest();
    if (!empty($filter) || !empty($status)  || !empty($master_filter)) {

      $pageQuery = $pageQuery->where(function ($query) use ($filter) {
        $query->where('title', 'like', '%' . $filter . '%')
          ->orWhere('slug', 'like', '%' . $filter . '%');
      });
      if (!empty($status)) {
        $pageQuery = $pageQuery->where('status',  $status);
      }
      if ($master_filter !== 'null') {
        $pageQuery = $pageQuery->where('created_at', 'like', '%' . $master_filter . '%');
      }
    }
    $data = $pageQuery->paginate(env('DEFAULT_PAGINATION', 10))->withQueryString();

    return view('admin.pages.index', compact('data', 'filter', 'status'))->with('i', ($request->input('page', 1) - 1) *  env('DEFAULT_PAGINATION', 10));
  }



  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.pages.create');
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
      'title' => 'required',
      'slug' => 'required',
      'status' => 'required',
      'short_description' => 'required',
      'description' => 'required',

    ]);

    $input = $request->all();
    $user = Page::create($input);
    return redirect()->route('admin.pages.index')->with('success', 'Page created successfully');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $page = Page::find($id);
    return view('admin.pages.show', compact('page'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $page = Page::find($id);

    return view('admin.pages.edit', compact('page'));
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
      'title' => 'required',
      'slug' => 'required',
      'status' => 'required',
      'short_description' => 'required',
      'description' => 'required',

    ]);
    $input = $request->all();
    // dd($input);
    $page = Page::find($id);
    $page->update($input);
    unset($input['previous_url']);
    return redirect()->to($request->get('previous_url'))->with('success', 'Page updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    Page::find($id)->delete();
    return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully');
  }

  public function description(Page $pages)
  {
    return view('admin.pages.page',compact('pages'));
  }
}
