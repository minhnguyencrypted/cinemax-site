//signup-form variables
var signup_form = document.querySelector('#signup_form');
var signup_email = document.querySelector('#signup_form #email');
var signup_phone_number = document.querySelector('#signup_form #p_number');
var signup_password = document.querySelector('#signup_form #pw');
var signup_retype_password = document.querySelector('#signup_form #re_pw');
var signup_first_name = document.querySelector('#signup_form #fname');
var signup_last_name = document.querySelector('#signup_form #lname');
var signup_address = document.querySelector('#signup_form #address');
var signup_city = document.querySelector('#signup_form #city');
var signup_zipcode = document.querySelector('#signup_form #zipcode');
var signup_store_owner = document.querySelector('#signup_form #store_owner');
var signup_shopper = document.querySelector('#signup_form #shopper');

var signup_store_owner_section = document.querySelector('.store_owner_section');

//contact-form variables
var contact_form = document.querySelector('#contact_form');
var contact_email = document.querySelector('#contact_form #email');
var contact_purpose = document.querySelector('#contact_form #purpose');
var contact_phone_number = document.querySelector('#contact_form #p_number');
var contact_radio = document.querySelector('.contact_radio');



//add event listener
signup_form.addEventListener('submit', (e) => {
  e.preventDefault();
  checkInputsSignupForm()
});

contact_form.addEventListener('submit', (e) => {
  e.preventDefault();
  checkInputsContactForm();
});

signup_shopper.addEventListener('click', () => {
  signup_store_owner_section.style.visibility = 'hidden';
});

signup_store_owner.addEventListener('click', () => {
  signup_store_owner_section.style.visibility = 'visible';
});




function checkInputsContactForm() {
  // get values back from inputs
  var emailValue = contact_email.value.trim();
  var phoneNumberValue = contact_phone_number.value.trim();

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
}



function checkInputsSignupForm() {
  // get values back from inputs
  var emailValue = signup_email.value.trim();
  var phoneNumberValue = signup_phone_number.value.trim();
  var passwordValue = signup_password.value.trim();
  var retypePasswordValue = signup_retype_password.value.trim();
  var firstNameValue = signup_first_name.value.trim();
  var lastNameValue = signup_last_name.value.trim();
  var addressValue = signup_address.value.trim();
  var cityValue = signup_city.value.trim();
  var zipcodeValue = signup_zipcode.value.trim();


  //check email
  if(emailValue === '') {
    //show error
    //add error class
    setErrorFor(signup_email, 'Email cannot be empty');
  } 
  else if (isEmail(emailValue) === false){
    setErrorFor(signup_email, 'The email entered is not valid');
  }
  else {
    setSuccessFor(signup_email);
  }
  
  //check phone number
  if(phoneNumberValue === '') {
    //show error
    //add error class
    setErrorFor(signup_phone_number, 'Phone number cannot be empty');
  } 
  else if(isPhoneNumber(phoneNumberValue) === false) {
    setErrorFor(signup_phone_number, 'Phone number is not valid')
  }
  else {
    setSuccessFor(signup_phone_number);
  }

  //check password
  if(passwordValue === '') {
    //show error
    //add error class
    setErrorFor(signup_password, 'Password cannot be empty');
  } 
  else if(isPassword(passwordValue) === false) {
    setErrorFor(signup_password, 'The password that you entered is not valid');
  }
  else {
    setSuccessFor(signup_password);
  }

  //check retype password
  if(retypePasswordValue === '') {
    //show error
    //add error class
    setErrorFor(signup_retype_password, 'Password cannot be empty');
  } 
  else if(retypePasswordValue != passwordValue) {
    setErrorFor(signup_retype_password, 'Retype password does not match the password');
  }
  else {
    setSuccessFor(signup_retype_password);
  }

  //check first name
  if(moreThanThreeChar(firstNameValue) === false) {
    setErrorFor(signup_first_name, 'First name should contains more than 3 characters');
  }

  else {
    setSuccessFor(signup_first_name)
  }

  //check last name
  if(moreThanThreeChar(lastNameValue) === false) {
    setErrorFor(signup_last_name, 'Last name should contains more than 3 characters');
  }
  else {
    setSuccessFor(signup_last_name)
  }

  //check address
  if(moreThanThreeChar(addressValue) === false) {
    setErrorFor(signup_address, 'Your address should contains more than 3 characters');
  }
  else {
    setSuccessFor(signup_address)
  }

  //check first city
  if(moreThanThreeChar(cityValue) === false) {
    setErrorFor(signup_city, 'City name should contains more than 3 characters');
  }
  else {
    setSuccessFor(signup_city)
  }

  //check zipcode
  if(/^[0-9]{4,6}$/.test(zipcodeValue) === false) { 
    setErrorFor(signup_zipcode, 'Zipcode should countains 4 to 6 numbers');
  }
  else {
    setSuccessFor(signup_zipcode)
  }
};





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

function isPassword(password) {
  let pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
  return pattern.test(password)
}

function moreThanThreeChar(string) {
  let pattern = /^[0-9a-zA-Z]{3,}$/
  return pattern.test(string)
}