<?php
class User extends AppModel {
	var $name = 'User';
	var $useTable = 'user';
	public $primaryKey = 'id';//默认是id
}