from unittest import TestCase
from flask_login import current_user
from app import create_app, db
from app.models import User


class SignUpTestCase(TestCase):
    def setUp(self) -> None:
        self.app = create_app(TESTING=True, WTF_CSRF_ENABLED=False)
        self.user = User(
            username='tester',
            email='test@test.com'
        )
        self.new_user = dict(
            username='Tester',
            email='tester@test.com',
            password='testtest',
            confirm_password='testtest',
            submit='Sign Up'
        )
        self.added_emails = []
        db.session.add(self.user)
        db.session.commit()

        # Users added during testing
        self.test_users = [self.user]

    def tearDown(self) -> None:
        for user in self.test_users:
            db.session.delete(user)
        db.session.commit()

    def test_valid_account(self):
        with self.app.test_client() as c:
            uinfo = self.new_user
            r = c.post('/sign-up', data=uinfo)
            u = User.query.filter_by(email=uinfo['email']).first()
            if u:
                self.test_users.append(u)

            self.assertEqual(r.status_code, 200)
            self.assertIsNotNone(u)

    def test_taken_username(self):
        with self.app.test_client() as c:
            uinfo = self.new_user
            uinfo['username'] = self.user.username
            r = c.post('/sign-up', data=uinfo)

            self.assertEqual(r.status_code, 200)
            self.assertIn(b'Username is already taken', r.data)
            self.assertNotEqual(
                User.query
                    .filter_by(username=self.user.username)
                    .first()
                    .email,
                uinfo['email']
            )

    def test_taken_email(self):
        with self.app.test_client() as c:
            uinfo = self.new_user
            uinfo['email'] = self.user.email
            r = c.post('/sign-up', data=uinfo)

            self.assertEqual(r.status_code, 200)
            self.assertIn(b'Email is already registered', r.data)
            self.assertNotEqual(
                User.query
                    .filter_by(email=self.user.email)
                    .first()
                    .username,
                uinfo['username']
            )

    def test_login_created_account(self):
        with self.app.test_client() as c:
            uinfo = self.new_user
            uinfo['username'] = 'logintest'
            uinfo['email'] = 'login@test.com'
            c.post('/sign-up', data=uinfo)

            r = c.post('/log-in', data=dict(
                email=uinfo['email'],
                password=uinfo['password'],
                submit='Log In'
            ))
            u = User.query.filter_by(email=uinfo['email']).first()
            if u:
                self.test_users.append(u)
            self.assertTrue(current_user.is_authenticated)
