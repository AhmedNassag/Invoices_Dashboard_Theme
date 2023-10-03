<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
<!-- JQuery min js -->
<script src="{{ URL::asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap Bundle js -->
<script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Ionicons js -->
<script src="{{ URL::asset('assets/plugins/ionicons/ionicons.js') }}"></script>
<!-- Moment js -->
<script src="{{ URL::asset('assets/plugins/moment/moment.js') }}"></script>
<!-- Rating js-->
<script src="{{ URL::asset('assets/plugins/rating/jquery.rating-stars.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/rating/jquery.barrating.js') }}"></script>
<!--Internal  Perfect-scrollbar js -->
<script src="{{ URL::asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/perfect-scrollbar/p-scroll.js') }}"></script>
<!--Internal Sparkline js -->
<script src="{{ URL::asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<!-- Custom Scroll bar Js-->
<script src="{{ URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<!-- right-sidebar js -->
<script src="{{ URL::asset('assets/plugins/sidebar/sidebar-rtl.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/sidebar/sidebar-custom.js') }}"></script>
<!-- Eva-icons js -->
<script src="{{ URL::asset('assets/js/eva-icons.min.js') }}"></script>
<!-- Sticky js -->
<script src="{{ URL::asset('assets/js/sticky.js') }}"></script>
<!-- custom js -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script><!-- Left-menu js-->
<script src="{{ URL::asset('assets/plugins/side-menu/sidemenu.js') }}"></script>


@yield('js')



<!-- notification reload -->
<script>
    setInterval(function() {
        $("#notifications_count").load(window.location.href + " #notifications_count");
        $("#unreadNotifications").load(window.location.href + " #unreadNotifications");
    }, 10000);
</script>


<!-- deleteSelected -->
<script type="text/javascript">
    //when check all
    function CheckAll(className, elem) {
        var elements = document.getElementsByClassName(className);
        var l = elements.length;
        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                elements[i].checked = false;
            }
        }
    }

    //when check show or hide button
    function showBtnDeleteSelected()
    {
        var selected = new Array();
        $("#example1 input[type=checkbox]:checked").each(function() {
            selected.push(this.value);
        });
        if (selected.length > 0) {
            document.getElementById('btn_delete_selected').style.display = "inline-block";
        } else {
            document.getElementById('btn_delete_selected').style.display = "none";
        }
    }

    //when click button show modal
    $(function() {
        $("#btn_delete_selected").click(function() {
            var selected = new Array();
            $("#example1 input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });
            if (selected.length > 0) {
                $('#delete_selected').modal('show')
                $('input[id="delete_selected_id"]').val(selected);
            }
        });
    });
</script>