<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Service
 */

namespace ZendServiceTest\Aspose\Cloud\Storage;

use ZendService\Aspose\Cloud\Storage\Folder;
use Zend\Http\Client as HttpClient;
use PHPUnit_Framework_TestCase as TestCase;




class FolderTest extends TestCase
{

    public function testGetFilesList()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $folder = new Folder(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,

        ));


        $result = $folder->getFilesList();

        $this->assertInternalType('array',$result);

    }

    public function testGetFile()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $folder = new Folder(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));


        $result = $folder->getFile('testfile.jpeg');

        $this->assertFileExists( __DIR__ . '\\_files\\outputFolder\\testfile.jpeg');

    }

    public function testUploadFile()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $folder = new Folder(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,
            'outputPath' => __DIR__ . '\\_files\\outputFolder\\',

        ));


        $folder->uploadFile(__DIR__ . '\\_files\\inputFolder\\testfile.jpeg','');

        $this->assertFileExists( __DIR__ . '\\_files\\outputFolder\\testfile.jpeg');

    }

    public function testGetDiskUsage()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $folder = new Folder(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,

        ));


        $result = $folder->getDiscUsage('');

        $this->assertInstanceOf('stdClass',$result);

    }

    public function testFileExists()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $folder = new Folder(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,

        ));


        $result = $folder->fileExists('testfile.jpeg');

        $this->assertEquals(true,$result);

    }

    public function testCreateFolder()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $folder = new Folder(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,

        ));


        $result = $folder->createFolder('Aspose_Folder');

        $this->assertEquals(true,$result);

    }

    public function testDeleteFolder()
    {
        $httpClient = new HttpClient();
        $httpClient->setAdapter('\Zend\Http\Client\Adapter\Curl');

        $folder = new Folder(array(
            'appKey'=>'8356c76c7412f32bb85ae7472e842da4',
            'appSid'=>'8EB6E644-4A40-4B50-8012-135D1F8F7513',
            'productUri'=>'http://test.aspose.com/v1.1',
            'httpClient' => $httpClient,

        ));


        $result = $folder->deleteFolder('Aspose_Folder');

        $this->assertEquals(true,$result);

    }

}
