<?php
	include_once __DIR__ . '/Role.php';

	class Guild {
		protected $id;
		protected $name;
		protected $icon;
		protected $icon_url;
		protected $splash;
		protected $owner_id;
		protected $region;
		protected $afk_channel_id;
		protected $afk_timeout;
		protected $embed_enabled;
		protected $embed_channel_id;
		protected $verification_level;
		protected $default_message_notifications;
		protected $explicit_content_filter;
		protected $roles;
		protected $emojis;
		protected $features;
		protected $mfa_level;
		protected $widget_enabled;
		
		public function __construct($id, $name, $icon, $splash, $owner_id, $region, $afk_channel_id, $afk_timeout, $embed_enabled, $embed_channel_id, $verification_level, $default_message_notifications, $explicit_content_filter, $roles, $emojis, $features, $mfa_level, $widget_enabled) {
			$this->id = $id;
			$this->name = $name;
			$this->icon = $icon;
			$this->icon_url = "https://cdn.discordapp.com/icons/{$id}/{$icon}.png";
			$this->splash = $splash;
			$this->owner_id = $owner_id;
			$this->region = $region;
			$this->afk_channel_id = $afk_channel_id;
			$this->afk_timeout = $afk_timeout;
			$this->embed_enabled = $embed_enabled;
			$this->embed_channel_id = $embed_channel_id;
			$this->verification_level = $verification_level;
			$this->default_message_notifications = $default_message_notifications;
			$this->explicit_content_filter = $explicit_content_filter;
			foreach ($roles as $role)
				$this->roles[] = new Role($role->id, $role->name, $role->mentionable, $role->color, $role->position, $role->permissions);
			$this->emojis = $emojis;
			$this->features = $features;
			$this->mfa_level = $mfa_level;
			$this->widget_enabled = $widget_enabled;
		}
		
		public function getID() {
			return $this->id;
		}
		
		public function getName() {
			return $this->name;
		}
		
		public function getIcon() {
			return $this->icon;
		}
		
		public function getIconURL() {
			return $this->icon_url;
		}
		
		public function getSplash() {
			return $this->splash;
		}
		
		public function getOwner() {
			return Rest::fetchUser($this->owner_id);
		}
		
		public function getOwnerID() {
			return $this->owner_id;
		}
		
		public function getRegion() {
			return $this->region;
		}
		
		public function getAFKChannel() {
			return Rest::fetchChannel($this->afk_channel_id);
		}
		
		public function getAFKChannelID() {
			return $this->afk_channel_id;
		}
		
		public function getAFKTimeout() {
			return $this->afk_timeout;
		}
		
		public function getEmbedEnabled() {
			return $this->embed_enabled;
		}
		
		public function getEmbedChannelID() {
			return $this->embed_channel_id;
		}
		
		public function getVerificationLevel() {
			return $this->verification_level;
		}
		
		public function getDefaultMessageNotifications() {
			return $this->default_message_notifications;
		}
		
		public function getExplicitContentFilter() {
			return $this->explicit_content_filter;
		}
		
		public function getRoles() {
			return $this->roles;
		}
		
		public function getEmojis() {
			return $this->emojis;
		}
		
		public function getFeatures() {
			return $this->features;
		}
		
		public function getMFALevel() {
			return $this->mfa_level;
		}
		
		public function getWidgetEnabled() {
			return $this->widget_enabled;
		}
	}
?>