<div class="row">
  <!-- User name -->
  <div class="col-xs-6 col-sm-6 col-md-6">
    <div class="form-group">
      <strong>Name:</strong>
      {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
    </div>
  </div>
  <!-- User Email -->
  <div class="col-xs-6 col-sm-6 col-md-6">
    <div class="form-group">
      <strong>Email:</strong>
      {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
      
    </div>
  </div>
  <!-- Phone -->
  <div class="col-xs-6 col-sm-6 col-md-6">
    <div class="form-group">
      <strong>Phone:</strong>
      {!! Form::text('phone', null, array('placeholder' => 'Phone','class' => 'form-control')) !!}
    </div>
  </div>
  <!-- User status -->
  <div class="col-xs-6 col-sm-6 col-md-6">
    <div class="form-group">
      <strong>Status:</strong>
      <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <div class="btn-group" role="group">
          <label type="button" class="btn btn-default" for="activeStatus">
            {!! Form::radio('status', 'ACTIVE', isset($user) && $user->status == 'ACTIVE' ? 'checked': null, array('id' => 'activeStatus')) !!} &nbsp;&nbsp; ACTIVE
          </label>
        </div>
        <div class="btn-group" role="group">
          <label type="button" class="btn btn-default" for="inActiveStatus">
            {!! Form::radio('status', 'INACTIVE', isset($user) && $user->status == 'INACTIVE' ? 'checked': null, array('id' => 'inActiveStatus')) !!} &nbsp;&nbsp; IN ACTIVE
          </label>
        </div>
        <div class="btn-group" role="group">
          <label type="button" class="btn btn-default" for="pendingStatus">
            {!! Form::radio('status', 'PENDING', isset($user) && $user->status == 'PENDING' ? 'checked': null, array('id' => 'pendingStatus')) !!} &nbsp;&nbsp; PENDING
          </label>
        </div>
        <div class="btn-group" role="group">
          <label type="button" class="btn btn-default" for="lockedStatus">
            {!! Form::radio('status', 'LOCKED', isset($user) && $user->status == 'LOCKED' ? 'checked': null, array('id' => 'lockedStatus')) !!} &nbsp;&nbsp; LOCKED
          </label>
        </div>
      </div>
    </div>
  </div>
  <!-- User password -->
  <div class="col-xs-6 col-sm-6 col-md-6">
    <div class="form-group">
      <strong>Password:</strong>
      {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
      
    </div>
  </div>
  <!-- User confirm password -->
  <div class="col-xs-6 col-sm-6 col-md-6">
    <div class="form-group">
      <strong>Confirm Password:</strong>
      {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
      
    </div>
  </div>
  <!-- User Address -->
  <div class="col-xs-6 col-sm-6 col-md-6">
    <div class="form-group">
      <strong>Address:</strong>
      {!! Form::textarea('address', null, array('rows'=>4, 'placeholder' => 'Address','class' => 'form-control')) !!}
    </div>
  </div>
  <!-- User role -->
  <div class="col-xs-6 col-sm-6 col-md-6">
    <div class="form-group">
      <strong>Role:</strong>
      @if ($hasCreate)
        {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
      @else
        {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
      @endif
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 text-left">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</div>
