 <!-- Content Wrapper. Contains page content -->
 <script src="<?php echo base_url();?>assets/plugins/sweetalert-master/dist/sweetalert.min.js"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/sweetalert-master/dist/sweetalert.css">

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Sales
            <small>Complete</small>
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
				
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/sales');?>" class="btn btn-primary"  id="">View by user</a></div>
					<div style="float: left;padding-bottom: 10px;padding-right: 10px;"><a href="<?php echo base_url('admin/sales/dispatched');?>" class="btn btn-primary" id="">Dispatched</a></div>
					<div style="float: left;padding-right:10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/sales/complete');?>" class="btn btn-primary"  style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px" id="">Complete</a></div>
					
					<div style="float: left;padding-bottom: 10px;padding-right:10px;"><a href="<?php echo base_url('admin/sales/cancel');?>" class="btn btn-primary" id="">Cancel</a></div>
					
					
					
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
			  <form role="form" name="product_add" action="<?php echo base_url('admin/sales/complete');?>" method="get" onsubmit="return validateForm()" >
			
			
			
			
			  

			
			   
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
		   if($result_count!="0"){
		   ?>
		     <div class="col-xs-12">
              <div class="box">
			 <!-- 
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
						//	window.location = "<?php echo base_url('admin/sales/card_up_date_status?user_id=');?>"+user_id+"&status="+status+"&card_id="+card_id+"&user_select_id="+user_select_id+"&page=complete";	
						  
							  
						  } else {     
							swal("Cancelled", "You have cancelled :)", "error");
						  } 
					  });
					
				}
				</script>
				-->
		   <?php foreach($transaction_id as $t_id){?>
		    <div class="box box-default collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Transaction ID ::<?php echo $t_id;?> </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>			  
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: none;">
			
			<table id="example7" class="table table-bordered table-striped" >
                    
					
					<?php $num="0" ;foreach($sales_details[$t_id] as $sales_details_rows){$num++;?>
					
					 
					
								
                      <tr>
                       
                        <td><img src="<?php echo base_url().$sales_details_rows['image_thumbnail_url'];?>" alt="Smiley face" height="150" width="150"></td>
                        <td>
						Product Name:: <?php echo $sales_details_rows['product_name'];?><br>
						Gender :: <?php echo $sales_details_rows['gender'];?><br>
						Size:: <?php echo $sales_details_rows['size_title'];?><br>
						Quantity:: <?php echo $sales_details_rows['quantity'];?><br>
						Price:: <?php echo $sales_details_rows['price'];?><br>
						Description:: <?php echo $sales_details_rows['description'];?>
						</td>
                        						
						
						<td>
						
						<select name="<?php echo "sales_status_id_".$num;?>" id="<?php echo "sales_status_id_".$num;?>">
						<?php foreach($sales_status as $sales_status_rows) {
							$selected="";
							if($sales_status_rows['sales_status']==$sales_details_rows['cart_status']){
								$selected="selected";
							}
							?>
						
						<option value="<?php echo $sales_status_rows['sales_status'];?>" <?php echo $selected;?>><?php echo ucfirst($sales_status_rows['sales_status']);?></option>
						
						<?php
						}
						?>
						</select>
						
						</td>
						
						<td>
												
						
						
						
					
						<!--
						
						
						<input value="UPDATE STATUS"  type="button"  class="btn btn-primary" onClick="return update_status('<?php echo $sess_user_id;?>',document.getElementById('sales_status_id_<?php echo $num;?>').value,'<?php echo $sales_details_rows['card_id'];?>','<?php echo $user_select_id;?>')" />
						
						-->
						
						</td>
						
                      </tr>
                 
					

				   
                   
					<?php }?>                
				</table>
			
			
             
            </div>
            <!-- /.box-body -->
          </div>
		   <?php }?>
			  
		   </div>
		   
		   
		   
		   </div>
		   <?php 
		   }
		   ?>
		   
		   
          </div><!-- /.row -->
       


	   </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   