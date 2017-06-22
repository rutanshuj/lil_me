
<style>
	.form-control{
			width: inherit !important;
	}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/datatable.css');?>">
<link rel="StyleSheet" type="text/css" href="<?php echo base_url().'assets/dist/css/table.css';?>">
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
             On Memo Status
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> On Memo Status</li>
          </ol>
        </section>

     
         
		   <!-- Main content -->
        <section class="content">
		
		
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="<?php echo base_url('admin/out_on_memo');?>" class="btn btn-primary" > Memo Dashboard</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/out_on_memo/memo_requests');?>" class="btn btn-primary"" class="btn btn-primary" > Memo Requests</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/out_on_memo/on_memo_status');?>" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> On Memo Status</a></div>
					
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/out_on_memo/memo_history');?>" class="btn btn-primary"> Memo History</a></div>
					
					
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/out_on_memo/manual_add');?>" class="btn btn-primary"> Manual Add</a></div>
				</div>
				
				<script>
				function extend(date_id,id,product_name){
					if(date_id==''){
						alert("Please select date");
						
						return false
					} else {
						
						$.ajax({
							type: "POST",
							url: "<?php echo base_url('admin/out_on_memo/extend');?>",
							data: {                
								'date_id' : date_id,
								'id' : id,
							},
							dataType: 'json',
							success: function(response){								
							   alert('Memo request has been extended '+date_id+' for project '+product_name)
							}
						});
					
					
					}
				}
				
				</script>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Memo History (<?php echo count($memo_history);?>) </h3>
                </div><!-- /.box-header -->
				<?php if((validation_errors())||(isset($error) &&($error!=""))){ ?>
		<div class="margin_left_right_12 alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
               <?php echo validation_errors(); if(isset($error) &&($error!="")){echo $error;}?>
              </div>
		
		
		
		
		<?php 
		}
		?>
		<?php if(isset($success)){ ?>		
		
		
		
		<div class="margin_left_right_12 alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $success;?>
              </div>
		
		
		<?php 
		}
		?>
                <div class="box-body">
				
				<?php if(count($memo_history)!="0"){?>
				<form method="post" name="frm">
                <table id="example6" class="table table-bordered table-striped">
                    <thead>
                      <tr class="table_th_border">
                        <th>User Name</th>
                        <th>Product Id</th>
                        <th>Product Category</th>
                        <th>Product Sub-Category</th>
                         
                        <th>Memo Date/Shipping Date</th>
                        <th>Expiry Date</th>
                        <th></th>
                        <th></th>	
						<th></th>							
                      </tr>
                    </thead>
                    <tbody>
					<?php 
					
					$memo_history_total=count($memo_history);	
					if(count($memo_history)!="0"){
						$limit=0;
						foreach($memo_history as $memo_history_rows){
							$limit++;
						?>
						<tr>						
						<td><?php echo $memo_history_rows->username;?></td>
                        <td><?php echo $memo_history_rows->product_name;?></td>
                        <td><?php echo $memo_history_rows->category_name;?></td>
                        <td><?php echo $memo_history_rows->subcategory_name;?></td>
                       
						<td>
						
					
						
						
						
						
						<?php

if(isset($memo_history_rows->request_approve_date)&&($memo_history_rows->request_approve_date!="")){
								echo date("Y-m-d", strtotime($memo_history_rows->request_approve_date));
							} //else {
								//echo date("Y-m-d",strtotime("+1 week",  strtotime($memo_history_rows->created_on)));
							//}
						?>
						
						
						</td>
						
						
						
						
						
						<td>
						<?php 
						$expiry_date="";
						if(isset($memo_history_rows->expiry_date)&&($memo_history_rows->expiry_date!="")){
								//$expiry_date= $memo_history_rows->expiry_date;
								$expiry_date= date("Y-m-d", strtotime($memo_history_rows->expiry_date));
							}
						
?>
						<input class="form-control" type="textbox" name="datepicker_<?php echo $limit;?>" id="datepicker_<?php echo $limit;?>" value="<?php echo $expiry_date;?>" style=" max-width: 100px;">
						
						</td>
						<td><a href="<?php echo base_url('admin/out_on_memo/on_memo_status_sole?id=').$memo_history_rows->out_on_memo_id."&name=".$memo_history_rows->username."&product_id=".$memo_history_rows->product_id;?>" class="btn btn-primary" style="min-width: 54px;">Sold</a></td>
						<td><a href="<?php echo base_url('admin/out_on_memo/on_memo_status_return?id=').$memo_history_rows->out_on_memo_id."&name=".$memo_history_rows->username;?>" class="btn btn-primary" style="min-width: 54px;">Return</a></td>
						<td>
						
						<input style="min-width: 54px;" value="Extend" type="button"  class="btn btn-primary" onClick="return extend(document.getElementById('datepicker_<?php echo $limit;?>').value,'<?php echo $memo_history_rows->out_on_memo_id;?>','<?php echo $memo_history_rows->product_name;?>')" />​
						
						
						
						</td>
						
						
                      
                      </tr>
						<?php
						
					}
					
					}
						?>
										
                      
                    </tbody>
                   
                  </table>
				  </form>
				  
				<?php }else {
					
					
				}?>
                 </div><!-- /.box-body -->
              </div><!-- /.box -->

            
           

		   </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   