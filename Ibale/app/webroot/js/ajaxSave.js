var gReloadUrl = '';
/**
 * AJAXで行データを更新
 * @param id            行番号
 * @param modelName         更新テーブルに対するモジュール名
 * @param pKeyName          更新テーブルの主キー
 * @param fieldName         更新項目の名（テーブルにコラム名）
 * @param fieldNameLabel    更新項目の名前
 * @return なし
 */
function saveLineData(modelName, pKeyName, pKeyValue, fieldName, obj, fieldLabel, uniqueFunction,associateKeyName,associateValue,lReloadUrl) {
    var url = '/admin/ajax/save_data';
    obj = $(obj);
    var fieldValue = obj.val();
    gReloadUrl = lReloadUrl;
    $.getJSON(url, {
                    model:modelName,
                    pKeyName:pKeyName,
                    pKeyValue:pKeyValue,
                    fieldName:fieldName,
                    fieldValue:fieldValue,
                    fieldLabel:fieldLabel,
                    uniqueFunction:uniqueFunction,
                    associateKeyName:associateKeyName,
                    associateKeyValue:associateValue
                }, afterSaveData);
}

/**
 * AJAXで行データを更新
 * @param id            行番号
 * @param modelName         更新テーブルに対するモジュール名
 * @param pKeyName          更新テーブルの主キー
 * @param fieldName         更新項目の名（テーブルにコラム名）
 * @param fieldNameLabel    更新項目の名前
 * @return なし
 */
function saveDataOrderNumbers(modelName, orderNumbers) {
    var url = '/admin/ajax/save_order_number';
    $.get(url, {
            model:modelName,
            orderNumbers:orderNumbers
        }, function(rs) {
            return;
        });
}

/**
 * AJAXで行データの編集欄を表示
 * @param id            行番号
 * @param textBoxName       テキスボクスの名
 * @param labelName         ラベルの名
 * @return なし
 */
function showTextBox(id, textBoxName, labelName) {
    $("#"+textBoxName+id).show();
    $("#"+labelName+id).hide();
}

/**
 * データを更新した後の処理を行う
 * @param rs
 */
function afterSaveData(rs) {
    if (!rs.result) {
        $("#"+rs.fieldName+"Error"+rs.id).html(rs.error);
        $("#"+rs.fieldName+"Error"+rs.id).show();
        return;
    }
    $("#"+rs.fieldName+"Error"+rs.id).hide();
    $("#"+rs.fieldName+"Label"+rs.id).html($("#"+rs.fieldName+rs.id).val().replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'));
    $("#"+rs.fieldName+"Label"+rs.id).show();
    $("#"+rs.fieldName+rs.id).hide();

    if (gReloadUrl != '' && gReloadUrl != undefined) {
        window.location.href = gReloadUrl;
        return;
    }
    if (rs.fieldName == 'order_number') {
        window.location.reload();
    }
}