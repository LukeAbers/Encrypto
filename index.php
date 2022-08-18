<title>JavaScript RSA Encryption Demo</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="jsencrypt.min.js"></script>
<script type="text/javascript"></script>

<script>
function encrypt() {
  // Encrypt on clientside with the public key
  var encrypt = new JSEncrypt();
  
  // Grab public key from publicKey textarea
  encrypt.setPublicKey($('#publicKey').val());
  
  // Grab message and encrypt
  var encrypted = encrypt.encrypt($('#iput').val());
  
  // Add encrypted message to Encrypted textarea
  $('#encrypted').val(encrypted);
}

function decrypt() {
	//	Make AJAX call
	$.post( "action.php",  );
	 $.ajax({
			type: "POST",
			url: '/action.php',
			// Send private key and encrypted message from textareas
			data: ({ privateKey: $('#privateKey').val(), eMsg: $('#encrypted').val() }),
			dataType: "html",
			success: function(data) {
				// Show response in alert
				alert(data);
				return data;
			},
			error: function() {
				alert('Error occured');
			}
		});
	}
</script>


<?php
// From serverside create keypair
$res = openssl_pkey_new();

// Create private key using passphrase
openssl_pkey_export($res, $privkey, "PassPhrase" );

// Get public key
$pubkey = openssl_pkey_get_details($res);
$pubkey = $pubkey["key"];
?>

<!--Webpage-->
<label>From PHP:</label>
<br>
<textarea name="privateKey" cols="50"rows="5" id="privateKey"><?php echo $privkey ?></textarea>
<textarea name="publicKey" cols="50"rows="5" id="publicKey"><?php echo $pubkey ?> </textarea>
<br>
<br>
<label for="iput">Input Message:</label>
<input type="text" id="iput" name="iput"><br><br>
<button onclick="encrypt()">Encrypt</button>  
<br>
<br>
<textarea name="encrypted" cols="50"rows="5" id="encrypted"></textarea>
<br>
<br>
<button onclick="decrypt()">Decrypt</button> 
