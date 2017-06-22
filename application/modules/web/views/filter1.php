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
					
					<div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Prints </h3>
                        </div>

                        <div class="panel-body">

                            
                                <div class="form-group">
								<?php if(isset($filter_data['print_selected']))
								{
								foreach($filter_data['print_selected'] as $index=>$print_row){ ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name='print' checked><?php echo $print_row['content']?>
                                        </label>
                                    </div>
								<?php }}?> 
								<?php foreach($filter_data['print_available'] as $index=>$print_row){ ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name='print' value='<?php echo $print_row['content']?>'><?php echo $print_row['content']?>
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

                             <button class="btn btn-default btn-sm btn-primary"  ><i class="fa fa-pencil"></i> Apply </button>

                        </div>
                    </div>
					
					
					<div class="panel panel-default sidebar-menu">
					 
                        <div class="panel-heading">
                            <h3 class="panel-title">Price </h3>
                        </div>

                        <div class="panel-body">
 
                                <div class="form-group">
								<?php if(isset($filter_data['price_selected']))
								{
								foreach($filter_data['price_selected'] as $index=>$price_row){ ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name='price' value='<?php echo $price_row['content']?>' checked><?php echo $price_row['content']?>
                                        </label>
                                    </div>
                                    
								<?php }}?> 
								<?php foreach($filter_data['price_available'] as $index=>$price_row){ ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name='price' value='<?php echo $price_row['content']?>'><?php echo $price_row['content']?>
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
                  
							 <button class="btn btn-default btn-sm btn-primary"  ><i class="fa fa-pencil"></i> Apply </button>
                        </div>
						
						
                    </div>
				
					
					<div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Size </h3>
                        </div>

                        <div class="panel-body">

                             
                                <div class="form-group">
								<?php if(isset($filter_data['size_selected']))
								{
								foreach($filter_data['size_selected'] as $index=>$size_row){ ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name='size' value='<?php echo $size_row['content']?>' checked><?php echo $size_row['content']?>
                                        </label>
                                    </div>
                                    
								<?php }}?>  
								<?php foreach($filter_data['size_available'] as $index=>$size_row){ ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name='size' value='<?php echo $size_row['content']?>'><?php echo $size_row['content']?>
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
       <button class="btn btn-default btn-sm btn-primary"  ><i class="fa fa-pencil"></i> Apply </button>

                        </div>
                    </div>
					
					
					 <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Colours </h3>
                        </div>

                        <div class="panel-body">

                         
                                <div class="form-group">
								 <?php foreach($filter_data['color_selected'] as $index=>$color_row){ ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"  name='color' checked value='<?php echo $color_row['content'];?>' > <span class="colour white"></span> <?php echo $color_row['content']?>
                                        </label>
                                    </div>
                                   <?php }?> 
								 <?php foreach($filter_data['color_available'] as $index=>$color_row){ ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name='color' value='<?php echo $color_row['content'];?>' > <span class="colour white"></span> <?php echo $color_row['content']?>
                                        </label>
                                    </div>
                                   <?php }?> 
                                    <?php foreach($filter_data['color_not_available'] as $index=>$color_row){ ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" disabled> <span class="colour white"></span> <?php echo $color_row['content']?>
                                        </label>
                                    </div>
                                   <?php }?>  
                                    
                                </div>

                       <button class="btn btn-default btn-sm btn-primary" ><i class="fa fa-pencil"></i> Apply </button><a class="btn btn-xs btn-danger pull-right" id='clear_link' href="#"><i class="fa fa-times-circle" style=" padding: 6px;"></i> Clear</a>

                           

                        </div>
						 
                    </div>
					
					<script>
					$(function(){
					 $('#clear_link').click(function(){
					  $('#form input[type="checkbox"]').attr('checked', false);
					  return false;
					  
					 });
					});
					$(document).ready(function() {
					$("button").click(function(){
						var price = [];
						var color = [];
						var print = [];
						var size = [];
						$.each($("input[name='price']:checked"), function(){            
							price.push($(this).val());
						});
						$.each($("input[name='print']:checked"), function(){            
							print.push($(this).val());
						});
						$.each($("input[name='color']:checked"), function(){            
							color.push($(this).val());
						});
						$.each($("input[name='size']:checked"), function(){            
							size.push($(this).val());
						});
						//alert("My favourite sports are: " + color.join(", "));
						//alert("My favourite sports are: " + print.join(", "));
						
						$('<form action="<?php echo base_url('products/').'/'.$category_slug.'/'.$subcategory_slug.'?subcat='.$subcategory_id?>" method="POST">' + 
						'<input type="hidden" name="price[]" value="' + price + '">' +
						'<input type="hidden" name="color[]" value="' + color + '">' +
						'<input type="hidden" name="print[]" value="' + print + '">' +
						'<input type="hidden" name="size[]" value="' + size + '">'+
						'</form>').submit();
						document.body.appendChild(form);
						
						
					});
				});
					
					</script>
					