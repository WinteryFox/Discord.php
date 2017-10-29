<?php
	include_once __DIR__ . '/Channel.php';
	
	class GuildChannel extends Channel {
		public $guild_id;
		public $position;
		public $permission_overwrites;
		public $name;
		public $topic;
		public $nsfw;
		public $last_message_id;
		public $parent_id;
		
		public function __construct($id) {
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, "https://discordapp.com/api/v6/channels/$id");
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
			$this->type = $result->type;
			$this->guild_id = $result->guild_id;
			$this->position = $result->position;
			$this->permission_overwrites = $result->permission_overwrites;
			$this->name = $result->name;
			$this->topic = $result->topic;
			$this->nsfw = $result->nsfw;
			$this->last_message_id = $result->last_message_id;
			$this->parent_id = $result->parent_id;
			if ($this->type != 0) {
				throw new Exception("The requested channel doesn't appear to be a guild text channel.");
			}
		}
	}
?>