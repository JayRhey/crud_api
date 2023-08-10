$(document).ready(function() {

  $('.btn_edit_submit').on('click', function() {
    var formData = {
      id: $('#id_edit').val(),
      fname: $('#fname_edit').val(),
      lname: $('#lname_edit').val(),
      email: $('#email_edit').val(),
      _address: $('#_address_edit').val(),
      cell: $('#cell_edit').val()
    };

    $.ajax({
      url: 'http://localhost/xampp/adamco/controller/update/UpdateController.php',
      type: 'post',
      dataType: 'json',
      data: JSON.stringify(formData),
      success: function(data) {
        console.log(data);
        // Handle the response data here if needed
        if (data.status === 'success') {
          // Data update was successful, show a success toast
          var toastHTML = '<span>' + data.message + '</span><button class="btn-flat toast-action">Close</button>';
          M.toast({ html: toastHTML });
          $('#modal_edit').modal('close');
          var rowId = '#row_' + data.id;
          $(rowId).find('.fname_td').text(data.fname);
          $(rowId).find('.lname_td').text(data.lname);
          $(rowId).find('.email_td').text(data.email);
          $(rowId).find('.address_td').text(data._address);
          $(rowId).find('.cell_td').text(data.cell);
          // You can add any logic here after successful update
        } else {
          // Data update failed, display the error message using a Materialize toast
          var toastHTML = '<span>' + data.message + '</span><button class="btn-flat toast-action">Close</button>';
          M.toast({ html: toastHTML });
          // You can add any error handling logic here
        }
      },
      error: function(xhr, status, error) {
        // Handle error if AJAX request fails
        console.error(error);
      }
    });
  });
});
