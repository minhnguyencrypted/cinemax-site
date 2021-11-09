from app import create_app


def test_custom_config():
    app = create_app(foo='foo', bar='bar', baz='baz')
    assert app.config.get('foo') == 'foo'
    assert app.config.get('bar') == 'bar'
    assert app.config.get('baz') == 'baz'
