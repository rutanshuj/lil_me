 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Update product
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Update product</li>
          </ol>
        </section>
		
<script>
function validate_select() {
	
		var x = document.forms["product_select"]["product_id"].value;		
		
		if (x == null || x == "") {
			alert("Kindly select a Diamond Stock");
			document.forms["product_select"]["product_id"].focus();							
			return false;
		} else {				
			window.location.href = '<?php echo base_url("admin/product_diamond/edit?id=");?>'+x;			
			return false;
		}
		return false;
	}


	function validateForm() {
		var x = document.forms["product_add"]["product_id"].value.trim();
		var y = document.forms["product_add"]["category_id"].value.trim();
		var z = document.forms["product_add"]["sub_category"].value.trim();
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
<script>
	function jsfunction(){
		$('#products')
    .find('option')
    .remove()
    .end()
    .append('<option value="" selected>--select--</option>');		
		
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('admin/product');?>/get_sub_category_ids",
			data: {                
				'category_id' : $('#category_id').val()
			},
			dataType: 'json',
			success: function(response){				 
				document.getElementById("sub_category").innerHTML=response['sub_cate_data'];
				document.getElementById("products").innerHTML=response['product_data'];
				
				
			}
		});   
	}
	function get_products(){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('admin/product');?>/get_product_ids",
			data: {                
				'sub_category_id' : $('#sub_category').val()
			},
			success: function(response){
				document.getElementById("products").innerHTML=response;
				
			}
			
		});   
	}
</script>
         
		   <!-- Main content -->
        <section class="content">
		
		
		
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="<?php echo base_url('admin/product_diamond');?>" class="btn btn-primary" > Add</a></div>
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/product_diamond/edit');?>" class="btn btn-primary"" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Update</a></div>
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/product_diamond/product_delete');?>" class="btn btn-primary"> Delete</a></div>
				</div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Product Edit</h3>
                </div>
                <div class="box-body">
				<?php 
				if(!is_numeric($product_id)){
					?>
					<div class="col-xs-12">
					<form role="form" name="product_select" action="<?php echo base_url('admin/product_diamond/edit');?>" method="post" onsubmit="return validate_select()" enctype="multipart/form-data">
			 <div class="form-group">
				<div  style="float: left;width: 160px;">Diamond Stock:</div>
				<div>
				
				
				<select name="product_id" id="product_id" >
				<option value="">--select-- </option>
				<?php
			if(count($diamond_pro)>0){
				foreach($diamond_pro as $diamond_pro_row){
			?>
				
				<option value="<?php echo $diamond_pro_row->product_id ;?>"><?php echo $diamond_pro_row->product_name ;?></option>
				<?php
				}
			}
				?>
				</select>
				</div>
				
				
                </div>
			  
			   
			   
			   <div class="form-group">
				
				<div  style="float: left;width: 160px;">
				
				<input type="submit" class="btn btn-primary" id="submit" name="submit" value="Select Product" >
				</div>
				
				
				
                </div>
			   
			   </form>
					</div>
					<?php 
				
				} else {
		?>
			
              <div class="col-xs-12">
			 
			  <form role="form" name="product_add" action="<?php echo base_url('admin/product_diamond/edit?id=').$product_id;?>" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
			
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
				<div  style="float: left;width: 160px;">Stock Name :</div>
				<div>
				<textarea id="product_name" name="product_name" ><?php if(isset($product_name)){echo $product_name;}?></textarea>
				</div>			
				
               </div>
			   <div class="form-group">
				<div  style="float: left;width: 160px;">Certificate Name :</div>
				<div>
				<textarea id="certificate" name="certificate" ><?php if(isset($certificate)){echo $certificate;}?></textarea>
				</div>			
				
               </div>
			   
			   <div class="form-group">
				<div  style="float: left;width: 160px;">Add Certificate Image :</div>
				<div>
				
				<?php
				if(isset($certificate_images->image_url)){
					$image_url=base_url().$certificate_images->image_url;
				} else {
					$image_url = base_url().'assets/img/default.jpg';
				}
			
						
						/*  
						$file_headers = @get_headers($image_url);
						
						if($file_headers[0] == "HTTP/1.0 404 Not Found") {
							$image_url = base_url().'assets/img/default.jpg';
						}  */
						
				?>
			 <img src="<?php echo $image_url;?>" alt="Smiley face" height="75" width="75">	
					</div>			
				
               </div>
			<div class="form-group">
				<div  style="float: left;width: 160px;">Change certificate :</div>
				<div>
				<input type="file" name="userfile" id="userfile" multiple accept="image/x-png, image/gif, image/jpeg">
				</div>			
				
               </div>

			<?php
			if(count($attribute)>0){
				foreach($attribute as $active_row){
					$value="";
					if(isset($attribute_value[$active_row->attribute_id])){
						$value=$attribute_value[$active_row->attribute_id];
					}
					
			?>
			
                <div class="form-group">
				<div  style="float: left;width: 160px;"><?php echo $active_row->attribute_name;?> :</div>
				<div>
				<input type="input" value="<?php echo $value;?>" name="product_attribute[<?php echo $active_row->attribute_id;?>]">
				</div>
				
				
                </div>
				<?php
				}
			}
				?>
				
			
				
				<div class="form-group">
				  
				<?php 
				  
				if(is_array($product_images)&&(count($product_images)!="0")) {
					foreach($product_images as $product_images_row){
						
						
						if($product_images_row->image_url!=""){
							$image_url=base_url().$product_images_row->image_url;
						} else {
							$image_url = base_url().'assets/img/default.jpg';
						}
						
						
					 
						     
						  ?>    
	
						  <div  style="border-style: groove;float: left;    margin-right: 10px;" >
						  
						 <div style="float: left;">
						  <img src="<?php echo $image_url;?>" alt="Smiley face" height="75" width="75">
							</div> 
						
						  </div>
						  <?php
					  }
					
				  }
				  ?>
				
					</div>			
             
				
				<div class="form-group">
				
				<div>
				<a href="<?php echo base_url('admin/product_diamond/image_edit?id=').$product_id;?>" class="btn btn-primary">Modify Image</a>
				
				
				</div>
				
				
				
                </div>
				
				
				
				<div class="form-group">
				
				<div  style="float: left;width: 160px;">
				
				<input type="submit" class="btn btn-primary" id="submit" name="submit" value="Update Product" >
				</div>
				
				
				
                </div>
				
				
				
				
				
				
				</form>
				
				
				
				
				
             
              </div>
              <!-- /.box-body -->

          <?php
				}
		  ?>
         
                 </div><!-- /.box-body -->
              </div><!-- /.box -->

                        


		   </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	 
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   