 {{ Form::open(['route' => 'configurations.store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'FormValidation']) }}
 @if (Route::is('configurations.edit'))
     <div class="form-group mb-3">
         <h4>
             <span class="badge bg-warning text-black">Configuration for:</span>{{ $configurationQuery->description }}
         </h4>
     </div>
 @endif
 @if (Route::is('configurations.edit'))
     <input type="hidden" value="{{ $configurationQuery->id }}" name="id">
 @endif
 <div class="row">
     <div class="form-group mb-3 col-md-6">
         <label for="">{{ __('Key') }}</label>
         <input  @if (Route::is('configurations.edit')) value="{{ $configurationQuery->configkey }}" readonly @endif
             type="text" name="configkey" class="form-control @if (Route::is('configurations.edit')) disabled @endif">
     </div>
     <div class="form-group mb-3  col-md-6">
         <label for="">{{ __('Value') }}</label>
         <input @if (Route::is('configurations.edit')) value="{{ $configurationQuery->configvalue }}" @endif type="text"
             name="configvalue" class="form-control">
     </div>

     @if (Route::is('configurations.create'))
         <div class="form-group mb-3  col-md-6">
             <label for="">{{ __('Description') }}</label>
             <input value="" type="text" name="description" class="form-control">
         </div>
     @endif
     <div class="form-group mb-3  col-md-6">
         <label for=""><b>{{ __('Status') }}</b></label>

         <select  class="form-control" name="status" id="">
             <option @if (Route::is('configurations.edit') && $configurationQuery->status == 'ACTIVE') selected @endif>{{ __('ACTIVE') }}</option>
             <option @if (Route::is('configurations.edit') && $configurationQuery->status == 'INACTIVE') selected @endif>{{ __('INACTIVE') }}</option>
             <option @if (Route::is('configurations.edit') && $configurationQuery->status == 'PENDING') selected @endif>{{ __('PENDING') }}</option>
         </select>
         <span class="text-danger">
             @error('status')
                 {{ $message }}
             @enderror
         </span>
     </div>

 </div>

 <div class="form-group ">
     <button type="submit" class=" btn btn-primary">{{ __('Save Configuration') }}</button>
 </div>
 {{ Form::close() }}
