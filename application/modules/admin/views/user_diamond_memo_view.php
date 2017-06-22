 <!-- Content Wrapper. Contains page content -->

     
        <!-- Content Header (Page header) -->
           
         
		   <!-- Main content -->
        <section class="">
		
		
		<?php
		if(!isset($back_url)||($back_url!="")){
			$back_url='javascript:history.back()';
		}
		?>
		<h3>
		
		
		<p style="float: left;">Diamond Memo (<?php echo $total_memo;?>)</p>
		
		<a href="<?php echo $back_url;?>" style="float: right;padding-right: 10px;color: black;"><u>Back to user details</u></a>
		</h3>
		<?php 	
		if(isset($error)&&($error!="")){
			?>
			
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                <?php echo $error;?>
              </div>
			<?php
		}
			?>
          <div class="row">
		<div class="col-xs-12">
		
			 <?php 
					if(count($user_out_on_memo_diamond)>0){							 
						foreach($user_out_on_memo_diamond as $d_memo_rows){
							
							
							
							if($d_memo_rows->image_url==""){
								$image_url = base_url().'assets/img/default.jpg';
							} else {
								$image_url=base_url().$d_memo_rows->image_url;
							}
							
							
							
						
							?>

		<div class="col-xs-6" style="border-style: groove;padding: 17px 0px 17px 0px;height: 120px;margin-top: 2px;" >
			<div style="float: left;">
				<img src="<?php echo $image_url;?>" alt="<?php echo $d_memo_rows->product_name;?>" height="75" width="75">
			</div> 
			<div>
				Product Name : <?php echo $d_memo_rows->product_name;?><br>
				Requested On   : <?php echo $d_memo_rows->created_on;?><br>
				Memo Date : <?php echo $d_memo_rows->memo_request_date;?><br>
				Current Status :  <?php echo $d_memo_rows->status;?>
			</div>
		</div>

						<?php
						}
					}
					?>
	
		
          </div><!-- /.row -->
		  <div class="col-xs-12">
		  </div>
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
     