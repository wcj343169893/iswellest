<div id="box">
	<h3 id="adduser">View Product</h3>
      <form id="form" action="/admin/products/edit/<?php echo $data["id"]?>" method="get">
      <fieldset id="personal">
        <legend>Basic Information</legend>
        <label for="name">Name : </label> 
        <span><?php echo $data["name"]?></span>
        <br />
        <label for="price">Price : </label>
        <span><?php echo $data["price"]?></span>
        <br />
        <label for="price">Category : </label>
        <span><?php echo $category[$data["cateID"]]?></span>
        <br />
        <label for="active">Active : </label>
        <span><?php echo $data["active"]?"Active":"DisActive" ?></span>
        <br />
        <label for="photo">photo : </label> 
        <input name="photo" id="photo" type="hidden"  tabindex="5" value="<?php echo $data["photo"]?>"/>
        <img alt="" src="<?php echo $data["photo"]?>" id="icon_img" class="<?php echo empty($data["photo"])?"hidden":""?>" width="200px">
        <div class="clear"></div>
        <br />
      </fieldset>
      <fieldset id="address">
        <legend>Other Information</legend>
        <label for="excerpt">Excerpt : </label>
        <span><?php echo $data["excerpt"]?></span>
        <br />
        <label for="description">Description : </label> 
        <textarea rows="10" cols="20" name="description" id="description" readonly="readonly"><?php echo $data["description"]?></textarea>
        <br />
      </fieldset>
	  </form>
      <form id="form" action="/admin/products/edit/<?php echo $data["id"]?>" method="get">
      <div align="center">
      <input id="button1" type="submit" value="Edit" /> 
      </div>
	  </form>
</div>
