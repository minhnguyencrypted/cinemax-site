import pytest
from app.forms import LoginForm


@pytest.fixture
def email():
    return 'fooatbardotcom'


@pytest.fixture
def password():
    return 'asdfasd'


@pytest.fixture
def form(app):
    with app.test_request_context():
        yield LoginForm()


def test_email_validator(form, email):
    form.email.data = email
    form.validate()
    assert len(form.email.errors) != 0


def test_password_validator(form, password):
    form.password.data = password
    form.validate()
    assert len(form.password.errors) != 0
    assert 'Password is too short (at least 8 characters).' in form.password.errors
