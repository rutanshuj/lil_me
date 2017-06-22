 <!-- Content Wrapper. Contains page content -->
<style>
td {
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
		<td ><b>DEVICE USER</b></td>
		<td  align="center"><b>TYPE</b></td>
		<td  align="center"><b>VALID THROUGH</b></td>
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
							
							
							if(isset($j_favorites_rows->image_url)&&($j_favorites_rows->image_url!="")){
								$image_url=base_url().$j_favorites_rows->image_url;
							} else {
								$image_url = base_url().'assets/img/default.jpg';
							}
								 
											
							?>
						<div style="margin-top: 10px;">

						<div style="float: left;">

						<img src="<?php echo $image_url;?>" alt="<?php echo $image_url;?>" height="75" width="75"><br>
						<label style="padding-left: 15px;"><?php echo $j_favorites_rows->product_name;?></label>
						</div> 
						<div >

						<b>Category :</b> <?php echo $j_favorites_rows->category_name;?><br>
						
						
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
						  
						  
						  
						
						  </div>
			
			
			<?php } else {?>
			<div class="col-xs-4" style="background-color: #545354;color: white;padding: 3px;font-size: 18px;">
			<p style="float: left;">Favorites (<?php echo $total_favorites;?>)</p>
			
			
			</div>
			<div class="col-xs-4"></div>
			<?php }?>
			
			
			
			
			
			
			
			
			
			


	
		
		
		
				
		
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
     