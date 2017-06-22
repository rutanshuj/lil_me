 <!-- Content Wrapper. Contains page content -->
 <style>
 
 #ui-datepicker-div{
	     z-index: 99999 !important;
 }
 </style>
 <script src="<?php echo base_url();?>assets/plugins/sweetalert-master/dist/sweetalert.min.js"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/sweetalert-master/dist/sweetalert.css">

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Sales
            <small>View</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Sales</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content">
		
		
          <div class="row">
		  <div class="col-xs-12">
				
					
					<?php 
					
					
					/* <div style="float: left;padding-right:10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/sales/cart');?>"  class="btn btn-primary" id="">Cart</a></div> */
					?>
					<div style="float: left;padding-bottom: 10px;padding-right: 10px;"><a href="<?php echo base_url('admin/sales/order_placed');?>"  style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px" class="btn btn-primary" id="">Order placed</a></div>
					
					
					
					<div style="float: left;padding-right:10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/sales/complete_cancel');?>" class="btn btn-primary" id="">Complete & Cancel</a></div>
					
				
					
				
					
				</div>
            <div class="col-xs-12">
              <div class="box">
               
                <div class="box-body">
				
				
		
			
              <div class="col-xs-12">
			  <script>
			  
			  
			  
			  
				  function validateForm() {
						var x = document.forms["product_add"]["user_select_id"].value;
						
						if (x == null || x == "") {
							alert("Please select user");
							document.forms["product_add"]["user_select_id"].focus();							
							return false;
						}
						
						
					}			  
			  </script>
			  <form role="form" name="product_add" action="<?php echo base_url('admin/sales/order_placed');?>" method="get" onsubmit="return validateForm()" >
			
			
			
			    
			  

			
			   
			   <div class="form-group" style="padding-top: 10px;">
				
				<div style="float: left;margin-right: 10px;"> 
				<select id="id" name="id" style="max-width: 137px;width: 137px;height: 30px;">
<option value="">User</option>

<?php 
				foreach($sales_user as $user_rows){			
				$selected="";
				if(isset($user_select_id)&&($user_select_id==$user_rows['user_id'])){
					$selected="selected";
				}
				if(is_numeric($user_rows['user_id'])){
			echo "<option ".$selected." value=\"".$user_rows['user_id']."\" >".$user_rows['username']."</option>";		
				}
		}
				?>
				</select>
		 
		 
		 	</div>	


<div style="float: left;margin-right: 10px;">
<select id="u_p_id" name="u_p_id" style="max-width: 137px;width: 137px;height: 30px;">
<option value="">Product</option>

<?php 
				foreach($product_details as $product_details_rows){			
				$selected="";
				if(isset($u_p_id)&&($u_p_id==$product_details_rows['product_id'])){
					$selected="selected";
				}
				
			echo "<option ".$selected." value=\"".$product_details_rows['product_id']."\" >".$product_details_rows['product_name']."</option>";		
			
		}
				?>
				</select>




</div>
<div style="float: left;margin-right: 10px;">
<select id="u_s_id" name="u_s_id" style="max-width: 137px;width: 137px;height: 30px;">
<option value="">Sales status</option>
<?php 
				foreach($sales_status as $sales_status_rows){			
					$selected="";
					if(isset($u_s_id)&&($u_s_id==$sales_status_rows['sales_status'])){
						$selected="selected";
					}
					if(($sales_status_rows['sales_status']!="cart")&&($sales_status_rows['sales_status']!="delivered")&&($sales_status_rows['sales_status']!="cancelled")){
					echo "<option ".$selected." value=\"".$sales_status_rows['sales_status']."\" >".ucfirst($sales_status_rows['sales_status'])."</option>";		
					}
			
				}
				?> 				
				
				
			
				</select>
				</div>	
		
		
		<div style="float: left;max-width: 137px;width: 137px;height: 30px;margin-right: 10px;">
		 <input type="text" class="form-control" name="start_date" value="<?php echo $start_date;?>"style="height: 31px;" placeholder="Start date" id="start_date">
		</div>
		 
		
		<div style="float: left;max-width: 137px;width: 137px;height: 30px;margin-right: 10px;">
		<input type="text" class="form-control" name="end_date"id="end_date"style="height: 31px;"  value="<?php echo $end_date;?>" placeholder="End date">
		</div>
		
		
				<div  style="float: left; margin-right: 10px;"><input type="submit" class="btn btn-primary" id="submit" name="submit" value="Search" ></div>
				<div  style="float: left;margin-right: 10px;">
				
				
				<a href="<?php echo base_url('admin/sales/order_placed');?>" class="btn btn-primary">Clear</a></div>
               </div>
			
			
				
				
				
				<div class="form-group">
				
				<div  style="float: left;width: 160px;">
				
				
				</div>
				
				
				
                </div>
				
				
				
				
				
				
				</form>
				
				
				
				
				
             
              </div>
			  
			 
              <!-- /.box-body -->

          
         
                 </div><!-- /.box-body -->
              </div><!-- /.box -->

                        


		   </div><!-- /.col -->
		   <?php $num="0" ;  $num12="0";
		   if($result_count!="0"){
		   ?>
		     <div class="col-xs-12">
              <div class="box"  style="border-top: none;" >
			  
			  <script>
function update_status(user_id,status,card_id,user_select_id,limit_plus_minus,u_p_id,u_s_id,start_date,end_date,email,product_name){	
				
				
				
				
					swal({   title: "Are you sure to change status as "+status+" ?", 
					  text: name,
					  type: "warning",  
					  showCancelButton: true,  
					  confirmButtonColor: "#DD6B55",  
					  confirmButtonText: "Yes, change it!",  
					  cancelButtonText: "No, cancel it!",  
					  closeOnConfirm: true, 
					  closeOnCancel: true },
					  function(isConfirm){  
						  if (isConfirm) { 


							ajaxRequest= $.ajax({
								method: "post",
								
								url: "<?php echo base_url('admin/sales/card_up_date_status');?>",							
								data: {"user_id": user_id, "status": status, "card_id": card_id, "user_select_id": user_select_id, "email": email, "product_name": product_name}
							});
						
							
							ajaxRequest.done(function (response, textStatus, jqXHR){
								  // show successfully for submit message								 
								 if(response=="1"){								
									window.location = "<?php echo base_url('admin/sales/order_placed?id=');?>"+user_select_id+"&div_plus_minus="+limit_plus_minus+"&u_p_id="+u_p_id+"&u_s_id="+u_s_id+"&start_date="+start_date+"&end_date="+end_date;
								 } else {									
									swal('Please try again'); 
								 }
								  
								  
							 });
	 
							 ajaxRequest.fail(function (){
							  swal('Please try again'); 
							 });

						  
							
						  
							  
						  } else {     
							swal("Cancelled", "You have cancelled :)", "error");
						  } 
					  });
					
				}
				</script>
		   <?php 
		   $limit_plus_minus="0";
		   foreach($user_ids as $user_rows){ 
		   foreach($users_id[$user_rows]['trans_ids'] as $t_id){$limit_plus_minus++;$num12++;?>
		    <div class="box box-default collapsed-box"  style="border-top: none !important;    margin-bottom: 1px  !important;">
			
            <div class="box-header with-border" data-widget="collapse-header">
			<?php 
			 
if($limit_plus_minus==$div_plus_minus){ 

?>
<div><h3 class="box-title"> <strong>   <?php echo "Successfully updated";?> </strong></h3></div><?php
}?>
<div style="float:left;width:100%" class="btn btn-box-tool" data-widget="collapse">
				
				<?php
				if($limit_plus_minus==$div_plus_minus){ ?>
					<i class="fa fa-minus"style="float:left;margin-top: 4px;" ></i><?php
				} else { ?>
				<i class="fa fa-plus" style="float:left;margin-top: 4px;" ></i><?php 
				}?>
                
			<div style="float:left"><h3 class="box-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Order ID :</strong><?php 
			echo "#";printf("%04d", $users_id[$user_rows]['card_id'][$t_id]);
			?> </h3></div>
			<div  style="float:left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
             <div  style="float:left"><h3 class="box-title"> <strong>   Order Date:&nbsp;&nbsp;</strong><?php  
			 
			echo date("d-m-Y H:i", strtotime($users_id[$user_rows]['transaction_created_on'][$t_id]));
			
			
			 ?> </h3></div>
			 
			 
			 
			 
			<div  style="float:left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
			 <div  style="float:left"><h3 class="box-title"> <strong>   Products:&nbsp;&nbsp;</strong><?php  
			 
			echo $users_id[$user_rows]['total_product'][$t_id];
			
			
			 ?> </h3></div><div  style="float:left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
			 <div  style="float:left"><h3 class="box-title"> <strong>   Total Price:&nbsp;&nbsp;</strong><?php  
			 
			echo   number_format($users_id[$user_rows]['trans_payu_txn_amount'][$t_id],2);
			
			
			 ?> </h3></div>
            
           
			
			
               
				
             	</div> 		  
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
			
			
			<?php
				if($limit_plus_minus==$div_plus_minus){ ?>
					<div class="box-body" style="display: block;margin-bottom: 0px !important;">
					<?php
				} else { ?>
				<div class="box-body" style="display: none;">
				
				<?php 
				}?>
            
			
			
			
			<table id="example7" class="table table-bordered table-striped" >
                    
					
					
					
					<?php 
					foreach($users_id[$user_rows]['sales_details'][$t_id]['details'] as $sales_details_rows){
						$num++;
						
						
						if($sales_details_rows['image_thumbnail_url']==""){
							$image_url=base_url()."/assets/img/coming_soon.jpg";
						} else {
							$image_url=base_url().$sales_details_rows['image_thumbnail_url'];
						}
					?>
					
					 
					 
					
					
								
                      <tr>
                       
                        <td><img src="<?php echo $image_url;?>" alt="Smiley face" height="100" width="100"></td>
                        <td>
						Product Name: <?php echo $sales_details_rows['product_name'];?><br>
						Gender : <?php echo $sales_details_rows['gender'];?><br>
						Size: <?php echo $sales_details_rows['size_title'];?><br>
						Payment type: 	<?php echo $sales_details_rows['user_transactions_mode'];?>
					
						
						</td>
						
				
						<td>
						Product Price: <?php echo $sales_details_rows['price'];?><br>
						Delivery Charges:0	<br>
						Discount: <?php echo $sales_details_rows['cart_individual_discount'];?><br>
						Tax:<?php echo $sales_details_rows['cart_tax'];?><br>						
						
						Amount paid: <?php echo $sales_details_rows['price']+$sales_details_rows['cart_tax']-$sales_details_rows['cart_individual_discount'];?>
						
						</td>
						
						
						
						
						
                        <td>
						<?php 
						
						/* Name:: <?php echo $sales_details_rows['user_address_firstname']."  ".$sales_details_rows['user_address_lastname'];?><br>
						Mobile number:: <?php echo $sales_details_rows['user_address_phone_number'];?><br>
						Address:	<?php echo $sales_details_rows['address_value'];?><br>	
						
						City :: <?php echo $sales_details_rows['user_address_city'];?><br>
						
						
						State :: <?php echo $sales_details_rows['user_address_state']."   , ";?>
						Pincode :: <?php echo $sales_details_rows['user_address_pincode'];?><br> */
						?>
						</td>						
						
						<td>
						<div>
						<select name="<?php echo "sales_status_id_".$num;?>" id="<?php echo "sales_status_id_".$num;?>" class="form-control" style="width: 115px;">
						<?php foreach($sales_status as $sales_status_rows) {
							$selected="";
							if($sales_status_rows['sales_status']==$sales_details_rows['order_tracker_order_status']){
								$selected="selected";
							}
							if(ucfirst($sales_status_rows['sales_status'])!="Cart"){
							?>
						
						<option value="<?php echo $sales_status_rows['sales_status'];?>" <?php echo $selected;?>><?php echo ucfirst($sales_status_rows['sales_status']);?></option>
						
						<?php
						}}
						?>
						</select>
						
						
							</div>					
						<div  style="margin-top: 10px;">
						
						<?php
						
						if(($sales_details_rows['order_tracker_order_status']=="in process")||($sales_details_rows['order_tracker_order_status']=="dispatched")){
					?>
						<input style="width: 115px;" value="UPDATE STATUS"  type="button"  class="btn btn-primary" onClick="return update_status('<?php  echo $sess_user_id;?>',document.getElementById('sales_status_id_<?php echo $num;?>').value,'<?php echo $sales_details_rows['order_tracker_id'];?>','<?php echo $user_select_id;?>','<?php echo $limit_plus_minus;?>','<?php echo $u_p_id;?>','<?php echo $u_s_id;?>','<?php echo $start_date;?>','<?php echo $end_date;?>','<?php echo $sales_details_rows['email_id'];?>','<?php echo $sales_details_rows['product_name'];?>')" />
						
						
					
						
						<?php 
						}
					?>
						</div>
						</td>
						
                      </tr>
                 
					

				   
                   
					<?php }?>                
				</table>
			
			
			
			
			
			
			
			<table id="example7" border="10" class="table table-bordered table-striped" >
			<tr>
			
					<td>
					<h2>Shipping address</h2> <br>					
<strong><?php echo $users_id[$user_rows]['shipping_address'][$t_id]['firstname']." ".$users_id[$user_rows]['shipping_address'][$t_id]['lastname'];?></strong><br>
					<?php echo $users_id[$user_rows]['shipping_address'][$t_id]['address_value'];?><br>
					<?php echo $users_id[$user_rows]['shipping_address'][$t_id]['state'];?><br>
					<?php echo $users_id[$user_rows]['shipping_address'][$t_id]['city']."-".$users_id[$user_rows]['shipping_address'][$t_id]['pincode'];?><br>				
					Email: <?php echo $sales_details_rows['email_id'];?><br>
					
					Phone :<?php echo $users_id[$user_rows]['shipping_address'][$t_id]['phone_number'];?><br>	
						
					</td>
					<td> 
					<h2>Billing Address</h2><br>									
					<strong><?php echo $users_id[$user_rows]['billing_address'][$t_id]['firstname']." ".$users_id[$user_rows]['billing_address'][$t_id]['lastname'];?></strong><br>
					<?php echo $users_id[$user_rows]['billing_address'][$t_id]['address_value'];?><br>
					<?php echo $users_id[$user_rows]['billing_address'][$t_id]['state'];?><br>
					<?php echo $users_id[$user_rows]['billing_address'][$t_id]['city']."-".$users_id[$user_rows]['billing_address'][$t_id]['pincode'];?><br>				
					Phone ::<?php echo $users_id[$user_rows]['billing_address'][$t_id]['phone_number'];?><br>	
					
					</td>	
				
					
					
					
					<td>
					
					</td>
					</tr>			
			</table>
             
            </div>
            <!-- /.box-body -->
          </div>
		 
<?php

 if($trans_id_count!=$num12) {?>		  
		  <div style="height:10px;background-color: #ecf0f5;"></div>
		  
		  <?php }
		   } 
		   }
		   ?>
			  </div>
		   </div>
		   
		   
		   
		   
		   <?php 
		   }
		   ?>
		   
		   
          </div><!-- /.row -->
       


	   </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   