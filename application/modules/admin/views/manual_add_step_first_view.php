 <!-- Content Wrapper. Contains page content -->
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/datatable.css');?>">
 <link rel="StyleSheet" type="text/css" href="<?php echo base_url().'assets/dist/css/table.css';?>">
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manual add
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">manual_add</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content">
		
		<?php if(isset($message)){ ?>
		<div class="alert alert-error __web-inspector-hide-shortcut__">
		<button class="close" data-dismiss="alert"></button><?php echo $message;?></div>
		<?php 
		}
		?>
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="<?php echo base_url('admin/out_on_memo');?>" class="btn btn-primary" > Memo Dashboard</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/out_on_memo/memo_requests');?>" class="btn btn-primary"" class="btn btn-primary" > Memo Requests</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/out_on_memo/on_memo_status');?>" class="btn btn-primary" > On Memo Status</a></div>
					
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/out_on_memo/memo_history');?>" class="btn btn-primary" > Memo History</a></div>
					
					
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/out_on_memo/manual_add');?>" class="btn btn-primary"style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Manual Add</a></div>
				</div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Select User  </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				<script type="text/javascript" language="javascript" src="<?php echo base_url().'assets/dist/js/jquery-1.12.0.min.js';?>">
	</script>
				<script type="text/javascript" language="javascript" class="init">
	

$(document).ready(function() {
	
	
	
	// Setup - add a text input to each footer cell
	$('#example12 tfoot th').each( function () {
		var title = $(this).text();
		if(title!=""){
		$(this).html( '<input type="text" class="form-control select_size" placeholder="Search '+title+'" />' );
		}
	} );

	// DataTable
	var table = $('#example12').DataTable({"columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ]});

	// Apply the search
	table.columns().every( function () {
		var that = this;

		$( 'input', this.footer() ).on( 'keyup change', function () {
			if ( that.search() !== this.value ) {
				that
					.search( this.value )
					.draw();
			}
		} );
	} );
} );


   

	</script>
				<script>
				function validateForm() {
   var radios = document.getElementsByName("user_id");

     for (var i = 0, len = radios.length; i < len; i++) {
          if (radios[i].checked) {
              return true;
          }
     }
	alert("Please select at least one Username");	
     return false;
}
				</script>
				<?php if(count($user_details)!="0"){?>
				
				
				
				
				<form method="post" action="<?php echo base_url('admin/out_on_memo/manual_add');?>" onsubmit="return validateForm()"  name="step_first" id="step_first">
				Select user to whom you want to send Memo
               <!-- <table id="example2" class="table table-bordered table-striped"> -->
			   <table id="example12"  class="display table table-bordered table-striped " width="100%" >
                    <thead>
					
					
					<tr class="table_th_border">
						<th class="no-sort"></th>
                        <th style="text-align: center;">Username</th>
                        <th style="text-align: center;">Name</th>
                        <th style="text-align: center;">Email</th>
                        <th class="no-sort" style="text-align: center;">User Type</th>
                        
                        <th class="no-sort" style="text-align: center;">Validity</th>                       						
                      </tr>
					
					
					
					
					
                     
                    </thead>
					<tfoot>
					 <tr>
						<th></th>
                        <th style="text-align: center;">Username</th>
                        <th style="text-align: center;">Name</th>
                        <th style="text-align: center;">Email</th>
                        <th class="no-sort"></th>
                        
                        <th class="no-sort"></th>                       						
                      </tr>
				</tfoot>
                    <tbody>
					<?php if(count($user_details)!="0"){
						foreach($user_details as $user_details_rows){
							$check="";
							if($out_on_memo_user_id==$user_details_rows->user_id){
								$check="checked";
							}
							
						?>
						<tr>
<td><input type="radio" name="user_id" id="user_id" <?php echo $check;?> value="<?php echo $user_details_rows->user_id;?>"></td>						
						<td><?php echo $user_details_rows->username;?></td>
                        <td><?php echo $user_details_rows->firstname." ".$user_details_rows->lastname;?></td>
                        <td><?php echo $user_details_rows->email_id;?></td>
                        <td><?php echo $user_details_rows->user_type;?></td>
                        						
						
						<td>
										
						
						<?php 
						echo date("Y-m-d", strtotime($user_details_rows->valid_through));							
						?></td>
						
												
						
                      
                      </tr>
						<?php
						
					}
					
					}
						?>
										
                      
                    </tbody>
                   
                  </table>
				
				
				<input type="submit" class="btn btn-primary" id="submit" name="submit" value="Select user">
				</form>
				
				<?php }else {
					
					
				}?>
                 </div><!-- /.box-body -->
              </div><!-- /.box -->

            
           

		   </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   