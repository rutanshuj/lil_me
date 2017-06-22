<div class='container'>
<div class="col-md-9" id="checkout">

                    <div class="box">
                        <form id='form' method="post" action="<?php echo base_url('web/Payment');?>">
                            <h1>Checkout</h1>
                            <ul class="nav nav-pills nav-justified">
                                <li class="active"><a href="#"><i class="fa fa-map-marker"></i><br>Address</a>
                                </li>
                               
                                </li>
                                
                                <li class="disabled"><a href="#"><i class="fa fa-eye"></i><br>Order Review</a>
                                </li>
                            </ul>

                            <div class="content">
							
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="firstname">Name</label>
                                            <input type="text" class="form-control texts" id="firstname" value="<?php if(isset($firstname)) echo "" ;else echo "";?>">
                                        </div>
                                    </div>
                                   
                                </div>
								 <div class="row">
                                <!-- /.row -->
								  <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="phone">Telephone</label>
                                            <input type="text" class="form-control texts" id="phone" value="<?php if(isset($firstname)) echo "" ;else echo "";?>">
                                        </div>
                                    </div>
                               </div>
                                <!-- /.row -->

                                <div class="row">
                                  
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="zip">PINCODE</label>
                                            <input type="text" class="form-control texts" id="zip" value="<?php if(isset($firstname)) echo "" ;else echo "";?>">
                                        </div>
                                    </div>
								</div>
								<div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="state">State</label>
                                             <input type="text" class="form-control texts" id="zip" value="<?php if(isset($firstname)) echo "" ;else echo "";?>">
                                        </div>
                                    </div>
                                   <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="state">CITY</label>
                                              <input type="text" class="form-control texts" id="zip" value="<?php if(isset($firstname)) echo "" ;else echo "";?>">
                                        </div>
                                    </div>

                                  
                                   
								
                                </div>
								<div class="row">
								<div class="col-sm-12 ">
								<label for="comment">ADDRESS:</label>
								<textarea class="form-control texts" rows="3" id="comment" value="<?php if(isset($firstname)) echo "" ;else echo "";?>"></textarea>
								</div>
								</div>
                                <!-- /.row -->
                            </div>

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="<?php echo base_url('web/home/cart');?>" class="btn btn-default">Back to basket</a>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary">Continue to Delivery Method<i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->


                </div>
				</div>