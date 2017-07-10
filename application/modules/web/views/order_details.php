 <div id="content">
            <div class="container" style="padding-left: 8%;padding-right: 8%;padding-top: 2%;">


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
                                    <a href="<?php echo base_url('web/Payment/order_history')?>"><i class="fa fa-list"></i> My orders</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('web/home/favorites');?>"><i class="fa fa-heart"></i> My wishlist</a>
                                </li>
                                
                                <li>
                                    <a href="<?php echo base_url('web/home/logout')?>"><i class="fa fa-sign-out"></i> Logout</a>
                                </li>
                            </ul>
                        </div>

                    </div>
				</div>
				  <div class="col-md-9" id="customer-order">
                    <div class="box">
                        <h1>Order #<?php echo $order_id?></h1>

                        <p class="lead" style="margin-bottom: 12px;">Order #<?php echo $order_id?> <strong></strong></p>
                        <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>

                        <hr>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Product</th>
										<th>Size</th>
                                        <th>Unit price</th>
                                        <th>Discount</th>
                                        <th>Total</th>
										<th>Order Status</th>
                                    </tr>
                                </thead>
                                <tbody>
								
						<?php if(isset($orders['data']) && is_array($orders['data'])&&(count($orders['data'])!="0")) {
						$i=1;
						//$summary=$cart_list['data'];
						foreach($orders['data'] as $order_row){
							//print_r($orders['data']);
							//exit;
							
						switch ($order_row['order_status']) {
						case 'In Progress':
							$label_type='label-info';
							break;
						case 'Cancelled':
							$label_type='label-danger';
							break;
						case 'Delivered':
							$label_type='label-success';
							break;
						case 'Dispatched':
							$label_type='label-success';
							break;
						default:
							$label_type='label-info';
							break;
						}?>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                <img src="<?php echo $order_row['image_thumbnail_url']; ?>" alt="<?php echo $order_row['product_name'];?>">
                                            </a>
                                        </td>
                                        <td><a href="#"><?php echo $order_row['product_name']; ?></a>
                                        </td>
                                        <td style="text-align: center;"><?php echo $order_row['size_available'][$order_row['size']];?>
										</td>
                                        <td>&#8377;<?php echo $order_row['original_price'];?></td>
									
                                        <td>&#8377 0</td>
                                        <td>&#8377;<?php echo $order_row['price'];?></td>
										 <td><span class="label <?php echo $label_type?> "><?php echo $order_row['order_status'];?></span></td>
                                    </tr>
						<?php }?>
											
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="6" class="text-right">Order subtotal</th>
                                        <th style="text-align: right;">&#8377;<?php echo $orders['total_price'];?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="6" class="text-right">Shipping and handling</th>
                                        <th style="text-align: right;">&#8377;<?php echo $orders['total_discount'];?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="6" class="text-right">Tax</th>
                                        <th style="text-align: right;">&#8377;<?php echo $orders['total_tax'];?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="6" class="text-right">Total</th>
                                        <th style="text-align: right;">&#8377;<?php echo $orders['final_price'];?></th>
                                    </tr>
                                </tfoot>
							<?php }?>	
                            </table>
				
                        </div>
                        <!-- /.table-responsive -->

                        <div class="row addresses">
						<?php if(isset($orders['billing_address'])) $bill_address=$orders['billing_address'];{ ?>
                            <div class="col-md-6">
                                <h2>Billing address</h2>
                                 <p><?php echo $bill_address['name'];?>
                                    <br><?php echo $bill_address['address_firstline'];?>
                                    <br><?php echo $bill_address['address_secondline'];?>
                                    
                                    <br><?php echo $bill_address['phone_number'];?></p>
                            </div>
						<?Php }?>
						<?php if(isset($orders['shipping_address'])) $ship_address=$orders['shipping_address'];{ ?>
                            <div class="col-md-6">
                                <h2>Shipping address</h2>
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