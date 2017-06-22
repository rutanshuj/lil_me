<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/datatable.css');?>">


<!-- Add jQuery library -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/fancyBox/lib/jquery-1.10.1.min.js"></script>
	
	

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/fancyBox/source/jquery.fancybox.js?v=2.1.5"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/fancyBox/source/jquery.fancybox.css?v=2.1.5" media="screen" />


	<script type="text/javascript">
	var jq = $.noConflict();
		jq(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */
			jq('.fancybox').fancybox();
			jq("#fancybox-manual-b").click(function() {
				jq.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});
			});
	</script>

 
 
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Verify user
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">verify_user</li>
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
		


          <div class="row"  >
            <div class="col-xs-12" >
              <div class="box" >
                <div class="box-header">
                  <h3 class="box-title">Pending User Requests: <?php echo count($pending_user);?></h3>
                </div><!-- /.box-header -->
                <div class="box-body" >
				
				<?php if(count($pending_user)!="0"){?>
				<script>					
					
				function pending_user_enable(date,user_type,user_id,name,email){
					
					if(date==''){
						alert("Please Add Validity");						
						return false
					} else {	
										
						$.ajax({
							
							type: "POST",
							url: "<?php echo base_url('admin/verify_user/user_approve');?>",
							data: {                
								'date' : date,
								'user_type' : user_type,
								'name' : name,
								'user_id' : user_id,
								'email' : email
							},
							dataType: 'json',
							success: function(response){	
								window.location = "<?php echo base_url('admin/verify_user');?>";		 					
							   
							}
						});				
					}
				}				
				</script>
				
				<table id="example1"  class="display table table-bordered table-striped " >
               <!-- <table id="example2" class="table table-bordered table-striped">-->
                    <thead>
                      <tr>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Request Sent On</th>
                        <th  class="no-sort">User Type</th>
                        <th  class="no-sort" >Add Validity</th>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
						<th class="no-sort"></th>
						  
                      </tr>
                    </thead>
					

                    <tbody>
					<?php
					
					if(count($pending_user)!="0"){
						$limit_pen="0";
						foreach($pending_user as $pending_row){
							$limit_pen++;
							$pend_user_vali="";
							if(isset($pending_row->valid_through)&&($pending_row->valid_through!="")){
								//$pend_user_vali= date("Y-m-d", strtotime($pending_row->valid_through));
								$pend_user_vali= $pending_row->valid_through;
								
								
							}
						?>
						<tr>
						
						   <td><?php echo $pending_row->username;?></td>
                        <td><?php echo $pending_row->firstname." ".$pending_row->lastname;?></td>
                        <td><?php echo $pending_row->email_id;?></td>
						 
						 
						 <td><?php echo date("Y-m-d", strtotime($pending_row->created_on));?></td>
						 
                       <td>
						
						
						
						<select name="user_type" id="pen_user_type_<?php echo $limit_pen;?>" class="form-control select_size" >
						<?php 
						
						foreach($master_user_type as $user_type_row) {
							
							
							$selected="";
							if($user_type_row->user_type==$pending_row->user_type) {
								$selected="selected='selected'";
							}
							?>
							<option value="<?php echo $user_type_row->user_type;?>" <?php echo $selected;?>><?php echo $user_type_row->user_type;?></option>
							<?php 
						}
						
						?>
						</select>
						
						</td>
                        <td> 
                  <!-- Date dd/mm/yyyy -->
                
                  
                 
               <input class="form-control inbox_size" type="text" id="pen_datepicker_<?php echo $limit_pen;?>" name="pen_datepicker_<?php echo $limit_pen;?>"value="<?php echo $pend_user_vali;?>">
				
				  </td>
						
						<td><a class="fancybox fancybox.iframe btn btn-primary" href="<?php echo base_url('admin/user/?id=').$pending_row->user_id."&name=".$pending_row->username;?>" >VIEW DETAIL</a></td>
						
						
						<td><input value="APPROVE"  type="button"  class="btn btn-primary" onClick="return pending_user_enable(document.getElementById('pen_datepicker_<?php echo $limit_pen;?>').value,document.getElementById('pen_user_type_<?php echo $limit_pen;?>').value,'<?php echo $pending_row->user_id;?>','<?php echo $pending_row->username;?>','<?php echo $pending_row->email_id;?>')" /></td>
						<td><a href="<?php echo base_url('admin/verify_user/user_disable?id=').$pending_row->user_id."&name=".$pending_row->username."&email=".$pending_row->email_id;?>" class="btn btn-primary">REJECT</a>
						
						​
						
						</td>
						
						
                      
                      </tr>
						<?php
						
					}
					
					}
						?>
										
                      
                    </tbody>
                   
                  </table>
				<?php }else {
					
					
				}?>
                
<div>

				</div><!-- /.box-body -->
              

    
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Active Users: <?php echo count($active_user);?></h3>
                </div><!-- /.box-header -->
                <div class="box-body" >
				
				<?php if(count($active_user)!="0"){
					?>
					<script>					
					
				function active_user_update(date,user_type,user_id,email){
					if(date==''){
						alert("Please Add Validity");
						
						return false
					} else {	
											
						$.ajax({
							
							type: "POST",
							url: "<?php echo base_url('admin/verify_user/user_updated');?>",
							data: {                
								'date' : date,
								'user_type' : user_type,
								'user_id' : user_id,
								'email' : email
							},
							dataType: 'json',
							success: function(response){								
							   alert('user successfully updated');
							}
						});				
					}
				}				
				</script>
                  <table id="example4" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th  class="no-sort">User Type</th>
                        <th  class="no-sort">Add Validity</th>
						<th class="no-sort"></th>
						<th class="no-sort"></th>
						<th class="no-sort"></th>
                      </tr>
                    </thead>
                    <tbody>
					<?php if(count($active_user)!="0"){
						$limit_act="0";
						foreach($active_user as $active_rows){
							$limit_act++;
							
							$active_user_vali="";
						if(isset($active_rows->valid_through)&&($active_rows->valid_through!="")){
								//$active_user_vali= date("Y-m-d", strtotime($active_rows->valid_through));
								$active_user_vali= $active_rows->valid_through;
							}
							
						?>
								
                      <tr>
                        <td><?php echo $active_rows->username;?></td>
                        <td><?php echo $active_rows->firstname." ".$active_rows->lastname;?></td>
                        <td><?php echo $active_rows->email_id;?></td>
                        <td>
						
						
						
						<select name="user_type" id="user_type_<?php echo $limit_act;?>" class="form-control select_size" >
						<?php 
						
						foreach($master_user_type as $user_type_row) {
							
							
							$selected="";
							if($user_type_row->user_type==$active_rows->user_type) {
								$selected="selected='selected'";
							}
							?>
							<option value="<?php echo $user_type_row->user_type;?>" <?php echo $selected;?>><?php echo $user_type_row->user_type;?></option>
							<?php 
						}
						
						?>
						</select>
						
						</td>
                       
                        <td> 
                
                  <?php // echo $active_rows->valid_through; ?>
                  <input class="form-control inbox_size" type="text" id="a_u_datepicker_<?php echo $limit_act;?>" name="a_u_datepicker_<?php echo $limit_act;?>"value="<?php echo $active_user_vali;?>">
               
				
				  </td>
						
						
						
						<td><a class="fancybox fancybox.iframe btn btn-primary" href="<?php echo base_url('admin/user/?id=').$active_rows->user_id."&name=".$active_rows->username;?>" >VIEW DETAIL</a></td>
						<td><a href="<?php echo base_url('admin/verify_user/user_disable?id=').$active_rows->user_id."&name=".$active_rows->username."&email=".$active_rows->email_id;?>" class="btn btn-primary">DISABLE</a></td>
						<td>					
						
						<input value="UPDATE"  type="button"  class="btn btn-primary" onClick="return active_user_update(document.getElementById('a_u_datepicker_<?php echo $limit_act;?>').value,document.getElementById('user_type_<?php echo $limit_act;?>').value,'<?php echo $active_rows->user_id;?>','<?php echo $active_rows->email_id;?>')" />​
						
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
                  <h3 class="box-title">Inactive Users: <?php echo count($disabled_user);?></h3>
                </div><!-- /.box-header -->
                <div class="box-body" >
				
				<?php if(count($disabled_user)!="0"){
					$disa_limit="0";
					?>
					
					<script>					
					
				function inactive_user_enable(date,user_type,user_id,name,email){
					
					if(date==''){
						alert("Please Add Validity");
						
						return false
					} else {												
						$.ajax({
							
							type: "POST",
							url: "<?php echo base_url('admin/verify_user/user_enable');?>",
							data: {                
								'date' : date,
								'user_type' : user_type,
								'name' : name,
								'user_id' : user_id,
								'email' : email,
							},
							dataType: 'json',
							success: function(response){									
							  
							   window.location = "<?php echo base_url('admin/verify_user');?>";
							}
						});				
					}
				}				
				</script>
					
					
                  <table id="example5" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th class="no-sort">User Type</th>
                        <th class="no-sort">Add Validity</th>
						<th class="no-sort"></th>
						<th class="no-sort"></th>
                      </tr>
                    </thead>
                    <tbody>
					<?php if(count($disabled_user)!="0"){
						foreach($disabled_user as $disabled_rows){
							$disa_limit++;
							$ina_user_vali="";
						if(isset($disabled_rows->valid_through)&&($disabled_rows->valid_through!="")){
								//$ina_user_vali= date("Y-m-d", strtotime($disabled_rows->valid_through));
								$ina_user_vali= $disabled_rows->valid_through;
							}
						?>
								
                      <tr>
                        <td><?php echo $disabled_rows->username;?></td>
                        <td><?php echo $disabled_rows->firstname." ".$active_rows->lastname;?></td>
                        <td><?php echo $disabled_rows->email_id;?></td>
                        <td>
						
						
						
						<select name="user_type" id="in_user_type_<?php echo $disa_limit;?>" class="form-control select_size" >
						<?php 
						
						foreach($master_user_type as $user_type_row) {
							
							
							$selected="";
							if($user_type_row->user_type==$disabled_rows->user_type) {
								$selected="selected='selected'";
							}
							?>
							<option value="<?php echo $user_type_row->user_type;?>" <?php echo $selected;?>><?php echo $user_type_row->user_type;?></option>
							<?php 
						}
						
						?>
						</select>
					
						</td>
						
						
						
						<td> 
                  <!-- Date dd/mm/yyyy -->
                
                  <?php // echo $active_rows->valid_through; ?>
                  <input class="form-control inbox_size" type="text" id="dis_datepicker_<?php echo $disa_limit;?>" name="dis_datepicker_<?php echo $disa_limit;?>"value="<?php echo $ina_user_vali;?>">
               
				
				  </td>
						
						
						
						
                     
						<td><a class="fancybox fancybox.iframe btn btn-primary" href="<?php echo base_url('admin/user?id=').$disabled_rows->user_id."&name=".$disabled_rows->username;?>">VIEW DETAIL</a></td>
						<td>	
						
						
						<input value="ENABLE"  type="button"  class="btn btn-primary" onClick="return inactive_user_enable(document.getElementById('dis_datepicker_<?php echo $disa_limit;?>').value,document.getElementById('in_user_type_<?php echo $disa_limit;?>').value,'<?php echo $disabled_rows->user_id;?>','<?php echo $disabled_rows->username;?>','<?php echo $disabled_rows->email_id;?>')" />​
						
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
	  
	  
   