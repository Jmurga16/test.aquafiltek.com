<?php 

require '../aws/vendor/autoload.php';

$operador=$_POST['operador'];
$cliente=$_POST['cliente'];
echo '<pre>'; print_r($operador); echo '</pre>';
use Aws\S3\S3Client;
	use Aws\S3\Exception\S3Exception;

	echo '<pre>'; print_r($_FILES['fileToUpload']['size']); echo '</pre>';
if( $_FILES['fileToUpload']['size'] > 1000000 ) {
  echo  "<script languaje='javascript' type='text/javascript'>alert('No se pueden cargar archivos mayores a 1MB');window.close();</script>";
} else {
	// AWS Info
	$bucketName = 'pdfpv';
	$IAM_KEY = 'AKIAJWKDELDKKWTP37UA';
	$IAM_SECRET = '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';
	// Connect to AWS
	try {
		// You may need to change the region. It will say in the URL when the bucket is open
		// and on creation.
		$s3 = S3Client::factory(
			array(
				'credentials' => array(
					'key' => $IAM_KEY,
					'secret' => $IAM_SECRET
				),
				'version' => 'latest',
				'region'  => 'us-east-2'
			)
		);
	} catch (Exception $e) {
		// We use a die, so if this fails. It stops here. Typically this is a REST call so this would
		// return a json object.
		die("Error: " . $e->getMessage());
	}
	
	// For this, I would generate a unqiue random string for the key name. But you can do whatever.
	$keyName = 'pdf/' . basename($cliente."_".$_FILES["fileToUpload"]['name']);
	$pathInS3 = 'https://s3.us-east-2.amazonaws.com/' . $bucketName . '/' . $keyName;
	// Add it to S3
	try {
		// Uploaded:
		$file = $_FILES["fileToUpload"]['tmp_name'];
		$s3->putObject(
			array(
				'Bucket'=>$bucketName,
				'Key' =>  $keyName,
				'SourceFile' => $file,
				'StorageClass' => 'REDUCED_REDUNDANCY',
				'ACL'    => 'public-read'
			)
		);
	} catch (S3Exception $e) {
		die('Error:' . $e->getMessage());
	} catch (Exception $e) {
		die('Error:' . $e->getMessage());
	}
include("connect.php");
$script="INSERT INTO `operador_x_ruta`(`id`, `ruta`) VALUES ($operador,'$keyName')";
mysqli_query($enlace,$script);
include("QuitDB.php");
echo "<script languaje='javascript' type='text/javascript'>alert('El archivo ha sido cargado con exito!');window.close();</script>";
	// Now that you have it working, I recommend adding some checks on the files.
	// Example: Max size, allowed file types, etc.
	// 
} 

?>