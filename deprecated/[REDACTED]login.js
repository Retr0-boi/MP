$(document).ready(function () {
  $('#login-form').on('submit', function (e) {
    e.preventDefault(); 

    $.ajax({
      url: '[REDACTED]login.php',
      type: 'POST',
      data: $(this).serialize(),
      success: function (response) {
        console.log(response.txt);

        if (response === 'invalid pass') {
            $('#error-message').text("Invalid password.");
        } else if (response === 'invalid email') {
            $('#error-message').text("Invalid email.");
        } else {
            $('#error-message').text("Something went wrong.");
        }
      },
      error: function () {
        $('#error-message').text("An error occurred during the AJAX request.");
      }
    });
  });
});

// $(document).ready(function () {
//   $('#login-form').on('submit', function (e) {
//     e.preventDefault(); // Prevent default form submission
//     // var username=$('.email').val();
//     // var password=$('.password').val();
//     // console.log(username);
//     // console.log(email);
//     // Send an AJAX request to the PHP file
//     $.ajax({
//       url: 'login.php',
//       type: 'post',
//       data: $(this).serialize(),
//       success: function (response) {
//         console.log(response)
//         // Display the error message received from the server
//         if(response==='invalid pass') {
//             $('#error-message').text("invalid password.");
//         }
//         else if(response==='invalid email'){
//             $('#error-message').text("invalid email.");
//         }
//         else {
//             $('#error-message').text("this means wrong response.")
//         }
//       }
//     });
//   });
// });

