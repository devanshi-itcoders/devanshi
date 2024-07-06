<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <!-- Title -->
        <div class="col-12">
            <div class="form-group">
                <strong>{{ __('Title') }}</strong>
                {!! Form::text('title', null, ['placeholder' => 'Title', 'class' => 'form-control ', 'id' => '']) !!}
            </div>
        </div>
        <!-- Button Link -->
        <div class="col-12">
            <div class="form-group">
                <strong>{{ __('Button Link') }}</strong>
                {!! Form::text('btn_link', null, ['placeholder' => 'Button Link', 'class' => 'form-control']) !!}
            </div>
        </div>
        <!--  status -->
        <div class="col-12">
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
        <div class="col-12">
            <div class="form-group">
                <strong>{{ __('Description') }}</strong>
                {!! Form::textarea('description', null, [
                    'rows' => '7',
                    'id' => 'description',
                    'placeholder' => 'Description',
                    'class' => 'form-control',
                ]) !!}
            </div>
        </div>
    </div><!-- End Col -->

    <div class="col-xs-6 col-sm-6 col-md-6">
        <!-- Button Text -->
        <div class="col-12">
            <div class="form-group">
                <strong>{{ __('Button Text') }}</strong>
                {!! Form::text('btn_text', null, ['placeholder' => 'Button Text', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <!-- Is Daily Darshan -->
                <div class="col-md-6">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_daily_darshan" value="1"
                            @if (!empty($image->is_daily_darshan)) checked @endif id="is_daily_darshan">
                        <label class="form-check-label" for="is_daily_darshan">
                            {{ __('Is Daily Darshan?') }}
                        </label>
                    </div>
                </div>
                <!-- Is Gallery -->
                <div class="col-md-6">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_gallery" value="1"
                            @if (!empty($image->is_gallery)) checked @endif id="is_gallery">
                        <label class="form-check-label" for="is_gallery">
                            {{ __('Is Gallery?') }}
                        </label>
                    </div>
                </div>
                <!-- Is Pages -->
                <div class="col-md-6">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_pages" value="1"
                            @if (!empty($image->is_pages)) checked @endif id="is_pages">
                        <label class="form-check-label" for="is_pages">
                            {{ __('Is Pages?') }}
                        </label>
                    </div>
                </div>
                <!-- Is Home Slider -->
                <div class="col-md-6">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_home_slider" value="1"
                            @if (!empty($image->is_home_slider)) checked @endif id="is_home_slider">
                        <label class="form-check-label" for="is_home_slider">
                            {{ __(' Is Home Slider?') }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Image --}}
        <div class="col-12">
            <div class="form-group mb-3">
                <label for="">{{ __('Image') }}</label>
                <input type="file" name="image" class="form-control">

                @if (Route::is('images.edit'))
                    <p class="mb-2 mt-3 h5">{{ __('image') }}</p>
                    <img src="/files/images/{{ $image->id }}/{{ $image->image }}" alt="image" width="100px">
                @endif
            </div>
        </div>
    </div><!-- End Col -->

    <div class="col-xs-12 col-sm-12 col-md-12 text-left">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
