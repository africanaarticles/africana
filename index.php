<?php

 //Processing the Mpesa json response Data
     $mpesaResponse = file_get_contents('lipa.json');
     $callbackContent = json_decode($mpesaResponse);

     $Resultcode = $callbackContent->Body->stkCallback->ResultCode;
     	 
     $Amount = $callbackContent->Body->stkCallback->CallbackMetadata->Item[0]->Value;
     $MpesaReceiptNumber = $callbackContent->Body->stkCallback->CallbackMetadata->Item[1]->Value;
	 $TransactionDate = $callbackContent->Body->stkCallback->CallbackMetadata->Item[3]->Value;
     $PhoneNumber = $callbackContent->Body->stkCallback->CallbackMetadata->Item[4]->Value;
     
     if ($Resultcode == 0) {

    
      // Connect to DB
      $conn = mysqli_connect("localhost","root","","lipajson");
  
  
  
  
      // Check connection
      if ($conn->connect_error) {
          die("<h1>Connection failed:</h1> " . $conn->connect_error);
      } else {
  
  
          $insert = $conn->query("INSERT INTO lipa(Amount,MpesaReceiptNumber,TransactionDate,PhoneNumber) VALUES ('$Amount','$MpesaReceiptNumber','$TransactionDate','$PhoneNumber')");
          $conn = null;
		  echo "Insert data successfully";
      }
  }

     

 
