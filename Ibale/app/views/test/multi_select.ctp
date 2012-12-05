<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/js/multiple_selectbox.js"></script>
<script>
$(function(){
    $("#leftSortUp").click(function() {
        moveUp("leftSelectBox");
    });
    $("#rightSortUp").click(function() {
        moveUp("rightSelectBox");
    });

    $("#leftSortDown").click(function() {
        moveDown("leftSelectBox");
    });

    $("#rightSortDown").click(function() {
        moveDown("rightSelectBox");
    });

    $("#toRight").click(function() {
        moveTo("leftSelectBox", "rightSelectBox");
    });
    $("#toLeft").click(function() {
        moveTo("rightSelectBox", "leftSelectBox");
    });
});

</script>
<table>
<tr><td>
<select id="leftSelectBox" multiple="multiple" style="width:155px;height:250px" name="data[Category][category3_id][]">

</select>
<input type="button" class="btn-style" id="leftSortUp" value="上  ">
<input type="button" class="btn-style" id="leftSortDown" value="下  ">
</td>
<td>
<input type="button" class="btn-style" id="toRight" value=">>">
<input type="button" class="btn-style" id="toLeft" value="">
</td>
<td>
<select id="rightSelectBox" multiple="multiple" style="width:155px;height:250px" name="data[Category][category3_id][]">
<option value="20">f</option>
<option value="21">g</option>
<option value="22">h</option>
<option value="20">a</option>
<option value="21">b</option>
<option value="22">c</option>
<option value="23">d</option>
<option value="62">e</option>
</select>
<input type="button" class="btn-style" id="rightSortUp" value="上  ">
<input type="button" class="btn-style" id="rightSortDown" value="下  ">
</td></tr>
</table>
