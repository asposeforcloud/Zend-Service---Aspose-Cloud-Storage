<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Service
 */

namespace ZendService\Aspose\Cloud\Storage;

use Traversable;
use Zend\Http\Client as HttpClient;
use Zend\Stdlib\ArrayUtils;
use ZendService\Aspose\Cloud\Exception;

abstract class AbstractAsposeApp {

    /**
     * AsposeCloud service version.
     * @since AsposeCloud 1.1
     */
    const VERSION = '1.1';

    /**
     * AppSID to access AsposeCloud service.
     * @var   string
     * @since AsposeCloud 1.1
     */
    protected $appSid = null;

    /**
     * AppKey to access AsposeCloud service.
     * @var   string
     * @since AsposeCloud 1.1
     */
    protected $appKey = null;

    /**
     * Output Path to access store outputs
     * @var   string
     * @since AsposeCloud 1.1
     */
    protected $outputPath = null;

    /**
     * Product URI to access AsposeCloud service.
     * @var   string
     * @since AsposeCloud 1.1
     */
    protected $productUri = 'http://api.aspose.com/v1.1';

    /**
     * Http client used to connect to AsposeCloud service.
     * @var   HttpClient
     * @since AsposeCloud 1.0
     */
    protected $httpClient = null;

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
        if ($options instanceof Traversable) {
            $options = ArrayUtils::iteratorToArray($options);
        }

        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * Set options. Valid options are appSid, appKey, productUri, output and httpClient.
     *
     * @param  array $options
     * @throws Exception\InvalidArgumentException
     * @return AbstractAsposeApp
     * @since  AsposeCloud 1.1
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            $method = 'set' . $key;
            if (!method_exists($this, $method)) {
                throw new Exception\InvalidArgumentException(sprintf(
                    'Invalid option specified - "%s"', $key
                ));
            }
            $this->$method($value);
        }

        return $this;
    }

    /**
     * Set HTTP client.
     *
     * @param  HttpClient $httpClient
     * @return AbstractAsposeApp
     * @since  AsposeCloud 1.1
     */
    public function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * Get HTTP client.
     *
     * @return HttpClient
     * @since  AsposeCloud 1.1
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * Set appSid.
     *
     * @param  string $appSid
     * @return AbstractAsposeApp
     * @since  AsposeCloud 1.1
     */
    public function setAppSid($appSid)
    {
        $this->appSid = $appSid;

        return $this;
    }

    /**
     * Get appSid
     *
     * @return string
     * @since  AsposeCloud 1.1
     */
    public function getAppSid()
    {
        return $this->appSid;
    }

    /**
     * Set appKey.
     *
     * @param  string $appKey
     * @return AbstractAsposeApp
     * @since  AsposeCloud 1.1
     */
    public function setAppKey($appKey)
    {
        $this->appKey = $appKey;

        return $this;
    }

    /**
     * Set productUri.
     *
     * @param  string $productUri
     * @return AbstractAsposeApp
     * @since  AsposeCloud 1.1
     */

    public function setProductUri($productUri)
    {
        $this->productUri = $productUri;

        return $this;
    }

    /**
     * Get appKey
     *
     * @return string
     * @since  AsposeCloud 1.1
     */
    public function getAppKey()
    {
        return $this->appKey;
    }

    /**
     * Get productUri
     *
     * @return string
     * @since  AsposeCloud 1.1
     */
    public function getProductUri()
    {
        return $this->productUri;
    }

    /**
     * Set outputPath.
     *
     * @param  string $outputPath
     * @return AbstractAsposeApp
     * @since  AsposeCloud 1.1
     */
    public function setOutputPath($outputPath)
    {
        $this->outputPath = $outputPath;

        return $this;
    }

    /**
     * Get outputPath
     *
     * @return string
     * @since  AsposeCloud 1.1
     */
    public function getOutputPath()
    {
        return $this->outputPath;
    }

} 