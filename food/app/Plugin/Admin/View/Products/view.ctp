<div id="box">
	<h3 id="adduser">View Product</h3>
      <form id="form" action="/admin/products/edit/<?php echo $data["id"]?>" method="get">
      <fieldset id="personal">
        <legend>Basic Information</legend>
        <div>
        <label for="name">Name : </label> 
        <span><?php echo $data["name"]?></span>
        </div>
         <div>
        <label for="price">Price : </label>
        <span><?php echo $data["price"]?></span>
       </div>
         <div>
        <label for="price">Category : </label>
        <span><?php echo $category[$data["cateID"]]?></span>
        </div>
         <div>
        <label for="active">Active : </label>
        <span><?php echo $data["active"]?"Active":"DisActive" ?></span>
       </div>
         <div>
        <img alt="" src="<?php echo $data["icon"]?>" id="icon_img" class="view_icon_img <?php echo empty($data["photo"])?"hidden":""?>" width="200px">
        <div class="clear"></div>
        </div>
      </fieldset>
      <fieldset id="address">
        <legend>Other Information</legend>
         <div>
        <label for="excerpt">Excerpt : </label>
        <span><?php echo $data["excerpt"]?></span>
        </div>
         <div>
        <label for="description">Description : </label> 
        <textarea rows="10" cols="20" name="description" id="description" readonly="readonly"><?php echo $data["description"]?></textarea>
        </div>
      </fieldset>
	  </form>
      <form id="form" action="/admin/products/edit/<?php echo $data["id"]?>" method="get">
      <div align="center">
      <input id="button1" type="submit" value="Edit" /> 
      </div>
	  </form>
</div>
