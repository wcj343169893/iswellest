<div id="box">
	<h3 id="adduser">Add Cooking Class</h3>
    <form id="form" action="/admin/cookingclass/save" method="post">
    <input type="hidden" name="id" value="<?php echo $cookingClass["id"]?>" />
      <fieldset id="personal">
        <legend>BASE INFORMATION</legend>
        <label for="name">Name : </label> 
        <input name="name" id="name" type="text" tabindex="1" value="<?php echo $cookingClass["name"]?>"/>
       	<br />
        <label for="price">Price : </label> 
        <input name="price" id="price" type="text" tabindex="3" value="<?php echo $cookingClass["price"]?>"/>
        <br />
        <label for="video_address">Video Address : </label> 
        <input name="video_address" id="video_address" type="text" tabindex="4" value="<?php echo $cookingClass["video_address"]?>"/>
        <br />
        <label for="active">Status : </label>
        <input name="status" id="active_true" type="radio" tabindex="5" value="active" <?php echo empty($cookingClass["active"])?"":"checked"?>/>
       	<label for="active_true" style="float: none;display: initial;">Active</label>
        <input name="status" id="active_false" type="radio" tabindex="5" value="inactive" <?php echo empty($cookingClass["active"])?"checked":""?>/>
       	<label for="active_false" style="float: none;display: initial;">Inactive</label>
       	 <br />
        <label for="description">Description : </label>
	    <textarea rows="10" cols="20" name="description" id="description" tabindex="2"><?php echo $cookingClass["description"]?></textarea>
      </fieldset>
      <fieldset>
      	<legend>TIME INFORMATION</legend>
      	<label for="start_order">Start Order : </label> 
        <input name="start_order" id="start_order" type="text" tabindex="6" value="<?php echo $this->Time->format("Y-m-d",$cookingClass["start_order"])?>"/> Example:2013-06-11
        <br />
      	<label for="start_learning">Start Learning : </label> 
        <input name="start_learning" id="start_learning" type="text" tabindex="6" value="<?php echo $this->Time->format("Y-m-d",$cookingClass["start_learning"])?>"/> Example:2013-06-11
        <br />
      	<label for="end_learning">End Learning : </label> 
        <input name="end_learning" id="end_learning" type="text" tabindex="6" value="<?php echo $this->Time->format("Y-m-d",$cookingClass["end_learning"])?>"/> Example:2013-06-11
        <br />
      </fieldset>
      <div align="center">
      <input id="button1" type="submit" value="Submit" /> 
      <input id="button2" type="reset" />
      </div>
    </form>
</div>