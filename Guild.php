<?php
	include_once __DIR__ . '/GuildChannel.php';
	include_once __DIR__ . '/Role.php';

	class Guild {
		public $id;
		public $name;
		public $icon;
		public $splash;
		public $owner_id;
		public $region;
		public $afk_channel_id;
		public $afk_timeout;
		public $embed_enabled;
		public $embed_channel_id;
		public $verification_level;
		public $default_message_notifications;
		public $explicit_content_filter;
		public $roles;
		public $emojis;
		public $features;
		public $mfa_level;
		public $widget_enabled;
		
		public function __construct($id) {
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, "https://discordapp.com/api/v6/guilds/$id");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

			$headers = array();
			$headers[] = "Authorization: Bot $discordToken";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close ($ch);
			$result = json_decode($result);
			
			$this->id = $result->id;
			$this->name = $result->name;
			$this->icon = $result->icon;
			$this->splash = $result->splash;
			$this->owner_id = $result->owner_id;
			$this->region = $result->region;
			$this->afk_channel_id = $result->afk_channel_id;
			$this->afk_timeout = $result->afk_timeout;
			$this->embed_enabled = $result->embed_enabled;
			$this->embed_channel_id = $result->embed_channel_id;
			$this->verification_level = $result->verification_level;
			$this->default_message_notifications = $result->default_message_notifications;
			$this->explicit_content_filter = $result->explicit_content_filter;
			foreach ($result->roles as $role)
				$this->roles[] = new Role($role->id, $role->name, $role->mentionable, $role->color, $role->position, $role->permissions);
			$this->emojis = $result->emojis;
			$this->features = $result->features;
			$this->mfa_level = $result->mfa_level;
			$this->widget_enabled = $result->widget_enabled;
		}
	}
?>