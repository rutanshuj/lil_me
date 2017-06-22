 <div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="index.html">Home</a>
                        </li>
                        <li><a href="#">My orders</a>
                        </li>
                        <li>Order # 1735</li>
                    </ul>

                </div>

                <div class="col-md-3">
                    <!-- *** CUSTOMER MENU ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Customer section</h3>
                        </div>

                        <div class="panel-body">

                            <ul class="nav nav-pills nav-stacked">
                                <li class="active">
                                    <a href="customer-orders.html"><i class="fa fa-list"></i> My orders</a>
                                </li>
                                <li>
                                    <a href="customer-wishlist.html"><i class="fa fa-heart"></i> My wishlist</a>
                                </li>
                                <li>
                                    <a href="customer-account.html"><i class="fa fa-user"></i> My account</a>
                                </li>
                                <li>
                                    <a href="index.html"><i class="fa fa-sign-out"></i> Logout</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.col-md-3 -->

                    <!-- *** CUSTOMER MENU END *** -->
                </div>

                <div class="col-md-9" id="customer-order">
                    <div class="box">
                        <h1>Order #1735</h1>

                        <p class="lead">Order #<?php echo $order_id?> is currently <strong>Being prepared</strong>.</p>
                        <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>

                        <hr>

                        <div class="table-responsive website-controls">
						<?php if(isset($orders['data']) && is_array($orders['data'])&&(count($orders['data'])!="0")) {
						$i=1;
						//$summary=$cart_list['data'];
						foreach($orders['data'] as $order_row){
						?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Product</th>
                                        <th>Quantity</th>
                                        <th>Unit price</th>
                                        <th>Discount</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                <tr>
                                        <td>
                                            <a href="#">
                                                <img src="<?php echo $order_row['image_thumbnail_url']; ?>" alt="<?php echo $order_row['product_name'];?>">
                                            </a>
                                        </td>
                                        <td><a href="#"><?php echo $order_row['product_name']; ?></a>
                                        </td>
                                        
                                        <td>&#8377;<?php echo $order_row['original_price'];?></td>
                                        <td>&#8377;<?php //echo $order_row['individual_discount'];?></td>
										
                                        <td>&#8377;<?php echo $order_row['price'];?></td>
										 
                                    </tr>
									<?php }?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" class="text-right">Order subtotal</th>
                                        <th>&#8377;<?php echo $orders['total_price'];?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right">Shipping and handling</th>
                                        <th>&#8377;<?php echo $orders['total_discount'];?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right">Tax</th>
                                        <th>&#8377;<?php echo $orders['total_tax'];?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right">Total</th>
                                        <th>&#8377;<?php echo $orders['final_price'];?></th>
                                    </tr>
                                </tfoot>
								<?php }?>	
                            </table>

                        </div>
						<?php if(isset($orders['data']) && is_array($orders['data'])&&(count($orders['data'])!="0")) {?>
							<div class="cart_resp phone-controls" id="">
					  <!--------for loop starts here for making cart cards------------>
						<?php  foreach($orders['data'] as $order_row){
						?>
								 <div class="cartitem" style="margin-bottom: 45px;"> 
									
									<div class="col-xs-3"><img class="side-img" src="<?php echo $order_row['image_thumbnail_url']; ?>"></div>
									<div class="cart-data col-xs-9">
									  <div class="title_row">
										<div class="cart-itemname col-sm-12"> 
										<b><?php echo $order_row['image_thumbnail_url']; ?></b>
										</div>
										
									  </div>
									  
									<div class="col-xs-12" style="padding-bottom: 6px;">
									<div>Qty :1</div>
									
										</div>
									
									
									<div class="col-sm-12" style="padding-bottom: 6px;" >
									  <span class="price_tag" >
										Price:&#8377; <?php echo $order_row['original_price'];?>
									  </span>
									</div>

								
								</div>
								
								


                              </div>
							  <?php }?>	
                        <!-- /.table-responsive -->
						</div>
						 <?php }?>	
                        <div class="row addresses">
						<?php if(isset($orders['billing_address'])) $bill_address=$orders['billing_address'];{ ?>
                            <div class="col-md-6">
                                <h3>Billing address</h3>
                                 <p><?php echo $bill_address['name'];?>
                                    <br><?php echo $bill_address['address_firstline'];?>
                                    <br><?php echo $bill_address['address_secondline'];?>
                                    
                                    <br><?php echo $bill_address['phone_number'];?></p>
                            </div>
						<?Php }?>
						<?php if(isset($orders['shipping_address'])) $ship_address=$orders['shipping_address'];{ ?>
                            <div class="col-md-6">
                                <h3>Shipping address</h3>
                                <p><?php echo $ship_address['name'];?>
                                    <br><?php echo $ship_address['address_firstline'];?>
                                    <br><?php echo $ship_address['address_secondline'];?>
                                    
                                    <br><?php echo $ship_address['phone_number'];?></p>
                            </div>
						<?Php }?>
                        </div>

                    </div>
                </div>

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->


       