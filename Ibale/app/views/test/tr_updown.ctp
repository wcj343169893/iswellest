<script>
function MoveRowDown(tableId, index)
{
        var rows = $("#" + tableId + " tr");

        rows.eq(index).insertAfter(rows.eq(index + 1));
}

function MoveRowUp(tableId, index)
{                       
        var rows = $("#" + tableId + " tr");

        rows.eq(index).insertBefore(rows.eq(index - 1));
}
$(function(){
    $("tr[id^='tr']").click(function(){
        //alert($(this).index());
        if ($(this).prevAll().length > 0) {
            //alert($(this).prevAll().length);
            $(this).insertBefore($("#t1 tr").eq($(this).index()-1));
        }
        //alert($(this).nextAll().length);
    });
});
</script>
<table id="t1">
<tr id="tr1" onclick="javaScript:MoveRowDown('t1', 1);">
<td>1111</td>
</tr>
<tr id="tr2">
<td >2222</td>
</tr>
<tr id="tr3">
<td>3333</td>
</tr>
</table>