<?php

class Api_model {

	public function response($status,$message,$data)
		{
			header("HTTP/1.1 ".$status);
			
			$response['status']=$status;
			$response['message']=$message;
			$response['data']=$data;
			
			$json_response = json_encode($response);
			echo $json_response;
		}
}