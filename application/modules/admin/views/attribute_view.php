 <!--<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-1.12.0.min.js">-->
 <script type="text/javascript" language="javascript" src="<?php echo base_url().'assets/dist/js/jquery-1.12.0.min.js';?>">
	</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/datatable.css');?>">
<link rel="StyleSheet" type="text/css" href="<?php echo base_url().'assets/dist/css/table.css';?>">
	
	<script type="text/javascript" language="javascript" class="init">
	

$(document).ready(function() {
	
	
	
	// Setup - add a text input to each footer cell
	$('#example tfoot th').each( function () {
		var title = $(this).text();
		if(title!=""){
		$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
		}
	} );

	// DataTable
	var table = $('#example').DataTable();

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
	<style>
	.dataTables_filter { display: none; }
	tfoot {
    display: table-header-group;
}
	</style>
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Attributes
            <small>view</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Attributes</li>
          </ol>
        </section>
 <script src="<?php echo base_url();?>assets/plugins/sweetalert-master/dist/sweetalert.min.js"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/sweetalert-master/dist/sweetalert.css">
    
         
		   <!-- Main content -->
        <section class="content">
		
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="<?php echo base_url('admin/attribute');?>" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Attribute List</a></div>
				
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/attribute/add');?>" class="btn btn-primary" > Add New Attribute</a></div>
				</div>
		  
            <div class="col-xs-12">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Attributes</h3>
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
				
				<?php if(count($attributes)!="0"){
					?>
					<script>
					function attribute_delete(attribute_id,headline){
					
					swal({   title: "Are you sure to delete below attribute ?", 
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
							window.location = "<?php echo base_url('admin/attribute/attribute_delete?id=');?>"+attribute_id+"&headline="+headline;	
						  
							  
						  } else {     
							swal("Cancelled", "You have cancelled :)", "error");
						  } 
					  });
					
					
				}
					</script>
                  <table id="example7" class="table table-bordered table-striped">
                    <thead>
                      <tr class="table_th_border">
                        <th>Name</th>
                        <th>Header</th>
                        <th>Attribute Type</th>
                        <th>Sort Order</th>
                        <th>Updated By</th>
                        <th>Updated On</th>
						<th class="no-sort"></th>
						<th class="no-sort"></th>
                      </tr>
                    </thead>
                    <tbody>
					<?php if(count($attributes)!="0"){
						foreach($attributes as $active_rows){
						?>
								
                      <tr>
                        <td><?php echo $active_rows->attribute_name;?></td>
                        <td><?php 
						if(is_numeric($active_rows->attribute_header)){
							echo $active_rows->attribute_header_title;
						} else {
							echo $active_rows->attribute_header; 
						}
						?></td>
                        <td><?php
						
						if(is_numeric($active_rows->attribute_type)){
							echo $active_rows->attribute_type_title;
						} else {
							echo $active_rows->attribute_type; 
						}
						
						?></td>
                        <td><?php echo $active_rows->sort_order;?></td>
                        <td><?php echo $active_rows->updated_by;?></td>
                        <td><?php echo $active_rows->updated_on;?></td>
                       
                     
						<td>
						<input value="Delete"  type="button"  class="btn btn-primary" onClick="return attribute_delete('<?php echo $active_rows->attribute_id;?>','<?php echo $active_rows->attribute_name;?>')" style="min-width: 52px;"/>
						
						
						
						
						
						</td>
						
						
						<td><a  class="btn btn-primary"  href="<?php echo base_url('admin/attribute/edit?id=').$active_rows->attribute_id."&headline=".$active_rows->attribute_name?>" style="min-width: 52px;">Edit</a></td>
						
						
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
	  
	  
   