 
		
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
	margin-left: 25%;
}

</style>
        <div id="content" style="min-height: 503px;">
            <div class="container"> 

 <div class="col-sm-12" id="blog-listing">
	 <div class="col-sm-6">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
 

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
	<?php //print_r($product_images);
	$i=0;
	if(isset($product_images) && count($product_images)!=0)
		{$i++;$select='';
		foreach($product_images as $img_row){
			if($i==1)
				$select='active';
			//echo  $img_row->image_url ?>
		<div class="item <?php echo $select?>">
	  
        <img src="<?php if(($img_row->image_url!='')|| isset($img_row->image_url))echo base_url().$img_row->image_url;?>">
      </div>
		<?php 
		}}
		else{ ?>
		 <img src="<?php echo  base_url().'assets/img/default.jpg';?>">	
		<?php	}?>
      </div>
	  <ol class="carousel-indicators">
	   <?php $j=0;
	   foreach($product_images as $img_row){
		  $select='';
		  if($i==0)
			$select='active';?>
      <li data-target="#myCarousel" data-slide-to="<?php echo $j;?>" class="<?php echo $select;?>"></li>
	   <?php $j++;} ?>
		</ol>
	</div>
	   <?php
		if(isset($product_data) && is_array($product_data)&&(count($product_data)!="0")) {
		foreach($product_data as $row){
			
		?>
			 <div class="col-sm-12" style="padding-bottom: 15px;margin-top: 7%;">
			 <div class="pdetail name"><?php echo $row->product_name; ?>
			  <?php if ($like_flag==0)
			$icon_path=base_url('assets/svgs/heart-outline.svg');
			else
			$icon_path=base_url('assets/svgs/lil me icons_liked.svg');?>
			<a id="like" onclick="like_product(<?php echo $product_id;?>,<?php echo $like_flag;?>)">
			  <img src="<?php echo $icon_path;?>" style="height: 30px;margin-left: 18%;">
			</a>
			 </div>
			  <div class="pdetail price"> &#8377; <?php echo $row->Price ?> 
			 </div>
			
			  </div>
		
			
			</div>
<div class="col-sm-6" >
		
			  
		 	<div class="col-sm-12">
             <div class="heading">
             <h3>Project description</h3>
             </div>

        <p style="font-size: 1.3em;">I love my jeans and its so good that i'm turned on</p>

		</div>	  
			  
		<?php $i=1;?>
		<div >
		<div class="quant-div-detail" style="style=padding-bottom: 21px;margin-left: 2%;">
		   <span style="float: left; margin-top: 3px; font-size: 1.5em;">Quantity :</span> 
		   <a id="subtract" onclick="decrementValueForSingleProduct(<?php echo $product_id.$i ;?>)">
			  <img src="<?php echo base_url();?>assets/svgs/minus-circle-outline.svg">
			</a>
			<input class ="quant-text" type="text" id="<?php echo $product_id.$i ;?>" value="<?php echo $i; ?>">
			<a id="add" onclick="incrementValueForSingleProduct(<?php echo $product_id.$i ;?>)">
			  <img src="<?php echo base_url();?>assets/svgs/plus-circle-outline.svg">
			</a>
	
	
	
		</div>
	<button class="btn btn-info" id= 'cart_desk' type="button" onclick="add_to_cart(<?php echo $product_id.$i?>,<?php echo $product_id ?>)">Add To Cart</button>
		
			</div>
			  
			  <div style="style=padding-bottom: 21px;margin-left: 2%;"  >
			  <div class="pdetail title" style="font-size: 23px;">Brand	 </div>
			  <div class="pdetail" ><?php echo $row->brand; ?>	 </div>
			  </div>
			  <div style="padding-bottom: 15px;" class="col-sm-12">
			  <div class="pdetail title" style="font-size: 23px;">	Code </div>
			  <div class="pdetail">hjskd12355 </div>
			  </div>
			  <div style="padding-bottom: 15px;" class="col-sm-4">
			  <div class="pdetail title" style="font-size: 23px;">Size	 </div>
			
					
				<div class="form-group">
				<select class="size form-control"  data-style="btn-info" id="sizedd" name="cars" style="width: 78%;" >
				<?php
				foreach($size_available as $size_row)
				{
				?>
				<option value="<?php echo $size_row->size_id;?>">
				<?php echo $size_row->size_title?>
				</option>
			  <?php }?>
			  </select>
			    </div>
				</div>
				
		
<?php }
		} ?>
<script>
$('.selectpicker').selectpicker({
  style: 'btn-info',
  size: 4
});

function add_to_cart(quantity,target) {
	
	var user_id='<?php echo $this->session->userdata('user_id');?>';//1;
	var api_key='<?php echo $this->session->userdata('api_key');?>';//'fb0aa13efb9ac71e1c09094d7102d798';
	var e = document.getElementById("sizedd");
	var size_id = e.options[e.selectedIndex].value;
	var quantity=document.getElementById(quantity).value;
	var product_name='<?php echo $row->product_name;?>';
	var price='<?php echo $row->Price ;?>';
	//alert(user_id);
	if(user_id!='' && api_key!='')
	{
			$.ajax({
				type: "POST",
				dataType:"json",
				url: "<?php echo base_url()."web/Cart/add"?>",				
				data: {product_id: target,user_id:user_id,api_key:api_key,size:size_id ,quantity:quantity,product_name:product_name,price: price},
			
									success:  function(data){  
								
									if(data['statusCode']==0)
									{
										alert(data['message']);
									}
									else{
										alert(data['message']);
										//console.log(data);
										 location.reload();
									}
								
																	
									}, 
					error: function(){
					  	alert("Fail");
					  	}
			   	});	
		
	}else{
		
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
function like_product(product_id,like_flag) {
	//alert(1);
	if(like_flag==1)
		like_flag=0;
	else
		like_flag=1;
	
	var user_id=1;
	var api_key='fb0aa13efb9ac71e1c09094d7102d798';
	$.ajax({
				type: "POST",
				dataType:"json",
				url: "<?php echo base_url()."web/user/addtofavourites"?>",				
				data: {product_id: product_id,user_id:user_id,api_key:api_key,like_flag:like_flag },
			
									success:  function(json_data){  																		
									if(json_data['statusCode']==0)
									{
										alert(json_data['message']);
										$('#like img').attr("src",'<?php echo base_url('assets/svgs/heart-outline.svg');?>');
									}
									else{
										
										alert(json_data['message']);
										$('#like img').attr("src",'<?php echo base_url('assets/svgs/lil me icons_liked.svg');?>');
										
									}
									
								}, 
					error: function(){
					  	alert("Fail");
					  	}
			   	});	
		}
</script>


		  

           

		   
		   
		   </div>
	   </div>
	</div>