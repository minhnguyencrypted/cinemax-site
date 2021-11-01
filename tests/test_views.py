from unittest import TestCase
from flask import url_for
from flask_login import current_user
from app import create_app, db
from app.models import User


class ViewTestCase(TestCase):
    def setUp(self) -> None:
        self.app = create_app(TESTING=True, WTF_CSRF_ENABLED=False)
        self.user = User(username='Tester', email='test@test.com', password='testtest')
        db.session.add(self.user)
        db.session.commit()

    def tearDown(self) -> None:
        db.session.delete(self.user)
        db.session.commit()

    def test_index(self):
        with self.app.test_client() as c:
            r = c.get('/')
            self.assertEqual(r.status_code, 200)

    def test_login_success_redirection(self):
        with self.app.test_client() as c:
            r = c.post('/log-in', data=dict(
                email='test@test.com',
                password='testtest',
                submit='Login'
            ))
            url = url_for('main.index')
            sv_name = self.app.config['SERVER_NAME'] or 'localhost'
            self.assertEqual(r.status_code, 302)
            self.assertEqual(r.location, f'http://{sv_name}{url}')
            self.assertEqual(current_user.username, 'Tester')

    def test_login_failed_flash_message(self):
        with self.app.test_client() as c:
            r = c.post('/log-in', data=dict(
                email='test@test.com',
                password='testtest_',
                submit='Login'
            ))
            self.assertIn(b'Incorrect email or password', r.data)

    def test_logout(self):
        with self.app.test_client() as c:
            c.post('/log-in', data=dict(
                email='test@test.com',
                password='testtest',
                submit='Login'
            ))
            c.get('/log-out')
            self.assertFalse(current_user.is_authenticated)
