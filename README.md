[![hV5sQ2.md.png](https://iili.io/hV5sQ2.md.png)](https://freeimage.host/i/hV5sQ2)

## Introduction

This is a very basic integration between the forum software and the connected account provider. Similiar to the other connected account providers included with XenForo, this add-on lets for visitors to log in and register via their Discord account. This can help reduce the friction of creating an account or remembering login details, especially if your forum's demographic consists of visitors who would likely already have a Discord account.

## Requirements

- PHP 7.4
- XenForo 2.2

## Installation

To get started, it's recommended to follow the XenForo 2 Manual's guide on Installing or upgrading an add-on.

### Creating a Discord application

Before you configure the add-on you should register a developer application with Discord. A Discord account is required to create an application.

1. Browse to https://discord.com/developers/ and be sure that you're logged into your Discord account.
2. Click the **New Application** button at the top.
3. Provide a name and select a team, either personal or an organization you're part of, and then click **Create**.
4. For the **Terms of Service URL** and **Privacy Policy URL** enter the links to those pages on your site.
5. In the sidebar on the left, click **OAuth2** under **Settings**.
6. Under **Redirects**, click **Add Redirect** and enter `<XF board URL>/connected_account.php`. For example, `https://xenforo.com/community/connected_account.php`. The beginning of this URL must match your *Board URL* setting in XenForo exactly. The Board URL *Requires HTTPS*. Once entered, click **Save Changes** at the bottom.
7. Near the top under **Client information**, make a note of the *Client ID* and *Client Secret*. These values will need to be entered into the XenForo control panel.

### Configuring Discord connected account

To finalize the Discord connected account, you must enter the data obtained above into the relevant section of the XenForo control panel.

1. Log in to the Admin Control panel.
2. Go to **Setup > Connected accounts.**
3. If you installed the add-on properly, you should see **Discord** in the list. Click on it and enter the **Client ID** and **Client secret** obtained earlier into the respective fields and save.
4. Test the connected account

## License

Code released under the [MIT License](./LICENSE).