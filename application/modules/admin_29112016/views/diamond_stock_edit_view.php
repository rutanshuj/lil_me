 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manage Stock
            <small>edit</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manage Stock</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content">
		
		
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="<?php echo base_url('admin/diamond_manage_stock');?>" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Update</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_manage_stock/stock_delete');?>" class="btn btn-primary"" class="btn btn-primary" > Delete</a></div>
						</div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Diamond stock edit</h3>
                </div>
                <div class="box-body">
				
				
		
			
              <div class="col-xs-12">
			  <script>
			  
			  
			  
			  
				  function validateForm() {
						var x = document.forms["d_stock_edit"]["product_name"].value.trim();
						var y = document.forms["d_stock_edit"]["availability"].value.trim();
						
						if (x == null || x == "") {
							alert("Product name is required");
							document.forms["d_stock_edit"]["product_name"].focus();							
							return false;
						}
						if (y == null || y == "") {
							alert("Kindly select a availability for the product");
							document.forms["product_add"]["availability"].focus();
							return false;
						}
						
					}			  
			  </script>
			  <form role="form" name="d_stock_edit" action="<?php echo base_url('admin/diamond_manage_stock/edit?id=').$diamond_stock_id;?>" method="post" onsubmit="return validateForm()" >
			
			<?php if(isset($successful)){ ?>		
		
		
		
		<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $successful;?>
              </div>
		
		
		<?php 
		}
		?>
			
			
			
			
			<div class="form-group">
				<div  style="float: left;width: 160px;">Name</div>
				<div><input type="input" name="product_name" id="product_name" value="<?php echo $product_name;?>"></div>
								
               </div>
			

			<div class="form-group">
				<div  style="float: left;width: 160px;">Availability</div>
				<div >
				<select name="availability" id="availability" >
				
					
					<option value="Out Of Stock" <?php if(isset($status) && (strtolower($status)=="out of stock")){echo "selected";}?>>Out Of Stock </option>
				<option value="Available"<?php if(isset($status) && (strtolower($status)=="available")){echo "selected";}?>>Available</option>
				</select>
				</div>
							
               </div>			   
				
				
				
				
				<div class="form-group">
				
				<div>
				
				<input type="submit" class="btn btn-primary" id="submit" name="submit" value="Update Stock" >
				</div>
				
				
				
                </div>
				
				
				
				
				
				
				</form>
				
				
				
				
				
             
              </div>
              <!-- /.box-body -->

          
         
                 </div><!-- /.box-body -->
              </div><!-- /.box -->

                        


		   </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   