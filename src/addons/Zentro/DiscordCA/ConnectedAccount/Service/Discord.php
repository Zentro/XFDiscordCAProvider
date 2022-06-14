<?php

namespace Zentro\DiscordCA\ConnectedAccount\Service;

use OAuth\OAuth2\Token\StdOAuth2Token;
use OAuth\Common\Http\Exception\TokenResponseException;
use OAuth\Common\Http\Uri\Uri;
use OAuth\Common\Consumer\CredentialsInterface;
use OAuth\Common\Http\Client\ClientInterface;
use OAuth\Common\Storage\TokenStorageInterface;
use OAuth\Common\Http\Uri\UriInterface;

class Discord extends \OAuth\OAuth2\Service\AbstractService
{
    const SCOPE_IDENTIFY = 'identify';
    const SCOPE_EMAIL = 'email';
	
    public function __construct(CredentialsInterface $credentials, ClientInterface $httpClient,
        TokenStorageInterface $storage, $scopes = array(), UriInterface $baseApiUri = null)
	{
        parent::__construct($credentials, $httpClient, $storage, $scopes, $baseApiUri, true);

        if (null === $baseApiUri)
		{
            $this->baseApiUri = new Uri('https://discord.com/api/');
        }
    }
	
    public function getAuthorizationEndpoint()
    {
        return new Uri('https://discord.com/api/oauth2/authorize');
    }

    public function getAccessTokenEndpoint()
    {
        return new Uri('https://discord.com/api/oauth2/token');
    }

    protected function getAuthorizationMethod()
    {
        return static::AUTHORIZATION_METHOD_HEADER_BEARER;
    }

    protected function parseAccessTokenResponse($responseBody)
    {
        $data = json_decode($responseBody, true);

        if (null === $data || !is_array($data))
		{
            throw new TokenResponseException('Unable to parse response.');
        }
		elseif (isset($data['error_description']))
		{
            throw new TokenResponseException('Error in retrieving token: "' . $data['error_description'] . '"');
        }

        $token = new StdOAuth2Token();
        $token->setAccessToken($data['access_token']);
		
        if (isset($data['expires_in']))
		{
            $token->setLifeTime($data['expires_in']);
            unset($data['expires_in']);
        }
		
		if (isset($data['refresh_token']))
		{
			$token->setRefreshToken($data['refresh_token']);
			unset($data['refresh_token']);
		}
		
        unset($data['access_token']);

        $token->setExtraParams($data);

        return $token;
    }
}
