 <div id="all">

        <div id="content">
            <div class="container"> 

 <div class="col-sm-12" id="blog-listing">
	 <div class="col-sm-6">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
	<?php //print_r($product_images);
	if(isset($product_images) && count($product_images)!=0)
		{
		foreach($product_images as $img_row){
			//echo  $img_row->image_url ?>
      <div class="item active">
	  
        <img src="<?php if(($img_row->image_url!='')|| isset($img_row->image_url))echo base_url().$img_row->image_url;?>">
      </div>
		<?php 
		}}
		else{ ?>
		 <img src="<?php echo  base_url().'assets/img/default.jpg';?>">	
		<?php	}?>
      </div>
	</div>
		<?php $i=0;?>
		<div class="quant-div-detail"">
		   <span style="float: left; margin-top: 3px; font-size: 1.5em;">Quantity :</span> 
		   <a id="subtract" onclick="decrementValueForSingleProduct(<?php echo $product_id.$i ;?>)">
			  <img src="<?php echo base_url();?>assets/svgs/minus-circle-outline.svg">
			</a>
			<input class ="quant-text" type="text" id="<?php echo $product_id.$i ;?>" value="<?php echo $i; ?>">
			<a id="add" onclick="incrementValueForSingleProduct(<?php echo $product_id.$i ;?>)">
			  <img src="<?php echo base_url();?>assets/svgs/plus-circle-outline.svg">
			</a>
			</div><button class="btn btn-info" id= 'cart_desk' type="button" style="width:20%;margin-left: 32%;" onclick="add_to_cart(<?php echo $product_id.$i?>,<?php echo $product_id ?>)">Add To Cart</button>
	</div>
<div class="col-sm-6" style="padding-left: 8%;">
		<?php
		if(isset($product_data) && is_array($product_data)&&(count($product_data)!="0")) {
		foreach($product_data as $row){
			
		?>
			 <div class="pdetail name"><?php echo $row->product_name; ?></div>
			  <div class="pdetail price"> &#8377; <?php echo $row->Price ?> </div>
			  <div class="pdetail title" style="padding-bottom: 0px;">Brand	 </div>
			  <div class="pdetail" ><?php echo $row->brand; ?>	 </div>
			  <div class="pdetail title" style="padding-bottom: 0px;">Size	 </div>
			    <select class="size" id="sizedd" name="cars" >
				<?php
				foreach($size_available as $size_row)
				{
				?>
				<option value="<?php echo $size_row->size_id;?>">
				<?php echo $size_row->size_title?>
				</option>
			  <?php }?>
			  </select>
			  <div class="pdetail title" style="padding-bottom: 0px;">	Code </div>
			  <div class="pdetail">hjskd12355 </div>
		<button class="btn btn-info" id= 'cart_mob' type="button" onclick="add_to_cart(<?php echo $product_id.$i?>,<?php echo $product_id ?>)">Add To Cart</button>
	 </div>
		

<?php }
		} ?>
<script>
function add_to_cart(quantity,target) {
	
	var user_id=1;
	var api_key='fb0aa13efb9ac71e1c09094d7102d798';
	var e = document.getElementById("sizedd");
	var size_id = e.options[e.selectedIndex].value;
	var quantity=document.getElementById(quantity).value;
	//alert(quantity);
	$.ajax({
				type: "POST",
				dataType:"json",
				url: "<?php echo base_url()."web/Cart/add"?>",				
				data: {product_id: target,user_id:user_id,api_key:api_key,size:size_id ,quantity:quantity},
			
									success:  function(data){  																		
									if(data['statusCode']==0)
									{
										alert(data['message']);
									}
									else{
										alert(data['message']);
										 location.reload();
									}
								
																	
									}, 
					error: function(){
					  	alert("Fail");
					  	}
			   	});	
		}
</script>
		  <div class="row portfolio-project">
                        <div class="col-md-8">
                            <div class="heading">
                                <h3>Project description</h3>
                            </div>

                            <p>Bringing unlocked me an striking ye perceive. Mr by wound hours oh happy. Me in resolution pianoforte continuing we. Most my no spot felt by no. He he in forfeited furniture sweetness he arranging. Me tedious so to behaved
                                written account ferrars moments. Too objection for elsewhere her preferred allowance her. Marianne shutters mr steepest to me. Up mr ignorant produced distance although is sociable blessing. Ham whom call all lain like.</p>

                            </div>
                       
                    </div>

           

		   </div>
		   
		   </div>
	   </div>
	</div>