<?php
require '../sendpulse-rest-api-php/ApiInterface.php';
require '../sendpulse-rest-api-php/ApiClient.php';
require '../sendpulse-rest-api-php/Storage/TokenStorageInterface.php';
require '../sendpulse-rest-api-php/Storage/FileStorage.php';
require '../sendpulse-rest-api-php/Storage/SessionStorage.php';
require '../sendpulse-rest-api-php/Storage/MemcachedStorage.php';
require '../sendpulse-rest-api-php/Storage/MemcacheStorage.php';
use Sendpulse\RestApi\ApiClient;
use Sendpulse\RestApi\Storage\FileStorage;

/**
 * This script is the Newsletter Class
 *
 * PHP version 7.2
 *
 * @category Newsletter_Class
 * @package  Newsletter_Class
 * @author   Benson Imoh,ST <benson@stbensonimoh.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://stbensonimoh.com
 */
class Newsletter
{
    /**
     * Constructor function
     *
     * @param string $apiUserId The SendPulse UserID
     * @param string $apiSecret The SendPUlse ApiSecret
     */
    public function __construct($apiUserId, $apiSecret)
    {
        $this->SPApiClient = new ApiClient($apiUserId, $apiSecret, new FileStorage());
    }

    /**
     * Add User to the SendPule mailing List
     *
     * @param string $bookID The BookID of the SendPulse mailing list
     * @param array  $emails The email and other variables to put in the list
     *
     * @return void
     */
    public function insertIntoList($bookID, $emails)
    {
        $this->SPApiClient->addEmails($bookID, $emails);
    }
}
