/**
 * 複数選択可能プルダウンーボタンの項目を上に移動
 * @param selectBoxId プルダウンーボタンのID
 */
function moveUp(selectBoxId) {
    $("#"+selectBoxId+" option:selected").each(function () {
        $(this).insertBefore($(this).prev());
    });
}
/**
 * 複数選択可能プルダウンーボタンの項目を下に移動
 * @param selectBoxId プルダウンーボタンのID
 */
function moveDown(selectBoxId) {
    $("#"+selectBoxId+" option:selected").each(function () {
        $(this).insertAfter($(this).next());
    });
}
/**
 * 複数選択可能プルダウンーボタンの項目を他の複数選択可能プルダウンーボタンに移動
 * @param selectBoxId プルダウンーボタンのID（遷移元）
 * @param selectBoxId プルダウンーボタンのID（遷移先）
 */
function moveTo(orgSelectBoxId, desSelectBoxId) {
    $("#"+orgSelectBoxId+" option:selected").each(function () {
        $("#"+desSelectBoxId).append($(this));
        $(this).attr('selected', false);
    });
}
