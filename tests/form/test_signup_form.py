import pytest
from app import create_app, db
from app.models.user_account import User
from app.forms import SignUpForm


@pytest.fixture
def rq_context(app):
    user = User(username='Tester', email='test@test.com')
    with app.app_context():
        db.session.add(user)
        db.session.commit()

        with app.test_request_context() as context:
            yield context

        db.session.delete(user)
        db.session.commit()


@pytest.fixture
def form(rq_context):
    with rq_context:
        form = SignUpForm()
        yield form


@pytest.fixture
def valid_usernames():
    return [
        'asdf',
        'asdf1234',
        '__init__',
        '__init.__',
        'tiger_900.gt.pro'
    ]


@pytest.fixture
def invalid_usernames():
    return [
        '000asdf',
        '0000000',
        'asd+_I@#_)K',
        'a......a',
        '.foobar.',
        'foo_bar_123.456.'
    ]


def test_taken_email(form):
    form.email.data = 'test@test.com'
    form.validate()
    assert 'Email is already registered' in form.email.errors


def test_taken_username(form):
    form.username.data = 'Tester'
    form.validate()
    assert 'Username is already taken' in form.username.errors


def test_username_regex(form, valid_usernames, invalid_usernames):
    # Valid usernames
    for username in valid_usernames:
        form.username.data = username
        form.validate()
        assert len(form.username.errors) == 0

    # Invalid usernames
    for username in invalid_usernames:
        form.username.data = username
        form.validate()
        assert 'Invalid username' in form.username.errors
    