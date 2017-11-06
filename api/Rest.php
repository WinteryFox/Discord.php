<?php
	include_once __DIR__ . '/../DiscordClient.php';
	include_once __DIR__ . '/objects/Channel.php';
	include_once __DIR__ . '/objects/Embed.php';
	include_once __DIR__ . '/objects/Guild.php';
	include_once __DIR__ . '/objects/Message.php';

	abstract class Rest {
		public static function fetchGuild(String $id) {
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, "https://discordapp.com/api/v6/guilds/{$id}");
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
				throw new Exception('Code: ' . $result->code . ' Message: ' . $result->message);
			
			return new Guild($result->id, $result->name, $result->icon, $result->splash, $result->owner_id, $result->region, $result->afk_channel_id, $result->afk_timeout, $result->embed_enabled, $result->embed_channel_id, $result->verification_level, $result->default_message_notifications, $result->explicit_content_filter, $result->roles, $result->emojis, $result->features, $result->mfa_level, $result->widget_enabled);
		}
		
		public static function fetchDMChannel(String $id) {
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
				throw new Exception('Code: ' . $result->code . ' Message: ' . $result->message);
			
			return new Channel($result->id, $result->type, isset($result->guild_id) ? $result->guild_id : null, isset($result->position) ? $result->position : null, isset($result->permission_overwrites) ? $result->permission_overwrites : null, isset($result->name) ? $result->name : null, isset($result->topic) ? $result->topic : null, $result->last_message_id, isset($result->bitrate) ? $result->bitrate : null, isset($result->user_limit) ? $result->user_limit : null, isset($result->recipients) ? $result->recipients : null, isset($result->icon) ? $result->icon : null, isset($result->owner_id) ? $result->owner_id : null, isset($result->application_id) ? $result->application_id : null, isset($result->nsfw) ? $result->nsfw : null, isset($result->parent_id) ? $result->parent_id : null);
		}
		
		public static function fetchChannel(String $id) {
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
				throw new Exception('Code: ' . $result->code . ' Message: ' . $result->message);
			
			return new Channel($result->id, $result->type, isset($result->guild_id) ? $result->guild_id : null, isset($result->position) ? $result->position : null, isset($result->permission_overwrites) ? $result->permission_overwrites : null, isset($result->name) ? $result->name : null, isset($result->topic) ? $result->topic : null, $result->last_message_id, isset($result->bitrate) ? $result->bitrate : null, isset($result->user_limit) ? $result->user_limit : null, isset($result->recipients) ? $result->recipients : null, isset($result->icon) ? $result->icon : null, isset($result->owner_id) ? $result->owner_id : null, isset($result->application_id) ? $result->application_id : null, isset($result->nsfw) ? $result->nsfw : null, isset($result->parent_id) ? $result->parent_id : null);
		}
		
		public static function fetchMessage(String $channelID, String $messageID) {
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
			$result = json_decode($result);
			if (isset($result->code))
				throw new Exception('Code: ' . $result->code . ' Message: ' . $result->message);
			
			return new Message($result->id, $result->channel_id, $result->author, $result->content, $result->timestamp, $result->edited_timestamp, $result->tts, $result->mention_everyone, $result->mentions, $result->mention_roles, $result->attachments, $result->embeds, isset($result->reactions) ? $result->reactions : null, $result->pinned, isset($result->webhook_id) ? $result->webhook_id : null, $result->type);
		}
		
		public static function fetchHistory(String $channelID, int $before, int $limit) {
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
				throw new Exception('Code: ' . $result->code . ' Message: ' . $result->message);
			
			$messages = array();
			foreach($result as $message) {
				$messages[] = new Message($message->id, $message->channel_id, $message->author, $message->content, $message->timestamp, $message->edited_timestamp, $message->tts, $message->mention_everyone, $message->mentions, $message->mention_roles, $message->attachments, $message->embeds, isset($message->reactions) ? $message->reactions : null, $message->pinned, isset($message->webhook_id) ? $message->webhook_id : null, $message->type);
			}
			
			return $messages;
		}
		
		public static function postMessage(String $channelID, String $content, Embed $embed) {
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, "https://discordapp.com/api/v6/channels/{$channelID}/messages");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, '{"content":"' . $content . '", "embed":' . json_encode((Object) array_filter($embed->expose())) . '}');
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
		
		public static function postDelete(String $channelID, String $messageID) {
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, "https://discordapp.com/api/v6/channels/{$channelID}/messages/{$messageID}");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
			
			$headers = array();
			$headers[] = "Authorization: Bot " . DiscordClient::$token;
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			
			$result = curl_exec($ch);
			if (curl_errno($ch))
				echo 'Error: ' . curl_error($ch);
			curl_close($ch);
			$result = json_decode($result);
			return $result;
		}
	}
?>