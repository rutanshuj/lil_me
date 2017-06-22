 <!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/datatable.css');?>">
<link rel="StyleSheet" type="text/css" href="<?php echo base_url().'assets/dist/css/table.css';?>">
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
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Request for quote
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">request_for_quote</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content">
		
		
          <div class="row">
		  
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> RFQ Dashboard</a></div>
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_request_for_quote/request');?>" class="btn btn-primary"" class="btn btn-primary"> RFQ Requests</a></div>
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_request_for_quote/history');?>" class="btn btn-primary"> RFQ History</a></div>
				</div>
            <div class="col-xs-12">
             
			  
			  
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title">RFQ Due Today (<?php echo count($due_today);?>) </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
				<?php if(count($due_today)!="0"){
					?>
                  <table id="example16" class="table table-bordered table-striped" >
                    <thead>
                      <tr  class="table_th_border">
                         <th class="no-sort width_20_persent sorting_disabled">RFQ Id</th>
                        <th class="width_20_persent">User</th>
                        <th class="no-sort width_20_persent">Products</th>
                        <th class="width_20_persent">Request Sent ON</th>
                       <!-- <th class="width_15_persent">Quotation Deadline</th>   -->                     
                        <th class="no-sort width_20_persent">RFQ Status</th>
                        
                      </tr>
                    </thead>
                    <tbody>
					<?php if(count($due_today)!="0"){
						foreach($due_today as $due_today_rows){
						?>
								
                      <tr>
						
						   <td><?php echo $due_today_rows->rfq_id;?></td>
                        <td><?php echo $due_today_rows->firstname." ".$due_today_rows->lastname;?></td>
                        <td><?php echo $due_today_rows->product_name;?></td>
                        <td><?php echo $due_today_rows->requested_on;?></td>
                       
						<td><?php echo $due_today_rows->rfq_status;?></td>
					
                      </tr>
                      <?php
						}
					}
					  ?>
					

				   </tbody>
                   
                  </table>
				<?php } else {
					echo "No RFQ Request..";
					
				}
				?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  
			 			  
			  
			  
			  
			  
			  
			  
			  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">RFQ expired in last 7 days (<?php echo count($expired);?>)</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
				<?php if(count($expired)!="0"){
					?>
                  <table id="example2" class="table table-bordered table-striped" >
                    <thead>
                      <tr class="table_th_border"> 
					  <th class="no-sort width_20_persent">RFQ Id</th>
                        <th class="width_20_persent">User</th>
                        <th class="no-sort width_20_persent">Products</th>
                        <th class="width_20_persent">Request Sent ON</th>
                       <!-- <th class="width_15_persent">Quotation Deadline</th>                       -->
                        <th class="no-sort width_20_persent">RFQ Status</th>
						
                       
                      </tr>
                    </thead>
                    <tbody>
					<?php if(count($expired)!="0"){
						foreach($expired as $expired_rows){
						?>
								
                      <tr>
                       <td><?php echo $expired_rows->rfq_id;?></td>
                        <td><?php echo $expired_rows->firstname." ".$expired_rows->lastname;?></td>
                        <td><?php echo $expired_rows->product_name;?></td>
                        <td><?php echo $expired_rows->requested_on;?></td>
                     
						<td><?php echo $expired_rows->rfq_status;?></td>
						
						
						
                      </tr>
                      <?php
						}
					}
					  ?>
					

				   </tbody>
                   
                  </table>
				<?php } else {
					
					echo "No RFQ request expired in last 7 days";
				}
				?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  
			  
			  
			  
			  
			  
			  
			  
			  
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   