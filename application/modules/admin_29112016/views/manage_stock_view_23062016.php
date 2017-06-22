 <!-- Content Wrapper. Contains page content -->
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/datatable.css');?>">
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
	//
// Updates "Select all" control in a data table
//
function updateDataTableSelectAllCtrl(table){
   var $table             = table.table().node();
   var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
   var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
   var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

   // If none of the checkboxes are checked
   if($chkbox_checked.length === 0){
      chkbox_select_all.checked = false;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = false;
      }

   // If all of the checkboxes are checked
   } else if ($chkbox_checked.length === $chkbox_all.length){
      chkbox_select_all.checked = true;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = false;
      }

   // If some of the checkboxes are checked
   } else {
      chkbox_select_all.checked = true;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = true;
      }
   }
}

$(document).ready(function (){
	
	
	$('#example tfoot th').each( function () {
		var title = $(this).text();
		if(title!=""){
		$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
		}
	} );
	
   // Array holding selected row IDs
   var rows_selected = [];
   var table = $('#example').DataTable({
      'columnDefs': [{
         'targets': 0,
         'searchable':false,
         'orderable':false,
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox">';
         }
      }],
	  
	  
	  
	  
	  
	  
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
				
			}
				
				
            } );
        },
	  
	  
	   
	  
	  
	  
      'order': [1, 'asc'],
      'rowCallback': function(row, data, dataIndex){
         // Get row ID
         var rowId = data[0];

         // If row ID is in the list of selected row IDs
         if($.inArray(rowId, rows_selected) !== -1){
            $(row).find('input[type="checkbox"]').prop('checked', true);
            $(row).addClass('selected');
         }
      }
   });


	// DataTable
	

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

   // Handle click on checkbox
   $('#example tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = table.row($row).data();

      // Get row ID
      var rowId = data[0];

      // Determine whether row ID is in the list of selected row IDs 
      var index = $.inArray(rowId, rows_selected);

      // If checkbox is checked and row ID is not in list of selected row IDs
      if(this.checked && index === -1){
         rows_selected.push(rowId);

      // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
      } else if (!this.checked && index !== -1){
         rows_selected.splice(index, 1);
      }

      if(this.checked){
         $row.addClass('selected');
      } else {
         $row.removeClass('selected');
      }

      // Update state of "Select all" control
      updateDataTableSelectAllCtrl(table);

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle click on table cells with checkboxes
   $('#example').on('click', 'tbody td, thead th:first-child', function(e){
      $(this).parent().find('input[type="checkbox"]').trigger('click');
	  
   });

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', table.table().container()).on('click', function(e){
      if(this.checked){
         $('tbody input[type="checkbox"]:not(:checked)', table.table().container()).trigger('click');
      } else {
         $('tbody input[type="checkbox"]:checked', table.table().container()).trigger('click');
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle table draw event
   table.on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl(table);
   });
    
   // Handle form submission event 
   $('#frm-example').on('submit', function(e){
      var form = this;

      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element 
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'product_id[]')
                .val(rowId)
         );
      });
	
      // FOR DEMONSTRATION ONLY     
      
      // Output form data to a console     
      $('#example-console').text($(form.product_id));
      console.log("Form submission", $(form.product_id));
      
	  // document.getElementById("frm-example").submit();
	   
	   var x = document.getElementsByTagName("frm-example");
x[0].submit();
	   
	   
      // Remove added elements
      $('input[name="product_id\[\]"]', form).remove();
       
      // Prevent actual form submission
     e.preventDefault();
	  
	  
	 // alert(JSON.stringify(product_id));
   });
});

//$(document).ready(function() {
	
	
	
/* 	// Setup - add a text input to each footer cell
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
} ); */


   

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
		
		
		
		<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $error;?>
              </div>
		
		
		<?php 
		}
		?>
		
		
		
				<form action="<?php echo base_url('admin/stock/manage_stock');?>" method="post" name="frm-example" id="frm-example">
				<?php if(count($stock_list)!="0"){
					?>
					
					 <table id="example"  class="display table table-bordered table-striped">
                 <!-- <table id="example1" class="table table-bordered table-striped"> -->
                    <thead>
                      <tr>
					   <th class="no-filter"><input name="select_all" value="1" type="checkbox"></th>
					  
                        <th>Product id</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th class="no-filter">Last Updated</th>
                       
                       
						
                      </tr>
					  <tfoot>
					<tr>
					<th></th>
						<th  class="input-filter">Product</th>
						<th class="select-filter">Category</th>
						<th class="select-filter">Subcategory</th>
						<th class="no-filter"></th>
						
					</tr>
				</tfoot>
                    </thead>
					
					
                    <tbody>
					<?php if(count($stock_list)!="0"){
						foreach($stock_list as $active_rows){
						?>
								
                      <tr>
					   <td><?php echo $active_rows->product_id;?></td>
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
				   <p><button type="submit" class="btn btn-primary" value="Delete Selected Stock">Submit</button></p>
				  
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
	  
	  
   