<?php
include('../../../koneksi.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$statement = $connection->prepare("
			INSERT INTO hrd_biodata (NIK,NKK) 
			VALUES (:NIK,:NKK)
		");
		$result = $statement->execute(
			array(
			    ':NIK'	=>	$_POST["NIK"],
				':NKK'	=>	$_POST["NKK"],
			)
		);
		if(!empty($result))
		{
			echo 'Data Telah Ditambahkan';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		$statement = $connection->prepare(
			"UPDATE surat 
			SET jenis = :jenis, kepada = :kepada, perihal = :perihal  , nomor_surat = :nomor_surat  , kka = :kka    WHERE id = :id"
		);
		$result = $statement->execute(
			array(
			    ':jenis'	=>	$_POST["jenis"],
				':kepada'	=>	$_POST["kepada"],
				':perihal'	=>	$_POST["perihal"],
				':nomor_surat'	=>	$_POST["nomor_surat"],
				':kka'	=>	$_POST["kka"],
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Surat Telah Disunting';
		}
	}
}

?>