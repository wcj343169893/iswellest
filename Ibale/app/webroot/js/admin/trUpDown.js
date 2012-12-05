/**
 * TRを上に移動
 * @param id
 * @param tableId
 */
function moveTrUp(id, tableId, modelName) {
    if ($("#tr"+id).index() == 1) {
        return;
    }
    var currentTr   = $("#tr"+id);
    var upBtn       = $("#upBtn"+id);
    var downBtn     = $("#downBtn"+id);
    var prevTr      = $("#"+tableId+" tr").eq($("#tr"+id).index() - 1);
    var prevId      = prevTr.attr('id').substring(2);
    var prevUpBtn   = prevTr.find("a[id^='upBtn']");
    var prevDownBtn = prevTr.find("a[id^='downBtn']");

    //dataArray[id]['order_number']     = parseInt(dataArray[id]['order_number'])-1;
    //dataArray[prevId]['order_number'] = parseInt(dataArray[prevId]['order_number'])+1;
    currentTr.insertBefore(prevTr);

    var orderNumbers = new Array();
    $("#"+tableId+" tr").each(function(){
        if ($(this).attr('id') == undefined) {
            return;
        }
        var dataId = $(this).attr('id').substring(2);
       orderNumbers[dataId] = $(this).index();
    });

    saveDataOrderNumbers(modelName, orderNumbers);
    //saveDataById('PageProperty', 'id', id, 'order_number', parseInt(dataArray[id]['order_number']), '顺序');
    //saveDataById('PageProperty', 'id', prevId, 'order_number', parseInt(dataArray[prevId]['order_number']), '顺序');

    //$("#orderNumber"+id).html(dataArray[id]['order_number']);
    //$("#orderNumber"+prevId).html(dataArray[prevId]['order_number']);

    $("#orderNumber"+id).html(currentTr.index());
    $("#orderNumber"+prevId).html(prevTr.index());

    if (currentTr.prevAll().length == 1) {
        upBtn.addClass("disabled");
    } else {
        upBtn.removeClass("disabled");
    }
    downBtn.removeClass("disabled");

    if (prevTr.nextAll().length == 0) {
        prevDownBtn.addClass("disabled");
    } else {
        prevDownBtn.removeClass("disabled");
    }
    prevUpBtn.removeClass("disabled");
}

/**
 * TRを下に移動
 * @param id
 * @param tableId
 */
function moveTrDown(id, tableId, modelName) {
    if ($("#"+tableId+" tr").length == $("#tr"+id).index() + 1) {
        return;
    }
    var currentTr   = $("#tr"+id);
    var upBtn       = $("#upBtn"+id);
    var downBtn     = $("#downBtn"+id);
    var nextTr      = $("#"+tableId+" tr").eq($("#tr"+id).index() + 1);
    var nextId      = nextTr.attr('id').substring(2);
    var nextUpBtn   = nextTr.find("a[id^='upBtn']");
    var nextDownBtn = nextTr.find("a[id^='downBtn']");
//    dataArray[id]['order_number']     = parseInt(dataArray[id]['order_number'])+1;
//    dataArray[nextId]['order_number'] = parseInt(dataArray[nextId]['order_number'])-1;
    
    //saveDataById('PageProperty', 'id', id, 'order_number', parseInt(dataArray[id]['order_number']), '顺序');
    //saveDataById('PageProperty', 'id', nextId, 'order_number', parseInt(dataArray[nextId]['order_number']), '顺序');

    currentTr.insertAfter(nextTr);

    var orderNumbers = new Array();
    $("#"+tableId+" tr").each(function(){
        if ($(this).attr('id') == undefined) {
            return;
        }
        var dataId = $(this).attr('id').substring(2);
       orderNumbers[dataId] = $(this).index();
    });

    saveDataOrderNumbers(modelName, orderNumbers);

    //$("#orderNumber"+id).html(dataArray[id]['order_number']);
    //$("#orderNumber"+nextId).html(dataArray[nextId]['order_number']);
    $("#orderNumber"+id).html(currentTr.index());
    $("#orderNumber"+nextId).html(nextTr.index());

    if (currentTr.nextAll().length == 0) {
        downBtn.addClass("disabled");
    } else {
        downBtn.removeClass("disabled");
    }
    upBtn.removeClass("disabled");

    if (nextTr.prevAll().length == 1) {
        nextUpBtn.addClass("disabled");
    } else {
        nextUpBtn.removeClass("disabled");
    }
    nextDownBtn.removeClass("disabled");
}