<style>
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
	padding:5px;
}
#cart_resp
  {
	  display:none;
  }
@media (max-width: 768px) {
 .table-desc{
	  display:none
  }
  #cart_resp
  {
	  display:block;
  }
  
}
.td_text{
	width: 100px;
}
.td_value{
	width: 115px;
}
.td_val
{
	width: 90px;
	
}
@media (max-width: 650px) {
.cart_size{
	    padding-left: 4%;
}
}  
 .div_close{
	 float:right
  }
  
  .loader {
	position: absolute;
	left: 50%;
	top: 50%;
	z-index: 1;
	margin: -75px 0 0 -75px;
	border: 16px solid #f3f3f3;
	 border-top: 16px solid blue;
	border-bottom: 16px solid blue;
	//border-right: 16px solid green;
	//border-bottom: 16px solid red;
    border-radius: 50%;
    width: 100px;
	height: 100px;
	-webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
}
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
.blur{
  -webkit-filter: blur(10px);
  -moz-filter: blur(10px);
  -o-filter: blur(10px);
  -ms-filter: blur(10px);
  filter: blur(10px);
    
}

</style>
<div id="loader" class="loader" display = "block"> </div>
<div id= "cart_container" class="container" style="padding-left: 8%;padding-right: 8%;padding-top: 2%;min-height: 554px;">  
<div class="row">
  <div class="col-md-9" id="basket">

                    <div class="box">

                        <form method="post" action="<?php echo base_url('web/Payment/order_review');?>">
							<ul class="nav nav-pills nav-justified">
                                 <li class="active"><a href="#" id="cart"><i class="fa fa-map-marker"></i><br>Cart</a>
                                </li>
								<li  <?php if(!isset($cart_list['data'])) echo "style = 'display : none;'"?> ><a id = "order_review" href="<?php if(!isset($cart_list['data'])) echo "#";else echo base_url('web/Payment/order_review')?>"><i class="fa fa-eye"></i><br>Order Review</a>
                                </li>
                                <li  <?php if(!isset($cart_list['data'])) echo "style = 'display : none;'";?>><a id = "payment_method" href="<?php if(!isset($cart_list['data'])) echo "#";else echo base_url('web/Payment/payment_method')?>"><i class="fa fa-money"></i><br>Payment Method</a>
                                </li>
                                
                            </ul>
                            <h1>Shopping cart</h1>
							
                            <p class="text-muted">You currently have <span id='cart_no_items'>
							<?php if(isset($cart_list['total_quantity'])){
							echo $cart_list['total_quantity'];}
							else echo '0';?></span> item(s) in your cart.</p>
							<?php
					if(isset($cart_list['data']) && is_array($cart_list['data'])&&(count($cart_list['data'])!="0")) {
						$i=1;?>
							
				
                            <div class="table-responsive">
                                <table class="table table-desc" id='cart_table'>
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Quantity</th>
											<th>Size</th>
                                            <th style = "text-align: right;">Unit price</th>
											
                                            <th style = "text-align: right;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php	foreach($cart_list['data'] as $cart_row){
										?>
                                        <tr id='<?php echo $cart_row['id'];?>'>
                                            <td>
                                                <a href="#">
                                                    <img src="<?php echo $cart_row['image_thumbnail_url']; ?>" alt="<?php echo $cart_row['product_name']; ?>">
                                                </a>
                                            </td><?php //---prani's code?>
                                            <td><a href="<?php echo base_url('products/').'/'.$cart_row['category_slug'].'/'.$cart_row['product_slug'].'/'.$cart_row['product_id'];?>"><?php echo $cart_row['product_name']; ?></a>
                                            </td>
											 </td>
                                            
                                            <td>
                                                <input id="quantity_scroll" cart_id="<?php echo $cart_row['id']; ?>" min="1" type ="number" max="99" 
												value="<?php echo $cart_row['quantity'] ;?>" class="form-control form-quantity" style=" width: 60px;text-align: left;" >
                                            </td>
											<td> 	
			<div class="form-group">
			<select class="form-control"  data-style="btn-info" id="<?php echo $cart_row['id'].'size';?>" 
			onchange="sizeChange(<?php echo $cart_row['id'];?>,this.value)" style="z-index: 10;position: relative;margin-top: 15px;width: 60px;">
												<?php
												foreach($cart_row['size_available'] as $size_id=>$size_row)
												{
													$i=0;
												?>
								<option value="<?php echo $size_id;?>" 
								<?php if($cart_row['size']==$size_row) echo 'selected="selected"';?>><?php echo $size_row?></option>
								<?php
								$i++;}?>
											</select>
										</div>
                                            </td>
                                            <td class='td_val' style = "text-align: right;"> &#8377;<?php echo number_format($cart_row['original_price']);?></td>
                                      
                                            <td class='td_val' style = "text-align: right;">&#8377; <span id="<?php echo $cart_row['id']."price";?>"> 
											<?php echo number_format($cart_row['price']);?> </span></td>
                                            <td><a href="#" onclick="hide('<?php echo $cart_row['id'];?>')"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
										<tr>
					<?php $i++; 
					} ?>
                                       
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5">Total</th>
                                            <th colspan="1" style = "text-align: right;" class="td_value">&#8377;<span id="cart_total_amount_summary">
											<?php echo number_format($cart_list['total_price']);?></span></th>
                                        </tr>
                                    </tfoot>
                                </table>
								<div class="col-sm-12" id="cart_resp">
								<?php
								
								foreach($cart_list['data'] as $cart_row){  
								?>
								  <!--------for loop starts here for making cart cards------------>
								  <div class="cartitem"  id="<?php echo $cart_row['id'].'resp';?>"> 
									<div class="cart-img col-sm-12" style="margin-left: 20px;float: left;">
									  <img class="side-img" src="<?php echo $cart_row['image_thumbnail_url']; ?>">
									</div>
									
										  <a href="#" class="div_close" onclick="hide('<?php echo $cart_row['id'];?>')">
											<img src="<?php echo base_url();?>assets/svgs/close.svg">
										  </a>
									<div style="float:left">	
									<div class="cart-data">
									  <div class="title_row">
										<div class="cart-itemname col-sm-12"> 
										  <?php echo $cart_row['product_name']; ?>
										</div>
										
									  </div>
									 <div style="padding-bottom: 15px;float:left"  class="col-sm-3 col-xs-6">
									<div>Quantity</div>
									<div class="quant-div-detail">
											<input cart_id="<?php echo $cart_row['id']; ?>" min="1" type="number" max="99"
												value="<?php echo $cart_row['quantity'] ;?>" class="form-control form-quantity" 
												style="width: 60px;">
										</div>
										</div>
									<div style="padding-bottom: 15px;float:left" class="col-sm-3 col-xs-6" id='size_div'>
										<div>Size	 </div>
										<div class="form-group">
											<select class="form-control"  data-style="btn-info" 
											id="<?php echo $cart_row['id'].'size';?>" onclick="sizeChange(<?php echo $cart_row['id'];?>,this.value)"
											style="z-index: 10;position: relative;width: 60px;">
												<?php
												foreach($cart_row['size_available'] as $size_id=>$size_row)
												{
													$i=0;
												?>
								<option value="<?php echo $size_id;?>" 
								<?php if($cart_row['size']==$size_row) echo 'selected="selected"';?>><?php echo $size_row?></option>
								<?php
								$i++;}?>
											</select>
										</div>
									</div>
									<div class="cart-itemprice col-sm-12">Price:
									  <span class="price_tag number" id="<?php echo $cart_row['id']."cart_price";?>">&#8377; 
										<?php echo $cart_row['price'];?>  
									  </span>
									</div>
								  </div>

								</div>
								</div>
								<?php	$i++;
								} ?>
								<div id="col-sm-12">
								  <div class="cart_no_items number" >Total Item:
									<span id="cart_no_items_resp"><?php echo $cart_list['total_quantity'];?></span>
								  </div>
								  <div class="cart_total_amount number" >
								  &#8377; &nbsp; <span id="cart_total_amount_summary_resp">
									<?php echo $cart_list['total_price'];?></span>
								  </div>
								</div>


                              </div>
				
                            </div>
                            <!-- /.table-responsive -->
				
                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="<?php echo base_url('web/home');?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Continue shopping</a>
                                </div>
                                <div class="pull-right">
                                    
                                    <button id = "checkout" type="submit" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>

                        </form>
						<?php }?>
                    </div>
                    <!-- /.box -->
					 
                </div>
					<?php if(isset($cart_list['total_price']) && isset($cart_list['total_discount'])&& isset($cart_list['total_tax']) && isset($cart_list['final_price']))
			{?>
				   <div class="col-md-3">
                    <div class="box" id="order-summary">
                        <div class="box-header">
                            <h3>Order summary</h3>
                        </div>
                        <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>

                        <div class="table-responsive">
						
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class='td_text'>Order subtotal</td>
                                        <th class='td_value'>&#8377;<span id="cart_total_amount" > <?php  echo $cart_list['total_price'];?></span></th>
                                    </tr>
                                    <tr>
                                        <td class='td_text'>Discount</td>
                                        <th class='td_value'><span id="total_discount">  <?php  echo $cart_list['total_discount']; ?>%</span></th>
                                    </tr>
                                    <tr>
                                        <td class='td_text'>Tax</td>
                                        <th class='td_value'>&#8377; <span id="total_tax"><?php  echo $cart_list['total_tax']; ?></span></th>
                                    </tr>
                                    <tr class="total">
                                        <td class='td_text'>Total</td>
                                        <th class='td_value'>&#8377; <span id="final_price"><?php  echo $cart_list['final_price']; ?></span></th>
                                    </tr>
                                </tbody>
                            </table>
						
                        </div>

                    </div>


					
                </div>
			<?php }?>

                    <div class="row same-height-row">
                               <?php 
				if(isset($cart_list['related_products'])&&is_array($cart_list['related_products'])&&(count($cart_list['related_products'])!="0")) {?>
				 <div class="col-md-12">
                    <ul class="breadcrumb" style="width:100%;height: 36px;">
                        <li style="float:left"><a href="#">Products you may also like</a>
                        </li>
                   
                    </ul>
				 </div> 
				<?php foreach($cart_list['related_products'] as $product_row){
				$image_url=base_url().$product_row->image_url;
				$file_headers = @get_headers($image_url);
				if($file_headers[0] == "HTTP/1.0 404 Not Found") {
				$image_url = base_url().'assets/img/default.jpg';
				} 
				//$image_url=base_url()."assets/img/product1.jpg";
				?>
				 
                  <div class="col-md-3 col-xs-6" style="height: 418px;">
				  <div class="product">
					<div class="image">
					  <a href="<?php echo base_url('products/').'/'.$product_row->category_slug.'/'.$product_row->product_slug.'/'.$product_row->product_id?>">
						<img src="<?php echo $image_url;?>" alt="" class="img-responsive image1" style="width:100%;height:100%">
					  </a>
					</div>
					<!-- /.image -->
					<div class="text">
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

                        

                    </div>


                </div>
		
			</div>	
		</div>
<script type="text/javascript">
				  (function($) {
					 $('.loader').hide();
					var user_id='<?php echo $this->session->userdata('user_id');?>';
					var api_key='<?php echo $this->session->userdata('api_key');?>';
					// var quantity= $(this).val(); 
					// var cart_id=$(this).attr('cart_id'); 
				    // edit_cartData(cart_id,user_id,api_key,'',quantity);
					$(":input").on("keyup keydown change",function(event){
						//code that's working like a charm
					var quantity= $(this).val(); 
					if(quantity !="" && quantity>0){
					var cart_id=$(this).attr('cart_id'); 
				    edit_cartData(cart_id,user_id,api_key,'',quantity);
					}
					else if(quantity==""){
						quantity = 0;
						
						var cart_id=$(this).attr('cart_id'); 
				    edit_cartData(cart_id,user_id,api_key,'',quantity);
					}
					else if(quantity<=0){
					quantity = 1;
						var x=document.getElementsByClassName("form-quantity");
						var i;
						for(i=0; i<x.length; i++){
							if(x[i].value<=0){
								x[i].value = 1;
							}
					}
						var cart_id=$(this).attr('cart_id'); 
						edit_cartData(cart_id,user_id,api_key,'',quantity);	
					}
					});
					})(jQuery);
	
					$(".form-quantity").on('input', function() {
						var enteredVal = $(this).val();
						if (enteredVal.length > 2) {
							$(this).val(enteredVal.substring(0, enteredVal.length - 1));
							console.log('More than 2 characters not allowed.');
							return;
							}
							});


</script>
			