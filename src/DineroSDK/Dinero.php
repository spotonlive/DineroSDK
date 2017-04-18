<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace DineroSDK;

use DateInterval;
use DateTime;
use DineroSDK\Exception\DineroAuthenticationFailedException;
use DineroSDK\Exception\DineroException;
use DineroSDK\Exception\DineroMissingConfigException;
use DineroSDK\Http\DineroResponse;
use DineroSDK\HttpClient\HttpClientInterface;
use DineroSDK\Resource\Contacts;
use DineroSDK\Resource\Invoices;
use GuzzleHttp\Client;

class Dinero
{
    const DINERO_API_VERSION = 'v1';
    const DINERO_BASE_URL = 'https://api.dinero.dk/' . self::DINERO_API_VERSION;
    const DINERO_OAUTH_URL = 'https://authz.dinero.dk/dineroapi/oauth/token';

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var string
     */
    private $apiKey;
    
    /**
     * @var string
     */
    private $scope = 'read write';

    /**
     * @var integer
     */
    private $organizationId;

    /**
     * @var string
     */
    private $accessToken = null;

    /**
     * @var DateTime
     */
    private $accessTokenExpireTime = null;

    /**
     * @var array
     */
    private $emailSettings = [];

    /**
     * Dinero constructor.
     * @param array $config
     * @param HttpClientInterface|null $client
     */
    public function __construct(array $config, HttpClientInterface $client = null)
    {
        $this->validateConfig($config);
        $this->clientId = $config['client_id'];
        $this->clientSecret = $config['client_secret'];
        $this->apiKey = $config['api_key'];
        $this->organizationId = $config['organization_id'];

        if (isset($config['scope'])) {
            $this->scope = $config['scope'];
        }

        if (isset($config['email_settings'])) {
            $this->emailSettings = (array) $config['email_settings'];
        }

        if (!$client) {
            $guzzleClient = new Client();
            $this->client = new HttpClient\GuzzleClient($guzzleClient);
        }
    }

    /**
     * Contacts
     *
     * @return Contacts
     */
    public function contacts()
    {
        return new Contacts($this);
    }

    /**
     * Invoices
     *
     * @return Invoices
     */
    public function invoices()
    {
        return new Invoices($this);
    }

    /**
     * @param array $config
     * @throws DineroMissingConfigException
     */
    private function validateConfig(array $config)
    {
        if (!isset($config['client_id']) || empty($config['client_id'])) {
            throw new DineroMissingConfigException('Please specify \'client_id\' in your config file');
        }

        if (!isset($config['client_secret']) || empty($config['client_secret'])) {
            throw new DineroMissingConfigException('Please specify \'client_secret\' in your config file');
        }

        if (!isset($config['api_key']) || empty($config['api_key'])) {
            throw new DineroMissingConfigException('Please specify \'api_key\' in your config file');
        }

        if (!isset($config['organization_id']) || empty($config['organization_id'])) {
            throw new DineroMissingConfigException('Please specify \'organization_id\' in your config file');
        }
    }

    /**
     * @param string $url
     * @param string $method
     * @param string $body
     * @param array $headers
     * @param int $timeOut
     * @return DineroResponse
     * @throws DineroAuthenticationFailedException
     * @throws DineroException
     */
    public function send(string $url, string $method, string $body, array $headers = [], int $timeOut = 10) : DineroResponse
    {
        $headers = array_merge([
            'Authorization' => 'Bearer ' . $this->getAccessToken(),
            'Content-Type' => 'application/json',
        ], $headers);
        return $this->client->send(self::DINERO_BASE_URL . $url, $method, $body, $headers, $timeOut);
    }

    /**
     * Get access token
     *
     * @return string
     * @throws DineroAuthenticationFailedException
     * @throws \DineroSDK\Exception\DineroException
     */
    public function getAccessToken()
    {
        $now = new DateTime();

        if (!$this->accessToken || $this->accessTokenExpireTime < $now) {
            $this->generateAccessToken();
        }

        return $this->accessToken;
    }

    /**
     * Generate an access token
     *
     * @throws DineroAuthenticationFailedException
     * @throws DineroException
     */
    private function generateAccessToken()
    {
        $credentials = base64_encode($this->clientId . ':' . $this->clientSecret);

        $headers = [
            'Authorization' => 'Basic ' . $credentials,
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $body = http_build_query([
            'grant_type' => 'password',
            'scope' => $this->scope,
            'username' => $this->apiKey,
            'password' => $this->apiKey,
        ]);

        /** @var DineroResponse $response */
        $response = $this->client->send(self::DINERO_OAUTH_URL, 'post', $body, $headers);
        $data = $response->getBody();

        if (!isset($data['access_token'])) {
            throw new DineroAuthenticationFailedException(
                sprintf(
                    'Failed obtaining access_token: %s',
                    json_encode($data)
                ),
                401
            );
        }

        $seconds = (int) $data['expires_in'];

        $now = new DateTime();

        $expire = $now->add(new DateInterval(sprintf('PT%sS', $seconds)));
        $this->accessTokenExpireTime = $expire;
        $this->accessToken = $data['access_token'];
    }

    /**
     * @return int
     */
    public function getOrganizationId()
    {
        return $this->organizationId;
    }

    /**
     * @return array
     */
    public function getEmailSettings()
    {
        return $this->emailSettings;
    }
}
