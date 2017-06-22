 <!-- Content Wrapper. Contains page content -->
<style>
.td_width {
  width:33%;
}

</style>
    
        <!-- Content Header (Page header) -->
           
         
		   <!-- Main content -->
        <section class="">
		<h3>User Profile Page</h3>
				
          <div class="row">
		<div class="col-xs-12">
		<div class="col-xs-8">
		<div class="col-xs-12" style="float:left;border-style: groove;padding: 0px 0px 17px 0px;">
			<div style="float:left">
		<img src="<?php echo base_url()."assets\img\default.jpg";?>" alt="Smiley face" height="150" width="180">
		</div>
		
		
			<div>
		<div>
		<table>
		<tr>
		<td><b>Name</b></td>
		<td colspan="2"> <?php echo ucfirst($users_details->firstname)." ".$users_details->lastname;?></td>
		
		</tr>
		<tr>
		<td><b>Username</b></td>
		<td colspan="2"><?php echo $users_details->username;?></td>
		
		</tr>
		<tr>
		<td><b>Email</b></td>
		<td colspan="2"> <?php echo $users_details->email_id;?></td>
		
		</tr>
		<tr>
		<td><b>Contact Number</b></td>
		<td colspan="2"> <?php echo $users_details->primary_phone_number;?></td>
		
		</tr>
		<tr>
		<td><b>Company</b></td>
		<td colspan="2"> <?php echo ucfirst($users_details->company_name);?></td>
		
		</tr>
		<tr>
		<td class="td_width"><b>DEVICE USER</b></td>
		<td class="td_width"  align="center"><b>TYPE</b></td>
		<td class="td_width"  align="center"><b>VALID THROUGH</b></td>
		</tr>
		<tr>
		<td><?php echo $users_details->device_type;?></td>
		<td  align="center"><?php echo ucfirst($users_details->user_type);?></td>
		<td align="center"><?php echo date("Y-m-d", strtotime($users_details->valid_through))?></td>
		</tr>
		
		</table>
		




</div>
		</div>
		</div>
		
		<div  class="col-xs-12" style="min-height: 284px;">
		<?php if(count($user_activity)!="0"){?>
		
		<table id="example"  class="display table table-bordered table-striped">
               <!-- <table id="example2" class="table table-bordered table-striped">-->
                    <thead>
                      <tr>
                        <th>Activity Time</th>
                        <th>Activity</th>
                        <th>Activity Detail</th>
                        
						
						  
                      </tr>
                    </thead>
					

                    <tbody>
					<?php
foreach($user_activity as $user_activity_row){
					?>
		<tr>
		<td><?php echo $user_activity_row->activity_time;?></td>
		<td><?php echo $user_activity_row->event_type;?></td>
		<td><?php echo  $user_activity_row->activity_comment;?></td>
		</tr>
		<?php
}
		?>
		</tbody>
			</table>
		<?php
		} else {
			echo "<p style='padding-top: 32px;font-size: 16px'>";
			echo "Zero activity found";
			echo "</p>";
			
		}
		?>
		</div>
		
		
		</div>
			





			
			<?php if($total_favorites!="0"){ ?>
			
			<div class="col-xs-4" style="background-color: #545354;color: white;padding: 3px;font-size: 18px;">
			<p style="float: left;">Favorites (<?php echo $total_favorites;?>)</p>
<a href="<?php echo base_url('admin/user/favorites?id=').$id;?>" style="float: right;padding-right: 10px;color: white;"><u>View all</u></a>
			
			
			</div>
			<div  style="border-style: groove;padding: 0px 0px 17px 0px;   height: 120px;
    overflow: auto;" >
			
						  
						  
						  <?php 
					if(count($jewellery_favorites)>0){
						$ji="0";
						$t_jewellery = count($jewellery_favorites);
						 
						foreach($jewellery_favorites as $j_favorites_rows){
							$ji++;							
							
							$image_url=base_url().$j_favorites_rows->image_url;
				 
							$file_headers = @get_headers($image_url);
							
							if((strpos($file_headers['0'], '404 Not Found') !== false)||($j_favorites_rows->image_url=="")) {
								$image_url = base_url().'assets/img/default.jpg';
							}
							
							
							?>
						<div style="float: right;margin-top: 10px;">

						<div style="float: left;">

						<img src="<?php echo $image_url;?>" alt="<?php echo $image_url;?>" height="75" width="75"><br><?php echo $j_favorites_rows->product_name;?>
						</div> 
						<div style="float: right;">

						Category : <?php echo $j_favorites_rows->category_name;?><br>
						Sub-Category : <?php echo $j_favorites_rows->subcategory_name;?><br>
						
						</div>	

						</div>
						<?php
						if($t_jewellery!=$ji){
							?>
							<div style="float: inherit;margin-top: 10px;width: 91%;margin-left: 10px;">&nbsp;<hr style="color: #f00;
    background-color: #333;
    height: 1px;"></div>
							<?php 
						}
						?>
						
						
						
						
							<?php 
						}
					}
					
					
					
					
					
					
			?>
						  
						  
						  
<?php 
					if(count($diamond_favorites)>0){
						$di="0";
						$t_diamond = count($diamond_favorites);
						 
						foreach($diamond_favorites as $d_favorites_rows){
							$di++;							
							$image_url=base_url().$d_favorites_rows->image_url;
				 
							$file_headers = @get_headers($image_url);						
							
							if((strpos($file_headers['0'], '404 Not Found') !== false)||($d_favorites_rows->image_url=="")) {
								$image_url = base_url().'assets/img/default.jpg';
							}							
							?>
						<div style="float: right;margin-top: 10px;width: 98%;height: 75%;">
						<?php  if($di=="1"){?>
						
						<div style=""><b>Diamond Favorites</b></div>
						
						<?php }?>
						<div style="float: left;">

						<img src="<?php echo $image_url;?>" alt="<?php echo $d_favorites_rows->product_name;?>" height="75" width="75"><br>
						</div> 
						<div style="padding-top: 25px;">

						Product : <?php echo $d_favorites_rows->product_name;?>
						
						
						</div>	

						</div>
						<?php
						if($t_diamond!=$di){
							?>
							<div style="float: inherit;margin-top: 10px;width: 91%;margin-left: 10px;">&nbsp;<hr style="color: #f00;
    background-color: #333;
    height: 1px;"></div>
							<?php 
						}
						?>
						
						
						
						
							<?php 
						}
					}
					
					
					
					
					
					
			?>









							
						  </div>
			
			
			<?php } else {?>
			<div class="col-xs-4" style="background-color: #545354;color: white;padding: 3px;font-size: 18px;">
			<p style="float: left;">Favorites (<?php echo $total_favorites;?>)</p>
			
			
			</div>
			<div class="col-xs-4"></div>
			<?php }?>
			
			
			
			
			
			
			
			
			
			




			
		<?php if(count($user_out_on_memo)!="0"){
			
			
			
				
				 $image_url=base_url().$j_image_url;
				 
				$file_headers = @get_headers($image_url);
				
				if(($file_headers[0] == "HTTP/1.0 404 Not Found")||($j_image_url=="")) {
					$image_url = base_url().'assets/img/default.jpg';
				} 				
				
			?>
		
		
			<div class="col-xs-4" style="background-color: #545354;color: white;padding: 3px;font-size: 18px;">
			 <p style="float: left;">Jewellery Memo (<?php echo count($user_out_on_memo);?>)</p>
<a href="<?php echo base_url('admin/user/jewellery_memo?id=').$id;?>" style="float: right;padding-right: 10px;color: white;"><u>View all</u></a>
			
			
			</div>
			
		<div class="col-xs-4" style="border-style: groove;padding: 0px 0px 17px 0px;" >
		
		
		
		
		
		

						 <div style="float: left;">
						 
						  <img src="<?php echo $image_url;?>" alt="<?php echo $j_product_name;?>" height="75" width="75"><br><?php echo $j_product_name;?>
							</div> 
							<div >
						
							Requested On   : <?php echo $j_created_on;?><br>
							Memo Date : <?php echo $j_memo_request_date;?><br>
							Current Status : <?php echo $j_status;?>
							</div>						
						  </div>
		<?php 		
		
			
		
		
		}	else {
			?>
			
			<div class="col-xs-4" style="background-color: #545354;color: white;padding: 3px;font-size: 18px;">
			 <p style="float: left;">Jewellery Memo (<?php echo count($user_out_on_memo);?>)</p>

			
			
			</div>
			<div class="col-xs-4"></div>
			<?php 
			
		}		
		
		?>		
		
		
		<?php if(count($user_out_on_memo_diamond)!="0"){
			
			
				
				
				 $image_url=base_url().$d_image_url;
				 
				$file_headers = @get_headers($image_url);
				
				if(($file_headers[0] == "HTTP/1.0 404 Not Found")||($d_image_url=="")) {
					$image_url = base_url().'assets/img/default.jpg';
				} 				
				
			?>
		
		<div class="col-xs-4" style="background-color: #545354;color: white;padding: 3px;font-size: 18px;">
			 <p style="float: left;">Diamond Memo (<?php echo count($user_out_on_memo_diamond);?>)</p>
<a href="<?php echo base_url('admin/user/diamond_memo?id=').$id;?>" style="float: right;padding-right: 10px;color: white;"><u>View all</u></a>
			
			
			</div>
		
		
		
		<div class="col-xs-4" style="border-style: groove;padding: 0px 0px 17px 0px;" >
						 
						 <div style="float: left;">
						 
						  <img src="<?php echo $image_url;?>" alt="<?php echo $d_product_name;?>" height="75" width="75"><br><?php echo $d_product_name;?>
							</div> 
							<div >
						
							Requested On   : <?php echo $d_created_on;?><br>
							Memo Date : <?php echo $d_memo_request_date;?><br>
							Current Status : <?php echo $d_status;?>
							</div>						
						  </div>
			<?php 
		} else {
			?>
			
			<div class="col-xs-4" style="background-color: #545354;color: white;padding: 3px;font-size: 18px;">
			 <p style="float: left;">Diamond Memo (<?php echo count($user_out_on_memo_diamond);?>)</p>

			
			
			</div>
			<?php 
		}
		?>
		
				
		
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
     