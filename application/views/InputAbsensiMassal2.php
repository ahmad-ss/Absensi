  <hr>
  
  <a href="<?php echo $DownloadLink; ?>">Download Format</a>
  <br>
  <br>
  
  <!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
  <form method="post" action="<?php echo base_url(); ?>inputabsen/InputAbsensiMassalHarian" enctype="multipart/form-data">
    <!-- 
    -- Buat sebuah input type file
    -- class pull-left berfungsi agar file input berada di sebelah kiri
    -->
    <input type="file" name="file">
    
    <!--
    -- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
    -->
    <input type="submit" name="preview" value="Preview">
    
  </form>
      
<script>

    
// }
$(document).ready(function(){

$('#icon_save').html('<i class="fa fa-save"></i>');

//input();

//loadHarianUmum();

});
</script>


