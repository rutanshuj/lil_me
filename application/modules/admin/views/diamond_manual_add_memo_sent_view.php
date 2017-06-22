 <!-- Content Wrapper. Contains page content -->
 <link rel="StyleSheet" type="text/css" href="<?php echo base_url().'assets/dist/css/table.css';?>">
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
             Manual Add
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> Manual Add</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content">
		
	
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="<?php echo base_url('admin/diamond_out_on_memo');?>" class="btn btn-primary" > Memo Dashboard</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/memo_requests');?>" class="btn btn-primary"" class="btn btn-primary" > Memo Requests</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/on_memo_status');?>" class="btn btn-primary" > On Memo Status</a></div>
					
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/memo_history');?>" class="btn btn-primary"> Memo History</a></div>
					
					
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/manual_add');?>" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Manual Add</a></div>
				</div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Following products has been sent on memo  </h3>
                </div><!-- /.box-header -->
				
				
                <div class="box-body">
				<?php if(isset($message)){ ?>		
		
		
		
		<div class="margin_left_right_12 alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $message;?>
              </div>
		
		
		<?php 
		}
		?>
				<?php if(count($product_memo_details)!="0"){?>
				<script>
				
				</script>
				
				
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr class="table_th_border">
					 
                        <th>User Name</th>
                        <th>Product Id</th>
                        <th>Request Sent On</th>
                        <th>Memo Date Requested</th>
                        <th>Memo Date Sent</th>
                        <th>Expiry Date</th>
                        <th>Current Status</th>
                                                						
                      </tr>
                    </thead>
                    <tbody>
					<?php if(count($product_memo_details)!="0"){
						foreach($product_memo_details as $product_memo_details_rows){
							
							
							
						?>
						<tr>
					
						<td><?php echo $product_memo_details_rows['user_name'];?></td>
                        <td><?php echo $product_memo_details_rows['product_id'];?></td>
                        <td><?php echo $product_memo_details_rows['request_sent_on'];?></td>
                        <td><?php echo $product_memo_details_rows['memo_date_requested'];?></td>
                        <td><?php echo $product_memo_details_rows['memo_date_sent'];?></td>
                        <td><?php echo $product_memo_details_rows['expiry_date'];?></td>
                        <td><?php echo $product_memo_details_rows['current_status'];?></td>
                       
                         
						   
						   
						  				
						
						
                      
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
	  
	  
   