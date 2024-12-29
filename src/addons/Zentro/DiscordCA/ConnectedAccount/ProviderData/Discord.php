<?php

namespace Zentro\DiscordCA\ConnectedAccount\ProviderData;

class Discord extends \XF\ConnectedAccount\ProviderData\AbstractProviderData
{
	public function getDefaultEndpoint()
	{
		return 'users/@me';
	}

	public function getProviderKey()
	{
		return $this->requestFromEndpoint('id');
	}

	public function getUsername()
	{
		return $this->requestFromEndpoint('username');
	}

	public function getDiscriminator()
	{
		return $this->requestFromEndpoint('discriminator');
	}

	public function getEmail()
	{
		return $this->requestFromEndpoint('email');
	}

	public function getVerified()
	{
		return $this->requestFromEndpoint('verified');
	}

	public function getAvatarUrl()
	{
		$providerKey = $this->getProviderKey();
		$avatar = $this->requestFromEndpoint('avatar');

        if($avatar) {
            return 'https://cdn.discordapp.com/avatars/' . $providerKey . '/' . $avatar . '.png';
        }
        else {
            //discord has 5 default avatars
           $defaultAvatarIndex = random_int(0, 4);
           return "https://cdn.discordapp.com/embed/avatars/" . $defaultAvatarIndex . '.png';
        }
	}
}