 <!-- Content Wrapper. Contains page content -->
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
				
					
					
						
					<div style="float: left;padding-right:10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/sales/cart');?>" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px" class="btn btn-primary" id="">Cart</a></div>
					
					<div style="float: left;padding-bottom: 10px;padding-right: 10px;"><a href="<?php echo base_url('admin/sales/order_placed');?>"  class="btn btn-primary" id="">Order placed</a></div>
					
					
					
					<div style="float: left;padding-right:10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/sales/complete_cancel');?>"   class="btn btn-primary" id="">Complete & Cancel</a></div>
					
				
					
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
			  <form role="form" name="product_add" action="<?php echo base_url('admin/sales/cart');?>" method="get" onsubmit="return validateForm()" >
			
			
			
			
			  

			
			   
			   <div class="form-group" style="padding-top: 10px;">
				<div  style="float: left;width: 160px;">Select user</div>
				<div style="float: left;"> <select id="user_select_id" name="user_select_id" style="max-width: 137px;width: 137px;height: 30px;">
<option value="">Select user</option>

<?php 
				foreach($sales_user as $user_rows){			
				$selected="";
				if(isset($user_select_id)&&($user_select_id==$user_rows['user_id'])){
					$selected="selected";
				}
				
			echo "<option ".$selected." value=\"".$user_rows['user_id']."\" >".$user_rows['username']."</option>";		
			
		}
				?>
				</select>
		 
		 
		 	</div>			
				<div  style="float: left;width: 160px;"><input type="submit" class="btn btn-primary" id="submit" name="submit" value="View" ></div>
				
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
		   <?php 
		   $num12="0";
		   if($result_count!="0"){
			   
		   ?>
		     <div class="col-xs-12">
              <div class="box">
			  
			  <script>
function update_status(user_id,status,card_id,user_select_id){	
				
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
							window.location = "<?php echo base_url('admin/sales/card_up_date_status?user_id=');?>"+user_id+"&status="+status+"&card_id="+card_id+"&user_select_id="+user_select_id+"&page=cart";	
						  
							  
						  } else {     
							swal("Cancelled", "You have cancelled :)", "error");
						  } 
					  });
					
				}
				</script>
		   <?php foreach($proje_ids as $projec_ids_row){$num12++?>
		    <div class="box box-default collapsed-box" style="border-top: none !important;    margin-bottom: 1px  !important;">
            <div class="box-header with-border">
              <h3 class="box-title">Product Name ::<?php echo $sales_details[$projec_ids_row]['0']['product_name'];?> </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>			  
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
			<?php  foreach($sales_details[$projec_ids_row] as $sales_details_row){?>
			
            <div class="box-body" style="display: none;">
			
			<table id="example7" class="table table-bordered table-striped" >
                    
					
					<?php $num="0" ;
					//foreach($sales_details[$t_id] as $sales_details_rows){
						$num++;
					?>
					
					 
					
								
                      <tr>
                       
                        <td><img src="<?php echo base_url().$sales_details_row['image_thumbnail_url'];?>" alt="Smiley face" height="150" width="150"></td>
                        <td>
						 <?php // echo Product Name::$sales_details_row['product_name'];<br> ?>
						Gender :: <?php echo $sales_details_row['gender'];?><br>
						Size:: <?php echo $sales_details_row['size_title'];?><br>
						Quantity:: <?php echo $sales_details_row['quantity'];?><br>
						Price:: <?php echo $sales_details_row['price'];?><br>
						Description:: <?php echo $sales_details_row['description'];?>
						</td>
						
				<td>
						 <?php // echo Product Name::$sales_details_row['product_name'];<br> ?>
						Unit price :: <?php echo $sales_details_row['price'];?><br>
						Discount:: <?php echo $sales_details_row['product_indi_discount'];?><br>
						Tax:: <?php echo "0.00";//echo $sales_details_row['quantity'];?><br>
						Total:: <?php echo $sales_details_row['price_with_discount_in'];?>
						
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
						
						
						
						
						
                      </tr>
                 
					

				   
                   
					<?php 
					//}
					
					?>                
				</table>
			
			
             
            </div>
            <!-- /.box-body -->
         
		   <?php }?>

		 </div>
		  
<?php 

if(count($proje_ids)!=$num12) {?>
<div style="height:10px;background-color: #ecf0f5;"></div>
		   <?php }}?>
			  
		   </div>
		   
		   
		   
		   </div>
		  

 <div class="col-xs-12">
              <div class="box">
			 
			  
			   <div class="box-body">
				<b>product :: </b><?php echo $total_product;?> ;
			    <b>Price :: </b><?php echo $total_price;?> ;
			<b>Discount :: </b><?php echo $total_discount;?> ;
			<b>Price after discount :: </b><?php echo $total_price_after_diss;?>
              <div class="col-xs-12">
			  </div>
			  </div>
			  
			  </div>
			  </div>

		  <?php 
		   }
		   ?>
		   
		   
          </div><!-- /.row -->
       


	   </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   