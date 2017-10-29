<?php
	class Message {
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
		
		public function __construct() {
			
		}
	}
?>