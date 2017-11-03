<?php
	class Role {
		public $id;
		public $name;
		public $mentionable;
		public $color;
		public $position;
		public $permissions;
		
		public function __construct($id, $name, $mentionable, $color, $position, $permissions) {
			$this->id = $id;
			$this->name = $name;
			$this->mentionable = $mentionable;
			$this->color = $color;
			$this->position = $position;
			$this->permissions = $permissions;
		}
	}
?>