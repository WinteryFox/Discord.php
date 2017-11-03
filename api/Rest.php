<?php
	include_once __DIR__ . '/../DiscordClient.php';
	include_once __DIR__ . '/objects/Channel.php';

	abstract class Rest {
		public static function fetchDMChannel($id) {
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, "https://discordapp.com/api/v6/users/@me/channels");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, '{"recipient_id":' . $id . '}');
			curl_setopt($ch, CURLOPT_POST, 1);
			
			$headers = array();
			$headers[] = "Authorization: Bot " . DiscordClient::$token;
			$headers[] = "Content-Type: application/json";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			
			$result = curl_exec($ch);
			if (curl_errno($ch))
				echo 'Error: ' . curl_error($ch);
			curl_close($ch);
			$result = json_decode($result);
			if (isset($result->code))
				throw new Exception('Code: ' . $result->code);
			
			return new Channel($result->id, $result->type, isset($result->guild_id) ? $result->guild_id : null, isset($result->position) ? $result->position : null, isset($result->permission_overwrites) ? $result->permission_overwrites : null, isset($result->name) ? $result->name : null, isset($result->topic) ? $result->topic : null, $result->last_message_id, isset($result->bitrate) ? $result->bitrate : null, isset($result->user_limit) ? $result->user_limit : null, isset($result->recipients) ? $result->recipients : null, isset($result->icon) ? $result->icon : null, isset($result->owner_id) ? $result->owner_id : null, isset($result->application_id) ? $result->application_id : null, isset($result->nsfw) ? $result->nsfw : null, isset($result->parent_id) ? $result->parent_id : null);
		}
		
		public static function fetchChannel($id) {
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, "https://discordapp.com/api/v6/channels/{$id}");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

			$headers = array();
			$headers[] = "Authorization: Bot " . DiscordClient::$token;
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close ($ch);
			$result = json_decode($result);
			if (isset($result->code))
				throw new Exception('Code: ' . $result->code);
			
			return new Channel($result->id, $result->type, isset($result->guild_id) ? $result->guild_id : null, isset($result->position) ? $result->position : null, isset($result->permission_overwrites) ? $result->permission_overwrites : null, isset($result->name) ? $result->name : null, isset($result->topic) ? $result->topic : null, $result->last_message_id, isset($result->bitrate) ? $result->bitrate : null, isset($result->user_limit) ? $result->user_limit : null, isset($result->recipients) ? $result->recipients : null, isset($result->icon) ? $result->icon : null, isset($result->owner_id) ? $result->owner_id : null, isset($result->application_id) ? $result->application_id : null, isset($result->nsfw) ? $result->nsfw : null, isset($result->parent_id) ? $result->parent_id : null);
		}
		
		public static function fetchMessage(int $channelID, int $messageID) {
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, "https://discordapp.com/api/v6/channels/{$channelID}/messages/{$messageID}");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

			$headers = array();
			$headers[] = "Authorization: Bot " . DiscordClient::$token;
			$headers[] = "Content-Type: application/json";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			if (curl_errno($ch))
				echo 'Error:' . curl_error($ch);
			curl_close ($ch);
			if (isset($result->code))
				throw new Exception('Code: ' . $result->code);
			return json_decode($result);
		}
		
		public static function fetchHistory(int $channelID, int $before, int $limit) {
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, "https://discordapp.com/api/v6/channels/{$channelID}/messages?before={$before}&limit={$limit}");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

			$headers = array();
			$headers[] = "Authorization: Bot " . DiscordClient::$token;
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			if (curl_errno($ch))
				echo 'Error:' . curl_error($ch);
			curl_close ($ch);
			$result = json_decode($result);
			if (isset($result->code))
				throw new Exception('Code: ' . $result->code);
			
			$messages = array();
			foreach ($result as $message) {
				$messages[] = $message;
			}
			return $messages;
		}
		
		public static function postMessage(int $channelID, String $content, String $embed) {
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, "https://discordapp.com/api/v6/channels/{$channelID}/messages");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, '{"content":"' . $content . '", "embed":{' . $embed . '}}');
			curl_setopt($ch, CURLOPT_POST, 1);
			
			$headers = array();
			$headers[] = "Authorization: Bot " . DiscordClient::$token;
			$headers[] = "Content-Type: application/json";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			
			$result = curl_exec($ch);
			if (curl_errno($ch))
				echo 'Error: ' . curl_error($ch);
			curl_close($ch);
			$result = json_decode($result);
			if (isset($result->code))
				throw new Exception('Code: ' . $result->code . ' Message: ' . $result->message);
			return $result;
		}
	}
?>