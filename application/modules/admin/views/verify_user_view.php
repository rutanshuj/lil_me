<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/datatable.css');?>">
<link REL="StyleSheet" TYPE="text/css" HREF="<?php echo base_url().'assets/dist/css/table.css';?>">


<script src="<?php echo base_url();?>assets/plugins/sweetalert-master/dist/sweetalert.min.js"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/sweetalert-master/dist/sweetalert.css">




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
		} else if(isset($success)){ ?>		
		
		
		
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
			
            <?php  /* ?> <div class="box" >
                <div class="box-header">
                  <h3 class="box-title  font_family_header">Pending User Requests: <?php echo count($pending_user);?></h3>
                </div><!-- /.box-header -->
                <div class="box-body" >
				
				<script>
				
				function reject_user(id,name,email,fullname){
					
					swal({   title: "Are you sure to reject below user ?", 
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
							window.location = "<?php echo base_url('admin/verify_user/user_disable?id=');?>"+id+"&name="+name+"&email="+email+"&status=rejected&fullname"+fullname;	
						  
							  
						  } else {     
							swal("Cancelled", "You have cancelled :)", "error");
						  } 
					  });
					
					
				}
				</script>
				<?php if(count($pending_user)!="0"){?>
				<script>					
				
				
				function pending_user_enable(date,user_type,user_id,name,email,fullname){
					if(date==''){
						alert("Please Add Validity");						
						return false
					} else {										
						swal({   title: "Are you sure to approve below user ?", 
						  text: name,
						  type: "warning",  
						  showCancelButton: true,  
						  confirmButtonColor: "#DD6B55",  
						  confirmButtonText: "Yes, Approve it!",  
						  cancelButtonText: "No, cancel it!",  
						  closeOnConfirm: true, 
						  closeOnCancel: true },
						  function(isConfirm){  
							  if (isConfirm) { 
							  
							  $.ajax({
							
							type: "POST",
							url: "<?php echo base_url('admin/verify_user/user_approve');?>",
							data: {                
								'date' : date,
								'user_type' : user_type,
								'name' : name,
								'user_id' : user_id,
								'email' : email,
								'fullname' : fullname
							},
							dataType: 'json',
							success: function(response){	
								window.location = "<?php echo base_url('admin/verify_user');?>";		 					
							   
							}
						});					
								
							  } else {     
								swal("Cancelled", "You have cancelled :)", "error");  
							  } 
						  });
						
					}
				}				
				</script>
				 <script type="text/javascript" language="javascript" src="<?php echo base_url().'assets/dist/js/jquery-1.12.0.min.js';?>">
	</script>
				<script type="text/javascript" language="javascript" class="init">
	

$(document).ready(function() {
	
	
	
	// Setup - add a text input to each footer cell
	$('#example12 tfoot th').each( function () {
		var title = $(this).text();
		if(title!=""){
		$(this).html( '<input type="text" class="form-control select_size" placeholder="Search '+title+'" />' );
		}
	} );

	// DataTable
	var table = $('#example12').DataTable({"columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ]});

	// Apply the search
	table.columns().every( function () {
		var that = this;

		$( 'input', this.footer() ).on( 'keyup change', function () {
			if ( that.search() !== this.value ) {
				that
					.search( this.value )
					.draw();
			}
		} );
	} );
} );


   

	</script>
	<div >
				<table id="example12"  class="display table table-bordered table-striped ">
               <!-- <table id="example2" class="table table-bordered table-striped">-->
                    <thead>
                      <tr style="border-top: 1px solid #d2d6de;">
                        <th class="width_15_persent" style="text-align: center;">Username</th>
                        <th class="width_15_persent" style="text-align: center;">Name</th>
                        <th class="width_15_persent" style="text-align: center;">Email</th>
                        <th style="text-align: center;">Request Sent On</th>
                        <th  class="no-sort" style="text-align: center;">User Type</th>
                        <th  class="no-sort" style="text-align: center;">Add Validity</th>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
						<th class="no-sort"></th>
						  
                      </tr>
                    </thead>
					<tfoot>
					<tr>
						<th class="width_15_persent" style="text-align: center;">Username</th>
                        <th class="width_15_persent" style="text-align: center;">Name</th>
                        <th class="width_15_persent" style="text-align: center;">Email</th>
                        <th></th>
                        <th  class="no-sort"></th>
                        <th  class="no-sort" ></th>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
						<th class="no-sort"></th>
						
					</tr>
				</tfoot>

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
                        <td><?php echo $fullname= $pending_row->firstname." ".$pending_row->lastname;?></td>
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
              
 

                  
                 
               <input class="form-control inbox_size" type="text" id="pen_datepicker_<?php echo $limit_pen;?>" name="pen_datepicker_<?php echo $limit_pen;?>"value="<?php echo $pend_user_vali;?>" >
				
				  </td>
						
						<td><a class="fancybox fancybox.iframe btn btn-primary" href="<?php echo base_url('admin/user/?id=').$pending_row->user_id."&name=".$pending_row->username;?>" >VIEW DETAIL</a></td>
						
						
						<td><input value="APPROVE"  type="button"  class="btn btn-primary" onClick="return pending_user_enable(document.getElementById('pen_datepicker_<?php echo $limit_pen;?>').value,document.getElementById('pen_user_type_<?php echo $limit_pen;?>').value,'<?php echo $pending_row->user_id;?>','<?php echo $pending_row->username;?>','<?php echo $pending_row->email_id;?>','<?php echo $fullname;?>')" /></td>
						
						
						
						<td>
						<input value="REJECT"  type="button"  class="btn btn-primary" onClick="return reject_user('<?php echo $pending_row->user_id;?>','<?php echo $pending_row->username;?>','<?php echo $pending_row->email_id;?>','<?php echo $fullname;?>')" />
						
						
						
						​
						
						</td>
						
						
                      
                      </tr>
						<?php
						
					}
					
					}
						?>
										
                      
                    </tbody>
                   
                  </table>
				
				</div>
				<?php }else {
					
					
				}?>
                </div>
                </div>

              
<?php

 */

?>










			  <div class="row"  >
            <div class="col-xs-12" >

    
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title font_family_header">Active Users: <?php echo count($active_user);?></h3>
                </div><!-- /.box-header -->
                <div class="box-body" >
				
				<?php if(count($active_user)!="0"){
					?>
					<script>					
					
					
					
				
				function disable_user(id,name,email,fullname){
					
					swal({   title: "Are you sure to disable below user ?", 
					  text: name,
					  type: "warning",  
					  showCancelButton: true,  
					  confirmButtonColor: "#DD6B55",  
					  confirmButtonText: "Yes, disable it!",  
					  cancelButtonText: "No, cancel it!",  
					  closeOnConfirm: true, 
					  closeOnCancel: true },
					  function(isConfirm){  
						  if (isConfirm) {  
							window.location = "<?php echo base_url('admin/verify_user/user_disable?id=');?>"+id+"&name="+name+"&email="+email+"&status=disabled&fullname="+fullname;	
						  
							  
						  } else {     
							swal("Cancelled", "You have cancelled :)", "error");
						  } 
					  });
					
					
					
				
				}
				
					
					
					
					
					
					
					
					
					
				function active_user_update(date,user_type,user_id,email,username,fullname){
					if(date==''){
						alert("Please Add Validity");
						
						return false
					} else {	
							




swal({   title: "Are you sure to update below user ?", 
  text: username,
  type: "warning",  
  showCancelButton: true,  
  confirmButtonColor: "#DD6B55",  
  confirmButtonText: "Yes, update it!",  
  cancelButtonText: "No, cancel it!",  
  closeOnConfirm: true, 
  closeOnCancel: true },
  function(isConfirm){  
	  if (isConfirm) { 


	
						$.ajax({
							
							type: "POST",
							url: "<?php echo base_url('admin/verify_user/user_updated');?>",
							data: {                
								'date' : date,
								'user_type' : user_type,
								'user_id' : user_id,
								'username' : username,
								'email' : email,
								'fullname' : fullname
							},
							dataType: 'json',
							success: function(response){								
							   window.location = "<?php echo base_url('admin/verify_user');?>"; 
							}
						});
						

	  
		
	  } else {     
		swal("Cancelled", "You have cancelled :)", "error");  
	  } 
  });



										
					}
				}				
				</script>
                  <table id="example7" class="table table-bordered table-striped">
                    <thead>
					
                      <tr style="border-top: 1px solid #d2d6de;text-align: center;">
                        
                        <th style="text-align: center;">Name</th>
                        <th style="text-align: center;">Email</th>
                        <th style="text-align: center;">Contact No.</th>
                       
                       
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
                       
                        <td><?php echo $fullname =ucfirst($active_rows->firstname." ".$active_rows->lastname);?></td>
                        <td><?php echo $active_rows->email_id;?></td>
                        <td><?php echo $active_rows->primary_phone_number;?></td>
                       
                       
                      
                
                
						
						
						
						<td><a class="fancybox fancybox.iframe btn btn-primary" href="<?php echo base_url('admin/user/?id=').$active_rows->user_id."&name=".$active_rows->username;?>" >VIEW DETAIL</a></td>
						
						
						<td>
						
						
						<input value="DISABLE"  type="button"  class="btn btn-primary" onClick="return disable_user('<?php echo $active_rows->user_id;?>','<?php echo $active_rows->username;?>','<?php echo $active_rows->email_id;?>','<?php echo $fullname;?>')" />
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

	  <div class="row"  >
            <div class="col-xs-12" >
  <div class="box">
                <div class="box-header">
                  <h3 class="box-title  font_family_header">Inactive Users: <?php echo count($disabled_user);?></h3>
                </div><!-- /.box-header -->
                <div class="box-body" >
				
				<?php if(count($disabled_user)!="0"){
					$disa_limit="0";
					?>
					
					
					
					
					
					<script>					
					
				function inactive_user_enable(user_id,name,email,fullname){
					
					




swal({   title: "Are you sure to enable below user?", 
  text: name,
  type: "warning",  
  showCancelButton: true,  
  confirmButtonColor: "#DD6B55",  
  confirmButtonText: "Yes, enable it!",  
  cancelButtonText: "No, cancel it!",  
  closeOnConfirm: true, 
  closeOnCancel: true },
  function(isConfirm){  
	  if (isConfirm) {    
		$.ajax({
							
							type: "POST",
							url: "<?php echo base_url('admin/verify_user/user_enable');?>",
							data: {                
								
								'name' : name,
								'user_id' : user_id,
								'email' : email,
								'fullname' : fullname
							},
							dataType: 'json',
							success: function(response){									
							  
							   window.location = "<?php echo base_url('admin/verify_user');?>";
							}
						});
	  } else {     
		swal("Cancelled", "You have cancelled :)", "error"); 
	  } 
  });

					
										
					}
						
				</script>
				
					
					
                  <table id="example5" class="table table-bordered table-striped" >
                    <thead>
                      <tr style="border-top: 1px solid #d2d6de;text-align: center;">
                       
                        <th  style="text-align: center;">Name</th>
                        <th  style="text-align: center;">Email</th>
                        <th style="text-align: center;">Contact No.</th>
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
                       
                        <td><?php echo $fullname=$disabled_rows->firstname." ".$disabled_rows->lastname;?></td>
                        <td><?php echo $disabled_rows->email_id;?></td>
                        
						
						<td><?php echo $active_rows->primary_phone_number;?></td>
						
						
						
						
						
						
                     
						<td><a class="fancybox fancybox.iframe btn btn-primary" href="<?php echo base_url('admin/user?id=').$disabled_rows->user_id."&name=".$disabled_rows->username;?>">VIEW DETAIL</a></td>
						<td>	
						
						
						<input value="ENABLE"  type="button"  class="btn btn-primary" onClick="return inactive_user_enable('<?php echo $disabled_rows->user_id;?>','<?php echo $disabled_rows->username;?>','<?php echo $disabled_rows->email_id;?>','<?php echo $fullname;?>')" />​
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
		  
		  <div class="col-xs-12" style="height: 90px;" >
		  </div>
		 
		  
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   