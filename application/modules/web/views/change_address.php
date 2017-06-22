  <div id="content">
            <div class="container">
				
                
				
                <div class="col-md-9" id="checkout">

                    <div class="box">
                        <form method="post" action="<?php echo base_url("web/payment/set_".$address_type)?>">
                           
                            
				<?php
			
				if(isset($address_list)) {
						/* 	echo"<pre>";
							print_r($address_list);
							echo"</pre>";
							die(); */?>
							
                              
                                     <?php 
							$row_count=0;
							$count=count($address_list);
							$row_count=ceil($count/2);
				
				//for($i=1;$i<$row_count;$i++) {?>
				  <div class="row">
				
				<?php foreach($address_list as $address){?>
                                    
									<div class="col-sm-6">
                                        <div class="box shipping-method" style="height: 188px;">
											<div class="address_type" style="margin-left: 26px;"> Shipping Address
										
											
										<a href="<?php echo base_url('web/payment/add_address?address_id=').$address->address_id;?>" class="addr_edit" style="float:right"><img src="<?php echo base_url();?>assets/svgs/ic_mode_edit_black_18px.svg"></a>
										</div>
										<hr style="margin-top: 10px;margin-bottom: 35px;">
											<div><input type="radio" name="address_id" value="<?php echo $address->address_id;?>"></div>
											<div class='address_detail'> <span class="r_name"><b><?php echo $address->firstname." ".$address->lastname?></b></span>
											
											<br>
											<span class="address_line"><?php echo $address->address_value?></span>
											<br>
											<span class="city"><?php echo $address->city?></span>-<span class="pin"><?php echo $address->pincode?></span>
											<br>
											<span class="phone"><?php echo $address->phone_number?></span>
                                           </div>
                                        </div>
                                    </div>

				<?php }?>   
                         <div class="col-sm-6">
                                        <div class="box shipping-method" align="center" style="height: 188px;">
										
										
										<span class="phone">ADD MORE</span><br>
										<a href="<?php echo base_url('web/payment/add_address');?>" class="address_add" style="float:left;margin-left: 40%;">
										<img src="<?php echo base_url();?>assets/svgs/ic_add_black_36px.svg" style="height: 75px;"></a>	
										
                                        </div>
                            </div> 
					</div>     
				<?php //}?>							
                               
								
                      
				<?php }?>
				
                           
                          <div class="box-footer">
                                <div class="pull-left">
                                    
                                </div>
								
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary">Save<i class="fa fa-chevron-right"></i>
                                   </button>
                                </div>
                            </div>
							 
                        </form>
                    </div>
                    <!-- /.box -->  


                </div>
                <!-- /.col-md-9 -->
				<script>
					function address_delete(address_id){
					
					swal({   title: "Are you sure to delete below Address ?", 
					
					  type: "warning",  
					  showCancelButton: true,  
					  confirmButtonColor: "#DD6B55",  
					  confirmButtonText: "Yes, delete it!",  
					  cancelButtonText: "No, cancel it!",  
					  closeOnConfirm: true, 
					  closeOnCancel: true },
					  function(isConfirm){  
						  if (isConfirm) {  
							window.location = "<?php echo base_url('admin/category/address_delete?address_id=');?>"+address_id;
							  
						  } else {     
							swal("Cancelled", "You have cancelled :)", "error");
						  } 
					  });
					
					
				}
					</script>
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
                                        <th>&#8377;<span id="cart_total_amount"> <?php echo $cart_list['total_price']; ?></span></th>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <th><span id="total_discount">  <?php echo $cart_list['total_discount']; ?>%</span></th>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <th>&#8377; <span id="total_tax"><?php echo $cart_list['total_tax']; ?></span></th>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <th>&#8377; <span id="final_price"><?php echo $cart_list['final_price']; ?></span></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
					</div>

                </div>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
        </div>
		