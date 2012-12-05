<table id="tContentDetail" cellspacing="0" cellpadding="0" border="0" class="boxy-wrapper fixed" style="z-index: 1337; display: none; top: 50.5px; opacity: 1;">
    <tbody>
        <tr>
            <td class="top-left"></td>
            <td class="top"></td>
            <td class="top-right"></td>
        </tr>
        <tr>
            <td class="left"></td>
            <td class="boxy-inner">
            <div class="title-bar" style="-moz-user-select: none;">
                    <h2>评论内容详细</h2>
                    <a class="close" href="javaScript:void(0);" onClick="javaScript:closePop();">[关闭]</a>
                </div>
                <div id="contentDetail" class="display boxy-content" id="foobar" style="width:600px;min-height:100px;max-height:400px;display:block;text-align:left;vertical-align:middle;overflow:auto;">
                </div>
                <div style="text-align:center;margin-top:10px;margin-bottom:5px;"><input class="btnWidth" type="button" name="close" value="确定" onClick="javaScript:closePop()" /></div>
            </td>
            <td class="right"></td>
        </tr>
        <tr>
            <td class="bottom-left"></td>
            <td class="bottom"></td>
            <td class="bottom-right"></td>
        </tr>
    </tbody>
</table>
<script type="text/javascript">
function closePop(id) {
    $('#tContentDetail').hide();
}
</script>