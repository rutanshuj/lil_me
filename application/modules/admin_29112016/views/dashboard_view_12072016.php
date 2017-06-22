 <script type="text/javascript" language="javascript" src="<?php echo base_url().'assets/dist/js/jquery-1.12.0.min.js';?>">
	</script>
 <style>
.width_20_persent {
   width: 20% !important;
}
.width_15_persent {
   width: 15% !important;
}
.width_10_persent {
   width: 10% !important;
}
</style>

	
	<script type="text/javascript" language="javascript" class="init">
	
$(document).ready(function() {
	
	 
    $('#example').DataTable( {
		autoWidth: false,
		"order": [[ 1, "desc" ]],
        initComplete: function () {
			
			
			 this.api().columns('.no-filter').every( function () {
                var column = this;	
				
                var select = $('')
                    .appendTo( $(column.footer()).empty() )                    
            } );
			
			
            this.api().columns('.select-filter').every( function () {
                var column = this;
				
				
                var select = $('<select class="form-control"><option value="">Select one</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );

   

	</script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/datatable.css');?>">
	
	
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
         
		 <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  Active Admins<br>
                  <?php if(isset($admin['active_admins'])){ echo $admin['active_admins'];}else { echo 0 ;}?><br>
				  Pending Requests<br>
                  <?php if(isset($admin['pending_admins'])){ echo $admin['pending_admins'];}else { echo 0 ;}?>
                </div>
				
				
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="<?php echo base_url('admin/verify_admin');?>" class="small-box-footer">Admin </i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
				
                  Active Users<br>
                  <?php if(isset($user['active_user'])){ echo $user['active_user'];}else { echo 0 ;}?><br>
				  Pending Requests<br>
                  <?php if(isset($user['pending_user'])){ echo $user['pending_user'];}else { echo 0 ;}?>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?php echo base_url('admin/verify_user');?>" class="small-box-footer">Users</a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  Last Updated On<br>
                  <?php if(isset($diamond['last_updated_on'])){ echo $diamond['last_updated_on'];}else { echo 0 ;}?><br>
				  Number Of Stocks<br>
                  <?php if(isset($diamond['number_of_stocks'])){ echo $diamond['number_of_stocks'];}else { echo 0 ;}?>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="<?php echo base_url('admin/diamond_manage_stock');?>" class="small-box-footer">Diamond Stock </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
				
                   Last Updated On<br>
                  <?php if(isset($jewellery['last_updated_on'])){ echo $jewellery['last_updated_on'];}?><br>
				  Number Of Stocks<br>
                  <?php if(isset($jewellery['number_of_stocks'])){ echo $jewellery['number_of_stocks'];}else { echo 0 ;}?>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?php echo base_url('admin/stock');?>" class="small-box-footer">Jewellery Stock </a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          <!-- Main row -->
         
		 <div class="row">
            <!-- Left col -->
          <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
			  
			  
                <div class="box-header">
                  <h3 class="box-title">Recent Activities</h3>
                </div><!-- /.box-header -->
				
				<?php 
				if(count($activity)>0){
				?>
                <div class="box-body">
                
				  
				  <div class="row">
				  <div class="col-sm-12">
				  
				   <table id="example" class="table table-bordered table-striped">
				  
                    <thead>
                      <tr>
					  <th class="select-filter" style="width: 20% !important;">User</th>
					  
					  <td  class="no-filter" style="width: 20% !important;"><b>Activity Time</b></td>
					  
					  <th class="select-filter" style="width: 20% !important;">Activity</th>
					  
					  <th class="select-filter" style="width: 20% !important;">Product type</th>
					  <th class="select-filter" style="width: 20% !important;">Product name</th>
					 
                    </thead>
					
					
					
					
					<tfoot>
					<tr>
						<th class="width_20_persent">User</th>
						<th class="width_20_persent">Activity Time</th>
						<th class="width_20_persent">Activity</th>
						<th class="width_20_persent">Product type</th>
					  <th class="width_20_persent">Product name</th>
						
					</tr>
				</tfoot>
                    <tbody>
                                
                    
					    <?php
					  $i="0";
					  foreach($activity as $activity_row){
						 $i++;
							if($i%2){
								$tr_class = 'class="even"';	
							} else {
								$tr_class = 'class="odd"';
							}
						  
						  ?>
						  
						  
						 <tr >
                        <td   class="width_20_persent"><?php echo $activity_row->user_username;?></td>
                        <td  class="width_20_persent"><?php echo $activity_row->activity_time;?></td>
                        <td  class="width_20_persent"><?php echo ucfirst($activity_row->activity);?></td>                        
                        <td  class="width_20_persent"><?php echo $activity_row->product_type;?></td>
                        <td  class="width_20_persent"><?php echo $activity_row->product_name;?></td>
                        
                      </tr> 
						  <?php
					  }
					  ?>
                      					  
					 
					  
                      </tbody>
                   
                  </table>
				  </div>
				  
				  <div class="col-sm-12">
				  
				  
				</div></div>
                </div><!-- /.box-body -->
            

			</div><!-- /.box -->

              
				<?php } else {
					echo "There is no any Recent Activities";
				}
				?>
				
				
				
				
			  <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Favorites (<?php echo count($favorites);?>)</h3>
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
				  
				if(is_array($favorites)&&(count($favorites)!="0")) {
					foreach($favorites as $favorites_row){
						
						$image_url=base_url().$favorites_row->image_url;
						
						 
						$file_headers = @get_headers($image_url);
						
						if($file_headers[0] == "HTTP/1.0 404 Not Found") {
							$image_url = base_url().'assets/img/default.jpg';
						} 
						
						     
						  ?>
						      
    
	
						  <div class="col-md-4" style="border-style: groove;padding: 17px 0px 17px 0px;" >
						  
						 <div style="float: left;">
						  <img src="<?php echo $image_url;?>" alt="Smiley face" height="75" width="75">
							</div> 
							<div >
						
							Favorites Count : <?php echo $favorites_row->fav_count;?><br>
							Product : <?php echo $favorites_row->product_name;?><br>
							Last Updated : <?php echo $favorites_row->updated_on;?>
							</div>
							
						  </div>
						  <?php
					  }
				  }
				  ?>
				  
				  
				  
				  
				  
				  
				  
				  
				  <?php /* ?>
				  <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info" >
                    <thead>
                      <tr role="row">
					  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">User</th>
					  
					  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Activity Time</th>
					  
					  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Activity</th>
					  
					  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Activity Detail</th>
					  
					 
                    </thead>
                    <tbody>
                                
                    
					    <?php
					  $i="0";
					  foreach($activity as $activity_row){
						 $i++;
							if($i%2){
								$tr_class = 'class="even"';	
							} else {
								$tr_class = 'class="odd"';
							}
						  
						  ?>
						  
						  
						 <tr role="row" <?php echo $tr_class;?> >
                        <td class="sorting_1"><?php echo $activity_row->user_username;?></td>
                        <td><?php echo $activity_row->activity_time;?></td>
                        <td><?php echo $activity_row->activity;?></td>
                        <td><?php echo $activity_row->activity_detail;?></td>
                        
                      </tr> 
						  <?php
					  }
					  ?>
                      					  
					  
					  
                      </tbody>
                   
                  </table>
				  </div>
				  
				  
				  <?php  */?>
				  
				  
				  <div class="col-sm-12">
				  
				  
				</div></div></div>
                </div><!-- /.box-body -->
            
				 
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>   
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  
	  
   