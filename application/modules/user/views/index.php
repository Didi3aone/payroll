<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title"><?= $title_table; ?></h4>
				<h6 class="card-subtitle pull-right">
					<a href="<?= $url_create; ?>" class="btn btn-rounded btn-primary"><i class="fa fa-plus"></i>
						Add
					</a>
				</h6>
				<div class="table-responsive m-t-40">
					<table id="myTable" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Name</th>
								<th>Position</th>
								<th>Email</th>
								<th>Status Login</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								if( !empty($datas) ) {
									foreach($datas as $key => $val ) :
							?>
							<tr>
								<td><?php echo $val['fullname']; ?></td>
								<td><?php echo $val['role_name']; ?></td>
								<td><?php echo $val['email']; ?></td>
								<td><?php echo $val['status_login']; ?></td>
								<td class="text-center">
									<a href="<?= $url_edit.$val['hash_id']; ?>" data-toggle="tooltip" title="Edit" class="btn btn-rounded btn-primary"><i class="fa fa-pencil"></i></a>
									<a href="javascript:void()" data-id="<?= $val['id']; ?>" data-toggle="tooltip" title="Delete" class="btn btn-rounded btn-danger btn-delete"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
							<?php endforeach; } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>