<?php
require(APPPATH.'libraries/REST_Controller.php');
header('Content-Type: application/json');
date_default_timezone_set('Asia/Kolkata');
class Payu extends REST_controller {

	 function __construct()
    {
        parent::__construct();
      	
    }
	
	
	function checkNull($value) {
            if ($value == null) {
                  return '';
            } else {
                  return $value;
            }
      }
	
	
	function getHashes_post(){
		
		
		///////////////
		$txnid=trim($this->input->post('txnid',true));
		$amount=trim($this->input->post('amount',true));
		$productinfo=trim($this->input->post('productinfo',true));
		$firstname=trim($this->input->post('firstname',true));
		$email=trim($this->input->post('email',true));
		$user_credentials=trim($this->input->post('user_credentials',true));
		$udf1=trim($this->input->post('udf1',true));
		$udf2=trim($this->input->post('udf2',true));
		$udf3=trim($this->input->post('udf3',true));
		$udf4=trim($this->input->post('udf4',true));
		$udf5=trim($this->input->post('udf5',true));
		$offerKey=trim($this->input->post('offerKey',true));
		$cardBin=trim($this->input->post('cardBin',true));
	
		
		
		//////////
		
		$status_code="200";
		$salt ="jOfvdGdwql";
		$key ="1BA7Z9eM";
		
		

      $payhash_str = $key . '|' . $this->checkNull($txnid) . '|' .$this->checkNull($amount)  . '|' .$this->checkNull($productinfo)  . '|' . $this->checkNull($firstname) . '|' . $this->checkNull($email) . '|' . $this->checkNull($udf1) . '|' . $this->checkNull($udf2) . '|' . $this->checkNull($udf3) . '|' . $this->checkNull($udf4) . '|' . $this->checkNull($udf5) . '||||||' . $salt;
      $paymentHash = strtolower(hash('sha512', $payhash_str));
      $arr['payment_hash'] = $paymentHash;

      $cmnNameMerchantCodes = 'get_merchant_ibibo_codes';
      $merchantCodesHash_str = $key . '|' . $cmnNameMerchantCodes . '|default|' . $salt ;
      $merchantCodesHash = strtolower(hash('sha512', $merchantCodesHash_str));
      $arr['get_merchant_ibibo_codes_hash'] = $merchantCodesHash;

      $cmnMobileSdk = 'vas_for_mobile_sdk';
      $mobileSdk_str = $key . '|' . $cmnMobileSdk . '|default|' . $salt;
      $mobileSdk = strtolower(hash('sha512', $mobileSdk_str));
      $arr['vas_for_mobile_sdk_hash'] = $mobileSdk;

      $cmnPaymentRelatedDetailsForMobileSdk1 = 'payment_related_details_for_mobile_sdk';
      $detailsForMobileSdk_str1 = $key  . '|' . $cmnPaymentRelatedDetailsForMobileSdk1 . '|default|' . $salt ;
      $detailsForMobileSdk1 = strtolower(hash('sha512', $detailsForMobileSdk_str1));
      $arr['payment_related_details_for_mobile_sdk_hash'] = $detailsForMobileSdk1;

      //used for verifying payment(optional)  
      $cmnVerifyPayment = 'verify_payment';
      $verifyPayment_str = $key . '|' . $cmnVerifyPayment . '|'.$txnid .'|' . $salt;
      $verifyPayment = strtolower(hash('sha512', $verifyPayment_str));
      $arr['verify_payment_hash'] = $verifyPayment;

      if(($user_credentials != NULL) && ($user_credentials != ''))
      {
            $cmnNameDeleteCard = 'delete_user_card';
            $deleteHash_str = $key  . '|' . $cmnNameDeleteCard . '|' . $user_credentials . '|' . $salt ;
            $deleteHash = strtolower(hash('sha512', $deleteHash_str));
            $arr['delete_user_card_hash'] = $deleteHash;

            $cmnNameGetUserCard = 'get_user_cards';
            $getUserCardHash_str = $key  . '|' . $cmnNameGetUserCard . '|' . $user_credentials . '|' . $salt ;
            $getUserCardHash = strtolower(hash('sha512', $getUserCardHash_str));
            $arr['get_user_cards_hash'] = $getUserCardHash;

            $cmnNameEditUserCard = 'edit_user_card';
            $editUserCardHash_str = $key  . '|' . $cmnNameEditUserCard . '|' . $user_credentials . '|' . $salt ;
            $editUserCardHash = strtolower(hash('sha512', $editUserCardHash_str));
            $arr['edit_user_card_hash'] = $editUserCardHash;

            $cmnNameSaveUserCard = 'save_user_card';
            $saveUserCardHash_str = $key  . '|' . $cmnNameSaveUserCard . '|' . $user_credentials . '|' . $salt ;
            $saveUserCardHash = strtolower(hash('sha512', $saveUserCardHash_str));
            $arr['save_user_card_hash'] = $saveUserCardHash;

            $cmnPaymentRelatedDetailsForMobileSdk = 'payment_related_details_for_mobile_sdk';
            $detailsForMobileSdk_str = $key  . '|' . $cmnPaymentRelatedDetailsForMobileSdk . '|' . $user_credentials . '|' . $salt ;
            $detailsForMobileSdk = strtolower(hash('sha512', $detailsForMobileSdk_str));
            $arr['payment_related_details_for_mobile_sdk_hash'] = $detailsForMobileSdk;
      }


       if(($udf3!=NULL ) && ( !empty($udf3))){
            $cmnSend_Sms='send_sms';
            $sendsms_str=$key . '|' . $cmnSend_Sms . '|' . $udf3 . '|' . $salt;
            $send_sms = strtolower(hash('sha512',$sendsms_str));
            $arr['send_sms_hash']=$send_sms;
       }


      if (($offerKey!=NULL ) && ( !empty($offerKey))) {
                  $cmnCheckOfferStatus = 'check_offer_status';
                        $checkOfferStatus_str = $key  . '|' . $cmnCheckOfferStatus . '|' . $offerKey . '|' . $salt ;
                  $checkOfferStatus = strtolower(hash('sha512', $checkOfferStatus_str));
                  $arr['check_offer_status_hash']=$checkOfferStatus;
            }


            if (($cardBin!=NULL ) && ( !empty($cardBin)) ){
                  $cmnCheckIsDomestic = 'check_isDomestic';
                        $checkIsDomestic_str = $key  . '|' . $cmnCheckIsDomestic . '|' . $cardBin . '|' . $salt ;
                  $checkIsDomestic = strtolower(hash('sha512', $checkIsDomestic_str));
                  $arr['check_isDomestic_hash']=$checkIsDomestic;
            }

echo json_encode($arr);

  
	}
	
	
	
	function sha512_post(){
		$status_code="200";
		$salt ="jOfvdGdwql";
		$key ="1BA7Z9eM";
		
		
		$user_id=trim($this->input->post('user_id',true));
		$api_key=trim($this->input->post('api_key',true));
		
		$where_array=array('user_id'=>$user_id,'api_key'=>$api_key);
		$this->db->select("username");
		$this->db->from('user_details');
		$this->db->where($where_array);
		$query=$this->db->get();
		$query->num_rows();
		if($query->num_rows()!="1"){
			$data['message']="some data is missing";
		} else {
			
			$txnid=trim($this->input->post('txnid',true));
			$txnid=trim($this->input->post('txnid',true));
			$amount=trim($this->input->post('amount',true));
			$productinfo=trim($this->input->post('productinfo',true));
			$firstname=trim($this->input->post('firstname',true));
			$email=trim($this->input->post('email',true));
			
			$udf1=trim($this->input->post('udf1',true));
			$udf2=trim($this->input->post('udf2',true));
			$udf3=trim($this->input->post('udf3',true));
			$udf4=trim($this->input->post('udf4',true));
			$udf5=trim($this->input->post('udf5',true));
			
			
			

			
			
			
			$data['statusCode']=0;
			if(($txnid!="")&&($amount!="")&&($productinfo!="")&&($firstname!="")&&($email!="")){
				$data['statusCode']=1;	
				$data['data']=openssl_digest("$key|$txnid|$amount|$productinfo|$firstname|$email|$udf1|$udf2|$udf3|$udf4|$udf5|$salt", 'sha512');
			} else {
				$data['message']="some data is missing";
			}
		}		
		$this->response($data,$status_code);
	}
	
	
	
	
	
	
	
	
	
	
	
	}
?>      