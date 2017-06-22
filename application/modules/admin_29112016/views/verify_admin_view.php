 <!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/datatable.css');?>">
<link REL="StyleSheet" TYPE="text/css" HREF="<?php echo base_url().'assets/dist/css/table.css';?>">
<style>
.width_20_persent {
   width: 20% !important;
}
.width_15_persent {
   width: 15% !important;
}
.width_10_persent {
   width: 10% !important;
}
</style>
<script src="<?php echo base_url();?>assets/plugins/sweetalert-master/dist/sweetalert.min.js"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/sweetalert-master/dist/sweetalert.css">
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Verify admin
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">verify_admin</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content">
		
	<?php if(isset($error)){ ?>
		
		<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                <?php echo $error;?>
              </div>
		
		
		
		
		<?php 
		}
		?>
		<?php if(isset($success)){ ?>		
		
		
		
		<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $success;?>
              </div>
		
		
		<?php 
		}
		?>
          <div class="row">
            <div class="col-xs-12">
             
			  
			  
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Pending Admin Requests: <?php echo count($pending_admins);?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
				<?php if(count($pending_admins)!="0"){
					?>
					
					
					
					<script>
					
					function admin_reject(id,name,email,fullname){
					
					swal({   title: "Are you sure to reject below admin ?", 
					  text: name,
					  type: "warning",  
					  showCancelButton: true,  
					  confirmButtonColor: "#DD6B55",  
					  confirmButtonText: "Yes, reject it!",  
					  cancelButtonText: "No, cancel it!",  
					  closeOnConfirm: true, 
					  closeOnCancel: true },
					  function(isConfirm){  
						  if (isConfirm) {  
							window.location = "<?php echo base_url('admin/verify_admin/admin_reject?id=');?>"+id+"&name="+name+"&email="+email+"&status=rejected&fullname="+fullname;	
						  
							  
						  } else {     
							swal("Cancelled", "You have cancelled :)", "error");
						  } 
					  });
					
					
				}
					
					
					
					
					function user_approve(id,name,email,fullname){
						swal({   title: "Are you sure to approve below admin ?", 
					  text: name,
					  type: "warning",  
					  showCancelButton: true,  
					  confirmButtonColor: "#DD6B55",  
					  confirmButtonText: "Yes, approve it!",  
					  cancelButtonText: "No, cancel it!",  
					  closeOnConfirm: true, 
					  closeOnCancel: true },
					  function(isConfirm){  
						  if (isConfirm) {  
							window.location = "<?php echo base_url('admin/verify_admin/admin_approve?id=');?>"+id+"&name="+name+"&email="+email+"&status=approved&fullname="+fullname;	
						  
							  
						  } else {     
							swal("Cancelled", "You have cancelled :)", "error");
						  } 
					  });
					}
					
					</script>
					
					
                  <table id="example16" class="table table-bordered table-striped" >
                    <thead>
                      <tr  class="table_th_border">
                        <th class="width_15_persent">Username</th>
                        <th class="width_15_persent">Name</th>
                        <th class="width_15_persent">Email</th>
                        <th class="width_10_persent">Phone Number</th>
                        <th class="width_10_persent">City</th>
                        <th class="width_15_persent">Request Sent On</th>
                        <th class="no-sort width_10_persent"></th>
                        <th class="no-sort width_10_persent"></th>
                      </tr>
                    </thead>
                    <tbody>
					<?php if(count($pending_admins)!="0"){
						foreach($pending_admins as $pending_rows){
						?>
								
                      <tr>
						
						   <td><?php echo $pending_rows->username;?></td>
                        <td><?php echo $fullname= $pending_rows->firstname." ".$pending_rows->lastname;?></td>
                        <td><?php echo $pending_rows->email_id;?></td>
                        <td><?php echo $pending_rows->primary_phone_number;?></td>
                        <td><?php echo $pending_rows->city_name;?></td>
						<td><?php echo $pending_rows->created_on;?></td>
						
						<td>
						
						
						
						<input value="APPROVE"  type="button"  class="btn btn-primary" onClick="return user_approve('<?php echo $pending_rows->admin_id;?>','<?php echo $pending_rows->username;?>','<?php echo $pending_rows->email_id;?>','<?php echo $fullname;?>')" />
						
						
						</td>
						
						
						
						
						<td>
						<input value="REJECT"  type="button"  class="btn btn-primary" onClick="return admin_reject('<?php echo $pending_rows->admin_id;?>','<?php echo $pending_rows->username;?>','<?php echo $pending_rows->email_id;?>','<?php echo $fullname;?>')" />
						
						</td>
						
						
                      
                      </tr>
                      <?php
						}
					}
					  ?>
					

				   </tbody>
                   
                  </table>
				<?php } else {
					
					
				}
				?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  
			 			  
			  
			  <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Total Active Admins: <?php echo count($active_admins);?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
				<?php if(count($active_admins)!="0"){
					?>
					
					
					
					<script>
					function admin_delete(id,name,email){
					
					if((name=='Admin')||(name=='admin')){
						swal("Sorry, You cannot delete Admin account !");
					} else {
					
					
					swal({   title: "Are you sure to delete below user ?", 
					  text: name,
					  type: "warning",  
					  showCancelButton: true,  
					  confirmButtonColor: "#DD6B55",  
					  confirmButtonText: "Yes, delete it!",  
					  cancelButtonText: "No, cancel it!",  
					  closeOnConfirm: true, 
					  closeOnCancel: true },
					  function(isConfirm){  
						  if (isConfirm) {  
							window.location = "<?php echo base_url('admin/verify_admin/admin_reject?id=');?>"+id+"&name="+name+"&email="+email+"&status=deleted";	
						  
							  
						  } else {     
							swal("Cancelled", "You have cancelled :)", "error");
						  } 
					  });
					}
					
				}
					
					
					</script>
					
					
                  <table id="example5" class="table table-bordered table-striped" >
                    <thead>
                      <tr  class="table_th_border">
                        <th class="width_20_persent">Username</th>
                       <th class="width_20_persent">Name</th>
                        <th class="width_20_persent">Email</th>
                        <th class="width_15_persent">Phone Number</th>
                        <th class="width_15_persent">City</th>
						<th class="no-sort width_10_persent" >Action</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php if(count($active_admins)!="0"){
						foreach($active_admins as $active_rows){
						?>
								
                     
                      <tr>
                        <td><?php echo $active_rows->username;?></td>
                        <td><?php echo $active_rows->firstname." ".$active_rows->lastname;?></td>
                        <td><?php echo $active_rows->email_id;?></td>
                        <td><?php echo $active_rows->primary_phone_number;?></td>
                        <td><?php echo $active_rows->city_name;?></td>
						<td>
						<input value="DELETE"  type="button"  class="btn btn-primary" onClick="return admin_delete('<?php echo $active_rows->admin_id;?>','<?php echo $active_rows->username;?>','<?php echo $active_rows->email_id;?>')" />
						</td>
                      </tr>
                      <?php
						}
					}
					  ?>
					

				   </tbody>
                   
                  </table>
				<?php } else {
					
					
				}
				?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  
			  
			  
			  
			  
            
			  
			  
			  
			  
			  
			  
			  
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   