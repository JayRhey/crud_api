$(document).ready(function() {
    // Function to display the fetched data in the HTML table
    function displayData(data) {
        // Get the tbody element of the table
        var tbody = $('#dataTable');

        // Clear the existing table content
        tbody.empty();

        // Add rows with data to the table
        data.forEach(function(item) {
            var tableRow = '<tr id="row_'+item.id+'">' +
                '<td class="fname_td">' + item.fname + '</td>' +
                '<td class="lname_td">' + item.lname + '</td>' +
                '<td class="cell_td">' + item.cell + '</td>' +
                '<td class="address_td">' + item._address + '</td>' +
                '<td class="email_td">' + item.email + '</td>' +
                '<td>' + '<a class="update_form waves-effect waves-light btn-small modal-trigger" href="#modal_edit" data-id="'+item.id+'">Edit</a><a class="waves-effect waves-light btn-small delete_form" data-id="'+item.id+'">Delete</a>' + '</td>' +
                '</tr>';
            tbody.append(tableRow);
        });
    }

    // Send AJAX request to fetch data
    $.ajax({
        url: 'http://localhost/xampp/adamco/controller/read/ReadController.php',
        type: 'get',
        dataType: 'json',
        success: function(data) {
            // Call the displayData function to display the fetched data in the table
            displayData(data);
        },
        error: function(xhr, status, error) {
            // Handle error if AJAX request fails
            console.error(error);
        }
    });
});
