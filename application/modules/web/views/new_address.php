<div class='container'>
<div class="col-md-9" id="checkout">

                    <div class="box">
                        <form id='form' method="post" action="<?php echo base_url('web/Payment/update_address');?>">
						<input type="hidden" name="address_type" value=<?php echo $this->input->get('address_type'); ?>>
                            <h1>Checkout</h1>
                            <ul class="nav nav-pills nav-justified">
                                <li class="active"><a href="#"><i class="fa fa-map-marker"></i><br>Address</a>
                                </li>
                               
                                </li>
                                
                                <li class="disabled"><a href="#"><i class="fa fa-eye"></i><br>Order Review</a>
                                </li>
                            </ul>
							<?php 
							if(isset($addresses) && is_array($addresses)) {?>
							<?php 
							foreach($addresses as $address){?>
                            <div class="content">
							
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name">NAME</label>
                                            <input type="text" class="form-control texts" name="name" value="<?php if(isset($address->firstname)) echo $address->firstname." ".$address->lastname ;else echo "";?>" required>
                                        </div>
                                    </div>
                                   
                                </div>
								 <div class="row">
                                <!-- /.row -->
								  <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="phone_number">TELEPHONE</label>
                                            <input type="text" class="form-control texts" name="phone_number" value="<?php if(isset($address->phone_number)) echo $address->phone_number ;else echo "";?>" >
                                        </div>
                                    </div>
                               </div>
                                <!-- /.row -->

                                <div class="row">
                                  
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="zip">PINCODE</label>
                                            <input type="text" class="form-control texts" id="pincode" value="<?php if(isset($address->pincode)) echo $address->pincode ;else echo "";?>">
                                        </div>
                                    </div>
								</div>
								<div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="city">CITY</label>
                                             <input type="text" class="form-control texts" name="city" value="<?php if(isset($address->city)) echo $address->city ;else echo "";?>" >
                                        </div>
                                    </div>
                                   <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="state">State</label>
                                              <input type="text" class="form-control texts" name="state" value="<?php if(isset($address->state)) echo $address->state ;else echo "";?>">
                                        </div>
                                    </div>

                                  
                                   
								
                                </div>
								<div class="row">
								<div class="col-sm-12 ">
								<input type="hidden" name="address_id" value="<?php if(isset($address->address_id)) echo $address->address_id ;?>">
								<label for="comment">ADDRESS:</label>
								<textarea class="form-control texts" rows="3" name="address_value" ><?php if(isset($address->address_value)) echo $address->address_value ;else echo "";?></textarea>
								</div>
								</div>
                                <!-- /.row -->
                            </div>
							<?php }?>
							
							 
							 
							 
                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="<?php echo base_url('web/home/cart');?>" class="btn btn-default">Back to basket</a>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary">Add Address<i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
					<?php } else { ?>
						<form id='form' method="post" action="<?php echo base_url('web/Payment/update_address');?>">
                           						
                            <div class="content">
							
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="firstname">NAME</label>
                                            <input type="text" class="form-control texts" name="name" value="<?php if(isset($address->firstname)) echo $address->firstname." ".$address->lastname ;else echo "";?>" required>
                                        </div>
                                    </div>
                                   
                                </div>
								 <div class="row">
                                <!-- /.row -->
								  <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="phone">TELEPHONE</label>
                                            <input type="text" class="form-control texts" name="phone_number" value="<?php if(isset($address->phone_number)) echo $address->phone_number ;else echo "";?>" required>
                                        </div>
                                    </div>
                               </div>
                                <!-- /.row -->

                                <div class="row">
                                  
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="zip">PINCODE</label>
                                            <input type="text" class="form-control texts" name='pincode' id="zip" value="<?php if(isset($address->pincode)) echo $address->pincode ;else echo "";?>" required>
                                        </div>
                                    </div>
								</div>
								<div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="state">CITY</label>
                                             <input type="text" class="form-control texts" name="city" value="<?php if(isset($address->city)) echo $address->city ;else echo "";?>" required>
                                        </div>
                                    </div>
                                   <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="state">STATE</label>
                                              <input type="text" class="form-control texts" name="state" value="<?php if(isset($address->state)) echo $address->state ;else echo "";?>" required>
                                        </div>
                                    </div>

                                  
                                   
								
                                </div>
								<?php $address_type=$this->input->get('address_type')?>
								<div class="row">
								<div class="col-sm-12 ">
								<input type="hidden" name="address_id" value="<?php if(isset($address->address_id)) echo $address->address_id ;?>">
								<input type="hidden" name="address_type" value="<?php echo $address_type ?>">
								<label for="comment">ADDRESS:</label>
								<textarea class="form-control texts" rows="3" name="address_value" ><?php if(isset($address->address_value)) echo $address->address_value ;else echo "";?></textarea>
								</div>
								</div>
                                <!-- /.row -->
                            </div>
									 
                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="<?php echo base_url('web/home/cart');?>" class="btn btn-default">Back to basket</a>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary">Save Address<i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
						<?php }?>
                    </div>
                    <!-- /.box -->


                </div>
				</div>