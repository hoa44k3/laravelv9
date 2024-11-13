<!DOCTYPE html>
<html lang="en">
  @include('backend.dashboard.component.head')
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      @include('backend.dashboard.component.sidebar')
      <!-- End Sidebar -->     
      @include('backend.dashboard.component.main')  
      <!-- Custom template | don't include it in your project! -->
      @include('backend.dashboard.component.custom')
      <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    @include('backend.dashboard.component.script')
  </body>
</html>