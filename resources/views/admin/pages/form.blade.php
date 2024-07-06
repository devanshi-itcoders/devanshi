<div class="row">
    <!-- Title -->
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>{{ __('Title') }}</strong>
            {!! Form::text('title', null, ['placeholder' => 'Title', 'class' => 'form-control slug-input', 'id' => 'title']) !!}
        </div>
    </div>
    <!-- Slug -->
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>{{ __('Slug') }}</strong>
            {!! Form::text('slug', null, [
                'placeholder' => 'Slug',
                'class' => 'form-control slug-output',
                'onclick' => 'getData()',
                'id' => 'slug',
            ]) !!}
        </div>
        
    </div>
    <!-- Short Description -->
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>{{ __('Short Description') }}</strong>
            {!! Form::text('short_description', null, ['placeholder' => 'Short Description', 'class' => 'form-control']) !!}
        </div>
    </div> <!--  status -->
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>{{ __('Status') }}</strong>
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <label type="button" class="btn btn-default" for="activeStatus">
                        {!! Form::radio('status', 'ACTIVE', isset($page) && $page->status == 'ACTIVE' ? 'checked' : null, [
                            'id' => 'activeStatus',
                        ]) !!} &nbsp;&nbsp; {{ __('ACTIVE') }}
                    </label>
                </div>
                <div class="btn-group" role="group">
                    <label type="button" class="btn btn-default" for="inActiveStatus">
                        {!! Form::radio('status', 'INACTIVE', isset($page) && $page->status == 'INACTIVE' ? 'checked' : null, [
                            'id' => 'inActiveStatus',
                        ]) !!} &nbsp;&nbsp; {{ __('IN ACTIVE') }}
                    </label>
                </div>

            </div>
        </div>
    </div>
    <!-- Description -->
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>{{ __('Description') }}</strong>
            {!! Form::textarea('description', null, [
                'id' => 'pageDescription',
                'placeholder' => 'Description',
                'class' => 'form-control ckeditor',
            ]) !!} 
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-left">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>


