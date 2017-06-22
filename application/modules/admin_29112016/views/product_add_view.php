 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Product
            <small>Add</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Product</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content">
		
		
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Add</a></div>
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/product/edit');?>" class="btn btn-primary"" class="btn btn-primary"> Update</a></div>
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/product/product_delete');?>" class="btn btn-primary"> Delete</a></div>
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
						var x = document.forms["product_add"]["product_id"].value;
						var y = document.forms["product_add"]["category_id"].value;
						var z = document.forms["product_add"]["sub_category"].value;
						if (x == null || x == "") {
							alert("Product Id is required");
							document.forms["product_add"]["product_id"].focus();							
							return false;
						}
						if (y == null || y == "") {
							alert("Kindly select a category for the product");
							document.forms["product_add"]["category_id"].focus();
							return false;
						}
						if (z == null || z == "") {
							alert("Kindly select a sub-category for the product");
							document.forms["product_add"]["sub_category"].focus();
							return false;
						}
					}			  
			  </script>
			  <form role="form" name="product_add" action="<?php echo base_url('admin/product');?>" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
			
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
			
			<div class="form-group">
				<div  style="float: left;width: 160px;">Product Id</div>
				<div style="float: left;width: 160px;"><input type="input" name="product_id" id="product_id"></div>
				<div  style="float: left;"><input type="checkbox" name="new_product_checkbox" id="new_product_checkbox"  value="1"></div>
				<div>New Product</div>				
               </div>
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

			<div class="form-group"  style="padding-top: 7px;">
				<div  style="float: left;width: 160px;">Category</div>
				<div style="float: left;width: 160px;">
				<select name="category_id" id="category_id" onChange="jsfunction()" style="max-width: 137px;width: 137px;height: 30px;
   
">
				<option value="">Please select </option>
				<?php
			if(count($category_list)>0){
				foreach($category_list as $category_row){
			?>
				
				<option value="<?php echo $category_row->category_id ;?>"><?php echo $category_row->category_name ;?></option>
				<?php
				}
			}
				?>
				</select>
				</div>
				<div  style="float: left;"><input type="checkbox" name="hot_product_checkbox" id="hot_product_checkbox" value="1"></div>
				<div>Hot Product</div>				
               </div>
			   
			   <div class="form-group" style="padding-top: 10px;">
				<div  style="float: left;width: 160px;">Sub-Category</div>
				<div> <select id="sub_category" name="sub_category" style="max-width: 137px;width: 137px;height: 30px;"><option value="">Please select Category</option> </select>
		 
		 
		 	</div>			
				
               </div>
			   <div class="form-group">
				<div  style="float: left;width: 160px;">Describe Your Product</div>
				<div>
				<textarea id="describe" name="describe" style="max-width: 137px;"></textarea>
				</div>			
				
               </div>
			
			<?php
			if(count($attribute)>0){
				foreach($attribute as $active_row){
			?>
			
                <div class="form-group">
				<div  style="float: left;width: 160px;"><?php echo $active_row->attribute_name;?> :</div>
				<div  style="float: left;width: 160px;"><?php echo $active_row->attribute_type;?> </div>
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
	  
	  
   