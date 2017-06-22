 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Stock delete
            <small>update</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">stock_delete</li>
          </ol>
        </section>

   <script type="text/javascript" language="javascript" src="<?php echo base_url().'assets/dist/js/jquery-1.12.0.min.js';?>">
	</script>

	</script>
         
		   <!-- Main content -->
        <section class="content">
		
		<script language="JavaScript">

function do_this(){

        var checkboxes = document.getElementsByName('product_id[]');
        var button = document.getElementById('toggle');
		
		
		if($("#toggle").prop('checked') == true){
    //do something
	for (var i in checkboxes){
                checkboxes[i].checked = 'FALSE';
            }
} else {
	for (var i in checkboxes){
                checkboxes[i].checked = '';
            }
}
		
        
    }
	
</script>
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="<?php echo base_url('admin/diamond_manage_stock');?>" class="btn btn-primary" > Update</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_manage_stock/stock_delete');?>" class="btn btn-primary"" class="btn btn-primary"style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px" > Delete</a></div>
					
				
				</div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Delete Diamond Stocks  </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				<?php if(isset($success)){ ?>		
		
		
		
		<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $success;?>
              </div>
		
		
		<?php 
		}else if(isset($error)){ ?>		
		
		
		
		<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $error;?>
              </div>
		
		
		<?php 
		}
		?>	
				<?php if(count($diamond_stock_list)!="0"){?>
			
				<form role="form" name="d_stock_delete" action="<?php echo base_url('admin/diamond_manage_stock/stock_delete')?>" method="post" >
				
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
						<th  class="no-sort"><input type="checkbox"  id="toggle" name="toggle" onClick="do_this()"></th>
                        <th  class="no-sort">Name</th>
                        <th  class="no-sort">Availability</th>
                        <th  class="no-sort">Updated By</th>
                        <th  class="no-sort">Last Updated</th>                      
                       
                                                						
                      </tr>
					  
					  
                    </thead>
                    <tbody>
					<?php if(count($diamond_stock_list)!="0"){
						foreach($diamond_stock_list as $diamond_stock_rows){
							
							
							
						?>
						<tr>	
						
					 <td>
					 
					 <input type="checkbox" name="product_id[]" id="product_id"  value="<?php echo $diamond_stock_rows->product_id;?>">
					 
					</td>
						<td><?php echo $diamond_stock_rows->product_name;?></td>
                        <td><?php echo $diamond_stock_rows->status;?></td>
                        <td><?php echo $diamond_stock_rows->updated_by;?></td>
                        <td><?php echo $diamond_stock_rows->updated_on;?></td>
                       
                        
						
                      
                      </tr>
						<?php
						
					}
					
					}
						?>
										
                      
                    </tbody>
					
					 
                 
                  </table>
				  <div class="form-group">
				
				<div>
				
				<input type="submit" class="btn btn-primary" id="submit" name="submit" value="Delete Stock" >
				</div>
				
				
				
                </div>
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
	  
	  
   