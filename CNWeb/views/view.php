 <!-- Ngo Huu Tuan -->
 
<?php
	abstract class View{
		protected $model;
		public function __construct($model){
			$this->model = $model;
		}

		abstract function display();
	}
?>