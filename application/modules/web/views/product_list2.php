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
@media (min-width: 400px) {
	#filter_resp_div
{
	display:none;
	height: 450px;
}
}


  
.custom_ul{
	list-style-type:none;
	    margin-left: 5%;
}

.pages a{
	    padding: 10px;
    font-size: 20px;
    color: #EF6ACA;
}
.col-xs-6
{
	margin-right:0px
}


@media screen and (min-width: 768px) and (max-width: 1000px) {
   .col-sm-3 {
    width: auto !important;
}
}
@media only screen and (max-width: 768px) {
    /* For mobile phones: */
    .btn-primary dropdown-toggle {
        width: 100%;
    }
}

html, body {
    max-width: 100%;
    overflow-x: hidden;
}

</style>
<div class="container" style="
    min-height: 485px;
">
	<section>
		<button id="filter_btn" type="button" class="btn btn-primary" style="margin-bottom:10px;width:100%" data-toggle="dropdown"><span>filter and Sort</span></button>
		<div id="filter_resp_div">
		<form method="post" action="<?php echo base_url('products/').'/'.$category_slug?>" id="form1">
			<div class="button-group" style=" margin-bottom: 10px;">
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"  style="width:100%">
						<span>size</span>
						<span class="caret"></span>
					</button>
					<ul class="custom_ul">
						<?php foreach($size_array as $size){?>
						<li>
							<a href="#" class="small" data-value="
								<?php echo $size->size_id;?>" tabIndex="-1">
								<input type="checkbox" name='size[]' value="<?php echo $size->size_id;?>"
								<?php if (isset($selected_size))
								{
									if(in_array($size->size_id, $selected_size)) echo"checked";
								}?> />&nbsp;&nbsp;
								<?php echo $size->size_title;?>
							</a>
						</li>
						<?php }?>
					</ul>
				</div>
				
				<div class="button-group" style=" margin-bottom: 10px;">
				<button type="button" class="btn btn-primary" data-toggle="dropdown" style="width: 100%;">
						<span>Gender</span>
						<span class="caret"></span>
					</button>
					<ul class="custom_ul">
						<?php foreach($gender_list as $row){?>
						<li>
							<a href="#" class="small" 
								data-value="<?php echo $row->gender;?>" tabIndex="-1">
								<input name='gender[]' type="checkbox"
								value="<?php echo $row->gender;?>" 
								<?php if (isset($seleted_gender))
								{
									if(in_array($row->gender, $seleted_gender)) echo"checked";
								}?> />&nbsp; &nbsp;
								<?php echo $row->gender;?>
							</a>
						</li>
						<?php }?>
					</ul>
					</div>
					<?php 
					
					switch ($sortflag) {
					case 1:
						$sort_title='Price High to Low';
						break;
					case 2:
						$sort_title='Name';
						break;
					case 3:
						$sort_title='Discount';
						break;
					default:
						$sort_title='Price Low to High';
}
					?>
					<div class="button-group" style=" margin-bottom: 10px;">
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="width:100%">
					<span style="text-transform: uppercase;font-size: 14px;">Sort By : <?php echo $sort_title; ?></span>
						<span class="caret"></span>
					</button>
					<form method="post" action="#">
					<ul class=" custom_ul" >
						
						<li>
							<a onclick="form_submit_sort();" href="#" class="small" data-value="option2" tabIndex="-1"> <input type='radio' id='radios_1' name='type1' 
						value='1'
						<?php 	
						if($sortflag==4){
							echo "checked";
						}
						?>>
						 &nbsp;Price Low to High </a>
						</li>
						<li>
							<a onclick="form_submit_sort(1);" href="#" class="small" data-value="option2" tabIndex="-1"><input type='radio' 
						<?php 
						if($sortflag==1){
							echo "checked";
						}?>
						id='radios_2' name='type1' value='1'>
						  &nbsp;Price High to Low </a>
						</li>
						<li>
							<a onclick="form_submit_sort(2);" href="#" class="small" data-value="option3" tabIndex="-1"> <input type='radio' 
						<?php 
						if($sortflag==2){
							echo "checked";
						}?>
						id='radios_3' name='type1' value='1'>
						 &nbsp;Name</a>
						</li>
						<li>
							<a onclick="form_submit_sort(3);" href="#" class="small" data-value="option4" tabIndex="-1"><input type='radio' 
						<?php 
						if($sortflag==3){
							echo "checked";
						}?>
						id='radios_4' name='type1' value='1'>
						 &nbsp;Discount</a>
						</li>
							
					</ul>
					
				</div>
			<div align='center'>
			<button type="button" class="btn btn-default" onclick="form_submit();"
				style="background-color: #EF6ACA;color: white;border: none;">Submit</button>
			<button type="button" class="btn btn-default" onclick="clear_content();"
				style="background-color: #EF6ACA;color: white;border: none;">Clear Filters</button>
			</div>
			</div>
		
		
		<div id='fliter_div' class="row cont_top" style="padding-top:10px">
			<div id='container'>
			
			 <input type="hidden" name="sortflag" value="" id="sortflag">
			<span  style="float:left;padding-top: 5px;text-transform: uppercase;font-size: 14px; margin-left: 80px;" >Filter By:</span>
			<div class="col-sm-3 col-lg-3" style="width: 175px;">
				<div class="button-group" style=" margin-bottom: 10px;">
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="width:155px; margin:0 auto;">
						<span>size</span>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu custom_ul">
						<?php foreach($size_array as $size){?>
						<li>
							<a href="#" class="small" data-value="<?php echo $size->size_id;?>" tabIndex="-1">
								<input name='size[]' type="checkbox" 
								value="<?php echo $size->size_id;?>"
								<?php if (isset($selected_size))
								{
									if(in_array($size->size_id, $selected_size)) echo"checked";
								}?> />&nbsp;&nbsp;
								<?php echo $size->size_title;?>
							</a>
						</li>
						<?php }?>
					</ul>
				</div>
			</div>
			<div class="col-sm-3 col-lg-3" style="width: 175px;">
				<div class="button-group" style=" margin-bottom: 10px;">
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="width:155px;">
						<span>Gender</span>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu custom_ul">
						<?php foreach($gender_list as $row){?>
						<li>
							<a href="#" class="small" data-value="<?php echo $row->gender;?>" tabIndex="-1">

								<input name='gender[]' type="checkbox"
								value="<?php echo $row->gender;?>" 
								<?php if (isset($seleted_gender))
								{
									if(in_array($row->gender, $seleted_gender)) echo"checked";
								}?> />&nbsp; &nbsp;
								<?php echo $row->gender;?>
							</a>
						</li>
						<?php }?>
					</ul>
				</div>
			</div>
			<div class="col-sm-3 col-lg-3" style="width: 185px; margin: 0 auto; display: block;" >
				<button type="button" class="btn" onclick="form_submit();"
				style="background-color: #EF6ACA;color: white;border: none; width: 75px;">Submit</button>
			
				<button type="button" class="btn" onclick="clear_content();"
				style="background-color: #EF6ACA;color: white;border: none; width: 75px;">Clear</button>
			</div>
			<div class="col-sm-3 col-lg-3">
			<span  style="float:left;padding-top: 5px;text-transform: uppercase;font-size: 14px;padding-right: 13px;">Sort By: </span>
				<div class="button-group" style=" margin-bottom: 10px;float:left;" >
					
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="width: 155px;">
					<span><?php echo $sort_title; ?></span>
						<span class="caret" ></span>
					</button>
					<form method="post" action="#">
					<ul class="dropdown-menu"style="margin-left: 30%;width: 65%;">
						<li>
						<a onclick="form_submit_sort(4);" class="small" href = "#" data-value="option2" tabIndex="-1" ><input type='radio' 
						<?php 
						if($sortflag==4){
							echo "checked";
						}?>
						id='radio_1' name='type'value='1'>
						 
						 &nbsp;Price Low to High</a>
						</li>
						<li>
							<a onclick="form_submit_sort(1);" href = "#" class="small" data-value="option2" tabIndex="-1"> <input type ="radio"
							<?php 
						if($sortflag==1){
							echo "checked";
							}?>
							id = "radio_2" name='type' value='2'>
							&nbsp;Price High to Low </a>
						</li> 
						<li>
							<a onclick="form_submit_sort(2) ;" href="#" class="small" data-value="option3" tabIndex="-1"> <input type ="radio"
							<?php 
						if($sortflag==2){
							echo "checked";
							}?>
							id = "radio_3" name='type' value='3'>
							&nbsp;Name </a>
						</li>
						<li>
							<a onclick="form_submit_sort(3) ;"  href = "#" class="small" data-value="option4" tabIndex="-1"><input type ="radio" 
							<?php 
							if($sortflag==3){
								echo "checked";
								}?>
							id = "radio_4" name='type' value='4'>
							&nbsp;Discount </a>
						</li>
					</ul>
					</form> 
					</form>
				</div>
			</div>
			
		
			</form>
			</div>
		</div>
		<div class="col-sm-12">
			<p class="text-muted lead" align="center">
				<?php echo $category_name?>
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
				}			?>
			
				<div class="col-md-3 col-xs-6">
					<div class="product">
						<div class="image">
							<a href="<?php echo base_url('products/').'/'.$category_slug.'/'.$product_row->product_slug.'/'.$product_row->product_id?>">
								<img src="<?php echo $image_url;?>" alt="" class="img-responsive image1">
								</a>
							</div>
							<!-- /.image -->
							<div class="text" style=" height: 80px;">
								<h4>
									<a href="<?php echo base_url('products/').'/'.$category_slug.'/'.$product_row->product_slug.'/'.$product_row->product_id?>">
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
						
						<a href="#"><?php echo $links?></a>
						
					</p>
				</div>
			</div>
		</section>
	</div>
	<script>
   	
	/////////////////
var options = [];
var gender_arr=[];
var size_arr=[];

// $('li').click(function() {
// $(':radio[data-id="'+$(this).data('level')+'"]').prop('checked', true);
// });

$( '.custom_ul a' ).on( 'click', function( event ) {

   var $target = $( event.currentTarget ),
       val = $target.attr( 'data-value' ),
	  
       $inp = $target.find( 'input' ),
       idx;
		if($target.attr( 'gender' ))
		{
		gender = $target.attr( 'gender' );
		gender_arr.push( gender );
		}
		if($target.attr( 'size_id' ))
		{
	    size_id = $target.attr( 'size_id' );
		size_arr.push(size_id);
		}
   if ( ( idx = options.indexOf( val ) ) > -1 ) {
      options.splice( idx, 1 );
      setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
   } else {
      options.push( val );
	 
	  
	  setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
   }

   $( event.target ).blur();
      
   //console.log( options );
   // console.log( gender_arr );
	// console.log( size_arr );
   return false;
});
function clear_content()
{
	$('input:checkbox').removeAttr('checked');
	window.location ="<?php echo base_url('products/').'/'.$category_slug?>";
}
function form_submit_sort(flag)
{
	$("#sortflag").val(flag);
	//$("#radio_1").prop("checked", true)
//	$(':radio[data-id="'+$(this).data('level')+'"]').prop('checked', true);
	document.getElementById("form1").submit();
}
function form_submit()
{
	document.getElementById("form1").submit();
	
}
var resizeTimer;
$(window).on('resize', function (e) {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function () {
        if ($(window).width() > 768) {
            $('#filter_resp_div').hide();
        } 
    }, 250);
});
$(document).ready(function(){
    $("#filter_btn").click(function(){
        $("#filter_resp_div").slideToggle();
    });


});


  </script>
