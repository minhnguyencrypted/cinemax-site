import unittest
from app.models import User


class PasswordTestCase(unittest.TestCase):
    def setUp(self) -> None:
        self.password = '8j23-_)+@#)'

    def test_password_getter(self):
        user = User(password=self.password)
        with self.assertRaises(AttributeError):
            _ = user.password

    def test_password_setter(self):
        user = User(password='adf')
        self.assertIsNotNone(user.password_hash)

    def test_verify_hash(self):
        user = User(password=self.password)
        self.assertTrue(user.verify_password(self.password))

    def test_different_hash(self):
        user1 = User(password=self.password)
        user2 = User(password=self.password)
        self.assertNotEqual(user1.password_hash, user2.password_hash)
