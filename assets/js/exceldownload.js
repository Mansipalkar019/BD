
$(document).on('click', '.exceldownload', function() {
    $.ajax({
        url: bases_url + "Projects/exceldownload",
        method: "POST",
        success: function(response) {
         window.location.replace(response);
        }
    });
});

var simpletable = $('#doc_list_datatable').DataTable({
"responsive": true,
'processing': true,
'serverSide': true,
'serverMethod': 'post',
'language': {
    'processing': '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>',
    searchPlaceholder: ""
    
},
'ajax': {
    'url': "<?= base_url() ?>Projects/getprojectrecord",
    'method': "POST",
    'dataType':'json',
    "data": function (data) {
        
    }
}, 
createdRow: function (row, data, index) {
    $('td', row).eq(2).addClass('text-capitalize');
},
});