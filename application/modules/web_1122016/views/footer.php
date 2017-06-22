 
	<div id="footer">
            <div class="container" style="margin-left: 19%;">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                      <img src="<?php echo base_url();?>assets/svgs/lilme.svg" alt="Obaju logo" class="hidden-xs" style="height: 57px;">  

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Company</h4>

                        

                        <ul>
                            <li><a href="category.html">About Us</a>
                            </li>
                            <li><a href="category.html">Reach Us</a>
                            </li>
                           
                        </ul>

                     

                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Need Help</h4>

                         <ul>
                            <li><a href="category.html">FAQS</a>
                            </li>
                            <li><a href="category.html">Terms & Conditions</a>
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
	var user_id=17;
	var api_key='fb0aa13efb9ac71e1c09094d7102d798';
	document.getElementById(target).style.display = 'none';
	$.ajax({
				type: "POST",
				dataType:"json",
				url: "<?php echo base_url()."web/Cart/delete_cartItem"?>",				
				data: {cart_id: target,user_id:user_id,api_key:api_key },
			
									success:  function(json_data){  																		
									
									document.getElementById("cart_total_amount").innerHTML = json_data["total_price"];
									document.getElementById("cart_no_items").innerHTML = json_data["total_quantity"];
									
								}, 
					error: function(){
					  	alert("Fail");
					  	}
			   	});	
		}
		 $('#overlay_div').click(function(){
		document.getElementById("mySidenav").style.width = "0";
		});

		function openNav() {
			  document.getElementById("mySidenav").style.width = "420px";
		}

		/* Set the width of the side navigation to 0 */
		function closeNav() {
			document.getElementById("mySidenav").style.width = "0";
		}
	function incrementValueForSingleProduct(textvalue)
	{
	
    var value = parseInt(document.getElementById(textvalue).value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
	//alert(value);
    document.getElementById(textvalue).value = value;
	}
	function decrementValueForSingleProduct(textvalue)
	{
	alert(textvalue.value);
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
	var user_id=17;
	var api_key='fb0aa13efb9ac71e1c09094d7102d798';
	edit_cartData(cart_id,user_id,api_key,'',value);
	}
	function decrementValue(cart_id,textvalue)
	{
	//alert(textvalue.value);
    var value = parseInt(document.getElementById(textvalue).value, 10);
	value--;
	value = (value>0) ? value : 0;
   
    document.getElementById(textvalue).value = value;
	var user_id=17;
	var api_key='fb0aa13efb9ac71e1c09094d7102d798';
	edit_cartData(cart_id,user_id,api_key,'',value);
	}
	function sizeChange(cart_id,value)
	{
	//	alert(value);
	var user_id=17;
	var api_key='fb0aa13efb9ac71e1c09094d7102d798';
	edit_cartData(cart_id,user_id,api_key,value,'');
	}
	function edit_cartData(cart_id,user_id,api_key,size,quantity)
	{
		$.ajax({
				type: "POST",
				dataType:"json",
				url: "<?php echo base_url()."web/Cart/edit_cartItem"?>",				
				data: {cart_id: cart_id,user_id:user_id,api_key:api_key,size:size,quantity:quantity},
			
									success:  function(json_data){  																		
									
									var product_arr=json_data['data'];
									 for(j in product_arr ){
										
									//console.log(product_arr[j]['id']);
									console.log(product_arr[j]);	
									document.getElementById(product_arr[j]['id']).value = product_arr[j]['quantity'];
									document.getElementById(product_arr[j]['id']+'price').innerHTML = product_arr[j]['price'];	
									//var element = document.getElementById(product_arr[j]['id']+'size');
									//element.value = ;
									 }
									document.getElementById("cart_total_amount").innerHTML = json_data["total_price"];
									document.getElementById("cart_no_items").innerHTML = json_data["total_quantity"];
																			
									}, 
					error: function(){
					  	alert("Fail");
					  	}
			   	});	
	}
	
	</script>

	<script src="<?php echo base_url();?>assets/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/dist/js/jquery.cookie.js"></script>
    <script src="<?php echo base_url();?>assets/dist/js/waypoints.min.js"></script>
    <script src="<?php echo base_url();?>assets/dist/js/modernizr.js"></script>
    <script src="<?php echo base_url();?>assets/dist/js/bootstrap-hover-dropdown.js"></script>
    <script src="<?php echo base_url();?>assets/dist/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url();?>assets/dist/js/front.js"></script>
	 </body>
	 </html>

	
	