<?php
	class User {
		public $id;
		public $username;
		public $discriminator;
		public $avatar;
		public $avatar_url;
		
		public function __construct($id) {
			$this->id = $result->id;
			$this->username = $result->username;
			$this->discriminator = $result->discriminator;
			$this->avatar = $result->avatar;
			$this->avatar_url = "https://cdn.discordapp.com/avatars/{$this->id}/{$this->avatar}.png";
		}
		
		public function getID() {
			return $this->id;
		}
		
		public function getUsername() {
			return $this->username;
		}
		
		public function getDiscriminator() {
			return $this->discriminator;
		}
		
		public function getAvatar() {
			return $this->avatar;
		}
		
		public function getAvatarURL() {
			return $this->avatar_url;
		}
		
		public function getOrCreateDMChannel() {
			return Rest::fetchDMChannel($this->id);
		}
	}
?>