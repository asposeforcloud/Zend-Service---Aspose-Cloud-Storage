<?php

include_once realpath('../../../../Bootstrap.php');


/**
 * Managing Files using Aspose Cloud Storage
 *
 * The primary goal of the Zend Framework Aspose Cloud Storage component is to manage files on the Aspose Cloud storage.
 *
 * In this demo application, 'AsposeLibraryTechnicalDetails.docx' file is fetched from Aspose Cloud Storage.
 *

 */
 
use ZendService\Aspose\Cloud\Storage\Folder;
use Zend\Http\Client as HttpClient;

$httpClient = new HttpClient();
$httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

$folder = new Folder(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',
        ));


$folder->getFile('testfile.jpeg');
