<?php
	include_once __DIR__ . '/api/Rest.php';

	class DiscordClient {
		public static $token;
		
		public function __construct(String $token) {
			self::$token = $token;
		}
		
		public function getUser(String $userID) {
			return Rest::fetchUser($userID);
		}
		
		public function getGuild(String $guildID) {
			return Rest::fetchGuild($guildID);
		}
		
		public function getChannel(String $channelID) {
			return Rest::fetchChannel($channelID);
		}
		
		public function getOrCreateDMChannel(String $recipientID) {
			return Rest::fetchDMChannel($recipientID);
		}
	}
?>