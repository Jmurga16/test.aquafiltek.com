<?php
  $BUCKET_NAME = 'pdfpv';
  $IAM_KEY = 'AKIAJWKDELDKKWTP37UA';
  $IAM_SECRET = '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';
  require '../aws/vendor/autoload.php';
    use Aws\S3\S3Client;
  use Aws\S3\Exception\S3Exception;
 
  // Get path from db
  $keyPath = $_POST['ruta'];
  // Get file
  try {
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
    //
    $result = $s3->getObject(array(
      'Bucket' => $BUCKET_NAME,
      'Key'    => $keyPath
    ));
    // Display it in the browser
    header("Content-Type: {$result['ContentType']}");
    header('Content-Disposition: filename="' . basename($keyPath) . '"');
    echo $result['Body'];
  } catch (Exception $e) {
    die("Error: " . $e->getMessage());
  }
?>