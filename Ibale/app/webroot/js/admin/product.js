<script>
/**
var errorRequired = '<?php __('error.required');?>';
var errorNotExists = '<?php __('error.notExists');?>';
var errorPleaseSelect = '<?php __('error.pleaseSelect');?>';
var errorProductCdIsDuplicate = '<?php __('error.productCdIsDuplicate');?>';
var errorProductCdNotMatch = '<?php __('error.productCdNotMatch');?>';
*/
function getProductInfo(objId,productNameObjId,productPicObjId) {
    var productCd = $("#"+objId).val();
    if (productCd == '' || productCd == undefined) {
        alert('<?php echo str_replace('{0}', '对应商品ID', __('error.required', true));?>');
        return;
    }

    $.getJSON('/product/ajax_get_info', {
        product_cd:productCd,
        enable_sale:true
    }, function(rs) {
        if (!rs) {
            $("#"+productNameObjId).html('');
            $("#"+productPicObjId).attr('src','/image/admin/img_2.gif');
            alert('<?php echo str_replace('{0}', '对应商品ID', __('error.notExist', true));?>');
            return;
        }
        $("#"+productNameObjId).html(rs.Product.product_name);
        if (rs.ProductPhoto[0] == undefined) {
            $("#"+productPicObjId).attr('src','/image/admin/img_2.gif');
        } else {
            $("#"+productPicObjId).attr('src', '<?php echo OMS_API_PHOTO_ROOT_URL;?>' + rs.ProductPhoto[0].url);
        }
        if (rs.msg != undefined) {
            alert(rs.msg);
        }
    });
}
/**
 * カテゴリトップ編集画面の商品IDより商品情報を取得する用の関数
 * @param objId            商品番号入力欄のID
 * @param typeId           商品種類のID（newProductCd、hotProductCd、categoryProductProductCd）
 * @param productNameObjId 商品番号名前のID
 * @param productPicObjId  商品番号画像のID
 * @param category1ObjId   関連カテゴリ１のID
 * @param category2ObjId   関連カテゴリ２のID
 * @param category3ObjId   関連カテゴリ３のID
 * @returns なし
 */
function getCategoryProductProductInfo(objId,typeId,productNameObjId,productPicObjId,category1ObjId,category2ObjId,category3ObjId,required,checkCategory) {
    var productCd = $("#"+objId).val();
    if (productCd == '' || productCd == undefined) {
        $("#"+productNameObjId).val('');
        if (productPicObjId != '' && $("#"+productPicObjId).length != 0) {
            $("#"+productPicObjId).attr('src', 'image/admin/img_2.gif');
        }
        if (required) {
            alert('<?php echo renderMsg(__('error.required', true), '对应商品ID');?>');
        }
        return;
    }

    //商品番号が重複の場合
    var isDupliateProductCd = false;
    $("input[id^='"+typeId+"']").each(function(){
        if ($(this).val() == productCd && $(this).attr('id') != objId) {
            isDupliateProductCd = true;
        }
    });
    if (isDupliateProductCd) {
        alert('<?php __('error.productCdIsDuplicate');?>');
        //$("#"+objId).focus();
        return;
    }
    
    //関連カテゴリが未選択の場合
    if ($("#"+category1ObjId+" option:selected").val() == '' 
            && $("#"+category2ObjId+" option:selected").val() == ''
            && ((category3ObjId != undefined && category3ObjId != '') && $("#"+category3ObjId+" option:selected").val() == '')) {
        alert('<?php echo str_replace('{0}', '关联分类', __('error.pleaseSelect',true));?>');
        return;
    }

    $.getJSON('/product/ajax_get_info', {
        product_cd:productCd
    }, function(rs) {
        if (!rs) {
            $("#"+productNameObjId).val('<?php  __('error.productCdNotMatch');?>');
            if (productPicObjId != '') {
                $("#"+productPicObjId).attr('src', '/image/admin/img_2.gif');
            }
            return;
        }
        var category1Id = null;
        var category2Id = null;
        var category3Id = null;
        category1Id = $("#"+category1ObjId+" option:selected").val();
        if(category2ObjId != undefined && $("#"+category2ObjId+" option:selected").val() != '') {
            category2Id = $("#"+category2ObjId+" option:selected").val();
        }
        if (category3ObjId != undefined && category3ObjId != '') {
            category3Id = $("#"+category3ObjId+" option:selected").val();
        }
 
        if (checkCategory == undefined) {
            checkCategory = true;
        }
        if (checkCategory && (category1Id != null || category2Id != null || category3Id != null)) {
            //関連カテゴリをチェック
            var categoryMatchFlg = false;
            if (rs.Category != undefined) {
                $.each(rs.Category, function(index, value){
                    if (value.CategoryProductRel == undefined) {
                        return;
                    }
                    var categoryId = value.CategoryProductRel.category_id;
                    var parentId = value.CategoryProductRel.parent_id;
                    var parentParentId = value.CategoryProductRel.parent_parent_id;
                    if (category3Id != null 
                            && (categoryId == category1Id 
                                    || categoryId == category2Id 
                                    || categoryId == category3Id)) {
                        categoryMatchFlg = true;
                        return;
                    } else if (category3Id == null && category2Id != null
                            && (categoryId == category1Id
                                    || categoryId == category2Id
                                    || parentId == category2Id)) {
                        categoryMatchFlg = true;
                        return;
                    } else if (category3Id == null && category2Id == null
                            && (categoryId == category1Id
                                    || parentId == category1Id
                                    || parentParentId == category1Id)) {
                        categoryMatchFlg = true;
                        return;
                    }
                });
            }
            if (!categoryMatchFlg) {
                $("#"+productNameObjId).val('<?php  __('error.categoryProductRelNotMatch');?>');
                return;
            }
        }
        $("#"+productNameObjId).val(rs.Product.product_name);
        //$("#"+productNameObjId).html(rs.Product.product_name);
        if (productPicObjId != '' && $("#"+productPicObjId).length != 0 && rs.ProductPhoto.length > 0 && rs.ProductPhoto[0].url != undefined) {
            $("#"+productPicObjId).attr('src', '<?php echo OMS_API_PHOTO_ROOT_URL;?>'+rs.ProductPhoto[0].url);
        } else if (productPicObjId != '') {
            $("#"+productPicObjId).attr('src', '/image/admin/img_2.gif');
        }
    });
}
</script>