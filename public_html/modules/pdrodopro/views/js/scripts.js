
function postCart(typefield){
    $.ajax({
        type: 'POST',
        headers: { "cache-control": "no-cache" },
        url: pdrodopro['baseUri'] + "index.php?fc=module&module=pdrodopro&controller=ajax",
        async: false,
        cache: false,
        dataType : "json",
        data: "typerequest=accountform&typefield=" + typefield,
        success: function (data) {
        },
        error: function () {
            alert('Error with update RODO plugin');
        }
        });
}

function getDataByUser(){
    $.ajax({
        type: 'POST',
        headers: { "cache-control": "no-cache" },
        url: pdrodopro['baseUri'] + "index.php?fc=module&module=pdrodopro&controller=ajax",
        async: false,
        cache: false,
        dataType : "json",
        data: "typerequest=getdatabyuser",
        success: function (data) {
            $.each(data, function(index) {
                $('#'+data[index].type_allow).prop('checked', true);
                $('#'+data[index].type_allow).prop('required',true);
            });
        }
    });
}

function getDataByCart(){
    $.ajax({
        type: 'POST',
        headers: { "cache-control": "no-cache" },
        url: pdrodopro['baseUri'] + "index.php?fc=module&module=pdrodopro&controller=ajax",
        async: false,
        cache: false,
        dataType : "json",
        data: "typerequest=getdatabycart",
        success: function (data) {
            $.each(data, function(index) {
                $('#'+data[index].type_allow).prop('checked', true);
                $('#'+data[index].type_allow).prop('required',true);
            });
        }
    });
}