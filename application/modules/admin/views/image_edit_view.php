 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Mood Images
            <small> edit</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mood</li>
          </ol>
        </section>
		
<script>
function validate_select() {
		var x = document.forms["product_select"]["category_id"].value;
		//var y = document.forms["product_select"]["sub_category"].value;
		var z = document.forms["product_select"]["products"].value;
		
		if (x == null || x == "") {
			alert("Product Id is required");
			document.forms["product_select"]["category_id"].focus();							
			return false;
		} else
		//if (y == null || y == "") {
		//	alert("Kindly select a category for the product");
		//	document.forms["product_select"]["sub_category"].focus();
		//	return false;
		//} else
		if (z == null || z == "") {
			alert("Kindly select a sub-category for the product");
			document.forms["product_select"]["products"].focus();
			return false;
		} else {
			
			window.location.href = '<?php echo base_url("admin/product/edit?id=");?>'+z;			
			return false;
		}
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
		
		
		<?php if(isset($message)){ ?>
		<div class="alert alert-error __web-inspector-hide-shortcut__">
		<button class="close" data-dismiss="alert"></button><?php echo $message;?></div>
		<?php 
		}
		?>
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;" >
					<a href="<?php echo base_url('admin/mood');?>" class="btn btn-primary" > List</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/mood/mood_modify');?>" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Modify</a></div>
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/mood/bulk_image_upload');?>" class="btn btn-primary" > Bulk Image Upload</a></div>
					
				</div>
            <div class="col-xs-12">
              <div class="box">
                
                <div class="box-body">
				<?php 
				//if(!is_numeric($product_id)){
					
				//} else {
		?>
			<?php if((validation_errors())||(isset($error) &&($error!=""))){ ?>
		<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
               <?php echo validation_errors(); if(isset($error) &&($error!="")){echo $error;}?>
              </div>
		
		
		
		
		<?php 
		}
		?>
		<?php if(isset($success)){ ?>		
		
		
		
		<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $success;?>
              </div>
		
		
		<?php 
		}
		?>
              <div class="col-xs-12">
			 
			 
			 <div class="form-group">
				<!--
				<div>
							   <form role="form" name="product_add" action="<?phpecho base_url('admin/mood/mood_modify');?>" method="post" enctype="multipart/form-data">
				<div style="float: left;">			  
				<input type="file" name="multi_upload[]" id="multi_upload[]" multiple accept="image/x-png, image/gif, image/jpeg">
				</div>
				<div style="float: left;">
								<input type="submit" class="btn btn-primary" id="upload" name="upload" value="Upload" >
								</div>
				</form> 
				</div>
				
				-->
				
                </div>
				<div class="col-xs-12"></div>
			 
			 
			  <form role="form" name="product_add" action="<?php echo base_url('admin/mood/mood_modify');?>" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
			
			
		<b>	Please select for delete::</b><br>
		 <div class="row" style ="display: block;height: 500px;overflow-y: auto ;    margin-right: 0px  !important;
    margin-left: 0px  !important; ">
		
		
				<?php 				  
				if(is_array($result)&&(count($result)!="0")) {
					foreach($result as $result_row){
						if($result_row['image_thumbnail_url']!=""){
							$image_url=base_url().$result_row['image_thumbnail_url'];
						} else {
							$image_url = base_url().'assets/img/default.jpg';
						}	
						  ?>    
						  
						  
						  
						  <div class="col-lg-3 col-xs-6">
						  <div class="small-box">
                <div class="inner" style="text-align: center;color: #333 !important;">
	
	 <img src="<?php echo $image_url;?>" alt="Smiley face" width="170" height="200"><br>
	<input type="checkbox" name="image_del[]" value="<?php echo $result_row['image_id'];?> ">
		<?php if($result_row['is_mobile']=="0"){echo "Desktop";}else{echo "Mobile";}?>
	
	
	 </div></div></div>
	 
	 
	 
						  <!--
						  
						  
      <div  style="float: left;    margin-right: 10px;" >
						 <div style="float: left;">
						  <img src="<?php //echo $image_url;?>" alt="Smiley face" height="75" width="75">
						 	</div> 
							<div>
							<input type="checkbox" name="image_del[]" value="<?php //echo $result_row['image_id'];?> ">
		<?php //if($result_row['is_mobile']=="0"){echo "Desktop";}else{echo "Mobile";}?>
							</div>
						  </div>
						  -->
						  
						  
						  <?php
					  }		
				  }
				  ?>				  
			
			</div>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
				  		
				 
				<?php 

			/* 	
			echo "<div class=\"form-group\">";				
			if(is_array($result)&&(count($result)!="0")) {
					foreach($result as $result_row){
						if($result_row['image_thumbnail_url']!=""){
							$image_url=base_url().$result_row['image_thumbnail_url'];
						} else {
							$image_url = base_url().'assets/img/default.jpg';
						}	
						  ?>    
      <div  style="float: left;    margin-right: 10px;" >
						 <div style="float: left;">
						  <img src="<?php echo $image_url;?>" alt="Smiley face" height="75" width="75">
						 	</div> 
							<div>
							<input type="checkbox" name="image_del[]" value="<?php echo $result_row['image_id'];?> ">
		<?php if($result_row['is_mobile']=="0"){echo "Desktop";}else{echo "Mobile";}?>
							</div>
						  </div>
						  <?php
					  }		
				  } 
				  echo "</div>	";
				  */
				  ?>				  
						
             
				
				
				
				
				<div class="form-group">
				
				<div  style="width: 160px;">
				
				<input type="submit" class="btn btn-primary" id="submit" name="delete" value="Delete Image" >
				</div>
				
				
				
                </div>
				
				
				
				
				
				
				</form>
				
				
				
				
				
             
              </div>
              <!-- /.box-body -->

          <?php
				//}
		  ?>
         
                 </div><!-- /.box-body -->
              </div><!-- /.box -->

                        


		   </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	 
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   