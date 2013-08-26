<div id="box">
	<h3 id="adduser">Edit user</h3>
    <form id="form" action="<?php echo $webroot?>admin/users/save/<?php echo $user["id"]?>" method="post">
      <fieldset id="personal">
        <legend>PERSONAL INFORMATION</legend>
        <label for="lastname">Last name : </label> 
        <input name="lastname" id="lastname" type="text" tabindex="1" value="<?php echo $user["last_name"]?>"/>
        <br />
        <label for="firstname">First name : </label>
        <input name="firstname" id="firstname" type="text"  value="<?php echo $user["first_name"]?>"
        tabindex="2" />
        <br />
        <label for="email">Email : </label>
        <input name="email" id="email" type="text"  value="<?php echo $user["email"]?>"
        tabindex="2" />    
        <br />
        <label for="birthday">Birthday : </label>
        <input name="birthday" id="birthday" type="text"  value="<?php echo $user["birth_date"]?>"
        tabindex="3" />
        <br />
        <label for="gender">Gender : </label>
        <input name="gender" id="gender_male" <?php echo $user["gender"]=="M"?"checked":""?> type="radio" value="M"
        tabindex="3" /><label for="gender_male" style="float: none;display: initial;">Male</label>
        <input name="gender" id="gender_female" type="radio" <?php echo $user["gender"]=="F"?"checked":""?> value="F"
        tabindex="3" /><label for="gender_female" style="float: none;display: initial;">Female</label>
        <br />
        <label for="userName">Login Name : </label>
        <input name="userName" id="userName" type="text" value="<?php echo $user["username"]?>"
        tabindex="3" />
        <br />
        <label for="pass">Password : </label>
        <input name="pass" id="pass" type="password" 
        tabindex="2" />
        <br />
        <label for="pass-2">Re-Password : </label>
        <input name="pass-2" id="pass-2" type="password" 
        tabindex="2" />
        <br />
      </fieldset>
      <fieldset id="address">
        <legend>Address</legend>
        <label for="street">Street address : </label> 
        <input name="street" id="street" type="text" value="<?php echo $user["address"]?>"
        tabindex="1" />
        <br />
        <label for="city">City : </label>
        <input name="city" id="city" type="text" value="<?php echo $user["city"]?>"
        tabindex="2" />
        <br />
        <label for="country">Country : </label> 
        <input name="country" id="country" type="text" value="<?php echo $user["country"]?>"
        tabindex="1" />
        <br />
        <label for="state">State/Province : </label>
        <input name="state" id="state" type="text" value="<?php echo $user["state"]?>"
        tabindex="2" />
        <br />
        <label for="zip">Zip/Postal Code : </label>
        <input name="zip" id="zip" type="text" value="<?php echo $user["zip"]?>"
        tabindex="2" />
        <br />
        <label for="tel">Telephone : </label>
        <input name="tel" id="tel" type="text" value="<?php echo $user["phone"]?>"
        tabindex="2" />
      </fieldset>
      <fieldset id="opt">
        <legend>OPTIONS</legend>
        <label for="choice">Group : </label>
        <select name="role_id">
          <option selected="selected" label="<?php echo $user_role["name"]?>" value="<?php echo $user_role["id"]?>"><?php echo $user_role["name"]?></option>
          <?php if(!empty($roles)){foreach ($roles as $k=>$v){?>
          <optgroup label="<?php echo $v["name"]?>">
          	<?php if(!empty($v["children"])){foreach ($v["children"] as $k2=>$v2){?>
            <option label="<?php echo $v2["Role"]["name"]?>" value="<?php echo $v2["Role"]["id"]?>"><?php echo $v2["Role"]["name"]?></option>
            <?php }}?>
          </optgroup>
          <?php }}?>
        </select>
        <br/>
        <label for="active">Status : </label>
        <input name="status" id="active_true" <?php echo $user["active"]=="active"?"checked":""?> type="radio" tabindex="13" value="active"/>
       	<label for="active_true" style="float: none;display: initial;">Active</label>
        <input name="status" id="active_false" type="radio" <?php echo $user["active"]=="inactive"?"checked":""?> tabindex="13" value="inactive"/>
       	<label for="active_false" style="float: none;display: initial;">Inactive</label>
      </fieldset>
      <div align="center">
      <input id="button1" type="submit" value="Save" /> 
      <input id="button2" type="reset" />
      </div>
    </form>
</div>