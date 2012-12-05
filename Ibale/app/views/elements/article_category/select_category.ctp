<table id="categorySelector" cellspacing="0" cellpadding="0" border="0" class="boxy-wrapper fixed" style="z-index: 1337; display:none; left: 583.5px; top: 151.5px; opacity: 1;">
    <tbody>
        <tr>
            <td class="top-left"></td>
            <td class="top"></td>
            <td class="top-right"></td>
        </tr>
        <tr>
            <td class="left"></td>
            <td class="boxy-inner"><div class="title-bar" style="-moz-user-select: none;">
                    <h2>请选择转移文章的目标分类</h2>
                    <a class="close" href="javaScript:void(0);" onClick="javaScript:closeCategorySelector();">[关闭]</a>
                </div>
                <div class="display boxy-content" id="foobar" style="display: block;">
                    <p>
                        <span>分类</span>
                        <?php echo $appForm->select('category1_id', $category1List, null, array('id'=>'category1', 'empty'=>__('label.pleaseSelect', true)));?>
                        <?php echo $appForm->select('category2_id', $category2List, null, array('id'=>'category2','empty'=>__('label.pleaseSelect', true)));?>
                    </p>
                    <div class="btn clearfix">
                        <input type="button" name="button3" value="确定" class="btnWidth" id="button3" onClick="javaScript:changeArticleCategory();">
                    </div>
                </div>
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
