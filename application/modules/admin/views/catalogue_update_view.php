 <!--<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-1.12.0.min.js">-->
 <script type="text/javascript" language="javascript" src="<?php echo base_url().'assets/dist/js/jquery-1.12.0.min.js';?>">
	</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/datatable.css');?>">
<link rel="StyleSheet" type="text/css" href="<?php echo base_url().'assets/dist/css/table.css';?>">
	
	
	<style>
	.dataTables_filter { display: none; }
	tfoot {
    display: table-header-group;
}
	</style>
	
	
	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/fancyBox/source/jquery.fancybox.js?v=2.1.5"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/fancyBox/source/jquery.fancybox.css?v=2.1.5" media="screen" />


	<script type="text/javascript">
	var jq = $.noConflict();
		jq(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */
			jq('.fancybox').fancybox({'width':820});
		
			});
	</script>
	
	
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Catalogue
            <small>update</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Catalogue</li>
          </ol>
        </section>
 <script src="<?php echo base_url();?>assets/plugins/sweetalert-master/dist/sweetalert.min.js"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/sweetalert-master/dist/sweetalert.css">
    
         
		   <!-- Main content -->
        <section class="content">
		
          <div class="row">
		   <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;" >
					<a href="<?php echo base_url('admin/catalogue');?>" class="btn btn-primary"> Add</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/catalogue/update');?>" class="btn btn-primary"  style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Update</a></div>
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/catalogue/bulk_upload');?>" class="btn btn-primary" > Bulk Upload</a></div>
					
				</div>
		  
            <div class="col-xs-12">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Catalogue</h3>
                </div><!-- /.box-header -->
				 <?php if(isset($success)){ ?>
		
		<div class="margin_left_right_12 alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $success;?>
              </div>
		<?php 
		}
		?>
		
		<?php if(isset($error) &&($error!="")){ ?>
		<div class="margin_left_right_12 alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
               <?php  echo $error;?>
              </div>
		<?php 
		}
		?>
                <div class="box-body">
				
				<?php if(count($catalogue)!="0"){
					?>
					<script>
					function attribute_delete(catalogue_id,headline){
					
					swal({   title: "Are you sure to delete below catalogue ?", 
					  text: headline,
					  type: "warning",  
					  showCancelButton: true,  
					  confirmButtonColor: "#DD6B55",  
					  confirmButtonText: "Yes, delete it!",  
					  cancelButtonText: "No, cancel it!",  
					  closeOnConfirm: true, 
					  closeOnCancel: true },
					  function(isConfirm){  
						  if (isConfirm) {  
							window.location = "<?php echo base_url('admin/catalogue/catalogue_delete?id=');?>"+catalogue_id+"&headline="+headline;	
						  
							  
						  } else {     
							swal("Cancelled", "You have cancelled :)", "error");
						  } 
					  });
					
					
				}
					</script>
                  <table id="example7" class="table table-bordered table-striped">
                    <thead>
                      <tr class="table_th_border">
                        <th>Title</th>
                        <th>Size</th>
                        <th>Uploaded By</th>
                        <th>Uploaded On</th>
                     
						<th class="no-sort"></th>
						<th class="no-sort"></th>
                      </tr>
                    </thead>
                    <tbody>
					<?php if(count($catalogue)!="0"){
						foreach($catalogue as $active_rows){
						?>
								
                      <tr>
                        <td><?php echo $active_rows['catalog_title'];?></td>
                        <td><?php 
						
							echo $active_rows['catalog_size']; 
						
						?></td>
                       
                      
                        <td><?php echo $active_rows['updated_by'];?></td>
                        <td><?php echo $active_rows['updated_on'];?></td>
                       
                     
					
						
					
						<td><a class="fancybox fancybox.iframe btn btn-primary" href="<?php echo base_url('admin/Catalogue/catalogue_pdf?id=').$active_rows['catalog_id'];?>" >VIEW CATALOGUE</a></td>
						
						
						
						
						
						
						
						
						<td>
						<input value="DELETE CATALOGUE"  type="button"  class="btn btn-primary" onClick="return attribute_delete('<?php echo $active_rows['catalog_id'];?>','<?php echo $active_rows['catalog_title'];?>')" style="min-width: 52px;"/>
						
						
						
                      </tr>
                      <?php
						}
					}
					  ?>
					

				   </tbody>
                   
                  </table>
				<?php } else {
					
					
				}
				?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   