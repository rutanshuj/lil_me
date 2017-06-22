 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          stock
            <small>Delete</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">stock</li>
          </ol>
        </section>

    <!--<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-1.12.0.min.js">-->
 <script type="text/javascript" language="javascript" src="<?php echo base_url().'assets/dist/js/jquery-1.12.0.min.js';?>">
	</script>
	<script type="text/javascript" language="javascript" src="../../media/js/jquery.dataTables.js">
	</script>
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
         
		   <!-- Main content -->
        <section class="content">
		
		
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="<?php echo base_url('admin/stock');?>" class="btn btn-primary" > Stock List</a></div>
				
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/stock/manage_stock');?>" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Manage Stock</a></div>
				</div>
		  
            <div class="col-xs-12">
             
<script language="JavaScript">

function do_this(){

        var checkboxes = document.getElementsByName('product_id[]');
        var button = document.getElementById('toggle');
		
		
		if($("#toggle").prop('checked') == true){
    //do something
	for (var i in checkboxes){
                checkboxes[i].checked = 'FALSE';
            }
} else {
	for (var i in checkboxes){
                checkboxes[i].checked = '';
            }
}
		
        
    }
	
</script>
  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Stock Delete</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
				<?php if(isset($success)){ ?>		
		
		
		
		<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $success;?>
              </div>
		
		
		<?php 
		}else if(isset($error)){ ?>		
		
		
		
		<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $error;?>
              </div>
		
		
		<?php 
		}
		?>
		
		
		
				<form action="<?php echo base_url('admin/stock/manage_stock');?>" method="post" name="stock_frm" id="stock_frm">
				<?php if(count($stock_list)!="0"){
					?>
					 <table id="example"  class="display table table-bordered table-striped">
                 <!-- <table id="example1" class="table table-bordered table-striped"> -->
                    <thead>
                      <tr>
					   <td><input type="checkbox"  id="toggle" name="toggle" onClick="do_this()"></td>
                        <th>Product id</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th class="no-sort">Last Updated</th>
                       
                       
						
                      </tr>
					  <tfoot>
					<tr>
					<th></th>
						<th>Product</th>
						<th>Category</th>
						<th>Subcategory</th>
						<th></th>
						
					</tr>
				</tfoot>
                    </thead>
					
					
                    <tbody>
					<?php if(count($stock_list)!="0"){
						foreach($stock_list as $active_rows){
						?>
								
                      <tr>
					   <td><input type="checkbox" class="checkbox1" name="product_id[]" id="" value="<?php echo $active_rows->product_id;?>"></td>
                        <td><?php echo $active_rows->product_name;?></td>
                        <td><?php echo $active_rows->category_name;?></td>
                        <td><?php echo $active_rows->subcategory_name;?></td>
                        <td><?php echo $active_rows->updated_on;?></td>
                        
                       					
						
                      </tr>
                      <?php
						}
					}
					  ?>
					

				   </tbody>
				   <tr><td colspan="7">
				   <input type="submit" name="submit" value="Delete Selected Stock" class="btn btn-primary">
				   </td></tr>
				   
                   <tbody>
				   </tbody>
                  </table>
				<?php } else {
					
					
				}
				?>
				</form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   