
<div class="container" style="padding-left: 8%;padding-right: 8%;padding-top: 2%;min-height: 430px;">  
			<div class="row">
					<?php
					$carts=array();
					if(isset($cart_list['data']) && is_array($cart_list['data'])&&(count($cart_list['data'])!="0")) {
						$i=1;?>
							
				<div class="col-md-9" id="checkout">

                    <div class="box">

                        <form method="post" action="<?php echo base_url('web/Payment/payment_method');?>">
							<ul class="nav nav-pills nav-justified">
                                 <li ><a href="<?php echo base_url('web/home/cart')?>"><i class="fa fa-map-marker"></i><br>Cart</a>
                                </li>
								<li class="active"><a href="#"><i class="fa fa-eye"></i><br>Order Review</a>
                                </li>
                                <li><a href="<?php echo base_url('web/Payment/payment_method');?>"><i class="fa fa-money"></i><br>Payment Method</a>
                                </li>
                                
                            </ul>
                            <h1>Order Review</h1>
                            <?php if(isset($address_list)) { ?>
							<div class="row">
                             <?php  $billing_address=$address_list['billing_address'];
							
							 if(isset($billing_address) && count($billing_address)!=0){?>
							 <div class="col-sm-6">
                                        <div class="box shipping-method" style="height: 188px;">
											<div class="address_type" style="margin-left: 26px;"> Billing  Address
										
										<a href="<?php echo base_url('web/payment/change_address?address_type=').'billing_address'?>" class="addr_edit" style="float:right"><img src="<?php echo base_url();?>assets/svgs/ic_mode_edit_black_18px.svg"></a>
										</div>
										<hr style="margin-top: 10px;margin-bottom: 35px;">
											<div><input type="radio" name="billing_address_id" checked="checked" value="<?php echo $billing_address['address_id'];?>"></div>
											<div class='address_detail'> <span class="r_name"><b><?php echo $billing_address['name']?></b></span>
											
											<br>
											<span class="address_line"><?php echo $billing_address['address_firstline'];?></span>
											<br>
											<span class="pin"><?php echo $billing_address['address_secondline'];?></span>
											<br>
											<span class="phone"><?php echo $billing_address['phone_number'];?></span>
                                           </div>
                                        </div>
                                    </div>
							 <?php }else { ?>
							
                                <div class="col-sm-6">
                                        <div class="box shipping-method" align="center" style="height: 188px;">
										<span class="phone">Billing Address</span><br>
										<a href="<?php echo base_url('web/payment/add_address?address_type=').'billing_address';?>" class="address_add">
										<img src="<?php echo base_url();?>assets/svgs/ic_add_black_36px.svg" style="height: 75px;"></a>	
										
                                        </div>
								</div> 
							<?php }?>
				<?php  $shipping_address=$address_list['shipping_address'];
						if(isset($shipping_address) && count($shipping_address)!=0){	 ?>
							 <div class="col-sm-6">
                                        <div class="box shipping-method" style="height: 188px;">
											<div class="address_type" style="margin-left: 26px;"> Shipping Address										
										<a href="<?php echo base_url('web/payment/change_address?address_type=').'shipping_address'?>" class="addr_edit" style="float:right"><img src="<?php echo base_url();?>assets/svgs/ic_mode_edit_black_18px.svg"></a>
										</div>
										<hr style="margin-top: 10px;margin-bottom: 35px;">
											<div><input type="radio" checked="checked" name="address_id" value="<?php echo $shipping_address['address_id'];?>"></div>
											<div class='address_detail'> <span class="r_name"><b><?php echo $shipping_address['name']?></b></span>
											
											<br>
											<span class="address_line"><?php echo $shipping_address['address_firstline']?></span>
											<br>
											<span class="city"><?php echo $shipping_address['address_secondline']?></span>
											<br>
											<span class="phone"><?php echo $shipping_address['phone_number']?></span>
                                           </div>
                                        </div>
                                    </div>
						<?php } else{?>
						  <div class="col-sm-6">
                                        <div class="box shipping-method" align="center" style="height: 188px;">
											
										<span class="phone">Shipping Address</span><br>
										<a href="<?php echo base_url('web/payment/add_address?address_type=').'shipping_address';?>" class="address_add">
										<img src="<?php echo base_url();?>assets/svgs/ic_add_black_36px.svg" style="height: 75px;"></a>	
										
                                        </div>
                            </div> 
						
						<?php} ?>
						</div>
						<?php }?>
					
				
                            <div class="table-responsive" style='margin-left: 5px;'>
                                <table class="table" id='cart_table'>
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
											<th>Size</th>
											<th>Quantity</th>
											 <th>Unit price</th>                                 		
                                            <th colspan="2">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php	foreach($cart_list['data'] as $cart_row){
										$carts[]=$cart_row['id'];
										?>
                                        <tr id='<?php echo $cart_row['id'];?>'>
                                            <td>
                                                <a href="#">
                                                    <img src="<?php echo $cart_row['image_thumbnail_url']; ?>" alt="<?php echo $cart_row['product_name']; ?>">
                                                </a>
                                            </td>
                                            <td><a href="<?php echo base_url('products/').'/'.$cart_row['category_slug'].'/'.$cart_row['product_slug'].'/'.$cart_row['product_id'];?>"><?php echo $cart_row['product_name']; ?></a>
                                            </td>
											<td><?php echo $cart_row['size'];?></td>
										    <td> <?php echo $cart_row['quantity'] ;?> </td>
                                            <td>&#8377;<?php echo $cart_row['original_price'];?></td>
                                            <td>&#8377<span id="<?php echo $cart_row['id']."price";?>"><?php echo $cart_row['price'];?> </span></td>
                                           
                                        </tr>
									<?php $i++; 
									} //print_r($carts);
									$this->session->set_userdata('carts',$carts);?>
                                       
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5">Total</th>
                                            <th colspan="2"><span id="cart_total_amount_summary">&#8377;<?php echo $cart_list['total_price'];?></span></th>
                                        </tr>
                                    </tfoot>
                                </table>
				
                            </div>
							<?php } ?>
                            <!-- /.table-responsive -->
				
                            <div class="box-footer" style="margin-left: 5px;margin-right: -5px;">
                                <div class="pull-left">
                                    <a href="<?php echo base_url('web/home');?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Continue shopping</a>
                                </div>
                                <div class="pull-right">
                                    
                                    <button id="proceed_to_checkout" type="submit" class="btn btn-primary" <?php
									if(isset($shipping_address) && count($shipping_address)!=0 && (isset($billing_address) && count($billing_address)!=0)){echo "enabled";}
									else{echo "disabled";}
									?>>Proceed to checkout <i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
							
                        </form>
						<?php }?>
                    </div>
                    <!-- /.box -->
					</div> 
                </div><!-- /.checkout -->
				
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
                                        <td>Order subtotal</td>
                                        <th>&#8377;<span id="cart_total_amount"> <?php  echo $cart_list['total_price'];?></span></th>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <th><span id="total_discount">  <?php  echo $cart_list['total_discount']; ?>%</span></th>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <th>&#8377; <span id="total_tax"><?php  echo $cart_list['total_tax']; ?></span></th>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <th>&#8377; <span id="final_price"><?php  echo $cart_list['final_price']; ?></span></th>
                                    </tr>
                                </tbody>
                            </table>
						
                        </div>

                    </div>


				<?php }?>	
                </div>
				
				</div>
				
                    <div class="row same-height-row">
          <?php if(isset($cart_list['related_products'])&&is_array($cart_list['related_products'])&&(count($cart_list['related_products'])!="0")) {?>
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
				 
                  <div class="col-md-3 col-sm-4" style="height: 418px;">
				  <div class="product">
					<div class="image">
					  <a href="<?php echo base_url('products/').'/'.$product_row->category_slug.'/'.$product_row->product_slug.'/'.$product_row->product_id?>">
						<img src="<?php echo $image_url;?>" alt="" class="img-responsive image1" style="height:100%; width:100%">
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
				}?>
				</div>
                   
			
		</div>
                   


               
		
			
				<script type="text/javascript">
				  (function($) {
					var user_id='<?php echo $this->session->userdata('user_id');?>';
					var api_key='<?php echo $this->session->userdata('api_key');?>';
					$(":input").bind('keyup mouseup', function () {
					var quantity= $(this).val(); 
					var cart_id=$(this).attr('cart_id'); 
					edit_cartData(cart_id,user_id,api_key,'',quantity);
					});
					})(jQuery);
				
				</script>
			