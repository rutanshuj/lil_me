<style>

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
.quantity-text{
	border: 1px solid #ccc;
    
	    width: 30px;
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
@media (max-width: 650px) , screen and(min-width: 570px) {
.cart_size{
	    padding-left: 4%;
}
.quantity-text{
	 width: 28px;
	 text-align: center;
}
    
.footer-button{
	    font-size: 12px;
		
		width: 140px;
}
#checkout-btn
{
	
	float:right
}
#update-btn{   margin-left: -60%;}
}

@media screen and (max-width: 767px)
{
.box .box-footer {
    padding: 0px;
}
}
@media (max-width: 650px) {
	.col-sm-3{
	    padding-right:0px;
}
}

 .div_close{
	 float:right
  }
  a i.fa, button i.fa {
    margin: 0 
}
</style>
<div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li>Shopping cart</li>
                    </ul>
                </div>

                <div class="col-md-9" id="basket">

                    <div class="box">

                        <form method="post" action="<?php echo base_url('web/payment/order_review')?>">

                            <h1>Shopping cart</h1>
                            <p class="text-muted"><p class="text-muted">You currently have <span id='cart_no_items'>
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
                                            <th>Unit price</th>
                                            <th colspan="2">Total</th>
                                        </tr>
                                    </thead>
									<?php	foreach($cart_list['data'] as $cart_row){ 
										?>
                                    <tbody>
                                        <tr id='<?php echo $cart_row['id'];?>'>
                                            <td>
                                                <a href="#">
                                                 <img src="<?php echo $cart_row['image_thumbnail_url']; ?>" alt="<?php echo $cart_row['product_name']; ?>" alt="White Blouse Armani">
                                                </a>
                                            </td>
                                            <td><a href="#"><?php echo $cart_row['product_name']; ?></a>
                                            </td>
                                            <td>
                                                <input cart_id="<?php echo $cart_row['id']; ?>" min="0" type="number" 
												value="<?php echo $cart_row['quantity'] ;?>" class="form-control" 
												style="width: 60px;" id='<?php  echo $cart_row['id'].'quant-big'; ?>'>
                                            </td>
											<td>
										<div class="form-group">
										<select class="form-control"  data-style="btn-info" id="<?php echo $cart_row['id'].'size-big';?>" 
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
                                            <td>&#8377; <?php echo $cart_row['original_price'];?></td>
                                          
                                            <td>&#8377; <span id="<?php echo $cart_row['id']."price";?>"> <?php echo $cart_row['price'];?></span></td>
                                            <td><a onclick="hide('<?php echo $cart_row['id'];?>')"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                       <?php }?>
                                    </tbody>
									
                                    <tfoot>
                                        <tr>
                                            <th colspan="5">Total</th>
                                            <th colspan="2">&#8377; <span id="cart_total_amount_summary"><?php  echo $cart_list['final_price']; ?></span></th>
                                        </tr>
                                    </tfoot>
                                </table>
					
                            </div>
					
                            <!-- /.table-responsive -->
							
                            <div class="box-footer">
						<div class="cart_resp phone-controls" id="">
					  <!--------for loop starts here for making cart cards------------>
					  <?php	foreach($cart_list['data'] as $cart_row){?>
						 <div class="cartitem"  id="<?php echo $cart_row['id'].'resp';?>" style="margin-top: 2%;"> 
									
						     <div class="col-xs-3" style="padding-right: 0px; " >
							 <img class="side-img" src="<?php echo $cart_row['image_thumbnail_url']; ?>"></div>
								  <a href="#" class="div_close" onclick="hide('<?php echo $cart_row['id'];?>')" style="margin-right: 4%;">
											<img src="<?php echo base_url();?>assets/svgs/close.svg">
										  </a>		
									<div class="col-xs-9" style="margin-top: -15px;">
									  <div class="title_row" style="padding-bottom: 18px;" >
										<div class="cart-itemname col-xs-12"> 
										<b><?php echo $cart_row['product_name']; ?></b>
										</div>
										
									  </div> 
									  
									
									<div class="col-xs-8" style="padding-bottom: 18px;" >
							<a onclick="decrementValue(this);" cart_id="<?php echo $cart_row['id'];?>"> <img src="<?php echo base_url();?>assets/svgs/remove.svg" alt="" class="quantity-icon"></a>
							<input type="text" class="quantity-text " id='<?php  echo $cart_row['id'].'quant'; ?>' value='<?php echo $cart_row['quantity'];?>'>
							<a onclick="incrementValue(this);" cart_id="<?php echo $cart_row['id'];?>"> <img src="<?php echo base_url();?>assets/svgs/add.svg" alt="" class="quantity-icon"></a>
							</div>
									
						<div class="col-xs-4" style="padding-bottom: 18px;padding-left: 0;" >	
							
								<select id="<?php echo $cart_row['id'].'size';?>" onchange="sizeChange(<?php echo $cart_row['id'];?>,this.value)"
								style="z-index: 10;position: relative;width: 60px;">
								<?php
								foreach($cart_row['size_available'] as $size_id=>$size_row)
								{
								$i=0;?>
								<option value="<?php echo $size_id;?>" 
								<?php if($cart_row['size']==$size_row) echo 'selected="selected"';?>><?php echo $size_row?></option>
								<?php $i++;}?>
											</select>
								
								</div>	
									
									
									<div class="col-xs-12" >Price:&#8377;
									 <span class="price_tag" id="<?php echo $cart_row['id']."cart_price";?>">
										 <?php echo $cart_row['price'];?>
									  </span>
									</div>
								  </div>

								
								</div>
								 
					  <?php }?>


                              </div>
							
							
							
                                <div class="pull-left">
                                    <a href="<?php echo base_url('web/home/categories')?>" class="btn btn-default footer-button"><i class="fa fa-chevron-left" style="color: #1E0022;"></i> Continue shopping</a>
									
                                </div>
								 <div class="pull-right phone-controls">
                                   
									<button type="submit" class="btn btn-default phone-controls footer-button" id="checkout-btn">Checkout <i class="fa fa-chevron-right" style="color: #1E0022;"></i>
                                    </button>
                                </div>
                                <div class="pull-right">
                                    <button class="btn btn-default  footer-button" id="update-btn" ><i class="fa fa-refresh" style="color: #1E0022;"></i> Update basket</button>
                                    <button type="submit" class="btn btn-default website-controls">Proceed to checkout <i class="fa fa-chevron-right" style="color: #1E0022;"></i>
                                    </button>
                                </div>
                            </div>
							<?php }?>
                        </form>

                    </div>
                    <!-- /.box -->


                    <div class="row same-height-row" id='related_products'>
                       
						<?php 
							$image_url='';
							if(isset($cart_list['related_products']) && is_array($cart_list['related_products'])&&(count($cart_list['related_products']))!="0") {?>
								 <div class="col-md-3 col-xs-6">
                            <div class="box same-height">
                                <h3>You may also like these products</h3>
                            </div>
                        </div>
							<?php foreach($cart_list['related_products']as $product_row){
							
							$file_headers = @get_headers($image_url);
							if(trim($product_row->image_url)!='') {
							$image_url=base_url().$product_row->image_url;
							} 
							else{
							$image_url = base_url().'assets/img/LPF-Loader-image.jpg';  
							}			?>
                         <div class="col-md-3 col-xs-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="<?php echo base_url('products/').'/'.$product_row->category_slug.'/'.$product_row->subcategory_slug.'/'.$product_row->product_id?>">
                                                <img src="<?php echo $image_url;?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="<?php echo base_url('products/').'/'.$product_row->category_slug.'/'.$product_row->subcategory_slug.'/'.$product_row->product_id?>">
                                                <img src="<?php echo $image_url;?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo base_url('products/').'/'.$product_row->category_slug.'/'.$product_row->subcategory_slug.'/'.$product_row->product_id?>" class="invisible">
                                    <img src="<?php echo $image_url;?>" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><?php echo $product_row->product_name;?></h3>
                                    <p class="price">
									<?php if($product_row->new_price==''){?>&#8377;<?php echo $product_row->mrp;} else{?>
									
									<del>&#8377;<?php echo $product_row->mrp;?></del>
									&#8377;<?php echo $product_row->new_price;}?>
									</p>

                                </div>
                            </div>
                            <!-- /.product -->
                        </div>
                    <?php
						 }
						}
						?>
                    </div>


                </div>
                <!-- /.col-md-9 -->
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
                <!-- /.col-md-3 -->
				<?php }?>
            </div>
            <!-- /.container -->
        </div>
		<script type="text/javascript">
				  (function($) {
					var user_id=1;//'<?php echo $this->session->userdata('user_id');?>';
					var api_key='';'<?php echo $this->session->userdata('api_key');?>';
					$(":input").bind('keyup mouseup', function () {
					var quantity= $(this).val(); 
					var cart_id=$(this).attr('cart_id'); 
					//alert(quantity);
					edit_cartData(cart_id,user_id,api_key,'',quantity);
					});
					})(jQuery);
				
				</script>
        <!-- /#content -->
