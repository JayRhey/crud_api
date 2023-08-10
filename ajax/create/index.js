$(document).ready(function() {
  // Attach event listener to the submit button
  $('#submit_form').on('click', function() {
    var formData = {
      fname: $('#fname').val(),
      lname: $('#lname').val(),
      email: $('#email').val(),
      _address: $('#_address').val(),
      cell: $('#cell').val()
    };

    $.ajax({
      url: 'http://localhost/xampp/adamco/controller/create/CreateController.php',
      type: 'post',
      dataType: 'json',
      success: function(data) {
        console.log(data);
        // Handle the response data here if needed
        if (data.status === 'success') {
          // Data insertion was successful, append the new table row to the table
          var toastHTML = '<span>' + data.message + '</span><button class="btn-flat toast-action">Close</button>';
          M.toast({ html: toastHTML });
          $('#dataTable').append(data.newRow);
          $('.modal').modal('close');
        } else {
          // Data insertion failed, display the error message using a Materialize toast
          var toastHTML = '<span>' + data.message + '</span><button class="btn-flat toast-action">Close</button>';
          M.toast({ html: toastHTML });
          }
          },
          data: JSON.stringify(formData)
          });
      });
});
