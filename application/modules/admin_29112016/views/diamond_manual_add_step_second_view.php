 <!-- Content Wrapper. Contains page content -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/datatable.css');?>">
  <link rel="StyleSheet" type="text/css" href="<?php echo base_url().'assets/dist/css/table.css';?>">
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
             Manual Add
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manual Add</li>
          </ol>
        </section>

     <script type="text/javascript" language="javascript" src="<?php echo base_url().'assets/dist/js/jquery-1.12.0.min.js';?>">
	</script>
	
	<script type="text/javascript" language="javascript" class="init">
	//
// Updates "Select all" control in a data table
//
  var pausecontent = new Array();
 
  
  
    <?php foreach($product_select as $key => $val){ ?>
	 pausecontent[<?php echo $val?>] = <?php echo $val ?>;
       
    <?php } ?>
	
	
	
	
	
 
	
	
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
		if((title!="")&&(title=="Product")){
			
		$(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
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
				
			}else if ($(column.footer()).hasClass('category')){
				
				
				      

				  
			} else if ($(column.footer()).hasClass('subcategory')){
				
				   
				  
				  
			}	
				
            } );
        },
	  
	  
	   
	  
	  
	  
      'order': [1, 'asc'],
      'rowCallback': function(row, data, dataIndex){
         // Get row ID
         var rowId = data[0];
			//alert(rowId);
			
			//product_select
			
			<?php 
			?>
         // If row ID is in the list of selected row IDs
         if($.inArray(rowId, rows_selected) !== -1){
            $(row).find('input[type="checkbox"]').prop('checked', true);
            $(row).addClass('selected');
         //} else if(pausecontent[rowId]=== undefined){
         } else if(rowId in pausecontent){
			  $(row).find('input[type="checkbox"]').prop('checked', true);
            $(row).addClass('selected');
			delete pausecontent[rowId];
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

	//////

	
	/////
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

 

	</script>
         
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
					<a href="<?php echo base_url('admin/diamond_out_on_memo');?>" class="btn btn-primary" > Memo Dashboard</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/memo_requests');?>" class="btn btn-primary"" class="btn btn-primary" > Memo Requests</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/on_memo_status');?>" class="btn btn-primary" > On Memo Status</a></div>
					
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/memo_history');?>" class="btn btn-primary"> Memo History</a></div>
					
					
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_out_on_memo/manual_add');?>" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Manual Add</a></div>
				</div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Stock List  </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
				<?php if(count($step_two_product)!="0"){?>
				<script>
				
				</script>
				<!--
				<form method="post" action="<?php echo base_url('admin/diamond_out_on_memo/manual_add_select_product');?>" onsubmit="return validateForm()"  name="step_second" id="step_second">
				
                <table id="example2" class="table table-bordered table-striped">
				
				-->
				
				
				<form action="<?php echo base_url('admin/diamond_out_on_memo/manual_add_select_product');?>" method="post" name="frm-example" id="frm-example">
				<?php //if(count($stock_list)!="0"){
					?>
					
					 <table id="example"  class="display table table-bordered table-striped">
				
				
				<thead>
                      <tr class="table_th_border">
					   <th class="no-filter" style="text-align:center;"><?php if(count($step_two_product)!="0"){?><input name="select_all" value="1" type="checkbox"><?php }?></th>
					  
                        <th style="width:45%;text-align:center;">Stock Id</th>
                        <th style="width:45%;text-align:center;">Last Updated</th>
                       
                       
                       
						
                      </tr>
					  <tfoot>
					<tr>
					<th></th>
						<th style="text-align:center;" class="input-filter">Product</th>
						<th class="category"></th>
						
					</tr>
				</tfoot>
                    </thead>
				
				
					
					
					
					
					
					
					
					
					
					
					
                    <tbody>
					<?php if(count($step_two_product)!="0"){
						foreach($step_two_product as $step_two_product_rows){
							$checked="";
							if(isset($product_select[$step_two_product_rows->product_id])){
								$checked="checked";
							}
							
						?>
						<tr>

<td><?php echo $step_two_product_rows->product_id;?></td>						
						<td><?php echo $step_two_product_rows->product_name;?></td>
                      
                       
                          <td><?php echo date("Y-m-d", strtotime($step_two_product_rows->updated_on)); ?></td>
						   
						   
						  				
						
						
                      
                      </tr>
						<?php
						
					}
					
					}
						?>
										
                      
                    </tbody>
					
                  </table>
				  <div style="float: left;">
				  <a href="<?php echo base_url('admin/diamond_out_on_memo/manual_add');?>" class="btn btn-primary" style="float: right;
">Back</a>
					 </div>
					 <div style="float: right;">
                   <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Next" style=" float: right;">
				   </div>
				<?php }else {
					
					
				}?>
                 </div><!-- /.box-body -->
              </div><!-- /.box -->

            
           

		   </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   