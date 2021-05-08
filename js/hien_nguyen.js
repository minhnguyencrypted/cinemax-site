localStorage.setItem('login_status', 'true');

// variables and constant
var login_status = JSON.parse(localStorage.getItem('login_status').toLocaleLowerCase());
var my_account_button = document.querySelector('#my_account_button');
var login_submit_button = document.querySelector('#login_submit_button');
var my_account_email = document.querySelector('#my_account_email');
var login_form = document.querySelector('#login_form');


// Add event listener
my_account_button.addEventListener('click', myAccountRedirect);
login_form.addEventListener('submit', login_protocol);
login_form.addEventListener('submit', () => {
  window.location('my_account.html');
});



// define functions 
function myAccountRedirect() {
  if (login_status == false) {
    my_account_button.href = 'myaccount/login.html';
  }
  else {
    my_account_button.href = 'myaccount/my_account.html';
  }
}

function login_protocol() {
  var login_form_data = Array.from(document.querySelectorAll('#login_form input')).reduce((acc, input) => ({ ...acc, [input.id]: input.value}), {});
  localStorage.setItem('email', login_form_data.email);
  localStorage.setItem('password', login_form_data.password);
  localStorage.setItem('login_status', 'true');
}







