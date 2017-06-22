 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/datatable.css');?>">

 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Delete product
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Delete product</li>
          </ol>
        </section>
		
<script>
function validate_select() {
		var x = document.forms["product_select"]["product_id"].value;
		//var y = document.forms["product_select"]["sub_category"].value;
		//var z = document.forms["product_select"]["products"].value;
		
		if (x == null || x == "") {
			alert("Kindly select a Stock Name");
			document.forms["product_select"]["product_id"].focus();							
			return false;
		} //else
		//if (y == null || y == "") {
		//	alert("Kindly select a category for the product");
		//	document.forms["product_select"]["sub_category"].focus();
		//	return false;
		//} else
		//if (z == null || z == "") {
			//alert("Kindly select a sub-category for the product");
			//document.forms["product_select"]["products"].focus();
			//return false;
		//} 
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
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/product_diamond/edit');?>" class="btn btn-primary"" class="btn btn-primary"> Update</a></div>
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/product_diamond/product_delete');?>" class="btn btn-primary"  style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Delete</a></div>
				</div>
             <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Product Delete</h3>
                </div>
				<?php if((validation_errors())||(isset($error) &&($error!=""))){ ?>
		<div class="alert margin_left_right_12 alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
               <?php echo validation_errors(); if(isset($error) &&($error!="")){echo $error;}?>
              </div>
		
		
		
		
		<?php 
		}else if(isset($success)){ ?>		
		
		
		
		<div class="alert margin_left_right_12 alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $success;?>
              </div>
		
		
		<?php 
		}
		?>
                <div class="box-body">
				
				<?php 
				if(!is_numeric($product_id)){
					?>
					<div class="col-xs-12">
					<form role="form" name="product_select" action="<?php echo base_url('admin/product_diamond/product_delete');?>" method="post" onsubmit="return validate_select()" enctype="multipart/form-data">
			 <div class="form-group">
				<div  style="float: left;width: 160px;">Stock Name :</div>
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
				
				<input type="submit" class="btn btn-primary" id="submit" name="submit" value="Delete Product" >
				</div>
				
				
				
                </div>
			   
			   </form>
					</div>
					<?php 
					
					
					
					
				} 
		?>
			
                  <!-- /.box-body -->

         
                 </div><!-- /.box-body -->
              </div><!-- /.box -->

                        


		   </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	 
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   