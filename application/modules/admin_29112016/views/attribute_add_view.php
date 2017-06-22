 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Attributes
            <small>add</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Attributes</li>
          </ol>
        </section>

    
         
		   <!-- Main content -->
        <section class="content">
		
		
		
          <div class="row">
		   <div class="col-xs-12">
					<div style="float: left;padding-right: 10px;padding-bottom: 10px;">
					<a href="<?php echo base_url('admin/attribute');?>" class="btn btn-primary" > Attribute List</a></div>
					
					<div style="padding-bottom: 10px;"><a href="<?php echo base_url('admin/attribute/add');?>" class="btn btn-primary" style="border-style:groove solid double;border-color: black;border-width: 2px;border-radius: 6px"> Add New Attribute</a></div>
				</div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Add Attribute</h3>
                </div>
                <div class="box-body">
				
			 
		
			
              <div class="col-xs-12">
			  
			  <form role="form" action="<?php echo base_url('admin/attribute/add');?>" method="post"  enctype="multipart/form-data">
			<?php if(isset($success)){ ?>
		
		<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $success;?>
              </div>
		<?php 
		}
		?>
		
		<?php if((validation_errors())||(isset($error) &&($error!=""))){ ?>
		<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
               <?php echo validation_errors(); if(isset($error) &&($error!="")){echo $error;}?>
              </div>
		
		
		
		
		<?php 
		}
		?>
			
                <div class="form-group">
				<div  style="float: left;width: 160px;">Attribute Name :</div>
				<div>
				<input value="<?php if(isset($attribute_name)){echo $attribute_name ;}?>" name="attribute_name" >
				</div>
				
				
                </div>
				
				
				
                <div class="form-group">
				<div style="float: left;width: 160px;">Attribute Type :</div>
				<div><select name="attribute_type_id" id="attribute_type_id"  class="form-control" style="width: inherit;">
				<?php foreach($master_attribute_type as $attribute_type_row) {?>
					<option value="<?php echo $attribute_type_row->attribute_type_title;?>"><?php echo $attribute_type_row->attribute_type_title;?></option>
				<?php
				}
				?>
				</select></div>
				
				
			   </div>
				
							
             
				
				<div class="form-group">
				
				<div style="float: left;width: 160px;">Atrribute Header :</div>
				
				
				
				<div>
				
				<select name="attribute_header_id" id="attribute_header_id"  class="form-control" style="width: inherit;">
				<?php foreach($master_attribute_header as $attribute_header_row) {?>
					<option value="<?php echo $attribute_header_row->attribute_header_title;?>"><?php echo $attribute_header_row->attribute_header_title;?></option>
				<?php
				}
				?>
				</select>
				</div>
				
				
                </div>
				<div class="form-group">
				
				
				<div  style="float: left;width: 160px;">Sort Order :</div>
				<div class="input-group">
				
               
				<input type="number" value="" name="sort_order" type="number"  min="0" >
				
				
				</div>
				
				
                </div>
				
				
				
				<div class="form-group">
				
				<div  style="float: left;width: 160px;">
				
				<input type="submit" class="btn btn-primary" id="submit" name="submit" value="Add" >
				</div>
				
				
				
                </div>
				
				
				
				
				
				
				</form>
				
				
				
				
				
             
              </div>
              <!-- /.box-body -->

          
         
                 </div><!-- /.box-body -->
              </div><!-- /.box -->

                        


		   </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      
	  
          <!-- Main row -->
      

     
      </div><!-- /.content-wrapper -->
	  
	  
   