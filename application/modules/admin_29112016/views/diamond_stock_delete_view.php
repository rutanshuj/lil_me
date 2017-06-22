 <!-- Content Wrapper. Contains page content -->
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/datatable.css');?>">
 <link rel="StyleSheet" type="text/css" href="<?php echo base_url().'assets/dist/css/table.css';?>">
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Stock delete
            <small>update</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">stock_delete</li>
          </ol>
        </section>

   <script type="text/javascript" language="javascript" src="<?php echo base_url().'assets/dist/js/jquery-1.12.0.min.js';?>">
	</script>

	</script>
         
		   <!-- Main content -->
        <section class="content">
		
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
	  
	  
	 
   });
});




   

	</script>
          <div class="row">
		  <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="<?php echo base_url('admin/diamond_manage_stock');?>" class="btn btn-primary" > Update</a></div>
					
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;"><a href="<?php echo base_url('admin/diamond_manage_stock/stock_delete');?>" class="btn btn-primary"" class="btn btn-primary"style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px" > Delete</a></div>
					
				
				</div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Delete Diamond Stocks  </h3>
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
				<?php //if(count($diamond_stock_list)!="0"){?>
			
				<form role="form" name="frm-example" id="frm-example" action="<?php echo base_url('admin/diamond_manage_stock/stock_delete')?>" method="post" >
				<table id="example"  class="display table table-bordered table-striped">
                <!--<table id="example" class="table table-bordered table-striped"> -->
                    <thead>
                      <tr class="table_th_border">
						 <th class="no-filter" style="text-align: center;"><?php if(count($diamond_stock_list)!="0"){?><input name="select_all" value="1" type="checkbox"><?php }?></th>
                        <th  class="no-sort" style="23%  !important;text-align: center;">Name</th>
                        <th  class="no-sort" style="23%  !important;text-align: center;">Availability</th>
                        <th  class="no-sort" style="23%  !important;text-align: center;">Updated By</th>
                        <th  class="no-sort" style="23%  !important;text-align: center;">Last Updated</th>                      
                       
                                                						
                      </tr>
					  
					  
                    </thead>
					
                    <tbody>
					<?php if(count($diamond_stock_list)!="0"){
						foreach($diamond_stock_list as $diamond_stock_rows){
							
							
							
						?>
						<tr>	
						
					 <td>	<?php echo $diamond_stock_rows->product_id;?>	</td>
						<td style="width:23%  !important;"><?php echo $diamond_stock_rows->product_name;?></td>
                        <td style="width:23%  !important;"><?php echo $diamond_stock_rows->status;?></td>
                        <td style="width:23%  !important;"><?php echo $diamond_stock_rows->updated_by;?></td>
                        <td style="width:23%  !important;"><?php echo $diamond_stock_rows->updated_on;?></td>
                       
                        
						
                      
                      </tr>
						<?php
						
					}
					
					}
						?>
										
                      
                    </tbody>
					<?php 
					if(count($diamond_stock_list)!="0"){
						?>
					   <tr><td colspan="7">
				   <p><button type="submit" class="btn btn-primary" value="Delete Selected Stock">Submit</button></p>
				  
				   </td></tr>
				   
					<?php } ?>
                 
                  </table>
				  <div class="form-group">
				
				<div>
				
			
				</div>
				
				
				
                </div>
				  </form>
				<?php //}else {
					
					
				//}
				?>
                 </div><!-- /.box-body -->
              </div><!-- /.box -->

            
           

		   </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   