<!--Datatable-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css">
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div id="alert-users"></div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tbKaryawan" style="font-size:12px;">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase">Kode Type</th>
                                <th class="text-center text-uppercase">Nama Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $bagian=''; ?>
                            <?php $idx = 0;foreach($users as $usr):?>
                            <tr>
                                <td class="text-left"><?php echo $usr->Kd_Waktu;?></td>
                                <td class="text-left"><?php echo $usr->Waktu;?></td>
                            </tr>
                            <?php $idx++;endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function(){
    $('#tbKaryawan').DataTable({
        "ordering": false
    });
});
function preChangeStatus(id_user,v){
    var cf = '';
    if(v == 1){
        cf = confirm("Are you sure to active this user ?");
    }else{
        cf = confirm("Are you sure to not active this user ?");
    }

    if(cf){
        changeStatus(id_user,v);
    }
}

</script>