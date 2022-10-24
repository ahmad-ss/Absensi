<script type="text/javascript">
  // Function ini dijalankan ketika Halaman ini dibuka pada browser
  $(function() {
    setInterval(timestamp, 1000); //fungsi yang dijalan setiap detik, 1000 = 1 detik
  });

  //Fungi ajax untuk Menampilkan Jam dengan mengakses File ajax_timestamp.php
  function timestamp() {
    $.ajax({
      url: '<?php /*$this->template->viewAdmin('ajax_timestamp');*/ echo base_url('dashboard/Timestamp');
            ?>',
      success: function(data) {
        $('#timestamp').html(data);
      },
    });
  }
</script>
<script type="text/javascript">
  function checkStatusOnline() {
    //$('#aside_sts_online').html('<i class="fa fa-circle text-success"></i> Online');
    $.ajax({
      url: '<?= base_url(); ?>admin/checkstatus',
      dataType: 'JSON',
      beforeSend: function() {
        $('#aside_sts_online').html('<i class="fa fa-circle text-warning"></i> Checking...');
      },
      success: function(result) {
        if (result.code == 0) {
          $('#aside_sts_online').html('<i class="fa fa-circle text-success"></i> ' + result.message);
        } else {
          $('#aside_sts_online').html('<i class="fa fa-circle text-danger"></i> ' + result.message);
          setTimeout(function() {
            location.href = '<?= base_url(); ?>';
          }, 5000);
        }
      },
      error: function(textStatus) {
        $('#aside_sts_online').html('<i class="fa fa-circle text-danger"></i> ' + textStatus);
        $.alert(xhr.responseText);
      }
    });
  }

  $.widget.bridge('uibutton', $.ui.button);
  $(document).ready(function(e) {

    $('.numprice').inputmask({
      "alias": "numeric",
      "rightAlign": false,
      "prefix": "",
      "digits": 0,
      "digitsOptional": false,
      "decimalProtect": false,
      "groupSeparator": ".",
      "radixPoint": ",",
      "radixFocus": true,
      "autoGroup": true,
      "autoUnmask": true,
      "removeMaskOnSubmit": true
    });

    var url = window.location
    $('.sidebar-menu a').each(function(e) {
      var link = $(this).attr('href');
      if (link == url) {
        $(this).parent('li').addClass('active');
        $(this).closest('.treeview').addClass('active');
      }
    });

    checkStatusOnline();
    setInterval(checkStatusOnline, 15000);
  });



  /*$('.sidebar-menu .treeview').click(function(){
    $(this).addClass('active');
    $('.treeview').not(this).removeClass('active');
  });

  $('.goto').click(function(e){
    e.preventDefault();
    var url=$(this).attr('href');
    if(url!='#'){
      $.get(url,function(data){
        $('.content-wrapper').html(data);
      });
    }
  });*/
</script>
</div>
</body>