<!-- start edit modal -->
<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('main.Edit') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <form action="{{ route('category.update', 'test') }}" method="post" enctype="multipart/form-data">
                    {{ method_field('patch') }}
                    @csrf
                    <div class="row">

                        <!-- name_ar -->
                        <div class="col-6">
                            <label for="name" class="mr-sm-2">{{ trans('main.Name') }} {{ trans('main.In Arabic') }} :</label>
                            <input id="name" type="text" name="name_ar" class="form-control" value="{{ $item->name_ar }}" required>
                        </div>

                        <!-- name_en -->
                        <div class="col-6">
                            <label for="name_en" class="mr-sm-2">{{ trans('main.Name') }} {{ trans('main.In English') }} :</label>
                            <input type="text" name="name_en" class="form-control" value="{{ $item->name_en }}" required>
                        </div>

                        <!-- photo -->
                        <div class="col-6">
                            <label for="photo" class="mr-sm-2">{{ trans('main.Photo') }} :</label>
                            <input type="file" name="photo" class="form-control" accept="image/*" data-height="70" value="{{ $item->photo }}"/>
                            @if($item->photo)
                                <div class="row">
                                    <div class="col-12">
                                        <img class="img-thumbnail m-1" src="{{ asset('attachments/category/'.$item->photo) }}" alt="{{ $item->photo }}" height="100" width="100">
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- id -->
                        <div class="col-6">
                            <input id="id" type="hidden" name="id" class="form-control" value="{{ $item->id }}">
                        </div>
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
<!-- end edit modal -->
