import pytest
from flask_login import current_user, login_user
from app.auth.views import validate_url


@pytest.fixture
def login_info():
    return dict(
        email='test@test.com',
        password='testtest'
    )


def test_login_success(client, login_info):
    r = client.post('/log-in', data=login_info)
    assert current_user.username == 'Tester'


def test_login_success_redirection(app, client, login_info):
    r = client.post('/log-in?redirect=/home', data=login_info)
    sv_name = app.config.get('SERVER_NAME') or 'localhost'

    assert r.status_code == 302
    assert r.location == f'http://{sv_name}/home'


def test_login_failed_flashed_messages(client, login_info):
    login_info['password'] = 'testtest_'
    r = client.post('/log-in', data=login_info)
    assert b'Incorrect email or password' in r.data


def test_log_out(client, login_info):
    client.post('/log-in', data=login_info)
    client.get('/log-out')
    assert current_user.is_authenticated is False


def test_log_out_redirection(app, client, login_info):
    client.post('/log-in', data=login_info)
    r = client.get('/log-out?redirect=/log-in')
    sv_name = app.config.get('SERVER_NAME') or 'localhost'

    assert current_user.is_authenticated is False
    assert r.status_code == 302
    assert r.location == f'http://{sv_name}/log-in'


def test_url_validator():
    assert validate_url('/log-in') == '/log-in'
    assert validate_url('google.com/log-in') == '/'
    assert validate_url(None) == '/'
