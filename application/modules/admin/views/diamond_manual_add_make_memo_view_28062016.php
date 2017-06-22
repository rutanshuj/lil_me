 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Category
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">verify_admin</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content">
		
		
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="<?php echo base_url('admin/diamond_out_on_memo');?>" class="btn btn-primary" > Memo Dashboard</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/memo_requests');?>" class="btn btn-primary"" class="btn btn-primary" > Memo Requests</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/on_memo_status');?>" class="btn btn-primary" > On Memo Status</a></div>
					
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/memo_history');?>" class="btn btn-primary" > Memo History</a></div>
					
					
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/manual_add');?>" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Manual Add</a></div>
				</div>
		  
            <div class="col-xs-6">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Create Custom Memo Request</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
<script> 
$('#datepicker').datepicker({ autoclose: true   });
$('#expiry_date').datepicker({ autoclose: true   });

</script>
				<form method="post" action="<?php echo base_url('admin/diamond_out_on_memo/manual_add_make_memo');?>" onsubmit="return validateForm()"  name="step_third" id="step_third">
				
				
				<?php if((validation_errors())||(isset($error) &&($error!=""))){ ?>
		<div class="margin_left_right_12 alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
               <?php echo validation_errors(); if(isset($error) &&($error!="")){echo $error;}?>
              </div>
		
		
		
		
		<?php 
		}
		?>
		<?php if(isset($success)){ ?>		
		
		
		
		<div class="margin_left_right_12 alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $success;?>
              </div>
		
		
		<?php 
		}
		?>
				

				<div>
						<div>Memo Date*:</div>
						<div><input type="text" name="memo_date" value="<?php echo $memo_date;?>" placeholder="YYYY-MM-DD" id="datepicker"></div>
					</div>
					<div>
						<div>Expiry Date*:</div>
						<div><input type="text" name="expiry_date"id="expiry_date" value="<?php echo $expiry_date;?>" placeholder="YYYY-MM-DD"></div>
					</div>
					<div>				
						<div><a href="<?php echo base_url('admin/diamond_out_on_memo/manual_add_select_product');?>" style="
    float: left;
    " class="btn btn-primary">Back</a></div>
						<div> <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Next"></div>
					</div>		
			 </form>
			  
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   