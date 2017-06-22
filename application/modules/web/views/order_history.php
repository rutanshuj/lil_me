     <div id="content">
            <div class="container" style="padding-top: 2%; padding-left: 8%; padding-right: 8%;">

                <div class="col-md-12">

                    

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
                                    <a href="#"><i class="fa fa-list"></i> My orders</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('web/home/favorites')?>"><i class="fa fa-heart"></i> My wishlist</a>
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
			
                <div class="col-md-9" id="customer-orders">
                    <div class="box">
                        <h1>My orders</h1>
						<?php $trans_msg=$this->session->userdata('trans_message');
							if(isset($trans_msg))echo $trans_msg?>
                        <p class="lead" style="margin-bottom: 17px;">Your orders on one place.</p>
                        <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>

                        <hr>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php if( isset($orders) && is_array($orders)) {
										
										foreach($orders as $single_order){?>
                                    <tr>
                                        <th># <?php echo $single_order->order_id ?></th>
                                        <td><?php echo $single_order->order_date ?></td>
                                        <td> &#8377;<?php echo $single_order->price ?></td>
                                        <td><a href="<?php echo base_url('web/Payment/order_details?ord_id=').$single_order->order_id ?>" class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                   
                                </tbody>
										<?php }
									}?>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container -->
        </div>