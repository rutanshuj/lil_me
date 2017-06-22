


	                 
     <div class="container">
                     <div class="col-md-12" style="margin-right: -15px;padding: 9%;margin-left: 0%;padding-bottom: 0 !important;
    padding-top: 0 !important;">
                    <div id="main-slider">
                        <div class="item">
                            <img src="<?php echo base_url();?>assets/img/main-slider1.jpg" alt="" class="img-responsive">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="<?php echo base_url();?>assets/img/main-slider2.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="<?php echo base_url();?>assets/img/main-slider3.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="<?php echo base_url();?>assets/img/main-slider4.jpg" alt="">
                        </div>
                    </div>
                    <!-- /#main-slider -->
                </div>
            </div> 
				
							 
          
                 <div class="container">

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
						
                            <div class="col-md-3 col-sm-4">
                                <div class="product">
                                    <div class="image">
                                        <a href="shop-detail.html">
                                            <img src="<?php echo $image_url;?>" alt="" class="img-responsive image1">
                                        </a>
                                    </div>
                                    <!-- /.image -->
                                    <div class="text">
                                        <h4><a href="<?php echo base_url('web/home/products_by_param')."?category_id=".$category_row->category_id?>"><?php echo $category_row->category_name?></a></h4>
                                    
                                        
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
					<div class="pages">

                            <p class="loadMore">
                                <a href="#" class="btn btn-template-main"><i class="fa fa-chevron-down"></i> Load more</a>
                            </p>

                           
                    </div>

                </section>

            </div>

			
		
	
 


		
