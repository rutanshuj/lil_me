<?php 
if($error=="0"){
?>
<b>Catalogue Title :<b><?php echo $catalog_title;?><br><br>
  <embed src="<?php echo $catalog_url;?>" width="820" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
  

<?php 
} else { echo "Record not found";}
?>