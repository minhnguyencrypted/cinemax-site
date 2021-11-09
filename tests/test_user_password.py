import pytest
from app.models import User


@pytest.fixture
def password():
    return '8j23-_)+@#)'


def test_password_getter(password):
    user = User(password=password)
    with pytest.raises(AttributeError):
        _ = user.password


def test_password_setter(password):
    user = User(password=password)
    assert user.password_hash is not None


def test_verify_hash(password):
    user = User(password=password)
    assert user.verify_password(password) == True


def test_different_hash(password):
    user1 = User(password=password)
    user2 = User(password=password)
    assert user1.password_hash != user2.password_hash
