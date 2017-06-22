 <!-- Content Wrapper. Contains page content -->

     
        <!-- Content Header (Page header) -->
           
         
		   <!-- Main content -->
        <section class="">
		
		
		<?php
		if(!isset($back_url)||($back_url!="")){
			$back_url='javascript:history.back()';
		}
		?>
		<h3>
		
		
		<p style="float: left;">Favorites (<?php echo $total_favorites;?>)</p>
		
		<a href="<?php echo $back_url;?>" style="float: right;padding-right: 10px;color: black;"><u>Back to user details</u></a>
		</h3>
		<?php 	
		if(isset($error)&&($error!="")){
			?>
			
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                <?php echo $error;?>
              </div>
			<?php
		}
			?>
          <div class="row">
		<div class="col-xs-12">
		
			 <?php 
					if(count($jewellery_favorites)>0){							 
						foreach($jewellery_favorites as $j_favorites_rows){
							
							
							
							
							
							
							
							if($j_favorites_rows->image_url==""){
							
								$image_url = base_url().'assets/img/default.jpg';
							} else {
							
								$image_url=base_url().$j_favorites_rows->image_url;
							}
							
						
							?>

		<div class="col-xs-4" style="border-style: groove;padding: 17px 0px 17px 0px;height: 115px;" >
			<div style="float: left;">
				<img src="<?php echo $image_url;?>" alt="Smiley face" height="75" width="75">
			</div> 
			<div>
				Product Name : <?php echo $j_favorites_rows->product_name;?>
				Category : <?php echo $j_favorites_rows->category_name;?><br>
				Sub Category :  <?php echo $j_favorites_rows->subcategory_name;?>
			</div>
		</div>

						<?php
						}
					}
					?>

		
		
		

		
		
		
		
			
			
							
		
          </div><!-- /.row -->
		  <div class="col-xs-12">
		  </div>
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
     