 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Memo Dashboard
            <small>view</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Memo Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
         
		
                <!-- Main row -->
         
		 <div class="row">
            <!-- Left col -->
          <section class="content">
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Memo Dashboard</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/memo_requests');?>" class="btn btn-primary"" class="btn btn-primary"> Memo Requests</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/on_memo_status');?>" class="btn btn-primary"> On Memo Status</a></div>
					
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/memo_history');?>" class="btn btn-primary"> Memo History</a></div>
					
					
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/manual_add');?>" class="btn btn-primary"> Manual Add</a></div>
				</div>
            <div class="col-xs-12">
              
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Due Today (<?php echo count($due_today);?>)</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                 
				  <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
				  <div class="row">
					  <div class="col-sm-6"></div>
					  <div class="col-sm-6"></div>
				  </div>
				  <div class="row">
				  <div class="col-sm-12" style ="display: block;height: 300px;overflow-y: auto ;">
				  
				  
				<?php 
				  
				if(is_array($due_today)&&(count($due_today)!="0")) {
					foreach($due_today as $due_today_row){						
						$image_url=base_url().$due_today_row->image_url;
						if($due_today_row->image_url==""){
							$image_url = base_url().'assets/img/default.jpg';
						}
						
						/* $file_headers = @get_headers($image_url);						
						if($file_headers[0] == "HTTP/1.0 404 Not Found") {
							
						} */ 						     
						  ?>
						  <div class="col-md-4" style="border-style: groove;padding: 17px 0px 17px 0px;" >					  
						 <div style="float: left;">
						  <img src="<?php echo $image_url;?>" alt="Smiley face" height="75" width="75">
							</div> 
						<div style="font-size: 12.5px;margin-left: 100px;">
							<b>User :</b> <?php echo $due_today_row->username;?><br>
							<b>Product :</b> <?php echo $due_today_row->product_name;?><br>
							<b>Requested On :</b> <?php echo $due_today_row->created_on;?><br>
							<b>Memo Date :</b> <?php echo $due_today_row->memo_request_date;?>
							</div>
							
						  </div>
						  <?php
					  }
				  }
				  ?>
				  
				</div>
				</div>
                </div><!-- /.box-body -->
            
				 
                </div><!-- /.box-body -->
              </div><!-- /.box -->
             <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Out On Memo (<?php echo count($out_on_memo);?>)</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                 
				  <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
				  <div class="row">
					  <div class="col-sm-6"></div>
					  <div class="col-sm-6"></div>
				  </div>
				  <div class="row">
				  <div class="col-sm-12" style ="display: block;height: 300px;overflow-y: auto ;">
				  
				  
				<?php 
				  
				if(is_array($out_on_memo)&&(count($out_on_memo)!="0")) {
					foreach($out_on_memo as $out_on_memo_row){						
						$image_url=base_url().$out_on_memo_row->image_url;	

						if($out_on_memo_row->image_url==""){
							$image_url = base_url().'assets/img/default.jpg';
						}
						
						/* $file_headers = @get_headers($image_url);						
						if($file_headers[0] == "HTTP/1.0 404 Not Found") {
							$image_url = base_url().'assets/img/default.jpg';
						}  */						     
						  ?>
						  <div class="col-md-4" style="border-style: groove;padding: 17px 0px 17px 0px;" >					  
						 <div style="float: left;">
						  <img src="<?php echo $image_url;?>" alt="Smiley face" height="95" width="90">
							</div> 
							<div style="font-size: 12.5px;margin-left: 100px;">
						
							<b>User :</b> <?php echo $out_on_memo_row->username;?><br>
							<b>Product :</b> <?php echo $out_on_memo_row->product_name;?><br>
							<b>Requested On :</b> <?php echo $out_on_memo_row->created_on;?><br>
							<b>Approved On :</b> <?php echo $out_on_memo_row->request_approve_date;?><br>
							<b>Expired On :</b> <?php 
							if(isset($out_on_memo_row->expiry_date)&&($out_on_memo_row->expiry_date!="")){
								echo date("Y-m-d", strtotime($out_on_memo_row->expiry_date));
							} else {
								echo date("Y-m-d",strtotime("+1 week",  strtotime($out_on_memo_row->created_on)));
							}
							?>
							</div>
							
						  </div>
						  <?php
					  }
				  }
				  ?>
				  
				</div>
				</div>
                </div><!-- /.box-body -->
            
				 
                </div><!-- /.box-body -->
              </div><!-- /.box -->
           


		   </div><!-- /.col -->
          </div><!-- /.row -->
        </section>   
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  
	  
   