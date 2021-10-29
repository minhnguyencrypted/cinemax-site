from os import getenv
from app import create_app
from app.models import User

app = create_app(getenv('FLASK_CONFIG', 'default'))


@app.shell_context_processor
def shell_context():
    return {
        'User': User
    }

