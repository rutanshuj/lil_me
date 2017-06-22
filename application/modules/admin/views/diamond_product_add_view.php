 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Product
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">verify_admin</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content">
		
		
		
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Add</a></div>
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/product_diamond/edit');?>" class="btn btn-primary"" class="btn btn-primary"> Update</a></div>
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/product_diamond/product_delete');?>" class="btn btn-primary"> Delete</a></div>
				</div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Product Add</h3>
                </div>
                <div class="box-body">
				
				
		
			
              <div class="col-xs-12">
			  <script>
			  
			  
			  
			  
				  function validateForm() {
						var x = document.forms["product_diamond"]["stock_name"].value;
						var y = document.forms["product_diamond"]["certificate_name"].value;
						
						if (x == null || x == "") {
							alert("Product Id is required");
							document.forms["product_diamond"]["stock_name"].focus();							
							return false;
						}
						//if (y == null || y == "") {
						//	alert("Kindly select a category for the product");
						//	document.forms["product_diamond"]["certificate_name"].focus();
						//	return false;
						//}
						
					}			  
			  </script>
			  <form role="form" name="product_diamond" action="<?php echo base_url('admin/product_diamond');?>" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
			
			<?php if((validation_errors())||(isset($error) &&($error!=""))){ ?>
		<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
               <?php echo validation_errors(); if(isset($error) &&($error!="")){echo $error;}?>
              </div>
		
		
		
		
		<?php 
		}else if(isset($success)){ ?>		
		
		
		
		<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $success;?>
              </div>
		
		
		<?php 
		}
		?>
			
			
			   <script>
			   
						   
			   
			   
			   function jsfunction(){
				    $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/product');?>/get_sub_category_ids",
            data: {                
                'category_id' : $('#category_id').val()
            },
			dataType: 'json',
            success: function(response){
				
               document.getElementById("sub_category").innerHTML=response['sub_cate_data'];
            }
        });   
}
			   </script>

			
			   
			   
			   
			   <div class="form-group">
				<div  style="float: left;width: 160px;">Stock Name :</div>
				<div>
				<input type="text" value="" name="stock_name" id="stock_name">
				
				</div>			
				
               </div>
			   <div class="form-group">
				<div  style="float: left;width: 160px;">
Certificate Name :</div>
				<div>
				<input type="text" value="" name="certificate_name" id="certificate_name">	
				</div>			
				
               </div>
			   <div class="form-group">
				<div  style="float: left;width: 160px;">
Add Certificate Image :</div>
				<div>
				<input type="file" name="certificate" id="certificate">
				</div>			
				
               </div>
			 
			
			<?php
			if(count($attribute)>0){
				foreach($attribute as $active_row){
			?>
			
                <div class="form-group">
				<div  style="float: left;width: 160px;"><?php echo $active_row->attribute_name;?> :</div>
				<div>
				<input type="input" value="" name="product_attribute[<?php echo $active_row->attribute_id;?>]">
				</div>
				
				
                </div>
				<?php
				}
			}
				?>
				
			
				
							
             
				
				<div class="form-group">
				
				<div>
				<input type="file" name="multi_upload[]" id="multi_upload[]" multiple accept="image/x-png, image/gif, image/jpeg">
				
				</div>
				
				
				
                </div>
				
				
				
				<div class="form-group">
				
				<div  style="float: left;width: 160px;">
				
				<input type="submit" class="btn btn-primary" id="submit" name="submit" value="Add Product" >
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
	  
	  
   