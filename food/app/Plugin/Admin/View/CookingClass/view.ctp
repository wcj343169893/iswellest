<div id="box">
	<h3 id="adduser">View Cooking Class</h3>
    <form id="form" action="<?php echo $webroot?>admin/cookingclass/save" method="post">
    <input type="hidden" name="id" value="<?php echo $cookingClass["id"]?>" />
      <fieldset id="personal">
        <legend>BASE INFORMATION</legend>
        <div>
        <label for="name">Name : </label> 
        <span><?php echo $cookingClass["name"]?></span>
        </div> 
        <div>
        <label for="price">Price : </label> 
       <span><?php echo $cookingClass["price"]?></span>
        </div> <div>
        <label for="video_address">Video Address : </label> 
        <span><?php echo $cookingClass["video_address"]?></span>
        </div> 
        <div>
        <label for="active">Status : </label>
        <span><?php echo empty($cookingClass["active"])?"Inactive":"Active"?></span>
       	</div>
        <div>
        <label for="description">Description : </label>
	    <textarea rows="10" cols="20" name="description" id="description" tabindex="2" disabled="disabled"><?php echo $cookingClass["description"]?></textarea>
        </div> 
      </fieldset>
      <fieldset>
      	<legend>TIME INFORMATION</legend>
        <div>
      	<label for="start_order">Start Order : </label> 
        <span><?php echo $this->Time->format("Y-m-d",$cookingClass["start_order"])?></span>
          </div> 
        <div>
      	<label for="start_learning">Start Learning : </label> 
        <span><?php echo $this->Time->format("Y-m-d",$cookingClass["start_learning"])?></span>
          </div> 
        <div>
      	<label for="end_learning">End Learning : </label> 
        <span><?php echo $this->Time->format("Y-m-d",$cookingClass["end_learning"])?></span>
          </div> 
      </fieldset>
    </form>
    <form id="form" action="/admin/cookingclass/edit/<?php echo $cookingClass["id"]?>" method="get">
      <div align="center">
      <input id="button1" type="submit" value="Edit" /> 
      </div>
   	</form>
</div>