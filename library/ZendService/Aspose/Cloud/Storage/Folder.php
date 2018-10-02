<?php
/**
 * Created by PhpStorm.
 * User: Fahad Adeel
 * Date: 5/9/14
 * Time: 10:42 AM
 */

namespace ZendService\Aspose\Cloud\Storage;
use Zend\Http\Client as HttpClient;


class Folder extends AbstractAsposeApp {

    /**
     * Constructor.
     *
     * pass an array of options or Traversable object.
     *
     * @param  array|Traversable $options
     * @since  AsposeCloud 1.1
     */
    public function __construct($options = null)
    {
        parent::__construct($options);
    }

    /**
     * Retrieves the list of files and folders under the specified folder. Use empty string to specify root folder.
     *
     * @param string $folder
     * @param string $storage
     * @return array
     * @since AsposeCloud 1.1
     */

    public function getFilesList($folder='', $storage = null)
    {
        // build request uri
        $uri = $this->productUri . '/storage/folder/';

        if(!empty($folder))
        {
            $uri .= $folder;
        }

        if(!empty($storage))
        {
            $uri .= '?storage=' . $storage;
        }

        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);
        $this->httpClient->setMethod('get');
        $response = json_decode($this->httpClient->send()->getBody());
        return $response->Files;

    }

    /**
     * Retrieves the file and saves to the output path.
     *
     * @param string $fileName
     * @param string $storageName
     * @return bool
     * @since AsposeCloud 1.1
     */

    public function getFile($fileName, $storageName = '')
    {
        //check whether file is set or not
        if ($fileName == '')
            throw new Exception('No file name specified');

        if($this->outputPath == '')
            throw new Exception('No Output path specified.');

        //build URI
        $uri = $this->productUri . '/storage/file/' . $fileName;

        if($storageName)
        {
            $uri .= '?storage = ' . $storageName;
        }

        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);
        $this->httpClient->setMethod('get');

        $response = $this->httpClient->send()->getBody();

        $uri = Utils::saveFile($response, $this->outputPath . $fileName);

        return true;

    }

    /**
     * Provides the total / free disc size in bytes for your app.
     *
     * @param string $fileName
     * @param string $storageName
     * @return array
     * @since AsposeCloud 1.1
     */

    public function getDiscUsage($storageName = '') {

        //build URI
        $uri = $this->productUri . '/storage/disc';

        if ($storageName != '') {
            $strURI .= '?storage=' . $storageName;
        }
        //sign URI
        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);
        $this->httpClient->setMethod('get');

        $response = json_decode($this->httpClient->send()->getBody());

        return $response->DiscUsage;
    }

    /**
     * Creates a new folder  under the specified folder on Aspose storage. If no path specified, creates a folder under the root folder.
     *
     * @param string $folder
     * @param string $storage
     * @return bool
     * @since AsposeCloud 1.1
     */

    public function createFolder($folder, $storage = '')
    {
        if($folder == '')
            throw new Exception('No folder name specified');

        //build URI
        $uri = $this->productUri . '/storage/folder/' . $folder;

        if ($storage != '') {
            $uri .= '?storage=' . $storage;
        }
        //sign URI
        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);
        $this->httpClient->setMethod('put');

        $response = json_decode($this->httpClient->send()->getBody());

        if ($response->Code != 200) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Deletes a folder from remote storage.
     *
     * @param string $folderName
     * @return bool
     * @since AsposeCloud 1.1
     */

    public function deleteFolder($folderName)
    {
        //check whether folder is set or not
        if ($folderName == '')
            throw new Exception('No folder name specified');

        //build URI
        $uri = $this->productUri . '/storage/folder/' . $folderName;

        //sign URI
        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);
        $this->httpClient->setMethod('delete');

        $response = json_decode($this->httpClient->send()->getBody());
        if ($response->Code != 200) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Checks if file exists on a storage.
     *
     * @param string $folderName
     * @param string $storageName
     * @return bool
     * @since AsposeCloud 1.1
     */

    public function fileExists($fileName, $storageName = '')
    {
        //check whether file is set or not
        if ($fileName == '')
            throw new Exception('No file name specified');

        //build URI
        $uri = $this->productUri . '/storage/exist/' . $fileName;
        if ($storageName != '') {
            $strURI .= '?storage=' . $storageName;
        }
        //sign URI
        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);
        $this->httpClient->setMethod('get');

        $response = json_decode($this->httpClient->send()->getBody());
        if (!$response->FileExist->IsExist) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Uploads a file from your local machine to specified folder / subfolder on Aspose storage.
     *
     * @param string $strFile
     * @param string $strFolder
     * @param string $storageName
     * @return bool
     * @since AsposeCloud 1.1
     */

    public function uploadFile($strFile, $strFolder, $storageName = '')
    {
        $strRemoteFileName = basename($strFile);

        $uri = $this->productUri .'/storage/file/';

        if ($strFolder == '')
            $uri .= $strRemoteFileName;
        else
            $uri .= $strFolder . '/' . $strRemoteFileName;

        if ($storageName != '')
        {
            $uri .= '?storage=' . $storageName;
        }


        $uri = Utils::sign($uri, $this->appSid, $this->appKey);

        $this->httpClient->setUri($uri);
        $this->httpClient->setMethod('put');

        $response = json_decode($this->httpClient->setFileUpload($strFile, $strRemoteFileName)->send()->getBody());

        if ($response->Code == '200') {
            return TRUE;
        }
        return FALSE;

    }


} 