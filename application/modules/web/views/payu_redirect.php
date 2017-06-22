<!DOCTYPE html>
<html>
<head>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  </head>
<body onload="submitPayuForm()">
 <form action="<?php echo $action; ?>" method="post" name="payuForm">
      <input type="hidden" name="key" value="<?php echo $key;?>" />
      <input  type="hidden" name="hash" value="<?php echo $hash;?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid;?>" /> 
          <input type="hidden"  name="amount" value="<?php echo $amount;?>" />
         <input  type="hidden" name="firstname" id="firstname" value="<?php echo $firstname;?>" />
          <input type="hidden"  name="email" id="email" value="<?php echo $email;?>" />
         <input type="hidden" name="phone" value="<?php echo $phone;?>" />
         <input type="hidden" name="productinfo" value="<?php echo $productinfo;?>" />
		 
		 
        
         <input  type="hidden" name="surl" value="<?php echo $surl;?>" size="64" />
        <input type="hidden" name="furl" value="<?php echo $furl;?>" size="64" />
         <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
         <input type="hidden" name="lastname" id="lastname" value="" />
         <input type="hidden" name="curl" value="" />
          <input type="hidden" name="address1" value="" />
         <input type="hidden" name="address2" value="" />
         <input type="hidden" name="city" value="" />
         <input type="hidden" name="state" value="" />
          <input type="hidden" name="country" value="" />
          <input type="hidden" name="zipcode" value="" />
          <input type="hidden" name="udf1" value="" />
          <input type="hidden" name="udf2" value="" />
          <input type="hidden" name="udf3" value="" />
         <input type="hidden" name="udf4" value="" />
         <input type="hidden" name="udf5" value="" />
          <input type="hidden" name="pg" value="" />
             
     </form>

</body>
</html>