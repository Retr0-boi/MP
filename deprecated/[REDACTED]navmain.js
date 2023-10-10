$(function() {
    $.ajax({
      url: 'navmain.html',
      dataType: 'html',
      success: function(data) {
        $('#navigation').html(data);
      },
      error: function() {
        console.error('Failed to load nav.html');
      }
    });
  })