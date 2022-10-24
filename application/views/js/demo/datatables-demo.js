

$(document).ready(function(){
	$('#add_button').click(function(){
		$('#user_form')[0].reset();
		$('.modal-title').text("Add User");
		$('#action').val("Add");
		$('#operation').val("Add");
	});
	
	var dataTable = $('#user_data').DataTable({
		
		responsive: true,
		"processing":true,
		"serverSide":true,
		"ordering": false,
		"autoWidth": true,
		order:[],
		"pagingType": "full_numbers",
		"ajax":{
			url:"fetch.php",
			type:"POST"
		},
		dom: 'lBfrtip',
		"lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50,100,"All"] ] ,
          buttons: [ 
			{

				extend: 'print',
			   text: 'Print',
			   messageTop: 'Daftar Surat',
			   title: 'Data Surat',
			   exportOptions: {
				   
				   columns: [ 0, 1, 2,3,4,5]
			   },
			   customize: function (win) {
		   
				   $(win.document.body).find('table').addClass('display').css('font-size', '14px');
				   $(win.document.body).find('table').addClass('display').css('@page { size: landscape; }');
				   $(win.document.body).find('tr:nth-child(odd) td').each(function(index){
					   $(this).css('background-color','#D0D0D0');
				   });
				   $(win.document.body).find('h1').css('text-align','center');
								   $(win.document.body).find('table tbody td:nth-child(1)').css('text-align', 'center');
								   $(win.document.body).find('table tbody td:nth-child(2)').css('text-align', 'center');
								   $(win.document.body).find('table tbody td:nth-child(3)').css('text-align', 'center');
								   $(win.document.body).find('table tbody td:nth-child(4)').css('text-align', 'center');
								   $(win.document.body).find('table tbody td:nth-child(5)').css('text-align', 'center');
								   $(win.document.body).find('table tbody td:nth-child(6)').css('text-align', 'center');

								   
								   
								   $(win.document.body).find('table thead th:nth-child(1)').css('text-align', 'center');
								   $(win.document.body).find('table thead th:nth-child(2)').css('text-align', 'center');
								   $(win.document.body).find('table thead th:nth-child(3)').css('text-align', 'center');
								   $(win.document.body).find('table thead th:nth-child(4)').css('text-align', 'center');
								   $(win.document.body).find('table thead th:nth-child(5)').css('text-align', 'center');
								   $(win.document.body).find('table thead th:nth-child(6)').css('text-align', 'center');



								  
								   
								   
			   }
		   }
		],
		
		

	});

	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var NIK = $('#NIK').val();
		var NKK = $('#NKK').val();
	
		
		
		if(nik != '' && nkk != '' )
		{
			$.ajax({
				url:"insert.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alert(data);
					$('#user_form')[0].reset();
					$('#userModal').modal('hide');
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
			url:"fetch_single.php",
			method:"POST",
			data:{user_id:user_id},
			dataType:"json",
			success:function(data)
			{
				

				$('#userModal').modal('show');
				$('#jenis').val(data.jenis);
				$('#kepada').val(data.kepada);
				$('#perihal').val(data.perihal);
				$('#nomor_surat').val(data.nomor_surat);
				$('#kka').val(data.kka);
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
				url:"delete.php",
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