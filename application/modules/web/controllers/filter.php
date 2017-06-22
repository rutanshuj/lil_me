<style>
.active{
	    background-color: #1E0022;
}
</style>
<?php 
		
		$filter_data = $this->session->userdata('filter_data');
		$category_slug=$this->session->userdata('category_slug');
		$subcategory_id=$this->session->userdata('subcategory_id');
		/* echo"<pre>";
		print_r($this->session->userdata('filter_data["price_selected"]'));
		echo"</pre>"; 
		die(); */
  	 ?>
                        <div class="panel-body">
						 <?php if(is_array($category_list)&&(count($category_list)!="0")) {?>
                            <ul class="nav nav-pills nav-stacked category-menu">
							
								<?php foreach($category_list as $index=>$category_row){ ?>
                                <li>
								
                                    <a href="<?php echo base_url('web/home/categories')?>" style="pointer-events: none;" ><?php echo $category_row->category_name?></a>
                                    <ul>
									<?php foreach($category_row->subcategory as $subcategory_row){?>
                                        <li <?php if(isset($subcategory_slug) && $subcategory_slug==$subcategory_row->subcategory_slug)
									echo 'class=active';?>  ><a href="<?php echo base_url('products/').'/'.$category_row->category_slug.'/'.$subcategory_row->subcategory_slug.'?subcat='.$subcategory_row->subcategory_id?>"><?php echo $subcategory_row->subcategory_name?></a>
                                        </li>
                                    <?php }?>
                                    </ul>
                                </li>
                               
							<?php }?>
                            </ul>
							<?php }?>
                        </div>
						</div>
					<form method="post" action="<?php echo base_url('products/').'/'.$category_slug.'/'.$subcategory_slug.'?subcat='.$subcategory_id?>" id='form'>
					<div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
						 <a class="btn btn-xs btn-danger pull-right" id='print_link' href="#"><i class="fa fa-times-circle"></i> Clear</a>
                            <h3 class="panel-title">Prints </h3>
							
                        </div>

                        <div class="panel-body" id='prints'>

                            
                                <div class="form-group">
								<?php foreach($filter_data['print_selected'] as $index=>$print_row){ ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" onclick='submitForms();'  name='print[]' checked><?php echo $print_row['content']?>
                                        </label>
                                    </div>
                                  <?php }?> 
								<?php foreach($filter_data['print_available'] as $index=>$print_row){ ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" onclick='submitForms();' name='print[]' value='<?php echo $print_row['content']?>'><?php echo $print_row['content']?>
                                        </label>
                                    </div>
                                  <?php }?>   
                                <?php foreach($filter_data['print_not_available'] as $index=>$print_row){ ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" disabled><?php echo $print_row['content']?>
                                        </label>
                                    </div>
                                  <?php }?> 
                                    
                                </div>

                            

                        </div>
                    </div>
					<div class="panel panel-default sidebar-menu">
					 
                        <div class="panel-heading">
						<a class="btn btn-xs btn-danger pull-right" id='price_link' href="#"><i class="fa fa-times-circle"></i> Clear</a>
                            <h3 class="panel-title">Price </h3>
							
                        </div>

                        <div class="panel-body" id='prices'>
 
                                <div class="form-group">
								<?php foreach($filter_data['price_selected'] as $index=>$price_row){ ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" onclick='submitForms();' name='price[]' value='<?php echo $price_row['content']?>' checked><?php echo $price_row['content']?>
                                        </label>
                                    </div>
                                    
                                 <?php }?> 
								<?php foreach($filter_data['price_available'] as $index=>$price_row){ ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" onclick='submitForms();' name='price[]' value='<?php echo $price_row['content']?>'><?php echo $price_row['content']?>
                                        </label>
                                    </div>
                                    
                                 <?php }?>  
								 <?php foreach($filter_data['price_not_available'] as $index=>$price_row){ ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" disabled><?php echo $price_row['content']?>
                                        </label>
                                    </div>
                                    
                                 <?php }?> 
                                </div>
                  

                        </div>
                    </div>
					<div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
						<a class="btn btn-xs btn-danger pull-right" id='size_link' href="#"><i class="fa fa-times-circle"></i> Clear</a>
                            <h3 class="panel-title">Size </h3>
							 
                        </div>

                        <div class="panel-body" id='sizes'>

                             
                                <div class="form-group">
								<?php foreach($filter_data['size_selected'] as $index=>$size_row){ ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" onclick='submitForms();' name='size[]' value='<?php echo $size_row['content']?>' checked><?php echo $size_row['content']?>
                                        </label>
                                    </div>
                                    
                                 <?php }?>  
								<?php foreach($filter_data['size_available'] as $index=>$size_row){ ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" onclick='submitForms();' name='size[]' value='<?php echo $size_row['content']?>'><?php echo $size_row['content']?>
                                        </label>
                                    </div>
                                    
                                 <?php }?>  
								 
								 <?php foreach($filter_data['size_not_available'] as $index=>$price_row){ ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" disabled><?php echo $price_row['content']?>
                                        </label>
                                    </div>
                                    
                                 <?php }?> 
                                </div>
      

                        </div>
                    </div>
					 <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
						<a class="btn btn-xs btn-danger pull-right" id='color_link' href="#"><i class="fa fa-times-circle"></i> Clear</a>
                            <h3 class="panel-title">Colours </h3>
							
                        </div>

                        <div class="panel-body" id='colors'>

                         
                                <div class="form-group">
								 <?php foreach($filter_data['color_selected'] as $index=>$color_row){ ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" onclick='submitForms();'  name='color[]' checked value='<?php echo $color_row['content'];?>' > <span class="colour white"></span> <?php echo $color_row['content']?>
                                        </label>
                                    </div>
                                   <?php }?> 
								 <?php foreach($filter_data['color_available'] as $index=>$color_row){ ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" onclick='submitForms();' name='color[]' value='<?php echo $color_row['content'];?>' > <span class="colour white"></span> <?php echo $color_row['content']?>
                                        </label>
                                    </div>
                                   <?php }?> 
                                    <?php foreach($filter_data['color_not_available'] as $index=>$color_row){ ?>
                                    <div class="checkbox">
                                        <label>
                                            <input  type="checkbox" disabled> <span class="colour white"></span> <?php echo $color_row['content']?>
                                        </label>
                                    </div>
                                   <?php }?>  
                                    
                                </div>

                     

                           

                        </div>
						 
                    </div>
					</form>
					<script>
					$(function(){
					 $('#price_link').click(function(){
					  $('#prices input[type="checkbox"]').attr('checked', false);
					  document.forms["form"].submit();
					  return false;
					 });
					});
					$(function(){
					 $('#print_link').click(function(){
					  $('#prints input[type="checkbox"]').attr('checked', false);
					  document.forms["form"].submit();
					  return false;
					 });
					 });
					 $(function(){
					 $('#color_link').click(function(){
					  $('#colors input[type="checkbox"]').attr('checked', false);
					  document.forms["form"].submit();
					  return false;
					 });
					 });
					 $(function(){
					 $('#price_link').click(function(){
					  $('#prices input[type="checkbox"]').attr('checked', false);
					  document.forms["form"].submit();
					  return false;
					 });
					 });
					submitForms = function(){
						//alert(1);
					document.forms["form"].submit();
					
					}
					
					
					</script>
					