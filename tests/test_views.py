from flask import url_for, redirect, g
from unittest import TestCase
from flask_wtf.csrf import generate_csrf
from app import create_app, db
from app.models import User
from app.forms import LoginForm


class ViewTestCase(TestCase):
    def setUp(self) -> None:
        self.app = create_app(TESTING=True, WTF_CSRF_ENABLED=False)
        self.user = User(username='Test', email='test@test.com', password='testtest')
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

    def test_login_failed_flash_message(self):
        with self.app.test_client() as c:
            r = c.post('/log-in', data=dict(
                email='test@test.com',
                password='testtest_',
                submit='Login'
            ))
            self.assertIn(b'Incorrect email or password', r.data)

    # def test_redirect(self):
    #     response = redirect(url_for('main.index'))
    #     self.assertRedirects(response, url_for('main.index'))
