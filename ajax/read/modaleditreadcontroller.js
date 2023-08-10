$(document).ready(function() {
  // Attach event listener to the "Edit" button in the table rows
  $(document).on('click', '.update_form', function() {
    var id = $(this).attr('data-id');
    console.log(id);
    // Send AJAX request to fetch data for the specific ID
    $.ajax({
      url: 'http://localhost/xampp/adamco/controller/read/ModalEditReadController.php',
      type: 'post',
      dataType: 'json',
      data: { id: id },
      success: function(data) {
        // Populate the modal with the retrieved data
        $('#id_edit').val(data.id);
        $('#fname_edit').val(data.fname);
        $('#lname_edit').val(data.lname);
        $('#email_edit').val(data.email);
        $('#_address_edit').val(data._address);
        $('#cell_edit').val(data.cell);
        // Open the modal
        $('#modal_edit').modal('open');
      },
      error: function(xhr, status, error) {
        // Handle error if AJAX request fails
        console.error(error);
      }
    });
  });
});
