@extends('layouts.master')



@section('css')
    <!-- Internal DataTable css -->
    <!-- <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet"> -->
    <!--Internal Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css')}}">
    <!---Internal Fileuploads css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal FancyUploder css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    
    
    <!---Internal Owl Carousel css-->
    <link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
    <!--- Select2 css -->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    
    <!-- Print -->
    <style>
        @media print {
            .notPrint {
                display: none;
            }
        }

    </style>
    @section('title')
        {{ trans('main.Categories') }}
    @stop
@endsection



@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('main.Dashboard') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('main.Categories') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection



@section('content')
        <!-- validationNotify -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- success Notify -->
        @if (session()->has('success'))
            <script id="successNotify">
                window.onload = function() {
                    notif({
                        msg: "تمت العملية بنجاح",
                        type: "success"
                    })
                }
            </script>
        @endif

        <!-- error Notify -->
        @if (session()->has('error'))
            <script id="errorNotify">
                window.onload = function() {
                    notif({
                        msg: "لقد حدث خطأ.. برجاء المحاولة مرة أخرى!",
                        type: "error"
                    })
                }
            </script>
        @endif

        <!-- canNotDeleted Notify -->
        @if (session()->has('canNotDeleted'))
            <script id="canNotDeleted">
                window.onload = function() {
                    notif({
                        msg: "لا يمكن الحذف لوجود بيانات أخرى مرتبطة بها..!",
                        type: "error"
                    })
                }
            </script>
        @endif


        <!-- row -->
        <div class="row">
                
            <div class="col-xl-12">
                <div class="card mg-b-20">
                    <div id="print">
                        <div class="card-header pb-0">
                            <!--start title-->
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mg-b-0">{{ trans('main.Categories') }}</h4>
                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                            </div>
                            <p class="tx-12 tx-gray-500 mb-2"></p>
                            <!--end title-->
                            <div class="row row-xs wd-xl-60p">
                                <div class="col-sm-6 col-md-12 notPrint">
                                    @if($trashed == false)
                                        <a class="modal-effect btn btn-primary ripple" data-effect="effect-newspaper" data-toggle="modal" href="#modaldemo8">
                                            <i class="mdi mdi-plus"></i>&nbsp;{{ trans('main.Add') }}
                                        </a>
                                    @endif
                                    <button class="btn btn-dark ripple" id="print_Button" onclick="printDiv()">
                                        <i class="mdi mdi-printer"></i>&nbsp;{{ trans('main.Print') }}
                                    </button>
                                    <button type="button" class="btn btn-danger ripple" id="btn_delete_selected" title="{{ trans('main.Delete Selected') }}" style="display:none">
                                        <i class="fas fa-trash-alt"></i>&nbsp;{{ trans('main.Delete Selected') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-striped table-bordered mg-b-0 text-md-nowrap">      
                                    <thead>
                                        <tr>
                                            @if($trashed == false)
                                                <th class="text-center border-bottom-0 notPrint">
                                                    <input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)"  oninput="showBtnDeleteSelected()">
                                                </th>
                                            @endif
                                            <th class="text-center border-bottom-0">#</th>
                                            <th class="text-center border-bottom-0">{{ trans('main.Name')}}</th>
                                            <th class="text-center border-bottom-0 notPrint">{{ trans('main.Photo')}}</th>
                                            <th class="text-center border-bottom-0 notPrint">{{ trans('main.Actions')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- start search -->
                                        @if($trashed == false)
                                            <tr class="notPrint">
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <form action="{{ route('category.index') }}" method="get">
                                                    <td class="text-center">
                                                        @if(app()->getLocale() == 'ar')
                                                            <input type="text" class="form-control text-center" name="name_ar" placeholder="{{ trans('main.Enter Search Key Of') }} {{ trans('main.Name') }}">
                                                        @else
                                                            <input type="text" class="form-control text-center" name="name_en" placeholder="{{ trans('main.Enter Search Key Of') }} {{ trans('main.Name') }}">
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control text-center" name="photo" placeholder="{{ trans('main.Enter Search Key Of') }} {{ trans('main.Photo') }}">
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-info btn-sm pr-3 pl-3 pt-1 pb-1 mt-2 text-center" title="{{ trans('main.Search') }}" onclick="this.form.submit()">
                                                            <i class="far fa-eye-slash"></i>&nbsp;{{ trans('main.Search') }}
                                                        </button>
                                                    </td>
                                                </form>
                                            </tr>
                                        @endif
                                        <!-- end serch -->
                                        <?php $i = 0; ?>
                                        @foreach ($categories as $item)
                                            <?php $i++; ?>
                                            <tr>
                                                @if($trashed == false)
                                                    <td class="text-center notPrint">
                                                        <input id="delete_selected_input" type="checkbox" value="{{ $item->id }}" class="box1 mr-3" oninput="showBtnDeleteSelected()">
                                                    </td>
                                                @endif
                                                <td class="text-center">{{ $i }}</td>
                                                <td class="text-center">{{ app()->getLocale() == 'ar' ? $item->name_ar : $item->name_en }}</td>
                                                <td class="text-center notPrint">
                                                    @if($item->photo)
                                                        <img src="{{ asset('attachments/category/'.$item->photo) }}" alt="{{ $item->photo }}" height="50" width="50">
                                                        <a class="btn btn-outline-success btn-sm" href="{{ url('show_file') }}/category/{{ $item->photo }}" role="button"><i class="fas fa-eye"></i></a>
                                                        <a class="btn btn-outline-info btn-sm" href="{{ url('download_file') }}/category/{{ $item->photo }}" role="button"><i class="fas fa-download"></i></a>
                                                    @endif
                                                </td>
                                                <td class="text-center notPrint">
                                                    <div class="dropdown">
                                                        <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm" data-toggle="dropdown" type="button"><i class="fas fa-caret-down ml-1"></i>{{ trans('main.Actions') }}</button>
                                                        <div class="dropdown-menu tx-13 bd-primary rounded-5">
                                                            @if($trashed == false)
                                                                <a class="dropdown-item" href="{{ route('category.show',[$item->id]) }}" title="{{ trans('main.Show') }}">
                                                                    <i class="text-success fas fa-eye"></i>&nbsp;&nbsp;{{ trans('main.Show') }}
                                                                </a>
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit{{ $item->id }}" title="{{ trans('main.Edit') }}">
                                                                    <i class="text-info fas fa-pencil-alt"></i>&nbsp;&nbsp;{{ trans('main.Edit') }}
                                                                </a>
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete{{ $item->id }}" title="{{ trans('main.Delete') }}">
                                                                    <i class="text-danger icon ion-md-paper-plane"></i>&nbsp;&nbsp;{{ trans('main.Archive') }}
                                                                </a>
                                                            @else
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#restore{{ $item->id }}" title="{{ trans('main.Restore') }}">
                                                                    <i class="text-success fas fa-exchange-alt"></i>&nbsp;&nbsp;{{ trans('main.Restore') }}
                                                                </a>
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#forceDelete{{ $item->id }}" title="{{ trans('main.Delete') }}">
                                                                    <i class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;{{ trans('main.Delete') }}
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            @include('dashboard.category.editModal')
                                            @include('dashboard.category.deleteModal')
                                            @include('dashboard.category.forceDeleteModal')
                                            @include('dashboard.category.restoreModal')

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('dashboard.category.addModal')
            @include('dashboard.category.deleteSelectedModal')

            <!-- row closed -->
        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection



@section('js')
    <!-- Internal Data tables -->
    <!-- <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script> -->
    <!--Internal  Datatable js -->
    <!-- <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script> -->
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    
    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!-- Internal Select2 js-->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal Modal js-->
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>

    <!-- Print -->
    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endsection
