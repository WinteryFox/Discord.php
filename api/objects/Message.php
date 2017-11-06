<?php
	class Message {
		protected $id;
		protected $channel_id;
		protected $author;
		protected $content;
		protected $timestamp;
		protected $edited_timestamp;
		protected $tts;
		protected $mention_everyone;
		protected $mentions;
		protected $mention_roles;
		protected $attachments;
		protected $embeds;
		protected $reactions;
		protected $pinned;
		protected $webhook_id;
		protected $type;
		
		public function __construct($id, $channel_id, $author, $content, $timestamp, $edited_timestamp, $tts, $mention_everyone, $mentions, $mention_roles, $attachments, $embeds, $reactions, $pinned, $webhook_id, $type) {
			$this->id = $id;
			$this->channel_id = $channel_id;
			$this->author = $author;
			$this->content = $content;
			$this->timestamp = $timestamp;
			$this->edited_timestamp = $edited_timestamp;
			$this->tts = $tts;
			$this->mention_everyone = $mention_everyone;
			$this->mentions = $mentions;
			$this->mention_roles = $mention_roles;
			$this->attachments = $attachments;
			$this->embeds = $embeds;
			$this->reactions = $reactions;
			$this->pinned = $pinned;
			$this->webhook_id = $webhook_id;
			$this->type = $type;
		}
		
		public function getID() {
			return $this->id;
		}
		
		public function getChannelID() {
			return $this->channel_id;
		}
		
		public function getAuthor() {
			return $this->author;
		}
		
		public function getContent() {
			return $this->content;
		}
		
		public function getTimestamp() {
			return $this->timestamp;
		}
		
		public function getEditedTimestamp() {
			return $this->edited_timestamp;
		}
		
		public function getTTS() {
			return $this->tts;
		}
		
		public function getMentionEveryone() {
			return $this->mention_everyone;
		}
		
		public function getMentions() {
			return $this->mentions;
		}
		
		public function getMentionRoles() {
			return $this->mention_roles;
		}
		
		public function getAttachments() {
			return $this->attachments;
		}
		
		public function getEmbeds() {
			return $this->embeds;
		}
		
		public function getReactions() {
			return $this->reactions;
		}
		
		public function getPinned() {
			return $this->pinned;
		}
		
		public function getWebhookID() {
			return $this->webhook_id;
		}
		
		public function getMessageType() {
			return $this->type;
		}
		
		public function deleteMessage() {
			Rest::postDelete($this->channel_id, $this->id);
		}
	}
?>