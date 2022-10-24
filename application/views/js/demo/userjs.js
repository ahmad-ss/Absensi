

$(document).ready(function(){
	$('#add_button').click(function(){
		$('#user_form2')[0].reset();
		$('.modal-title').text("Add User");
		$('#action').val("Add");
		$('#operation').val("Add");
	});
	
	var dataTable = $('#user_data2').DataTable({
		
		responsive: true,
		"processing":true,
		"serverSide":true,
		"ordering": false,
		"autoWidth": true,
		order:[],
		"pagingType": "full_numbers",
		"ajax":{
			url:"fetch2.php",
			type:"POST"
		},
		
		"lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50,100,"All"] ] ,
         
		
		

	});

	$(document).on('submit', '#user_form2', function(event){
		event.preventDefault();
		var nama = $('#nama').val();
		var username = $('#username').val();
		var password = $('#password').val();
		var akses = $('#akses').val();

		
		if(nama != '' && username != ''&& password != ''&& akses != '')
		{
			$.ajax({
				url:"insert2.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alert(data);
					$('#user_form2')[0].reset();
					$('#userModal2').modal('hide');
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			alert("Harap Mengisi Kolom Yang Kosong!");
		}
	});
	
	$(document).on('click', '.update', function(){
		var user_id = $(this).attr("id");
		$.ajax({
			url:"fetch_single2.php",
			method:"POST",
			data:{user_id:user_id},
			dataType:"json",
			success:function(data)
			{
				

				$('#userModal2').modal('show');
				$('#nama').val(data.nama);
				$('#username').val(data.username);
				$('#password').val(data.password);
				$('#akses').val(data.akses);
				$('.modal-title').text("Edit User");
				$('#user_id').val(user_id);
				$('#action').val("Edit");
				$('#operation').val("Edit");
			}
		})
	});
	
	$(document).on('click', '.delete', function(){
		var user_id = $(this).attr("id");
		if(confirm("Yakin Mau Dihapus?"))
		{
			$.ajax({
				url:"delete2.php",
				method:"POST",
				data:{user_id:user_id},
				success:function(data)
				{
					alert(data);
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			return false;	
		}
	});
	
	
});