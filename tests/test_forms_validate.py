import unittest
from flask import Flask
from os import urandom
from app.forms import LoginForm


class FormValidatorCase(unittest.TestCase):
    def setUp(self) -> None:
        self.app = Flask(__name__)
        self.app.config['SECRET_KEY'] = urandom(32)
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
            self.assertIsNotNone(form.email.errors)
