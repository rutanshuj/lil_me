 <!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/datatable.css');?>">
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
		
		<?php if(isset($message)){ ?>
		<div class="alert alert-error __web-inspector-hide-shortcut__">
		<button class="close" data-dismiss="alert"></button><?php echo $message;?></div>
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
                  <table id="example1" class="table table-bordered table-striped" >
                    <thead>
                      <tr>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>City</th>
                        <th>Request Sent On</th>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
                      </tr>
                    </thead>
                    <tbody>
					<?php if(count($pending_admins)!="0"){
						foreach($pending_admins as $pending_rows){
						?>
								
                      <tr>
						
						   <td><?php echo $pending_rows->username;?></td>
                        <td><?php echo $pending_rows->firstname." ".$pending_rows->lastname;?></td>
                        <td><?php echo $pending_rows->email_id;?></td>
                        <td><?php echo $pending_rows->primary_phone_number;?></td>
                        <td><?php echo $pending_rows->city_name;?></td>
						<td><?php echo $pending_rows->created_on;?></td>
						
						<td><a href="<?php echo base_url('admin/verify_admin/admin_approve?id=').$pending_rows->admin_id."&name=".$pending_rows->username."&email=".$pending_rows->email_id;?>" class="btn btn-primary">APPROVE</a></td>
						<td><a href="<?php echo base_url('admin/verify_admin/admin_reject?id=').$pending_rows->admin_id."&name=".$pending_rows->username."&email=".$pending_rows->email_id;?>" class="btn btn-primary">REJECT</a></td>
						
						
                      
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
                  <table id="example2" class="table table-bordered table-striped" >
                    <thead>
                      <tr> 
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
						<td><a href="<?php echo base_url('admin/verify_admin/admin_reject?id=').$active_rows->admin_id."&name=".$active_rows->username;?>" class="btn btn-primary">DELETE</a></td>
						
						
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
	  
	  
   