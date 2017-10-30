<?php
	class Message {
		public $discordToken;
		public $id;
		public $channel_id;
		public $author;
		public $content;
		public $timestamp;
		public $edited_timestamp;
		public $tts;
		public $mention_everyone;
		public $mentions;
		public $mention_roles;
		public $attachments;
		public $embeds;
		public $reactions;
		public $pinned;
		public $webhook_id;
		public $type;
		
		public function __construct($discordToken, $channel_id, $message_id) {
			$this->discordToken = $discordToken;
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, "https://discordapp.com/api/v6/channels/{$channel_id}/messages/{$message_id}");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

			$headers = array();
			$headers[] = "Authorization: Bot {$discordToken}";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close ($ch);
			$result = json_decode($result);
			if (isset($result->code))
				throw new Exception("Code: {$result->code}\n Message: {$result->message}");
			
			$this->id = $result->id;
			$this->channel_id = $result->channel_id;
			$this->author = $result->author;
			$this->content = $result->content;
			$this->timestamp = $result->timestamp;
			$this->edited_timestamp = $result->edited_timestamp;
			$this->tts = $result->tts;
			$this->mention_everyone = $result->mention_everyone;
			$this->mentions = $result->mentions;
			$this->mention_roles = $result->mention_roles;
			$this->attachments = $result->attachments;
			$this->embeds = $result->embeds;
			if (isset($response->reactions))
				$this->reactions = $result->reactions;
			$this->pinned = $result->pinned;
			if (isset($response->webhook_id))
				$this->webhook_id = $result->webhook_id;
			$this->type = $result->type;
		}
	}
?>