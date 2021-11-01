import unittest
from app import create_app


class FactoryTestCase(unittest.TestCase):
    def test_custom_config(self):
        app = create_app(foo='foo', bar='bar', baz='baz')
        self.assertIn('foo', app.config)
        self.assertIn('bar', app.config)
        self.assertIn('baz', app.config)
