<style>
.dropdown-menu>li>a:hover{
        background-color: #27BFE2;
		color:white
    }
.dropdown-menu>li>a {
    
		color:#27BFE2
    }
.custom_ul{
	width:90%
}
 #filter_btn
  {
	   display:none
  }
@media (max-width: 768px) {
  #fliter_div{
	  display:none
  }
  #filter_btn
  {
	  margin-top:10px;
	   display:block
  }
  .custom_ul{
	width:100%
  }
}
#filter_resp_div
{
	display:none
}
.custom_ul{
	list-style-type:none
}
#filter_resp_div
{
	display:none height: 225px;
}
.pages a{
	    padding: 10px;
    font-size: 20px;
    color: #EF6ACA;
}
</style>
<div class="container" style="min-height: 430px;" >
	<section>
		
		
		
		
		<div class="col-sm-12">
			<p class="text-muted lead" align="center">
				<?php //echo $category_name?>
			</p>
		</p>
	</div>
	<div class="col-sm-12" >
		<div class="row cont_top" ">
			<?php 
				if(is_array($product_list)&&(count($product_list)!="0")) {
				foreach($product_list as $product_row){
				
				$file_headers = @get_headers($image_url);
				if(trim($product_row->image_url)!='') {
				$image_url=base_url().$product_row->image_url;
				} 
				else{
				$image_url = base_url().'assets/img/idle_image_web.jpg';  
				}
			?>
			
				<div class="col-md-3 col-xs-6">
					<div class="product">
						<div class="image">
							<a href="<?php echo base_url('products/').'/'.$product_row->category_slug.'/'.$product_row->product_slug.'/'.$product_row->product_id?>">
								<img src="<?php echo $image_url;?>" alt="" class="img-responsive image1" style="width:100%">
								</a>
							</div>
							<!-- /.image -->
							<div class="text" style=" height: 80px;">
								<h4>
									<a href="<?php echo base_url('products/').'/'.$product_row->category_slug.'/'.$product_row->product_slug.'/'.$product_row->product_id?>">
										<?php echo $product_row->product_name?>
									</a>
								</h4>
							</div>
							<!-- /.text -->
						</div>
						<!-- /.product -->
					</div>
					<?php
}
}
?>
					<!-- /.products -->
				</div>
				<div class="pages">
					<p  class="loadMore">
						
						<a href="#"><?php //echo $links?></a>
						
					</p>
				</div>
			</div>
		</section>
	</div>
	<script>
   	
	/////////////////



  </script>
