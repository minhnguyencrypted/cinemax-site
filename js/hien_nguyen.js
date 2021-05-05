var login_status = false;
var my_account_button = document.querySelector('#my_account_button');
my_account_button.addEventListener('click', checkIfLoginForMyaccount)


function checkIfLoginForMyaccount() {
  if (login_status == false) {
    my_account_button.href = 'myaccount/login.html'
  }
  else {
    my_account_button.href = 'myaccount/my_account.html'
  }
}


