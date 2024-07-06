<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConfigurationRequest;
use App\Http\Requests\UpdateConfigurationRequest;
use App\Models\Configuration;
use Illuminate\Http\Request;
use \Cache;

class ConfigurationController extends Controller
{
    /**
   * Instantiate a new Controller instance.
   */
  public function __construct(Request $request)
  {
    parent::__construct($request);

    $this->middleware('auth');
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
    $configurationQuery = Configuration::where('created_at', '!=', null)->sortable()->latest(); //should not be null
    $searchInput = '';
    if ($request->search && !empty($request->search) || !empty($master_filter) ) {
      $searchInput = trim($request->search);

      if (!empty($searchInput)) {
        $configurationQuery = $configurationQuery->where(function ($query) use ($searchInput) {
          $query->where('configkey', 'like', '%' . $searchInput . '%')
            ->orWhere('configvalue', 'like', '%' . $searchInput . '%');
        });
      }

      if ($master_filter !== 'null') {
        $configurationQuery = $configurationQuery->where('created_at', 'like', '%' . $master_filter . '%');
      }
    }

    $configurationListArr = $configurationQuery->paginate(env('DEFAULT_PAGINATION', 10))->withQueryString();

    $pageTitle = 'Configurations';
    return view('admin.configurations.index', compact('configurationListArr', 'searchInput', 'pageTitle'))->with('i', ($request->input('page', 1) - 1) * env('DEFAULT_PAGINATION', 10));;

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $pageTitle = 'Create configuration';
    return view('admin.configurations.create', compact('pageTitle'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    if ($request->isMethod('POST')) {
      // default set as create new record
      $configurationQuery = null;
      if ($request->id && !empty($request->id)) {
        // Update record
        $configurationQuery = Configuration::find($request->id);
        $message = 'updated';
      } else {
        $configurationQuery = new Configuration();
        $message = 'added';
      }
      $validationRules = [
        'configkey' => 'required',
        'status' => 'required',
        'configvalue' => 'required',
      ];
      $request->validate(
        $validationRules
      );
      
      $configurationQuery->configkey = $request->configkey;
      $configurationQuery->configvalue = $request->configvalue;
      $configurationQuery->status = $request->status;
      if($request->description) {
        $configurationQuery->description = $request->description;
      }
      $configurationQuery->save();
      // reset config cache
      \Cache::delete('appConfiguration');
      return redirect()->route('admin.configurations.index')->with('status', "Configuration $message successfully.");
    }
    return redirect()->back()->with('status', 'Something went wrong.');
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
    $configurationQuery = Configuration::find($id);
    $pageTitle = 'Create configuration';
    return view('admin.configurations.edit', compact('pageTitle', 'configurationQuery'));
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
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $responseArr = [
      'status' => 'fail',
      'message' => 'Unable to delete record.'
    ];
    $configurationQuery = Configuration::find($id);
    if ($configurationQuery) {
      $queryResponse = $configurationQuery->delete();
      if ($queryResponse) {
        $responseArr['status'] = 'success';
        $responseArr['message'] = 'Record deleted!';
      }
    }
    return redirect()->route('admin.configurations.index')->with('success', 'Configuration deleted successfully');
  }
}
