<div id="rightnow">
                    <h3 class="reallynow">
                        <span>Right Now</span>
                        <br />
                    </h3>
				    <p class="youhave">You have <a href="#">19 new orders</a>, <a href="#">12 new users</a> , today you made <a href="#">$1523.63 in sales</a> and a total of <strong>$328.24 profit </strong>
                    </p>
</div>
<div id="infowrap">
             <div id="infobox">
               <h3>Last 5 Orders</h3>
               <table>
	<thead>
		<tr>
                       	<th>Customer</th>
                           <th>Items</th>
                           <th>Grand Total</th>
                       </tr>
	</thead>
	<tbody>
	<?php foreach($lastOrder as $k=>$v){?>
		<tr>
            <td><a href="#"><?php echo $v["Order"]["first_name"]." ".$v["Order"]["last_name"]?></a></td>
            <td><?php echo $v["Order"]["order_item_count"]?></td>
            <td><?php echo $v["Order"]["total"]?> $</td>
        </tr>
     <?php }?>                 
	</tbody>
</table>            
</div>
<div id="infobox">
               <h3>New Customers</h3>
               <table>
	<thead>
		<tr>
            <th>Customer</th>
            <th>Email</th>
        </tr>
	</thead>
	<tbody>
	<?php foreach($newCusomer as $k=>$v){?>
		<tr>
            <td><a href="#"><?php echo $v["User"]["first_name"]." ".$v["User"]["last_name"]?></a></td>
            <td><?php echo $v["User"]["email"]?></td>
        </tr>
     <?php }?>    
	</tbody>
</table>                 
</div>
</div>