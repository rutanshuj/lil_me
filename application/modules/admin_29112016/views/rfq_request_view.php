 <!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/datatable.css');?>">
<link rel="StyleSheet" type="text/css" href="<?php echo base_url().'assets/dist/css/table.css';?>">
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
					<a href="<?php echo base_url('admin/request_for_quote');?>" class="btn btn-primary" > RFQ Dashboard</a></div>
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px" class="btn btn-primary"> RFQ Requests</a></div>
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/request_for_quote/history');?>" class="btn btn-primary"> RFQ History</a></div>
				</div>
            <div class="col-xs-12">
             
			  
			  
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title">RFQ Requests (<?php echo count($rfq_request);?>) </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
				<?php if(count($rfq_request)!="0"){
					?>
                  <table id="example16" class="table table-bordered table-striped" >
                    <thead>
                      <tr class="table_th_border">
                         <th class="no-sort width_20_persent sorting_disabled">RFQ Id</th>
                        <th class="width_20_persent">User</th>
                        <th class="no-sort width_20_persent">Products</th>
                        <th class="width_20_persent">Request Sent ON</th>
                       <!-- <th class="width_15_persent">Quotation Deadline</th>                -->       
                        <th class="no-sort width_20_persent">RFQ Status</th>
                        
                      </tr>
                    </thead>
                    <tbody>
					<?php if(count($rfq_request)!="0"){
						foreach($rfq_request as $rfq_request_rows){
						?>
								
                      <tr>
						
						   <td><?php echo $rfq_request_rows->rfq_id;?></td>
                        <td><?php echo $rfq_request_rows->firstname." ".$rfq_request_rows->lastname;?></td>
                        <td><?php echo $rfq_request_rows->product_name;?></td>
                        <td><?php echo $rfq_request_rows->requested_on;?></td>
                      
						<td><?php echo $rfq_request_rows->rfq_status;?></td>
					
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
			  
			 			  
			  
			  
			 
			  
			  
			  
			  
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   