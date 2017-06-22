 <!-- Content Wrapper. Contains page content -->
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
					
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/memo_history');?>" class="btn btn-primary"> Memo History</a></div>
					
					
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/manual_add');?>" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Manual Add</a></div>
				</div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Stock List  </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
				<?php if(count($step_two_product)!="0"){?>
				<script>
				
				</script>
				<form method="post" action="<?php echo base_url('admin/diamond_out_on_memo/manual_add_select_product');?>" onsubmit="return validateForm()"  name="step_second" id="step_second">
				
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
					  <th></th>
                        <th>Stock Id</th>
                       
                        <th>Last Updated</th>
                                                						
                      </tr>
                    </thead>
                    <tbody>
					<?php if(count($step_two_product)!="0"){
						foreach($step_two_product as $step_two_product_rows){
							$checked="";
							if(isset($product_select[$step_two_product_rows->product_id])){
								$checked="checked";
							}
							
						?>
						<tr>

<td><input type="checkbox" <?php echo $checked;?> name="product_id[<?php echo $step_two_product_rows->product_id;?>]" id="product_id"  value="<?php echo $step_two_product_rows->product_name;?>"></td>						
						<td><?php echo $step_two_product_rows->product_name;?></td>
                      
                       
                          <td><?php echo date("Y-m-d", strtotime($step_two_product_rows->updated_on)); ?></td>
						   
						   
						  				
						
						
                      
                      </tr>
						<?php
						
					}
					
					}
						?>
										
                      
                    </tbody>
					<a href="<?php echo base_url('admin/diamond_out_on_memo/manual_add');?>" class="btn btn-primary">Back</a>
					 
                   <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Next">
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
	  
	  
   