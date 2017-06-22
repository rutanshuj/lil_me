 <!-- Content Wrapper. Contains page content -->
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
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/datatable.css');?>">
 <link rel="StyleSheet" type="text/css" href="<?php echo base_url().'assets/dist/css/table.css';?>">
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Manage stock
            <small>update</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">update</li>
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
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="<?php echo base_url('admin/diamond_manage_stock');?>" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Update</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_manage_stock/stock_delete');?>" class="btn btn-primary"" class="btn btn-primary" > Delete</a></div>
					
				
				</div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Edit Diamond Stocks  </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
				<?php if(count($diamond_stock_list)!="0"){?>
				<script>
				
				</script>
				
				
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr  class="table_th_border">
					  
                        <th class="width_20_persent">Name</th>
                        <th class="width_20_persent">Availability</th>
                        <th  class="width_20_persent">Updated By</th>
                        <th  class="width_20_persent">Last Updated</th>
                        <th class="no-sort width_20_persent" ></th>
                       
                                                						
                      </tr>
                    </thead>
                    <tbody>
					<?php if(count($diamond_stock_list)!="0"){
						foreach($diamond_stock_list as $diamond_stock_rows){
							
							
							
						?>
						<tr>	
					
						<td class="width_20_persent"><?php echo $diamond_stock_rows->product_name;?></td>
                        <td class="width_20_persent"><?php echo $diamond_stock_rows->status;?></td>
                        <td class="width_20_persent"><?php echo $diamond_stock_rows->updated_by;?></td>
                        <td class="width_20_persent"  align="center"><?php echo $diamond_stock_rows->updated_on;?></td>
                        <td sclass="width_20_persent"  align="center"><a href="<?php echo base_url('admin/diamond_manage_stock/edit?id=').$diamond_stock_rows->product_id;?>" class="btn btn-primary"> Edit</a></td>
                       
						
                      
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
	  
	  
   