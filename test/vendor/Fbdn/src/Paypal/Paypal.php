<?php

/**
 * Paypal short summary.
 *
 * Paypal description.
 *
 * @version 1.0
 * @author Francesco
 */
namespace Fbdn\Paypal;

class Paypal
{
	/********************************************
	PayPal API Module

	Defines all the global variables and the wrapper functions
     ********************************************/
	const PROXY_HOST = '127.0.0.1';
	const PROXY_PORT = '808';



	//'------------------------------------
	//' PayPal API Credentials
	//' Replace <API_USERNAME> with your API Username
	//' Replace <API_PASSWORD> with your API Password
	//' Replace <API_SIGNATURE> with your Signature
	//'------------------------------------
	const API_UserName="sb-rujkk3503116_api1.business.example.com";
	const API_Password="YLL7TCRFX64M4Z9R";
	const API_Signature="AY8hG4GFcbnx.98GkAz1Wl4F8.GFAY1HFzed-sM8FJJa.hcCzg37SH1G";

	// BN Code 	is only applicable for partners
	const sBNCode = "PP-ECWizard";
    const version= "93";

    private $API_Endpoint = '';
    private $PAYPAL_URL = '';
    private $SandboxFlag = true;
    private $USE_PROXY;

	/*
	' Define the PayPal Redirect URLs.
	' 	This is the URL that the buyer is first sent to do authorize payment with their paypal account
	' 	change the URL depending if you are testing on the sandbox or the live PayPal site
	'
	' For the sandbox, the URL is       https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=
	' For the live site, the URL is        https://www.paypal.com/webscr&cmd=_express-checkout&token=
     */
    function __construct(){

        if ($this->SandboxFlag == true)
        {
            $this->API_Endpoint = "https://api-3t.sandbox.paypal.com/nvp";
            $this->PAYPAL_URL = "https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&useraction=commit&token=";
        }
        else
        {
            $this->API_Endpoint = "https://api-3t.paypal.com/nvp";
            $this->PAYPAL_URL = "https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&useraction=commit&token=";
        }

        $this->USE_PROXY = false;


        if (session_id() == "" || session_status() == PHP_SESSION_NONE)
            session_start();
    }


	/* Una transazione express checkout inizia con un token, che
    identifica a PayPal la tua transazione.
    In questo esempio, quando lo script vede un token, lo script
    sa che l'acquirente ha già autorizzato il pagamento attraverso
    paypal.  Se non è stato trovato alcun token, l'azione consiste nell'inviare l'acquirente
    a PayPal per autorizzare il pagamento
     */

	/*
	'-------------------------------------------------------------------------------------------------------------------------------------------
    ' Scopo: Prepara i parametri per la chiamata API SetExpressCheckout.
	' Inputs:
	' paymentAmount:  	Valore totale del carrello
	' currencyCodeType: Il codice valuta es 'EUR'
	' paymentType: il tipo di pagamento deve essere uno dei seguenti valori: Sale o Order o Authorization
	' returnURL: la pagina in cui gli acquirenti tornano dopo aver effettuato la revisione del pagamento su PayPal
	' cancelURL: la pagina in cui gli acquirenti ritornano quando annullano la revisione del pagamento su PayPal
	'--------------------------------------------------------------------------------------------------------------------------------------------
     */
	public function CallShortcutExpressCheckout( $paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL)
	{
		//------------------------------------------------------------------------------------------------------------------------------------
		// Costruisce la stringa di parametri che descrive la chiamata API SetExpressCheckout nell'implementazione shortcut
        $items = $_SESSION['cart_item'];
		$nvpstr="&PAYMENTREQUEST_0_AMT=". $paymentAmount;
		$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_PAYMENTACTION=" . $paymentType;
		$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_ITEMAMT=". $paymentAmount;
        $i=0;
        foreach($items as $item){
            $nvpstr = $nvpstr . "&L_PAYMENTREQUEST_0_NAME".$i."=".$item['nomecorso'];
            $nvpstr = $nvpstr . "&L_PAYMENTREQUEST_0_QTY".$i."=".$item['quantity'];
            $nvpstr = $nvpstr . "&L_PAYMENTREQUEST_0_AMT".$i."=". $item['price'];
            $i++;
        }
        //-------------------------------------------------------------------------



		$nvpstr = $nvpstr . "&RETURNURL=" . $returnURL;
		$nvpstr = $nvpstr . "&CANCELURL=" . $cancelURL;
		$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_CURRENCYCODE=" . $currencyCodeType;
		$nvpstr = $nvpstr ."&PAYMENTREQUEST_0_NAME = Corsi Acquistati";

		$_SESSION["currencyCodeType"] = $currencyCodeType;
		$_SESSION["PaymentType"] = $paymentType;

		//'---------------------------------------------------------------------------------------------------------------
		//' Make the API call to PayPal
		//' If the API call succeded, then redirect the buyer to PayPal to begin to authorize payment.
		//' If an error occured, show the resulting errors
		//'---------------------------------------------------------------------------------------------------------------
	    $resArray = static::hash_call("SetExpressCheckout", $nvpstr);
		$ack = strtoupper($resArray["ACK"]);
		if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
		{
			$token = urldecode($resArray["TOKEN"]);
			$_SESSION['TOKEN']=$token;
		}

	    return $resArray;
	}

	/*
	'-------------------------------------------------------------------------------------------------------------------------------------------
	' Purpose: 	Prepares the parameters for the SetExpressCheckout API Call.
	' Inputs:
	'		paymentAmount:  	Total value of the shopping cart
	'		currencyCodeType: 	Currency code value the PayPal API
	'		paymentType: 		paymentType has to be one of the following values: Sale or Order or Authorization
	'		returnURL:			the page where buyers return to after they are done with the payment review on PayPal
	'		cancelURL:			the page where buyers return to when they cancel the payment review on PayPal
	'		shipToName:		the Ship to name entered on the merchant's site
	'		shipToStreet:		the Ship to Street entered on the merchant's site
	'		shipToCity:			the Ship to City entered on the merchant's site
	'		shipToState:		the Ship to State entered on the merchant's site
	'		shipToCountryCode:	the Code for Ship to Country entered on the merchant's site
	'		shipToZip:			the Ship to ZipCode entered on the merchant's site
	'		shipToStreet2:		the Ship to Street2 entered on the merchant's site
	'		phoneNum:			the phoneNum  entered on the merchant's site
	'--------------------------------------------------------------------------------------------------------------------------------------------
     */
	public function DoExpressCheckoutPayment($token, $amount, $payer_id) {
		return hash_call("DoExpressCheckoutPayment",
		array(
		"TOKEN" => $token,
		"PAYERID" => $payer_id,
		"PAYMENTACTION" => "Sale",
		"AMT" => $amount,
		)
		);
	}

	public function CallMarkExpressCheckout( $paymentAmount, $currencyCodeType, $paymentType, $returnURL,
									  $cancelURL, $shipToName, $shipToStreet, $shipToCity, $shipToState,
									  $shipToCountryCode, $shipToZip, $shipToStreet2, $phoneNum
									)
	{
		//------------------------------------------------------------------------------------------------------------------------------------
		// Construct the parameter string that describes the SetExpressCheckout API call in the shortcut implementation

		$nvpstr="&PAYMENTREQUEST_0_AMT=". $paymentAmount;
		$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_PAYMENTACTION=" . $paymentType;
		$nvpstr = $nvpstr . "&RETURNURL=" . $returnURL;
		$nvpstr = $nvpstr . "&CANCELURL=" . $cancelURL;
		$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_CURRENCYCODE=" . $currencyCodeType;
		$nvpstr = $nvpstr . "&ADDROVERRIDE=1";
		$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPTONAME=" . $shipToName;
		$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPTOSTREET=" . $shipToStreet;
		$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPTOSTREET2=" . $shipToStreet2;
		$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPTOCITY=" . $shipToCity;
		$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPTOSTATE=" . $shipToState;
		$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE=" . $shipToCountryCode;
		$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPTOZIP=" . $shipToZip;
		$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPTOPHONENUM=" . $phoneNum;

		$_SESSION["currencyCodeType"] = $currencyCodeType;
		$_SESSION["PaymentType"] = $paymentType;

		//'---------------------------------------------------------------------------------------------------------------
		//' Make the API call to PayPal
		//' If the API call succeded, then redirect the buyer to PayPal to begin to authorize payment.
		//' If an error occured, show the resulting errors
		//'---------------------------------------------------------------------------------------------------------------
	    $resArray=hash_call("SetExpressCheckout", $nvpstr);
		$ack = strtoupper($resArray["ACK"]);
		if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
		{
			$token = urldecode($resArray["TOKEN"]);
			$_SESSION['TOKEN']=$token;
		}

	    return $resArray;
	}

	/*
	'-------------------------------------------------------------------------------------------
	' Purpose: 	Prepares the parameters for the GetExpressCheckoutDetails API Call.
	'
	' Inputs:
	'		None
	' Returns:
	'		The NVP Collection object of the GetExpressCheckoutDetails Call Response.
	'-------------------------------------------------------------------------------------------
     */
	public function GetShippingDetails( $token )
	{
		//'--------------------------------------------------------------
		//' At this point, the buyer has completed authorizing the payment
		//' at PayPal.  The function will call PayPal to obtain the details
		//' of the authorization, incuding any shipping information of the
		//' buyer.  Remember, the authorization is not a completed transaction
		//' at this state - the buyer still needs an additional step to finalize
		//' the transaction
		//'--------------------------------------------------------------

	    //'---------------------------------------------------------------------------
		//' Build a second API request to PayPal, using the token as the
		//'  ID to get the details on the payment authorization
		//'---------------------------------------------------------------------------
	    $nvpstr="&TOKEN=" . $token;

		//'---------------------------------------------------------------------------
		//' Make the API call and store the results in an array.
		//'	If the call was a success, show the authorization details, and provide
		//' 	an action to complete the payment.
		//'	If failed, show the error
		//'---------------------------------------------------------------------------
	    $resArray=$this->hash_call("GetExpressCheckoutDetails",$nvpstr);
	    $ack = strtoupper($resArray["ACK"]);
		if($ack == "SUCCESS" || $ack=="SUCCESSWITHWARNING")
		{
			$_SESSION['payer_id'] =	$resArray['PAYERID'];

		}
		return $resArray;
	}

	/*
	'-------------------------------------------------------------------------------------------------------------------------------------------
	' Purpose: 	Prepares the parameters for the GetExpressCheckoutDetails API Call.
	'
	' Inputs:
	'		sBNCode:	The BN code used by PayPal to track the transactions from a given shopping cart.
	' Returns:
	'		The NVP Collection object of the GetExpressCheckoutDetails Call Response.
	'--------------------------------------------------------------------------------------------------------------------------------------------
     */
	public function ConfirmPayment( $FinalPaymentAmt )
	{
		/* Gather the information to make the final call to
        finalize the PayPal payment.  The variable nvpstr
        holds the name value pairs
         */


		//Format the other parameters that were stored in the session from the previous calls
		$token 				= urlencode($_SESSION['TOKEN']);
		$paymentType 		= urlencode($_SESSION['PaymentType']);
		$currencyCodeType 	= urlencode($_SESSION['currencyCodeType']);
		$payerID 			= urlencode($_SESSION['payer_id']);

		$serverName 		= urlencode($_SERVER['SERVER_NAME']);

		$nvpstr  = '&TOKEN=' . $token . '&PAYERID=' . $payerID . '&PAYMENTREQUEST_0_PAYMENTACTION=' . $paymentType . '&PAYMENTREQUEST_0_AMT=' . $FinalPaymentAmt;
		$nvpstr .= '&PAYMENTREQUEST_0_CURRENCYCODE=' . $currencyCodeType . '&IPADDRESS=' . $serverName;
        /* Make the call to PayPal to finalize payment
        If an error occured, show the resulting errors
         */
		$resArray=$this->hash_call("DoExpressCheckoutPayment",$nvpstr);

		/* Display the API response back to the browser.
        If the response from PayPal was a success, display the response parameters'
        If the response was an error, display the errors received using APIError.php.
         */
		$ack = strtoupper($resArray["ACK"]);

		return $resArray;
	}

	/*
	'-------------------------------------------------------------------------------------------------------------------------------------------
	' Purpose: 	This function makes a DoDirectPayment API call
	'
	' Inputs:
	'		paymentType:		paymentType has to be one of the following values: Sale or Order or Authorization
	'		paymentAmount:  	total value of the shopping cart
	'		currencyCode:	 	currency code value the PayPal API
	'		firstName:			first name as it appears on credit card
	'		lastName:			last name as it appears on credit card
	'		street:				buyer's street address line as it appears on credit card
	'		city:				buyer's city
	'		state:				buyer's state
	'		countryCode:		buyer's country code
	'		zip:				buyer's zip
	'		creditCardType:		buyer's credit card type (i.e. Visa, MasterCard ... )
	'		creditCardNumber:	buyers credit card number without any spaces, dashes or any other characters
	'		expDate:			credit card expiration date
	'		cvv2:				Card Verification Value
	'
	'-------------------------------------------------------------------------------------------
	'
	' Returns:
	'		The NVP Collection object of the DoDirectPayment Call Response.
	'--------------------------------------------------------------------------------------------------------------------------------------------
     */


	public function DirectPayment( $paymentType, $paymentAmount, $creditCardType, $creditCardNumber,
							$expDate, $cvv2, $firstName, $lastName, $street, $city, $state, $zip,
							$countryCode, $currencyCode )
	{
		//Construct the parameter string that describes DoDirectPayment
		$nvpstr = "&AMT=" . $paymentAmount;
		$nvpstr = $nvpstr . "&CURRENCYCODE=" . $currencyCode;
		$nvpstr = $nvpstr . "&PAYMENTACTION=" . $paymentType;
		$nvpstr = $nvpstr . "&CREDITCARDTYPE=" . $creditCardType;
		$nvpstr = $nvpstr . "&ACCT=" . $creditCardNumber;
		$nvpstr = $nvpstr . "&EXPDATE=" . $expDate;
		$nvpstr = $nvpstr . "&CVV2=" . $cvv2;
		$nvpstr = $nvpstr . "&FIRSTNAME=" . $firstName;
		$nvpstr = $nvpstr . "&LASTNAME=" . $lastName;
		$nvpstr = $nvpstr . "&STREET=" . $street;
		$nvpstr = $nvpstr . "&CITY=" . $city;
		$nvpstr = $nvpstr . "&STATE=" . $state;
		$nvpstr = $nvpstr . "&COUNTRYCODE=" . $countryCode;
		$nvpstr = $nvpstr . "&IPADDRESS=" . $_SERVER['REMOTE_ADDR'];

		$resArray=hash_call("DoDirectPayment", $nvpstr);

		return $resArray;
	}


	/**
    '-------------------------------------------------------------------------------------------------------------------------------------------
     * hash_call: Function to perform the API call to PayPal using API signature
     * @methodName is name of API  method.
     * @nvpStr is nvp string.
     * returns an associtive array containing the response from the server.
    '-------------------------------------------------------------------------------------------------------------------------------------------
     */
	private function hash_call($methodName,$nvpStr)
	{


		//setting the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$this->API_Endpoint);
		//curl_setopt($ch, CURLOPT_VERBOSE, 1);

		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);

	    //if USE_PROXY constant set to TRUE in Constants.php, then only proxy will be enabled.
        //Set proxy name to PROXY_HOST and port number to PROXY_PORT in constants.php
		if($this->USE_PROXY)
			curl_setopt ($ch, CURLOPT_PROXY, $this->PROXY_HOST. ":" . $this->PROXY_PORT);

		//NVPRequest for submitting to server
		$nvpreq="METHOD=" . urlencode($methodName) . "&VERSION=" . urlencode(self::version) . "&PWD=" . urlencode(self::API_Password) . "&USER=" . urlencode(self::API_UserName) . "&SIGNATURE=" . urlencode(self::API_Signature) . $nvpStr . "&BUTTONSOURCE=" . urlencode(self::sBNCode);

		//setting the nvpreq as POST FIELD to curl
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

		//getting response from server
		$response = curl_exec($ch);

		//convrting NVPResponse to an Associative Array
		$nvpResArray=self::deformatNVP($response);
		$nvpReqArray=self::deformatNVP($nvpreq);
		$_SESSION['nvpReqArray']=$nvpReqArray;

		if (curl_errno($ch))
		{
			// moving to display page to display curl errors
            $_SESSION['curl_error_no']=curl_errno($ch) ;
            $_SESSION['curl_error_msg']=curl_error($ch);

            //Execute the Error handling module to display errors.
		}
		else
		{
            //closing the curl
            curl_close($ch);
		}

		return $nvpResArray;
	}

	/*'----------------------------------------------------------------------------------
    Purpose: Redirects to PayPal.com site.
    Inputs:  NVP string.
    Returns:
	----------------------------------------------------------------------------------
     */
	public function RedirectToPayPal ( $token )
	{


		// Redirect to paypal.com here
		$payPalURL = $this->PAYPAL_URL . $token;
		header("Location: ".$payPalURL);
		exit;
	}


	/*'----------------------------------------------------------------------------------
     * This function will take NVPString and convert it to an Associative Array and it will decode the response.
     * It is usefull to search for a particular key and displaying arrays.
     * @nvpstr is NVPString.
     * @nvpArray is Associative Array.
    ----------------------------------------------------------------------------------
     */
	private static function deformatNVP($nvpstr)
	{
		$intial=0;
        $nvpArray = array();

		while(strlen($nvpstr))
		{
			//postion of Key
			$keypos= strpos($nvpstr,'=');
			//position of value
			$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);

			/*getting the Key and Value values and storing in a Associative Array*/
			$keyval=substr($nvpstr,$intial,$keypos);
			$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
			//decoding the respose
			$nvpArray[urldecode($keyval)] =urldecode( $valval);
			$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
        }
		return $nvpArray;
	}

}