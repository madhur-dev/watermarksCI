<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
	.container {
  padding: 2rem 0rem;
}

h4 {
  margin: 2rem 0rem 1rem;
}

.table-image {
  td, th {
    vertical-align: middle;
  }
}
.fa {
	font-size: 16px !important;
}
</style>
<div class="container">
	<div class="row">
		<table class="table table-image">
			<thead>
				<tr>
					<th>S. No</th>
					<th>Image</th>
					<th/><th/>
				</tr>
			</thead>
			<tbody>
			<?PHP 
				for($i=0;$i<count($files);$i++) {
				?>
				<tr>
					<td><?= $i+1 ?></td>
					<td class="w-25">
						<img class="img-fluid img-thumbnail" height="100" width="150" src="<?php echo base_url()."uploads/".$files[$i]['file_name'];?>" />
					</td>
					<td><a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>UploadFile/editFile?id=<?php echo $files[$i]['id']?>"><i class="fa fa-edit"> Edit</i></a></td>
					<td><a class="btn btn-danger btn-sm" href="<?php echo base_url(); ?>UploadFile/deleteFile?id=<?php echo $files[$i]['id']?>"><i class="fa fa-trash"> Delete</i></a></td>
				</tr>
				<?PHP
				}		
			?>
			</tbody>	
		</table>
	</div>
</div>
