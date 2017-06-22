<style = "text/css">
.img-responsive{
	margin-left: 0px;
}
</style>
  
  <div class="container" style="min-height= 430px;">
	 <div class="row">
     <div class="col-md-12" style="margin-right: -15px;padding: 9%;margin-left: 0%;padding-bottom: 0 !important;
    padding-top: 24px !important;">
	
	<?php if(is_array($home_images)&&(count($home_images)!="0")) {?>
	 <div id="main-slider">
					<?php foreach($home_images as $image){
						$file_headers = @get_headers($image);
						
						if($file_headers[0] == "HTTP/1.0 404 Not Found") {
							$image = base_url().'assets/img/default.jpg';
						} ?>
                   
                        <div class="item" >
                            <img src="<?php echo $image ?>" alt="" class="img-responsive">
                        </div>
                        
                   
                    <!-- /#main-slider -->
					<?php } ?>
					 </div>
			<?php	}?>
                </div>
            </div> 
				
							 
          
       <div class="row">

                <section>

                             
                    <div class="col-sm-12">
						
                   <?php if(isset($_SESSION['id'])) echo $_SESSION['username'];?>
                        <div class="row products">
					<?php 
				  
				if(is_array($category_list)&&(count($category_list)!="0")) {
					foreach($category_list as $category_row){
						if($category_row->image_url=='')
						{
						$image_url = base_url().'assets/img/default.jpg';	
						}
						else{
						$image_url = base_url().$category_row->image_url;		
						}
					 					 
						$file_headers = @get_headers($image_url);
						
						if($file_headers[0] == "HTTP/1.0 404 Not Found") {
							$image_url = base_url().'assets/img/default.jpg';
						}    
						  ?>
						
                            <div class="col-md-3 col-xs-6">
                                <div class="product">
                                    <div class="image">
                                        <a href="<?php echo base_url('products/').'/'.$category_row->category_slug.'/1'?>">
                                            <img src="<?php echo $image_url;?>" alt="" class="img-responsive image1">
                                        </a>
                                    </div>
                                    <!-- /.image -->
                                    <div class="text" style=" height: 50px;">
                                        <h4><a href="<?php echo base_url('products/').'/'.$category_row->category_slug.'/1'?>"><?php echo $category_row->category_name?></a></h4>
                                    </div>
                                    <!-- /.text -->
                                </div>
                                <!-- /.product -->  
                            </div>

                            <?php
					  }
				  }
				  ?>
                    </div>
                </section>

            </div>

			
		</div>
		</div>
	
 


		
