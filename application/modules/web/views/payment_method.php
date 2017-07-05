 <div class="container" style="padding-left: 8%;padding-right: 8%;padding-top: 2%;">

                <div class="col-md-9" id="checkout">

                    <div class="box">
                        <form method="post" action="<?php echo base_url('web/Payment/place_order');?>">
                            <h1>Checkout - Payment method</h1>
                            <ul class="nav nav-pills nav-justified">
                                <li class=""><a href="<?php echo base_url('web/home/cart')?>"><i class="fa fa-map-marker"></i><br>Cart</a>
                                </li>
                                                          
                                <li class=""><a href="<?php echo base_url('web/Payment/order_review')?>"><i class="fa fa-eye"></i><br>Order Review</a>
                                </li>
								 <li class="active"><a href="#"><i class="fa fa-money"></i><br>Payment Method</a>
                                </li>
                            </ul>

                            <div class="content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="box payment-method">

                                            <h4>Payment gateway</h4>

                                            <p>VISA and Mastercard only.</p>

                                            <div class="box-footer text-center">

                                                <input type="radio" checked name="payment" value="payu">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="box payment-method">

                                            <h4>Cash on delivery</h4>

                                            <p>You pay when you get it.</p>

                                            <div class="box-footer text-center">

                                                <input type="radio" name="payment" value="cod">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->
								<input type="hidden" name="amount" value="<?php  echo $cart_list['total_price']; ?>" size="64" />
                            </div>
                            <!-- /.content -->

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="<?php echo base_url('web/Payment/order_review');?>" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to Cart</a>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary">Continue to Order review<i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->


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


					
                </div>
			<?php }?>
                <!-- /.col-md-3 -->

            </div>