function showEdit(editableObj) {
    $(editableObj).css("background", "#DDD");
}

function saveToDatabase(editableObj,table,column,id,idcolumn) {
    $(editableObj)
        .css("background", "#FFF url(./img/loaderIcon.gif) no-repeat center right 5px");
    $.ajax({
        url: "./save.php",
        type: "POST",
        data: 'column=' + column + '&table=' + table + '&editval=' + editableObj.innerHTML +
            '&id=' + id + '&idcolumn=' + idcolumn,
        success: function (data) {
            $(editableObj).css("background", "#FDFDFD");
            //alert(data);
        }
    });
}