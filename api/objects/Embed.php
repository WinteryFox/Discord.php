<?php
	class Embed {
		protected $title;
		protected $description;
		protected $url;
		protected $timestamp;
		protected $color;
		protected $footer;
		protected $image;
		protected $thumbnail;
		protected $video;
		protected $author;
		protected $fields;
		
		public function __construct($title, $description, $url, $timestamp, $color, $footer, $image, $thumbnail, $video, $author, $fields) {
			$this->title = $title;
			$this->description = $description;
			$this->url = $url;
			$this->timestamp = $timestamp;
			$this->color = $color;
			$this->footer = $footer;
			$this->image = $image;
			$this->thumbnail = $thumbnail;
			$this->video = $video;
			$this->author = $author;
			$this->fields = $fields;
		}
		
		public function expose() {
			return get_object_vars($this);
		}
	}
	
	class Thumbnail {
		public function __construct($url, $proxy_url, $height, $width) {
			$this->url = $url;
			$this->proxy_url = $proxy_url;
			$this->height = $height;
			$this->width = $width;
		}
		
		public $url;
		public $proxy_url;
		public $height;
		public $width;
	}
	
	class Video {
		public function __construct($url, $height, $width) {
			$this->url = $url;
			$this->height = $height;
			$this->width = $width;
		}
		
		public $url;
		public $height;
		public $width;
	}
	
	class Image {
		public function __construct($url, $proxy_url, $height, $width) {
			$this->url = $url;
			$this->proxy_url = $proxy_url;
			$this->height = $height;
			$this->width = $width;
		}
		
		public $url;
		public $proxy_url;
		public $height;
		public $width;
	}
	
	class Author {
		public function __construct($name, $url, $icon_url, $proxy_icon_url) {
			$this->name = $name;
			$this->url = $url;
			$this->icon_url = $icon_url;
			$this->proxy_icon_url = $proxy_icon_url;
		}
		
		public $name;
		public $url;
		public $icon_url;
		public $proxy_icon_url;
	}
	
	class Footer {
		public function __construct($text, $icon_url, $proxy_icon_url) {
			$this->text = $text;
			$this->icon_url = $icon_url;
			$this->proxy_icon_url = $proxy_icon_url;
		}
		
		public $text;
		public $icon_url;
		public $proxy_icon_url;
	}
	
	class Field {
		public function __construct($name, $value, $inline) {
			$this->name = $name;
			$this->value = $value;
			$this->inline = $inline;
		}
		
		public $name;
		public $value;
		public $inline;
	}
	
	class EmbedBuilder {
		private $title;
		private $description;
		private $url;
		private $timestamp;
		private $color;
		private $footer;
		private $image;
		private $thumbnail;
		private $video;
		private $author;
		private $fields;
		
		public function __construct() {
			$this->title = null;
			$this->description = null;
			$this->url = null;
			$this->timestamp = null;
			$this->color = null;
			$this->footer = null;
			$this->image = null;
			$this->thumbnail = null;
			$this->video = null;
			$this->author = null;
			$this->fields = null;
		}
		
		public function withTitle(String $title) {
			$this->title = $title;
			return $this;
		}
		
		public function appendTitle(String $title) {
			$this->title = $this->title . $title;
			return $this;
		}
		
		public function withDescription(String $description) {
			$this->description = $description;
			return $this;
		}
		
		public function appendDescription(String $description) {
			$this->description = $this->description . $description;
			return $this;
		}
		
		public function withURL(String $url) {
			$this->url = $url;
			return $this;
		}
		
		public function withTimestamp($timestamp) {
			$this->timestamp = $timestamp;
			return $this;
		}
		
		public function withColor(String $color) {
			$this->color = $color;
			return $this;
		}
		
		public function withFooter(String $text, $icon_url = null, $proxy_icon_url = null) {
			$this->footer = new Footer($text, $icon_url, $proxy_icon_url);
			return $this;
		}
		
		public function withImage(String $url, $proxy_url = null, $width = 0, $height = 0) {
			$this->image = new Image($url, $proxy_url, $width, $height);
			return $this;
		}
		
		public function withThumbnail(String $url, $proxy_url = null, $width = 0, $height = 0) {
			$this->thumbnail = new Thumbnail($url, $proxy_url, $width, $height);
			return $this;
		}
		
		public function withVideo(String $url, $width = null, $height = null) {
			$this->video = new Video($url, $width, $height);
			return $this;
		}
		
		public function withAuthor(String $name, $url = null, $icon_url = null, $icon_proxy_url = null) {
			$this->author = new Author($name, $url, $icon_url, $icon_proxy_url);
			return $this;
		}
		
		public function appendField(String $name, String $value, boolean $inline) {
			if (!$fields)
				$fields = array();
			$fields[] = new Field($name, $value, $inline);
			return $this;
		}
		
		public function build() {
			if (strlen($this->title > 256))
				throw new Exception('Title cannot be more than 256 characters long.');
			if (strlen($this->description > 2048))
				throw new Exception('Description cannot be more than 2048 characters long.');
			
			if ($this->fields) {
				foreach ($this->fields as $field) {
					if (strlen($field->name) > 256)
						throw new Exception('Field name cannot be more than 256 characters long.');
					if (strlen($field->value) > 1024)
						throw new Exception('Field value cannot be more than 1024 characters long.');
				}
			}
			
			if ($this->footer) {
				if (strlen($this->footer->text) > 2048)
					throw new Exception('Footer text cannot be more than 2048 characters long.');
			}
			
			if ($this->author) {
				if (strlen($this->author->name) > 256)
					throw new Exception('Author name cannot be more than 256 characters long.');
			}
			
			return new Embed($this->title, $this->description, $this->url, $this->timestamp, $this->color, $this->footer, $this->image, $this->thumbnail, $this->video, $this->author, $this->fields);
		}
	}
?>