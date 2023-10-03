<!-- start add modal -->
<div class="modal" id="modaldemo8">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ trans('main.Add New') }}</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- name_ar -->
                        <div class="col-6">
                            <label for="name_ar" class="mr-sm-2">{{ trans('main.Name') }} {{ trans('main.In Arabic') }} :</label>
                            <input id="name_ar" type="text" class="form-control" name="name_ar" value="{{ old('name_ar') }}">
                        </div>
                        <!-- name_en -->
                        <div class="col-6">
                            <label for="name_en" class="mr-sm-2">{{ trans('main.Name') }} {{ trans('main.In English') }} :</label>
                            <input id="name_en" type="text" class="form-control" name="name_en" value="{{ old('name_en') }}">
                        </div>
                        <!-- photo -->
                        <div class="col-6">
                            <label for="photo" class="mr-sm-2">{{ trans('main.Photo') }} :</label>
                            <input type="file" name="photo" class="dropify" accept="image/*" data-height="70" />
                        </div>

                        <!-- Start select2 -->
                        <div class="col-6">
                            <label for="photo" class="mr-sm-2">{{ trans('main.Select2') }} :</label>
                            <select class="form-control select2">
                                <option label="Choose one"></option>
                                @foreach($categories as $item)
                                    <option value="{{$item->id}}">{{$item->name_ar}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- End select2 -->
                    </div>

                    <div class="modal-footer mt-3">
                        <button type="submit" class="btn btn-success ripple">{{ trans('main.Confirm') }}</button>
                        <button type="button" class="btn btn-danger ripple" data-dismiss="modal">{{ trans('main.Close') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end add modal -->