(function($) {

    $(".deleteButton").click(function(){
        var idValue = $(this).attr('id').split("_");
        if(idValue[1] !== null){
            $("#deleteId").val(idValue[1]);
        }
    });
    $("#confirmDelete").click(function(){
        var href = $("#confirmDelete").attr("href");
        $(this).attr("href", href + "?id="+$("#deleteId").val());
    });
   // $('#tblRequest').DataTable();

   $('#tblRequest').dataTable( {
    "columnDefs": [
      { "orderable": false, "targets": 7 }
    ],
		"pageLength": 100,
		"order": [[ 6, "desc" ]]
  } );
  $('#tblPgmTable').dataTable( {
    "columnDefs": [
      { "orderable": false, "targets": [8,9] }
    ],
		"pageLength": 100
  } );

$('#tblDiscount').dataTable( {
    "columnDefs": [
      { "orderable": false, "targets": [7,8] }
    ],
		"pageLength": 100
  } );
  $('#tblTest').dataTable( {
    "buttons": [
        'excel'
    ],
   "columnDefs": [
     { "orderable": false, "targets": 7 }
   ],
   "pageLength": 100,
   "order": [[ 6, "desc" ]],

  } );
  $('#tblPromotion').dataTable( {
    "columnDefs": [
      { "orderable": false, "targets": [7,8] }
    ],
		"pageLength": 100
  } );
})(jQuery);
