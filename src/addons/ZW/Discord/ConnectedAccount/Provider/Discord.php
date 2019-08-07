<?php

namespace ZW\Discord\ConnectedAccount\Provider;

use XF\Entity\ConnectedAccountProvider;
use XF\ConnectedAccount\Http\HttpResponseException;

class Discord extends \XF\ConnectedAccount\Provider\AbstractProvider
{
	public function getOAuthServiceName()
	{
		return 'ZW\Discord:Service\Discord';
	}
	
	public function getProviderDataClass()
	{
		return 'ZW\Discord:ProviderData\Discord';
	}

	public function getDefaultOptions()
	{
		return [
			'client_id' => '',
			'client_secret' => ''
		];
	}

	public function getOAuthConfig(ConnectedAccountProvider $provider, $redirectUri = null)
	{
		return [
			'key' => $provider->options['client_id'],
			'secret' => $provider->options['client_secret'],
			'redirect' => $redirectUri ?: $this->getRedirectUri($provider),
			'scopes' => ['identify','email'],
		];
	}

	public function parseProviderError(HttpResponseException $e, &$error = null)
	{
		$errorDetails = json_decode($e->getResponseContent(), true);
		if (isset($errorDetails['error_description']))
		{
			$e->setMessage($errorDetails['error_description']);
		}
		parent::parseProviderError($e, $error);
	}
}