
<?php
//require(APPPATH.'libraries/apn.php');
class PushNotifController extends CI_controller {  
//Basic usage for pushing (controller)
	function index()
	{
		//ECHO "hsdkjashdlak";
	}  
	function send_notifications()
	{
		$device_token = trim($this->input->post('device_id',true));
		
		if($device_token!=""){
		//echo $device_token;
			$this->load->library('apn');
			//echo"jdfljd";
			$this->apn->payloadMethod = 'enhance'; // you can turn on this method for debuggin purpose
			$this->apn->connectToPush();
			//echo "jdfljd"; 
			// adding custom variables to the notification
			$this->apn->setData(array( 'someKey' => true ));

			$send_result = $this->apn->sendMessage($device_token, 'Test notif #2 (TIME:'.date('H:i:s').')', /*badge*/ 2, /*sound*/ 'default'  );
			//echo $send_result."ndcjkx";
			if($send_result){
				log_message('debug','Sending successfully');
				
			}
			else{
				log_message('error',$this->apn->error);
		
			}
			$this->apn->disconnectPush();
		} else {
			log_message('error','device_id missing');
		}
	}
	
	// designed for retreiving devices, on which app not installed anymore
	public function apn_feedback()
	{
		$this->load->library('apn');

		$unactive = $this->apn->getFeedbackTokens();
		
		if (!count($unactive))
		{
			log_message('info','Feedback: No devices found. Stopping.');
			return false;
		}
		  
		foreach($unactive as $u)
		{
			$devices_tokens[] = $u['devtoken'];
		}
	
		/*
		print_r($unactive) -> Array ( [0] => Array ( [timestamp] => 1340270617 [length] => 32 [devtoken] => 002bdf9985984f0b774e78f256eb6e6c6e5c576d3a0c8f1fd8ef9eb2c4499cb4 ) ) 
		*/
	}
	public function send_gcm_message()
	{
    // simple loading
    // note: you have to specify API key in config before
        $this->load->library('gcm');
      	$reg_id= trim($this->input->post('regId',true));
    // simple adding message. You can also add message in the data,
    // but if you specified it with setMesage() already
    // then setMessage's messages will have bigger priority
        $this->gcm->setMessage('Test message '.date('d.m.Y H:s:i'));

    // add recepient or few
        $this->gcm->addRecepient($reg_id);
        //$this->gcm->addRecepient('New reg id');

    // set additional data
        $this->gcm->setData(array(
            'some_key' => 'some_val'
        ));
  
    // also you can add time to live
        $this->gcm->setTtl(500);
    // and unset in further
        $this->gcm->setTtl(false);

    // set group for messages if needed
        $this->gcm->setGroup('Test');
    // or set to default
        $this->gcm->setGroup(false);

    // then send
        if ($this->gcm->send())

            echo 'Success for all messages';
        else
            echo 'Some messages have errors';

    // and see responses for more info
       print_r($this->gcm->status);
        print_r($this->gcm->messagesStatuses);

    die(' Worked.');
	}
	}
	?>