<!--Datatable-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css">
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div id="alert-users"></div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tbKaryawan" style="width:100%;table-layout: auto;">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase">Kode Cabang</th>
                                <th class="text-center text-uppercase">Cabang</th>
                                <th class="text-center text-uppercase">Alamat Cabang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $bagian=''; ?>
                            <?php $idx = 0;foreach($users as $usr):?>
                            <tr>
                                <td class="text-center"><?php echo $usr->Kd_Cabang;?></td>
                                <td class="text-center"><?php echo $usr->Cabang;?></td>
                                <td class="text-center"><?php echo $usr->Alamat;?></td>
                            </tr>
                            <?php $idx++;endforeach;?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center text-uppercase">Kode Cabang</th>
                                <th class="text-center text-uppercase">Cabang</th>
                                <th class="text-center text-uppercase">Alamat Cabang</th>
                            </tr>
                        </tfoot>
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