<div><a href="/user/index" class="btn btn-info">所有用户</a></div>
<?php 
	echo $this->Form->create('User');
	echo $this->Form->input('username');
	echo $this->Form->input('password');
	echo $this->Form->input('birthday', array(
		'label' => 'Date of birth',
	    'dateFormat' => 'YMD',
	    'minYear' => date('Y') - 70,
	    'maxYear' => date('Y'),
	));
?>

<?php echo $this->Form->end("Submit"); ?>