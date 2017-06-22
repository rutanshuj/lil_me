 <style>
 .pages a{
	    padding: 10px;
    font-size: 20px;
    color: #EF6ACA;
}
 </style>
 <div class="container" style="min-height: 570px;">
  <section>
   
     <p class="text-muted lead" align="center">Favorites
    </p>
    <div class="col-sm-12">
      <div class="row cont_top">
        <?php 
				if(is_array($favorites)&&(count($favorites)!="0")) {
				foreach($favorites as $product_row){
				$image_url=base_url().$product_row->image_url;
				/* $file_headers = @get_headers($image_url);
				if($file_headers[0] == "HTTP/1.0 404 Not Found") {
				$image_url = base_url().'assets/img/default.jpg';
				}  */
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
              <a href="<?php echo base_url('products/').'/'.$product_row->category_slug.'/'.$product_row->product_slug.'/'.
				$product_row->product_id?>">
                <img src="<?php echo $image_url;?>" alt="" class="img-responsive image1">
              </a>
            </div>
            <!-- /.image -->
            <div class="text"  style="height: 80px;"">
              <h4>
                <a href="<?php echo base_url('products/').'/'.$product_row->category_slug.'/'.$product_row->product_slug.'/'.
				$product_row->product_id?>">
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
        <p class="loadMore">
          
          <a href="#"><?php echo $links?></a>
         
        </p>
      </div>
	  
      </section>
    </div>
</div>
  <script>
   
  </script>
