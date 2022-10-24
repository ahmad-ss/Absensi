</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
  <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div>
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right -->
  <div class="float-right d-none d-sm-inline">
    Anything you want
  </div>
  <!-- Default to the left -->
  <strong>Copyright &copy; 2021 <a href="http://bymartasia.com/">PT. Bymart Asia</a>.</strong> All rights reserved.
</footer>

<script type="text/javascript">
var module = angular.module('myApp', []);

module.controller('TimeCtrl', function($scope, $interval) {
	var tick = function() {
    	$scope.clock = Date.now();
	}
	tick();
	$interval(tick, 1000);
});
</script>