 <!-- Content Wrapper. Contains page content -->
 <link rel="StyleSheet" type="text/css" href="<?php echo base_url().'assets/dist/css/table.css';?>">
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Memo history
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">memo_history</li>
          </ol>
        </section>

     <script>
      $(function () {
		  $("[data-mask]").inputmask();
		  });
    </script>
         
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
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="<?php echo base_url('admin/diamond_out_on_memo');?>" class="btn btn-primary" > Memo Dashboard</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/memo_requests');?>" class="btn btn-primary"" class="btn btn-primary" > Memo Requests</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/on_memo_status');?>" class="btn btn-primary" > On Memo Status</a></div>
					
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/memo_history');?>" class="btn btn-primary"style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Memo History</a></div>
					
					
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/manual_add');?>" class="btn btn-primary"> Manual Add</a></div>
				</div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Memo History (<?php echo count($memo_history);?>) </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
				<?php if(count($memo_history)!="0"){?>
				
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr class="table_th_border">
                        <th>User Name</th>
                        <th>Product Id</th>
                       
                        
                        <th>Request Received On</th>
                        <th>Memo Date Requested</th>
                       
                        <th>Memo Date/ Shipping Date</th>
                        <th>Expiry Date</th>
                        <th>Current Status</th>
                        						
                      </tr>
                    </thead>
                    <tbody>
					<?php if(count($memo_history)!="0"){
						foreach($memo_history as $memo_history_rows){
						?>
						<tr>						
						<td><?php echo $memo_history_rows->username;?></td>
                        <td><?php echo $memo_history_rows->product_name;?></td>
                       
                       
                           <td><?php echo date("Y-m-d", strtotime($memo_history_rows->created_on)); ?></td>
						   
						   
						   
                           <td><?php echo date("Y-m-d", strtotime($memo_history_rows->memo_request_date)); ?></td>
						
						
										
						
						
						
						
						
						
						
						<td><?php echo date("Y-m-d", strtotime($memo_history_rows->request_approve_date));?></td>
						<td>
						<?php

if(isset($memo_history_rows->expiry_date)&&($memo_history_rows->expiry_date!="")){
								echo date("Y-m-d", strtotime($memo_history_rows->expiry_date));
							} else {
								echo date("Y-m-d",strtotime("+1 week",  strtotime($memo_history_rows->created_on)));
							}
						?></td>
						<td><?php echo $memo_history_rows->status;?></td>
						
						
						
						
						
                      
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
	  
	  
   