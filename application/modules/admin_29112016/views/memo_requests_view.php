<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/datatable.css');?>">
<link rel="StyleSheet" type="text/css" href="<?php echo base_url().'assets/dist/css/table.css';?>">
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Memo Request
            <small>View</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Memo Request</li>
          </ol>
        </section>

  
         
		   <!-- Main content -->
        <section class="content">
		
		
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="<?php echo base_url('admin/out_on_memo');?>" class="btn btn-primary" > Memo Dashboard</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/out_on_memo/memo_requests');?>" class="btn btn-primary"" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Memo Requests</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/out_on_memo/on_memo_status');?>" class="btn btn-primary"> On Memo Status</a></div>
					
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/out_on_memo/memo_history');?>" class="btn btn-primary"> Memo History</a></div>
					
					
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/out_on_memo/manual_add');?>" class="btn btn-primary"> Manual Add</a></div>
				</div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Memo request to be approved (<?php echo count($memo_requests);?>) </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				<?php if((validation_errors())||(isset($error) &&($error!=""))){ ?>
		<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
               <?php echo validation_errors(); if(isset($error) &&($error!="")){echo $error;}?>
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
		<script src="<?php echo base_url();?>assets/plugins/sweetalert-master/dist/sweetalert.min.js"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/sweetalert-master/dist/sweetalert.css">
				<script>
				function approve(memo_requests_date,expiry_date,memo_id,product_name,email,product_id,fullname,status){
					if(status=='OUT ON MEMO'){
						swal("This product is already out on memo, you cannot approve it.");						
						return false
					} else 
					if(memo_requests_date==''){
						alert("Please select Memo Date Requested");						
						return false
					} else 
					if(expiry_date==''){
						alert("Please select Expiry Date");						
						return false
					} else {
						
						$.ajax({
							type: "POST",
							url: "<?php echo base_url('admin/out_on_memo/approve');?>",
							data: {                
								'memo_requests_date' : memo_requests_date,
								'expiry_date' : expiry_date,
								'memo_id' : memo_id,
								'product_name' : product_name,
								'email' : email,
								'product_id' : product_id,
								'fullname' : fullname
							},
							dataType: 'json',
							success: function(response){
								//alert('Memo request has been approve till '+expiry_date+' for project '+product_name);
								window.location = "<?php echo base_url('admin/out_on_memo/memo_requests');?>";		
										
							   
							}
						});
					
					
					}
				}
				
				</script>
				<?php if(count($memo_requests)!="0"){?>
				
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr class="table_th_border">
                        <th>User Name</th>
                        <th>Product Id</th>
                        <th>Product Category</th>
                        <th>Product Sub-Category</th>
                        <th class="no-sort">Request Received On</th>
                        <th class="no-sort">Memo Date Requested</th>
                        <th class="no-sort">Expiry Date</th>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>						  
                      </tr>
                    </thead>
                    <tbody>
					<?php

					if(count($memo_requests)!="0"){
						$memo_limit='0';
						foreach($memo_requests as $memo_requests_rows){
							$memo_limit++;
							$full_name=$memo_requests_rows->firstname." ".$memo_requests_rows->lastname;
							
							$memo_request_date="";
							if(isset($memo_requests_rows->memo_request_date)&&($memo_requests_rows->memo_request_date!="")){
								$memo_request_date= date("Y-m-d", strtotime($memo_requests_rows->memo_request_date));
							}
							$expiry_date="";
							if(isset($memo_requests_rows->expiry_date)&&($memo_requests_rows->expiry_date!="")){
								$expiry_date= date("Y-m-d", strtotime($memo_requests_rows->expiry_date));
							}

						?>
						<tr>						
						<td><?php echo $memo_requests_rows->username;?></td>
                        <td><?php echo $memo_requests_rows->product_name;?></td>
                        <td><?php echo $memo_requests_rows->category_name;?></td>
                        <td><?php echo $memo_requests_rows->subcategory_name;?></td>
                        <td><?php //echo $memo_requests_rows->created_on;
						
						
						
						echo date("Y-m-d", strtotime($memo_requests_rows->created_on));
						?></td>
						
						
						<td>						
							
							
							
							<input type="textbox" name="memo_requests_date_<?php echo $memo_limit;?>" id="memo_requests_date_<?php echo $memo_limit;?>" value="<?php echo $memo_request_date;?>" style="max-width: 80px;text-align: center;">
											
						
						
						
						
						
						</td>
						<td>
						<input type="textbox" name="expiry_date_<?php echo $memo_limit;?>" id="expiry_date_<?php echo $memo_limit;?>" value="<?php echo $expiry_date;?>" style="max-width: 80px;text-align: center;">
						
						
						
						
						
						</td>
						
						<td>
						
						<input value="APPROVE" type="button"  class="btn btn-primary" onClick="return approve(document.getElementById('memo_requests_date_<?php echo $memo_limit;?>').value,document.getElementById('expiry_date_<?php echo $memo_limit;?>').value,'<?php echo $memo_requests_rows->out_on_memo_id;?>','<?php echo $memo_requests_rows->product_name;?>','<?php echo $memo_requests_rows->email_id;?>','<?php echo $memo_requests_rows->product_id;?>','<?php echo $full_name;?>','<?php echo $memo_requests_rows->product_status;?>')" />​
						
					
						
						</td>
						<td><a href="<?php echo base_url('admin/out_on_memo/reject?id=').$memo_requests_rows->out_on_memo_id."&name=".$memo_requests_rows->username."&email=".$memo_requests_rows->email_id."&fullname=".$full_name;?>" class="btn btn-primary">REJECT</a></td>
						
						
                      
                      </tr>
						<?php
						
					}
					
					}
						?>
										
                      
                    </tbody>
                   
                  </table>
				<?php }else {
					
					
				}?>
                 </div><!-- /.box-body -->
              </div><!-- /.box -->

            
           

		   </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   