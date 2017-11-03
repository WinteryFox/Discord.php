<?php
	include_once __DIR__ . '/../../DiscordClient.php'; 
	include_once __DIR__ . '/Embed.php';

	class Channel {
		protected $id;
		protected $type;
		protected $guild;
		protected $position;
		protected $permissionOverrides;
		protected $name;
		protected $topic;
		protected $bitrate;
		protected $userLimit;
		protected $recipients = array();
		protected $icon;
		protected $ownerID;
		protected $applicationID;
		protected $isNsfw;
		protected $parentID;
		protected $lastMessageID;
		
		public function __construct($id, $type, $guild_id, $position, $permission_overrides, $name, $topic, $last_message_id, $bitrate, $user_limit, $recipients, $icon, $owner_id, $application_id, $nsfw, $parent_id) {
			$this->id = $id;
			$this->type = $type;
			$this->guild = $guild_id;
			$this->position = $position;
			$this->permissionOverrides = $permission_overrides;
			$this->name = $name;
			$this->topic = $topic;
			$this->bitrate = $bitrate;
			$this->userLimit = $user_limit;
			$this->recipients = $recipients;
			$this->icon = $icon;
			$this->ownerID = $owner_id;
			$this->applicationID = $application_id;
			$this->isNsfw = $nsfw;
			$this->parentID = $parent_id;
			$this->lastMessageID = $last_message_id;
		}
		
		public function getLastMessage() {
			return Rest::fetchMessage($this->lastMessageID);
		}
		
		public function getLastMessageID() {
			return $this->lastMessageID;
		}
		
		public function getParentID() {
			return $this->parentID;
		}
		
		public function isNsfw() {
			return $this->nsfw;
		}
		
		public function getApplicationID() {
			return $this->applicationID;
		}
		
		public function getIconURL() {
			return 'https://cdn.discordapp.com/icons/' . $this->id . '/' . $this->icon . '.png';
		}
		
		public function getOwner() {
			return Rest::fetchUser($this->ownerID);
		}
		
		public function getOwnerID() {
			return $this->ownerID;
		}
		
		public function getIcon() {
			return $this->icon;
		}
		
		public function getRecipients() {
			return $this->recipients;
		}
		
		public function getUserLimit() {
			return $this->userLimit;
		}
		
		public function getBitrate() {
			return $this->bitrate;
		}
		
		public function getTopic() {
			return $this->topic;
		}
		
		public function getPermissionOverrides() {
			return $this->permissionOverrides;
		}
		
		public function getPosition() {
			return $this->position;
		}
		
		public function getName() {
			return $this->name;
		}
		
		public function getID() {
			return $this->id;
		}
		
		public function getGuild() {
			return Rest::fetchGuild($guild);
		}
		
		public function getChannelType() {
			return $this->type;
		}
		
		public function getMessage(int $id) {
			return Rest::fetchMessage($this->id, $id);
		}
		
		public function getMessageHistory(int $limit) {
			return Rest::fetchHistory($this->id, $this->lastMessageID, $limit);
		}
		
		public function sendMessageAndEmbed(String $content, Embed $embed) {
			Rest::postMessage($this->id, $content, json_encode($embed->expose()));
		}
	}
?>