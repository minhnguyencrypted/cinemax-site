import unittest
from re import fullmatch
from unittest import TestCase
from app import create_app, db
from app.forms import LoginForm, SignUpForm
from app.models import User


class LoginFormValidatorCase(TestCase):
    def setUp(self) -> None:
        self.app = create_app(TESTING=True)
        self.email = 'fooatbardotcom'

    def test_email_validator(self):
        with self.app.test_request_context():
            form = LoginForm()
            form.email.data = self.email
            self.assertFalse(form.email.validate(form))

    def test_email_errors(self):
        with self.app.test_request_context():
            form = LoginForm()
            form.email.data = self.email
            form.email.validate(form)
            self.assertIsNot(len(form.email.errors), 0)


class SignUpFormValidatorTestCase(TestCase):
    def setUp(self) -> None:
        self.app = create_app(TESTING=True)
        self.user = User(username='Tester', email='test@test.com')
        db.session.add(self.user)
        db.session.commit()

        self.valid_usernames = [
            'asdf',
            'asdf1234',
            '__init__',
            '__init.__',
        ]
        self.invalid_usernames = [
            '000asdf',
            '0000000',
            'asd+_I@#_)K',
            'a......a',
        ]

    def tearDown(self) -> None:
        db.session.delete(self.user)
        db.session.commit()

    def test_username_regex(self):
        with self.app.test_request_context():
            form = SignUpForm()

            # Valid usernames
            for name in self.valid_usernames:
                form.username.data = name
                self.assertTrue(form.username.validate(form))

            # Invalid usernames
            for name in self.invalid_usernames:
                form.username.data = name
                self.assertFalse(form.username.validate(form))

    def test_taken_username(self):
        with self.app.test_request_context():
            form = SignUpForm()
            form.username.data = 'Tester'
            self.assertFalse(form.validate())
            self.assertIn('Username is already taken', form.username.errors)

    def test_taken_email(self):
        with self.app.test_request_context():
            form = SignUpForm()
            form.email.data = 'test@test.com'
            self.assertFalse(form.validate())
            self.assertIn('Email is already registered', form.email.errors)

    def test_password_not_match(self):
        with self.app.test_request_context():
            form = SignUpForm()
            form.password.data = 'test'
            form.confirm_password.data = 'test_'
            self.assertFalse(form.confirm_password.validate(form))
            self.assertIn('Passwords don\'t match', form.confirm_password.errors)
