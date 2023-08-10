$(document).ready(function() {
  // Attach event listener to the "Delete" button in the table rows
  $(document).on('click', '.delete_form', function() {
    var id = $(this).attr('data-id');
    console.log(id);
    // Send AJAX request to delete data for the specific ID
    $.ajax({
      url: 'http://localhost/xampp/adamco/controller/delete/DeleteController.php',
      type: 'post',
      dataType: 'json',
      data: { id: id },
      success: function(data) {
        // Handle the response data here if needed
        if (data.status === 'success') {
          // Data deletion was successful, remove the corresponding table row
          $('#row_' + id).remove();

          // Show a success toast using Materialize CSS
          var toastHTML = '<span>' + data.message + '</span><button class="btn-flat toast-action">Close</button>';
          M.toast({ html: toastHTML });
        } else {
          // Data deletion failed, display the error message using a Materialize toast
          var toastHTML = '<span>' + data.message + '</span><button class="btn-flat toast-action">Close</button>';
          M.toast({ html: toastHTML });
        }
      },
      error: function(xhr, status, error) {
        // Handle error if AJAX request fails
        console.error(error);
      }
    });
  });
});
