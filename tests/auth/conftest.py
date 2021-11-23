import pytest
from app import create_app, db
from app.models.user_account import User


@pytest.fixture
def app():
    return create_app(TESTING=True, WTF_CSRF_ENABLED=False)


@pytest.fixture
def user():
    return User(
        username='Tester',
        email='test@test.com',
        password='testtest'
    )


@pytest.fixture
def client(app, user):
    with app.app_context():
        db.session.add(user)
        db.session.commit()

        with app.test_client() as client:
            yield client

        db.session.delete(user)
        db.session.commit()
