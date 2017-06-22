<style>
#order_history_resp
  {
	  display:none;
  }
@media (max-width: 768px) {
 .table-hover{
	  display:none
  }
  #order_history_resp
  {
	  display:block;
  }
  .table-responsive
  {
	  border:none;
  }
  
}
.single_order
{
	box-shadow: 0 1px 8px rgba(0, 0, 0, 0.2);
	border: solid 1px #e6e6e6;
	margin-bottom: 10px;
}
.ord_details{
	padding:10px;

}.ord_date{
	
    border-bottom: 1px solid grey;
	font-weight: 700;

}
</style>
<div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li>My orders</li>
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
                                    <a href="<?php echo base_url('web/home/')?>"><i class="fa fa-sign-out"></i> Logout</a>
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

                        <p class="lead">Your orders on one place.</p>
                        <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>

                        <hr>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Status</th>
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
										<td><span class="label label-info">Being prepared</span>
                                        <td><a href="<?php echo base_url('web/Payment/order_details?ord_id=').$single_order->order_id ?>" class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                                   
                                  
                                </tbody>
									<?php }
									}?>
                            </table>
							<div id ='order_history_resp' class="col-sm-12">
							<div class='single_order'>
							     <div class="col-sm-12 ord_details ord_date">22/06/2013
							 </div>
								<div class="col-sm-12 ord_details">Order Number : # <span>1735 </span>
							</div>
								<div class="col-sm-12 ord_details">Total : &#8377;<span> 14,500</span>
								<a href="" class="btn btn-info btn-sm pull-right">View</a>
							</div>
								<div class="col-sm-12 ord_details">
								Total Items : <span>5 </span>
								<span class="label pull-right label-info">Being prepared</span>
							</div>
							</div>
							
							<div class='single_order'>
							     <div class="col-sm-12 ord_details ord_date">22/06/2013
							 </div>
								<div class="col-sm-12 ord_details">Order Number : # <span>1735 </span>
							</div>
								<div class="col-sm-12 ord_details">Total : &#8377;<span> 14,500</span>
								<a href="" class="btn btn-info btn-sm pull-right">View</a>
							</div>
								<div class="col-sm-12 ord_details">
								Total Items : <span>5 </span>
								<span class="label pull-right label-warning">Being prepared</span>
							</div>
							</div>
							</div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container -->
        </div>
		
        <!-- /#content -->


        <!-- *** FOOTER *** -->
