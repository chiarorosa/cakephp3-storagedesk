<?php

namespace SDesk\Controller\Component;

// use Aws\S3\S3Client;
require_once(VENDORS . 'aws' . DS . 'aws-sdk-php' . DS . 'src' . DS . 'S3' . DS . 'S3Client.php');

// use League\Flysystem\AwsS3v3\AwsS3Adapter;
require_once(VENDORS . 'league' . DS . 'flysystem-aws-s3-v3' . DS . 'src' . DS . 'AwsS3Adapter.php');

// use League\Flysystem\Filesystem;
require_once(VENDORS . 'league' . DS . 'flysystem' . DS . 'src' . DS . 'Filesystem.php');

/**
 * https://github.com/thephpleague/flysystem-aws-s3-v3/blob/master/readme.md
 */
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;

use Cake\Core\Configure;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Event\Event;

/**
 * StorageDesk component
 */
class StorageDeskComponent extends Component
{

    /**
     * @var array
     */
    protected $credentials;
    
    /**
     * @var string
     */
    protected $region;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var string
     */
    protected $bucket;

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var object
     */
    protected $client;

    /**
     * @var object
     */
    protected $adapter;

    /**
     * @var object
     */
    public $filesystem;

    /**
     * Setup Component.
     * Is called manualy when is necessary
     *
     * @return void
     */
    public function setup()
    {
        $S3ClientConfigure = Configure::read('S3Client');
        
        $this->credentials = [
            'key' => $S3ClientConfigure['credentials']['key'],
            'secret' =>  $S3ClientConfigure['credentials']['secret']
        ];

        $this->region =  $S3ClientConfigure['region'];

        $this->version = $S3ClientConfigure['version'];

        $this->bucket = $S3ClientConfigure['bucket'];
        
        $this->endpoint = $S3ClientConfigure['endpoint'];

        $this->client = new S3Client([
            'credentials' => $this->credentials,
            'region' => $this->region,
            'version' => $this->version,
            'endpoint' => $S3ClientConfigure['endpoint']
        ]);

        $this->adapter = new AwsS3Adapter($this->client, $this->bucket);
        $this->filesystem = new Filesystem($this->adapter);
    }

    public function isConnected(string $adapter)
    {
        $this->setup();
        
        $contents = $this->filesystem->listContents();
        dd($contents);
    }
}
