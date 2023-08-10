// CREATE AJAX FROM FORM

$( document ).ready(function() {
  // OPEN MODAL
  $('.modal').modal();
  $('#createUser').on('click',function(e){
    e.preventDefault();
    $('.modal').modal();
  })

});
