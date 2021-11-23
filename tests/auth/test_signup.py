import pytest
from app import db
from app.models.user_account import User
from flask_login import current_user

pytestmark = pytest.mark.filterwarnings('ignore::sqlalchemy.exc.SAWarning')


@pytest.fixture
def signup_info():
    yield dict(
        username='another_tester',
        email='another_tester@test.com',
        password='testtest',
        confirm_password='testtest'
    )

    # Clean up added user during test
    user = User.query.filter_by(username='another_tester').first()
    if user:
        db.session.delete(user)
        db.session.commit()


def test_successful_signup(client, signup_info):
    r = client.post('/sign-up', data=signup_info)
    assert r.status_code == 200
    assert b'Your account is created' in r.data

    user = User.query.filter_by(username=signup_info['username']).first()
    assert user is not None


def test_login_with_signed_up_account(client, signup_info):
    r = client.post('/sign-up', data=signup_info)
    assert b'Your account is created' in r.data

    user = User.query.filter_by(username=signup_info['username']).first()
    assert user is not None

    login_info = dict(
        email=signup_info['email'],
        password=signup_info['password']
    )
    r = client.post('/log-in', data=login_info)
    assert current_user.is_authenticated
