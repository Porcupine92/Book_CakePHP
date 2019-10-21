<?php
class Book extends AppModel{
	public $useTable = 'books';
	
    public $hasMany = array(
		'Review' => array(
            'className'  => 'Review',
            'foreignKey' => 'book_id'
         )
	);
}
?>