<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @yield('register')

<script>
const form = document.getElementById('form');
const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const gmail = document.getElementById('gmail');
const phone = document.getElementById('phone');
const profile_photo = document.getElementById('profile_photo');

// Show input error message
function showError(input, message) {
  const formControl = input.parentElement;
  formControl.className = 'form-control error';
  const small = formControl.querySelector('small');
  small.innerText = message;
}

// Show success outline
function showSuccess(input) {
  const formControl = input.parentElement;
  formControl.className = 'form-control success';
}

// Check email is valid
function checkEmail(input) {
  const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if (re.test(input.value.trim())) {
    showSuccess(input);
    a = 1;
  } else {
    showError(input, 'Email is not valid');
  }
}

// Check Gmail is valid
function checkGmail(input) {
  const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if (re.test(input.value.trim())) {
    showSuccess(input);
    b = 1;
  } else {
    showError(input, 'Gmail is not valid');
  }
}

// Check phone is valid
function checkphone(input) {
    const re = new RegExp("^\\+[1-9]{1}[0-9]{0,2}-[2-9]{1}[0-9]{2}-[2-9]{1}[0-9]{2}-[0-9]{4}$");
  if (re.test(input.value.trim())) {
    showSuccess(input);
    c = 1;
  } else {
    showError(input, 'phone is not valid');
  }
}


// Check required fields
function checkRequired(inputArr) {
  let isRequired = false;
  inputArr.forEach(function(input) {
    if (input.value.trim() === '') {
      showError(input, `${getFieldName(input)} is required`);
      isRequired = true;
    } else {
      showSuccess(input);
      d = 1;
    }
  });

  return isRequired;
}

// Check input length
function checkLength(input, min, max) {
  if (input.value.length < min) {
    showError(
      input,
      `${getFieldName(input)} must be at least ${min} characters`
    );
  } else if (input.value.length > max) {
    showError(
      input,
      `${getFieldName(input)} must be less than ${max} characters`
    );
  } else {
    showSuccess(input);
    e = 1;
  }
}

// Check passwords match
/*function checkPasswordsMatch(input1, input2) {
  if (input1.value !== input2.value) {
    showError(input2, 'Passwords do not match');
  }
}*/

// Get fieldname
function getFieldName(input) {
  return input.id.charAt(0).toUpperCase() + input.id.slice(1);
}

// Event listeners
form.addEventListener('submit', function(e) {
  e.preventDefault();

  if(checkRequired([username, email, password, gmail,phone])){
    checkLength(username, 3, 15);
    checkLength(password, 6, 25);
    checkEmail(email);
    checkGmail(gmail);
    checkphone(phone);

  }
  var formData = new FormData($('#form')[0]);

$.ajax({
    type: 'post',
    enctype: 'multipart/form-data',
    url: "{{route('registration.store')}}",
    data: formData,
    processData: false,
    contentType: false,
    cache: false,
    success: function (data) {
      switch (data.status) {
  case 0:
       
        showError(email, 'Email Alredy Exists .');
  break; 
  case 1:
        
        showError(username, 'Name Alredy Exists .');
  break;
  case 2:

      showError(gmail, 'Gmail Alredy Exists .');
  break;

  case 3:

      showError(phone, 'Phone Alredy Exists .');
  break;
  case true:
      $('#success_msg').show();
      
      document.getElementById("form").reset();  
  break;
    

}}});});



</script>

</body>
</html>