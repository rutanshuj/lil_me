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
					<a href="<?php echo base_url('admin/stock');?>" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Stock List</a></div>
				
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/stock/manage_stock');?>" class="btn btn-primary" > Manage Stock</a></div>
				</div>
		  
            <div class="col-xs-12">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Manage News</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
				<?php if(count($stock_list)!="0"){
					?>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Product id</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Last Updated</th>
                       
                       
						
                      </tr>
                    </thead>
                    <tbody>
					<?php if(count($stock_list)!="0"){
						foreach($stock_list as $active_rows){
						?>
								
                      <tr>
                        <td><?php echo $active_rows->product_name;?></td>
                        <td><?php echo $active_rows->category_name;?></td>
                        <td><?php echo $active_rows->subcategory_name;?></td>
                        <td><?php echo $active_rows->updated_on;?></td>
                        
                       					
						
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
	  
	  
   