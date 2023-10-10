$(document).ready(function () {
  console.log("navhome is working");
  $.ajax({
    url: 'navhome.html',
    dataType: 'html',
    success: function (data) {
      $('#navigation').html(data);
    },
    error: function () {
      console.error('Failed to load nav.html');
      console.log("error on navhome");
    }
  });
})
