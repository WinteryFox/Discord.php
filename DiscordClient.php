<?php
	include_once __DIR__ . '/object/GuildObject.php';

	class DiscordClient {
		public $discordToken;
		
		public function __construct($discordToken) {
			$this->discordToken = $discordToken;
		}
		
		public function getGuild($guildId) {
			return new Guild($this->discordToken, $guildId);
		}
		
		public function getUser($userId) {
			return new User($this->discordToken, $userId);
		}
		
		public function getOrCreateDMChannel($recipientId) {
			return new DMChannel($this->discordToken, $recipientId);
		}
		
		public function getGuildChannel($channelId) {
			return new GuildChannel($this->discordToken, $channelId);
		}
	}
?>