from os import environ
from app import create_app

app = create_app(environ.get('FLASK_CONFIG', 'default'))


@app.shell_context_processor
def shell_context():
    pass
