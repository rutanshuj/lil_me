
<style type="text/css">

</style>
	<div id="footer" class = "footer" >
            <div class="container">
                <div class="row" style="margin-left: 18%;">
                    <div class="col-md-3 col-sm-6">
                      <img src="<?php echo base_url();?>assets/svgs/lilme.svg" alt="Obaju logo" class="hidden-xs" style="height: 57px;">  

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Company</h4>

                        

                        <ul>
                            <li><a href="<?php echo base_url('web/home/about_us')?>">About Us</a>
                            </li>
                            <li><a href="<?php echo base_url('web/home/contact_us')?>">Reach Us</a>
                            </li>
                           
                        </ul>

             <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Need Help</h4>

                         <ul>
                            <li><a href="<?php echo base_url('web/home/faqs')?>">FAQS</a>
                            </li>
                            <li><a href="<?php echo base_url('web/home/tnc');?>">Terms & Conditions</a>
                            </li>
                           
                        </ul>

                       

                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->



                    <div class="col-md-3 col-sm-6">

                  


                    </div>
                    <!-- /.col-md-3 -->

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div><!-- ./wrapper -->
	<script src="<?php echo base_url();?>assets/dist/js/jquery-1.11.0.min.js"></script>
	<script>
	function show(target) {
    document.getElementById(target).style.display = 'block';
		}

	function hide(target) {
	var user_id='<?php echo $this->session->userdata('user_id');?>';//1;1;
	var api_key='<?php echo $this->session->userdata('api_key');?>';//1;'fb0aa13efb9ac71e1c09094d7102d798';
	//alert(target);
	$('#cart_table tr#'+target).toggle();
	document.getElementById(target+'resp').style.display = 'none';
	$.ajax({
				type: "POST",
				dataType:"json",
				url: "<?php echo base_url()."web/Cart/delete_cartItem"?>",				
				data: {cart_id: target,user_id:user_id,api_key:api_key },
			
									success:  function(json_data){  
									if(json_data.length==0){
								document.getElementById("cart_table").style.display = "none";
								document.getElementById("cart_total_amount").innerHTML = '0';
								document.getElementById("cart_no_items").innerHTML = '0';
								document.getElementById("final_price").innerHTML = '0';
							
									}else{
								document.getElementById("cart_total_amount").innerHTML = json_data["final_price"];
								document.getElementById("cart_no_items").innerHTML = json_data["total_quantity"];
								document.getElementById("cart_total_amount_summary").innerHTML = json_data["total_price"];
								document.getElementById("cart_no_items_resp").innerHTML = json_data["total_quantity"];
								document.getElementById("cart_total_amount_summary_resp").innerHTML = json_data["total_price"];	
								document.getElementById("final_price").innerHTML = json_data["final_price"];
									}
								
									
								}, 
					error: function(){
					  	alert("Fail");
					  	}
			   	});	
		}
		
	function show_user_options()
	{
		 $("#user_settings").slideToggle();
	}
		
	function incrementValueForSingleProduct(textvalue)
	{
	
    var value = parseInt(document.getElementById(textvalue).value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
	//alert(value);
    document.getElementById(textvalue).value = value;
	}
	function place_order()
	{
	var user_id='<?php echo $this->session->userdata('user_id');?>';//1;1;
	var api_key='<?php echo $this->session->userdata('api_key');?>';//1;'fb0aa13efb9ac71e1c09094d7102d798';
	//alert(user_id);
		$.ajax({
				type: "POST",
				dataType:"json",
				url: "<?php echo base_url()."web/Cart/order_placed"?>",				
				data: {user_id:user_id,api_key:api_key},
			
									success:  function(json_data){  																		
									
									alert(json_data['message']);
																			
									}, 
					error: function(){
					  	alert("Fail");
					  	}
			   	});	
	}
	function decrementValueForSingleProduct(textvalue)
	{
	//alert(textvalue.value);
    var value = parseInt(document.getElementById(textvalue).value, 10);
	value--;
	value = (value>0) ? value : 0;
   
    document.getElementById(textvalue).value = value;
	}
	function incrementValue(cart_id,textvalue)
	{
	//alert(textvalue);
    var value = parseInt(document.getElementById(textvalue).value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById(textvalue).value = value;
	var user_id='<?php echo $this->session->userdata('user_id');?>';//1;1;
	var api_key='<?php echo $this->session->userdata('api_key');?>';//1;'fb0aa13efb9ac71e1c09094d7102d798';
	edit_cartData(cart_id,user_id,api_key,'',value);
	}
	function decrementValue(cart_id,textvalue)
	{
	//alert(textvalue.value);
    var value = parseInt(document.getElementById(textvalue).value, 10);
	value--;
	value = (value>0) ? value : 0;
   
    document.getElementById(textvalue).value = value;
	var user_id='<?php echo $this->session->userdata('user_id');?>';//1;1;
	var api_key='<?php echo $this->session->userdata('api_key');?>';//1;'fb0aa13efb9ac71e1c09094d7102d798';
	edit_cartData(cart_id,user_id,api_key,'',value);
	}
	function sizeChange(cart_id,value)
	{
	//alert(value);
	var user_id=1;//'<?php echo $this->session->userdata('user_id');?>';//1;1;
	var api_key='<?php echo $this->session->userdata('api_key');?>';//1;'fb0aa13efb9ac71e1c09094d7102d798';
	edit_cartData(cart_id,user_id,api_key,value,'');
	}
	function edit_cartData(cart_id,user_id,api_key,size,quantity)
	{
		//alert(user_id);
		$.ajax({
				type: "POST",
				dataType:"json",
				url: "<?php echo base_url()."web/Cart/edit_cartItem"?>",				
				data: {cart_id: cart_id,user_id:user_id,api_key:api_key,size:size,quantity:quantity},
			
									success:  function(json_data){  																		
									//console.log(json_data);
									var product_arr=json_data['data'];
									 for(j in product_arr ){
										
									
								document.getElementById(product_arr[j]['id']+'price').innerHTML = product_arr[j]['price'];
								document.getElementById(product_arr[j]['id']+'cart_price').innerHTML = product_arr[j]['price'];	
									
									 }
								document.getElementById("cart_total_amount").innerHTML = json_data["final_price"];
								document.getElementById("cart_no_items").innerHTML = json_data["total_quantity"];
								document.getElementById("cart_total_amount_summary").innerHTML = json_data["total_price"];
								document.getElementById("cart_no_items_resp").innerHTML = json_data["total_quantity"];
								document.getElementById("cart_total_amount_summary_resp").innerHTML = json_data["total_price"];
								document.getElementById("final_price").innerHTML = json_data["final_price"];
									}, 
					error: function(){
					  	alert("Fail");
					  	}
			   	});	
	}
	
	</script>
	
	<script src="<?php echo base_url();?>assets/dist/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/dist/js/dd.js"></script>
    <script src="<?php echo base_url();?>assets/dist/js/jquery.cookie.js"></script>
    <script src="<?php echo base_url();?>assets/dist/js/waypoints.min.js"></script>
    <script src="<?php echo base_url();?>assets/dist/js/modernizr.js"></script>
    <script src="<?php echo base_url();?>assets/dist/js/bootstrap-hover-dropdown.js"></script>
    <script src="<?php echo base_url();?>assets/dist/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url();?>assets/dist/js/front.js"></script>
	 </body>
	 </html>

	
	