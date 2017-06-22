 
<script type="text/javascript">
	var p1="2";
	function f1(){
		
	if(p1=="3"){
		
		jq('a[href="<?php echo base_url('web/signup/login');?>"]').click();
    jq('a[href="<?php echo base_url('web/signup/login');?>"]').fancybox({
        'autoScale': true,
        'transitionIn': 'elastic',
        'transitionOut': 'elastic',
        'speedIn': 500,
        'speedOut': 300,
        'autoDimensions': true,
        'centerOnScroll': true  // as MattBall already said, remove the comma
    });

	}else {
		alert("hahahhaa");
			
	}}
	
</script>
<div id="all">
	<style>
.carousel-inner>.item>img, .carousel-inner>.item>a>img {
    width:50%;
	
}
#quantity
{
	width:93%
}
.product_name{
	margin-top:7%
}
#size_div{
margin-left: 5%;
}
@media (max-width: 760px) {
	.product_name{
	margin-top:13%
}
#quantity
{
	width:50%
}

#size_div{
margin-left: 0%;
}
}
@media (max-width: 771px) {
#add_cart{
	    padding-top: 32px;
}
}



</style>
	<div id="content" style="min-height: 570px;">
		<div class="container cont_top" >
			<?php
		if(isset($product_data)) {
		
		?>
			<div class="col-sm-12" id="blog-listing">
				<div class="col-sm-6">
					<?php if ($like_flag==0)
			$icon_path=base_url('assets/svgs/lil me icons_like outline.svg');
			else
			$icon_path=base_url('assets/svgs/lil me icons_liked.svg');?>
					<a id="like" class="btn" href="#"
						 style="float: right;z-index: 10; position:relative" onclick="like_product(this)" product_id="<?php echo $product_id?>" like_flag="<?php echo $like_flag?>">
						<img src="<?php echo $icon_path;?>" 
							 style="height: 30px;margin-right: 10%;">
						</a>
						<div id="myCarousel" class="carousel slide" data-ride="carousel" >
							<!-- Indicators -->
							<!-- Wrapper for slides -->
							<div class="carousel-inner" role="listbox">
								<?php //print_r($product_images);
	$i=0;
	if(isset($product_data->image_url) && count($product_data->image_url)!=0)
		{
		foreach($product_data->image_url as $img_row){
			$i++;$select='';
			if($i==1)
				$select='active';
			 ?>
								<div class="item <?php echo $select?>" align="center">
									<img src="<?php if(($img_row!='')|| isset($img_row))echo base_url().$img_row;?>"
									 style="margin-left: 32px;">
									</div>
									<?php 
		}}
		else{ ?>
									<img src="
										<?php echo  base_url().'assets/img/default.jpg';?>" style="margin-left: 32px;">
										<?php	}?>
									</div>
									<ol class="carousel-indicators">
										<?php $j=0;
									   foreach($product_data->image_url as $img_row){
										   $select_ol='';  
										   if($j=="0"){
										  $select_ol='active';  
										   }
										  ?>
										<li data-target="#myCarousel" data-slide-to="<?php echo $j;?>" class="
											<?php echo $select_ol;?>">
										</li>
										<?php $j++;} ?>
									</ol>
								</div>
								<div class="col-sm-12 product_name">
									<div class="pdetail title" align='center' style="padding-top: 12px;">
										<?php echo $product_data->product_name; ?>
									</div>
									<div class="pdetail price"  align='center'> &#8377; 
										<?php echo $product_data->price ?>
									</div>
								</div>
							</div>
							<div class="col-sm-6" >
								<div class="col-sm-12">
									<div class="heading" >
										<h3 style="margin-top: 15px;">Product description</h3>
									</div>
									<p style="font-size: 1.3em;">
										<?php echo $product_data->description->attribute_value ?>
									</p>
								</div>
								<?php $i=1;?>
								<div style="padding-bottom: 15px;float:left"  class="col-sm-3">
									<div class="pdetail title" style="font-size: 23px;">Quantity</div>
									<div class="quant-div-detail">
										<input id='quantity' min='1' type="number" value="" class="form-control" placeholder="1" style="z-index: 10;position: relative;width: 60px;">
										</div>
									</div>
									<div style="padding-bottom: 15px;float:left" class="col-sm-3" id='size_div'>
										<div class="pdetail title" style="font-size: 23px;">Size	 </div>
										<div class="form-group">
											<select class="size form-control"  data-style="btn-info" id="sizedd" name="cars" style="z-index: 10;position: relative;width: 70px;" >
												<?php
												foreach($product_data->size as $size_id=>$size_row)
												{
												?>
												<option value="<?php echo $size_id;?>"><?php echo $size_row?></option>
												<?php }?>
											</select>
										</div>
									</div>
									<div style="padding-bottom: 15px;" id="add_cart" class="col-sm-12">
							<button class="btn btn-info" style="width: 200px;" type="button" onclick="add_to_cart(<?php echo $product_id ?>)">Add To Cart
							</button>
									</div>
									<div style="padding-bottom: 15px;" class="col-sm-12">
									<span id="cart_result" style="font-size: 20px;color: #EF6ACA;"></span>
									</div>
									<?php if(isset($product_data->attributes) && count($product_data->attributes)!=0)
									{$i++;$select='';
									foreach($product_data->attributes as $index=>$attribute_row){?>
									<div style="padding-bottom: 15px;" class="col-sm-12">
										<div class="pdetail title" style="font-size: 23px;">
											<?php echo $attribute_row->attribute_name ;?>
										</div>
										<div class="pdetail">
											<?php echo $attribute_row->attribute_value ;?>
										</div>
									</div>
									<?php } }?>
								</div>
								<?php //}
		} ?>
					</div>
				</div>
			</div>
<script>



function add_to_cart(target) {
	var user_id='<?php echo $this->session->userdata('user_id');?>';//1;
	var api_key='<?php echo $this->session->userdata('api_key');?>';//'fb0aa13efb9ac71e1c09094d7102d798';
	var e = document.getElementById("sizedd");
	var size_id = e.options[e.selectedIndex].value;
	var quantity=$("#quantity").val();
	var product_name="<?php echo $product_data->product_name;?>";
	var price='<?php echo $product_data->price ;?>';
	if(quantity=='')
	{
		quantity=1;
	}
	if(user_id!='' && api_key!='')
	{ 
			$.ajax({
				type: "POST",
				dataType:"json",
				url: "<?php echo base_url()."web/Cart/add"?>",				
				data: {product_id: target,user_id:user_id,api_key:api_key,size:size_id ,quantity:quantity,product_name:product_name,price: price},
			
									success:  function(data){  
									
									document.getElementById('cart_result').style.visibility = 'visible';
									if(data['statusCode']==0){
										
									//$("#cart_result").text(data['message']);
									$("#cart_result").fadeOut(1, function() {
										$(this).text(data['message']).fadeIn();
										});
									}
									else{
										// setTimeout(function(){
											// document.getElementById('cart_result').style.visibility = 'hidden';
											// }, 300000);
										$("#cart_result").fadeOut(1, function() {
											$(this).text(data['message']).fadeIn();
											});
											//$("#cart_result").text(data['message']);
											
										//alert(data['message']);
										}								
										}, 
					error: function(){
					  	alert("Fail");
					  	}
			   	});	
		
	}else{
		
		
		
		jq('a[href="<?php echo base_url('web/signup/login');?>"]').click();
		jq('a[href="<?php echo base_url('web/signup/login');?>"]').fancybox({
       'autoDimensions': false,
        'transitionIn': 'none',
        'transitionOut': 'none',
        'speedIn': 500,
        'speedOut': 300,
		'width'         : 940,
'height'        : 400,
'autoScale'     : false,
       // 'autoDimensions': true,
        'centerOnScroll': true  // as MattBall already said, remove the comma
    });

	}

		}
function like_product(product) {
	var product_id =product.getAttribute('product_id');
	var like_flag =product.getAttribute('like_flag');
	//alert(like_flag);
	if(like_flag==1)
	{
		like_flag=0;
	}
	else if(like_flag==0)
	{
		like_flag=1;
	}
	
	var user_id='<?php echo $this->session->userdata('user_id');?>';//1;;
	var api_key='<?php echo $this->session->userdata('api_key');?>';
	if(user_id!='' && api_key!='')
	{
	$.ajax({
				type: "POST",
				dataType:"json",
				url: "<?php echo base_url()."web/user/addtofavourites"?>",				
				data: {product_id: product_id,user_id:user_id,api_key:api_key,like_flag:like_flag },
			
									success:  function(json_data){  																		
									if(json_data['statusCode']==0)
									{
								//alert(json_data['message']);
								
									}
									else{
										
								//alert(json_data['message']);
								if(json_data['event']==1)
								{
								$('#like img').attr("src",'<?php echo base_url('assets/svgs/lil me icons_liked.svg');?>');
								$('#like').attr('like_flag',1)
								}else{
								$('#like img').attr("src",'<?php echo base_url('assets/svgs/lil me icons_like outline.svg');?>');	
								$('#like').attr('like_flag',0)
								}
								}
									
								}, 
					error: function(){
					  	alert("Fail");
					  	}
			   	});	

		}
		else{
		
		
		
		jq('a[href="<?php echo base_url('web/signup/login');?>"]').click();
		jq('a[href="<?php echo base_url('web/signup/login');?>"]').fancybox({
        'autoScale': true,
        'transitionIn': 'elastic',
        'transitionOut': 'elastic',
        'speedIn': 500,
        'speedOut': 300,
        'autoDimensions': true,
        'centerOnScroll': true  // as MattBall already said, remove the comma
		});
	
	}
}
</script>		