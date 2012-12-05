var other_city_name = '其他';

/**
 * 省のプルダウンを選択する時、市のプルダウンー・市の入力テキストボックスを設定する
 * @param provinceId  省のプルダウンのID
 * @param cityId     市のプルダウンID
 * @param city     省の入力テキストボックスのID
 * @param city     市の入力テキストボックスのID
 * @return なし
 */
function getCities(provinceId, cityId, city, regionId, region, zip ) {
    __getRegions('province', provinceId, cityId, '', city);
    $("#"+regionId).val('');
    $("#"+region).val('');
    $("#"+region).attr('disabled', true);
    $("#"+zip).val('');
    $("#"+zip).attr('readonly', true);
}

/**
 * 市のプルダウンを選択する時、区域のプルダウンー・区域の入力テキストボックスを設定する
 * @param provinceId  市のプルダウンのID
 * @param cityId     区域のプルダウンID
 * @param province   市の入力テキストボックスのID
 * @param city     区域の入力テキストボックスのID
 * @return なし
 */
function getRegions(cityId, regionId, city, region, zip) {
    __getRegions('city', cityId, regionId, city, region);
    $("#"+zip).val('');
    $("#"+zip).attr('readonly', true);
}
/**
 * 区域のプルダウンを選択する時、ZIPの入力テキストボックスを設定する
 * @param cityId     区域のプルダウンID
 * @return なし
 */
function getZip(regionId, zipNodeId, provinceId) {
    var id = null;
    if ($("#" + regionId + " option:selected").val() == 'other') {
        id = $("#"+provinceId).val();
    } else {
        id = $("#"+regionId).val();
    }
    $.post('/area/ajax_get_zip', {
        id : id
      }, function(rs) {
          $("#" + zipNodeId).val(rs);
      }
    );
    //loadZip(regionId, zipNodeId);
}


/**
 * 区域のプルダウンを選択する時、区域のプルダウンー・区域の入力テキストボックスを設定する
 * @param cityId     区域のプルダウンID
 * @param city     区域の入力テキストボックスのID
 * @return なし
 */
function chooseRegions(regionId, regionTxtId, zipNodeId, provinceId) {
    handleTextArea('', '', regionId, regionTxtId);
    getZip(regionId, zipNodeId, provinceId);
}

/**
 * 市のプルダウンー・市の入力テキストボックスの状態を設定する
 * @param cityId 市のプルダウンID
 * @param city   市の入力テキストボックスのID
 * @return なし
 */
function loadCity(cityId, city) {
    __loadRegion(cityId, city);
}

/**
 * 区域のプルダウンー・区域の入力テキストボックスの状態を設定する
 * @param regionId 区域のプルダウンID
 * @param region   区域の入力テキストボックスのID
 * @return なし
 */
function loadRegion(regionId, region) {
    __loadRegion(regionId, region);
}
function loadZip(regionNodeId, zipNodeId) {
    if ($("#" + regionNodeId + " option:selected").val() == 'other') {
        //$("#" + zipNodeId).val('');
        $("#" + zipNodeId).attr("readonly", false);
    } else {
        $("#" + zipNodeId).attr("readonly", true);
    }
}
function __getRegions(parent_level, parentNodeId, childNodeId, parentNodeTxtId, childTxtNodeId) {
    handleTextArea(parentNodeId, parentNodeTxtId, childNodeId, childTxtNodeId);

    if ($("#"+parentNodeId).val() == '') {
        return;
    }
    var url = '';
    if (parent_level == 'province') {
        url = '/area/ajax_get_cities';
    } else if (parent_level == 'city') {
        url = '/area/ajax_get_regions';
    } else {
        return;
    }

    $.post(url, {
            parentId    : $("#"+parentNodeId).val()
        }, function(rs) {
          $("#" + childNodeId +" >option[value!='']").remove();
          $("#" + childNodeId).append(rs);
          //$("#" + childNodeId).append("<option value='other'>其他</option>");
        }
    );
}

function __loadRegion(regionId, region) {
    if ($("#" + regionId + " option:selected").val() == 'other') {
        $("#" + region).attr("disabled", false);
    } else {
        $("#" + region).val('');
        $("#" + region).attr("disabled", true);
    }
}

function handleTextArea(parentNodeId, parentNodeTxtId, childNodeId, childTxtNodeId) {
    if (parentNodeId != '') {
        $("#" + childNodeId +" >option[value!='']").remove();
        $("#" + childNodeId).val('');
        $("#" + childTxtNodeId).val('');
        $("#" + childTxtNodeId).attr("disabled", true);
        if ($("#"+parentNodeId).val() == '') {
            $("#" + parentNodeTxtId).attr("disabled", true);
        } else if ($("#"+parentNodeId).val() == 'other') {
            $("#" + parentNodeTxtId).attr("disabled", false);
        } else {
            $("#" + parentNodeTxtId).val('');
            $("#" + parentNodeTxtId).attr("disabled", true);
        }
    }

    if ($("#"+childNodeId).val() == 'other') {
        $("#" + childTxtNodeId).attr("disabled", false);
    } else {
        $("#" + childTxtNodeId).val('');
        $("#" + childTxtNodeId).attr("disabled", true);
    }
}