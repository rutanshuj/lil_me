<div class="container">
  <section>
    <div class="filter">
      <span style="color: white;">uidjsjik
      </span>
      <div class="param1"> 
        <div class="verticalLine"> Filter by :
          <a href="#" onclick="displayAgeRow()">Age 
          </a>
        </div>
        <a href="#" onclick="displaySexRow()">sex 
        </a>
      </div>
      <div  class="param2"> 
        <div class="verticalLine">Sort by : 
          <a onclick='addsort(this)'>
            <?php if($sortflag==0)
{ echo "Low to High";}
else{ echo "High to Low";}?> 
          </a> 
        </div> 
        <div class="verticalLine">
          <a onclick='addsortbyName()'>Name  
          </a>
        </div>
        <a onclick='addsortbyDisc()'>Discount  
        </a>
      </div>
    </div>
    <div class="filter agegroup" id="filter_agegroup" align="center">
      <?php if(is_array($size_array)&&(count($size_array)!="0")) {
foreach($size_array as $size){
?>
      <a onclick="addsize(<?php echo $category_id?>,<?php echo $size->size_id?>,'');"> 
        <?php echo $size->size_title?> 
      </a>
      <?php }
}
?>
<?php //if (isset ($_SESSION['username'])) echo $_SESSION['username'];?>
    </div>
    <div class="filter agegroup" id="filter_sexgroup" align="center">
      <a onclick="addsize(<?php echo $category_id?>,'','male');"> Male 
      </a>
      <a onclick="addsize(<?php echo $category_id?>,'','female');"> Female
      </a>
      <a onclick="addsize(<?php echo $category_id?>,'','unisex');"> Unisex
      </a>
    </div>
    <p class="text-muted lead" align="center"> Baby Girl Clothing
    </p>
    <div class="col-sm-12">
      <div class="row products">
        <?php 
				if(is_array($product_list)&&(count($product_list)!="0")) {
				foreach($product_list as $product_row){
				$image_url=base_url().$product_row->image_url;
				$file_headers = @get_headers($image_url);
				if($file_headers[0] == "HTTP/1.0 404 Not Found") {
				$image_url = base_url().'assets/img/default.jpg';
				} 
				//$image_url=base_url()."assets/img/product1.jpg";
?>
				
        <div class="col-md-3 col-sm-4" style="height: 418px;">
          <div class="product">
            <div class="image">
              <a href="<?php echo base_url('web/home/product_details')."?product_id=".$product_row->product_id?>">
                <img src="<?php echo $image_url;?>" alt="" class="img-responsive image1">
              </a>
            </div>
            <!-- /.image -->
            <div class="text">
              <h4>
                <a href="<?php echo base_url('web/home/product_details')."?product_id=".$product_row->product_id?>">
                  <?php echo $product_row->product_name?>
                </a>
              </h4>
            </div>
            <!-- /.text -->
          </div>
          <!-- /.product -->
        </div>
        <?php
}
}
?>
        <!-- /.products -->
      </div>
      <div class="pages">
        <p class="loadMore">
          <a href="#" class="btn btn-template-main">
            <i class="fa fa-chevron-down">
            </i> Load more
          </a>
        </p>
      </div>
      </section>
    </div>
  <script>
    function addsize(category_id,size_id,gender)
    {
      //alert($size_id);
      var link = "http://localhost/lil_me/web/home/products_by_param?category_id="+category_id+"&size=" + size_id +"&gender="+gender ;
      window.location=link;
    }
    function displaySexRow()
    {
      if ( $('#filter_sexgroup').css('display') == 'block' )
      {
        document.getElementById("filter_sexgroup").style.display = 'none';
      }
      else{
        document.getElementById("filter_sexgroup").style.display = 'block';
      }
    }
    function addsort(obj)
    {
      var url= window.location.href;
      var t = $(obj).text();
      t=t.trim();
      if(t=='Low to High')
      {
        url=url+"&sortflag="+0;
      }
      else{
        url=url+"&sortflag="+1;
      }
      window.location=url;
    }
    function addsortbyName()
    {
      var url= window.location.href;
      url=url+"&sortparam="+'name';
      window.location=url;
    }
    function addsortbyDisc()
    {
      var url= window.location.href;
      url=url+"&sortparam="+'disc';
      window.location=url;
    }
    function displayAgeRow()
    {
      if ( $('#filter_agegroup').css('display') == 'block' )
      {
        document.getElementById("filter_agegroup").style.display = 'none';
      }
      else{
        document.getElementById("filter_agegroup").style.display = 'block';
      }
    }
  </script>
