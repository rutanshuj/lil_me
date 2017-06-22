 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/datatable.css');?>">
  <link rel="StyleSheet" type="text/css" href="<?php echo base_url().'assets/dist/css/table.css';?>">
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            stock 
            <small>List</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">stock</li>
          </ol>
        </section>

    
       <!--<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-1.12.0.min.js">-->
 <script type="text/javascript" language="javascript" src="<?php echo base_url().'assets/dist/js/jquery-1.12.0.min.js';?>">
	</script>

	
		
	<script type="text/javascript" language="javascript" class="init">
	
$(document).ready(function() {
	
	
	// Setup - add a text input to each footer cell
	$('#example tfoot th').each( function () {
		var title = $(this).text();
		if(title!=""){
		$(this).html( '<input type="text"  class="form-control" placeholder="Search '+title+'" />' );
		}
	} );

	
	
	
    $('#example').DataTable( {		 
		  
		"columnDefs": [ {
"targets": 3,
"orderable": false
} ],
		
        initComplete: function () {						
            this.api().columns().every( function () {
                var column = this;				
				
				 if ($(column.footer()).hasClass('input-filter')) {

				  var that = this;
				  $('input', this.footer()).on('keyup change', function () {
					 that.search(this.value).draw();
				  });   

				} else if ($(column.footer()).hasClass('select-filter')){
				
					
				
				
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
				
			} else if ($(column.footer()).hasClass('category')){
				
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
 				   <?php
				   if(isset($cate_select)&&($cate_select!="")){
					   echo "select.append( '".$cate_select."' )";
				   }   

				   ?>
			} else if ($(column.footer()).hasClass('subcategory')){
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
				   <?php
				   if(isset($sub_category_select)&&($sub_category_select!="")){
					   echo "select.append( '".$sub_category_select."' )";
				   }
				   
				  
				   ?>
			}
				
				
            } );
        }
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
		
		<?php if(isset($message)){ ?>
		<div class="alert alert-error __web-inspector-hide-shortcut__">
		<button class="close" data-dismiss="alert"></button><?php echo $message;?></div>
		<?php 
		}
		?>
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="<?php echo base_url('admin/stock');?>" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> List</a></div>
				
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/stock/manage_stock');?>" class="btn btn-primary" > Delete</a></div>
				</div>
		  
            <div class="col-xs-12">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Stock List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
				<?php //if(count($stock_list)!="0"){
					?>
					
                  <table id="example"  class="display table table-bordered table-striped">
                    <thead>
                      <tr class="table_th_border">
                        <th style="text-align: center;">Product id</th>
                        <th style="text-align: center;">Category</th>
                        <th style="text-align: center;">Gender</th>
                        <th  class="no-filter" style="text-align: center;">Last Updated</th>
                       
                       
						
                      </tr>
                    </thead>
					<tfoot>
					<tr>
						<th  class="input-filter" style="text-align: center;">Product</th>
						<th class="category" style="text-align: center;">Category</th>
						<th class="subcategory" style="text-align: center;">Gender</th>
						<th class="no-filter" style="text-align: center;"></th>
						
					</tr>
				</tfoot>
                    <tbody>
					<?php if(count($stock_list)!="0"){
						foreach($stock_list as $active_rows){
						?>
								
                      <tr>
                        <td><?php echo $active_rows->product_name;?></td>
                        <td><?php echo $active_rows->category_name;?></td>
                        <td><?php echo $active_rows->gender;?></td>
                        <td><?php echo $active_rows->updated_on;?></td>
                        
                       					
						
                      </tr>
                      <?php
						}
					}
					  ?>
					

				   </tbody>
                   
                  </table>
				<?php //} else {
					
					
			//	}
				?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   