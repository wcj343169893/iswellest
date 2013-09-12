<div id="box">
	<h3 id="adduser">Add Cooking Class</h3>
    <form id="form" action="<?php echo $webroot?>admin/cookingclass/save" method="post">
      <fieldset id="personal">
        <legend>BASE INFORMATION</legend>
        <label for="name">Name : </label> 
        <input name="name" id="name" type="text" tabindex="1" />
        <br />
        <label for="price">Price : </label> 
        <input name="price" id="price" type="text" tabindex="3" />
        <br />
        <label for="video_address">Video Address : </label> 
        <input name="video_address" id="video_address" type="text" tabindex="4" />
        <br />
        <label for="active">Status : </label>
        <input name="status" id="active_true" checked type="radio" tabindex="5" value="active"/>
       	<label for="active_true" style="float: none;display: initial;">Active</label>
        <input name="status" id="active_false" type="radio" tabindex="5" value="inactive"/>
       	<label for="active_false" style="float: none;display: initial;">Inactive</label>
       	 <label for="description">Description : </label>
	    <textarea rows="10" cols="20" name="description" id="description" tabindex="2"></textarea>
        <br />
      </fieldset>
      <fieldset>
      	<legend>TIME INFORMATION</legend>
      	<label for="start_order">Start Order : </label> 
        <input name="start_order" id="start_order" type="text" tabindex="6" /> Example:2013-06-11
        <br />
      	<label for="start_learning">Start Learning : </label> 
        <input name="start_learning" id="start_learning" type="text" tabindex="6" /> Example:2013-06-11
        <br />
      	<label for="end_learning">End Learning : </label> 
        <input name="end_learning" id="end_learning" type="text" tabindex="6" /> Example:2013-06-11
        <br />
      </fieldset>
      <div align="center">
      <input id="button1" type="submit" value="Submit" /> 
      <input id="button2" type="reset" />
      </div>
    </form>
</div>
<script>
  $(function() {
    	$( "#start_order" ).datepicker({"dateFormat":"yy-mm-dd"});
    	$( "#start_learning" ).datepicker({"dateFormat":"yy-mm-dd"});
    	$( "#end_learning" ).datepicker({"dateFormat":"yy-mm-dd"});
  });
</script>