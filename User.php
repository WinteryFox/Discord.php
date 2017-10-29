<?php
	class User {
		public $id;
		public $username;
		public $discriminator;
		public $avatar;
		public $avatarURL;
		public $dm;
		
		public function __construct($id) {
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, "https://discordapp.com/api/v6/users/$id");
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
			$this->username = $result->username;
			$this->discriminator = $result->discriminator;
			$this->avatar = $result->avatar;
			$this->avatarURL = "https://cdn.discordapp.com/avatars/$this->id/$this->avatar.png";
		}
		
		public function getOrCreateDMChannel() {
			return $this->dm == null ? $this->dm = new DMChannel($this->id) : $this->dm;
		}
		
		public function sendMessage($content, $embed) {
			if ($this->dm == null)
				$this->dm = new DMChannel($this->id);
			$this->dm->sendMessage($content, $embed);
		}
	}
?>