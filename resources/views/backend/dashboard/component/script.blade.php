
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<!-- jQuery Scrollbar -->
<script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<!-- Kaiadmin JS -->
<script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="{{ asset('assets/js/setting-demo2.js') }}"></script>

<script>
  $(document).ready(function() {
    $("#displayNotif").on("click", function () {
      var placementFrom = $("#notify_placement_from option:selected").val();
      var placementAlign = $("#notify_placement_align option:selected").val();
      var state = $("#notify_state option:selected").val();
      var style = $("#notify_style option:selected").val();
      var content = {};

      content.message = 'Turning standard Bootstrap alerts into "notify" like notifications';
      content.title = "Bootstrap notify";
      if (style == "withicon") {
        content.icon = "fa fa-bell";
      } else {
        content.icon = "none";
      }
      content.url = "index.html";
      content.target = "_blank";

      $.notify(content, {
        type: state,
        placement: {
          from: placementFrom,
          align: placementAlign,
        },
        time: 1000,
      });
    });
  });
</script>
