//contact-form variables
var contact_form = document.querySelector('#contact_form');
var contact_email = document.querySelector('#contact_form #email');
var contact_purpose = document.querySelector('#contact_form #purpose');
var contact_phone_number = document.querySelector('#contact_form #p_number');
var contact_radio = document.querySelectorAll('.contact_radio');
var contact_radio_group = document.querySelector('#contact_radio_group');

contact_form.addEventListener('submit', (e) => {
  e.preventDefault();
  checkInputsContactForm();
});

function checkInputsContactForm() {
  // get values back from inputs
  var emailValue = contact_email.value.trim();
  var phoneNumberValue = contact_phone_number.value.trim();
  var purposeValue = contact_purpose.value.trim();

  //check purpose
  

  //check email
  if(emailValue === '') {
    //show error
    //add error class
    setErrorFor(contact_email, 'Email cannot be empty');
  } 
  else if (isEmail(emailValue) === false){
    setErrorFor(contact_email, 'The email entered is not valid');
  }
  else {
    setSuccessFor(contact_email);
  }

  //check phone number
  if(phoneNumberValue === '') {
    //show error
    //add error class
    setErrorFor(contact_phone_number, 'Phone number cannot be empty');
  } 
  else if(isPhoneNumber(phoneNumberValue) === false) {
    setErrorFor(contact_phone_number, 'Phone number is not valid')
  }
  else {
    setSuccessFor(contact_phone_number);
  }

  //check radio
  // if(contact_radio[0].checked == false && contact_radio[1].checked == false) {
  //   setErrorFor(contact_radio_group, 'Please choose at least one radio');
  // }

  
}

//define the functions
function setErrorFor(input, message) {
  var formControl = input.parentElement.parentElement; //.form-control
  var small = formControl.querySelector('small');

  //add error messgae
  small.innerHTML = message;

  //add error classes
  formControl.className = 'row form-control validation-error'
}

function setSuccessFor(input) {
  var formControl = input.parentElement.parentElement; //.form-control
  //add class
  formControl.className = 'row form-control validation-success';
}

function isEmail(email) {
  let pattern =   /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
  return pattern.test(email)
}

function isPhoneNumber(phone_number) {
  let pattern = /(84|0[3|5|7|8|9])+([0-9-.]{8,10})\b/;
  return pattern.test(phone_number)
}