from os import getenv
from flask_migrate import Migrate
from app import create_app, db

app = create_app(getenv('FLASK_CONFIG', 'default'))
migrate = Migrate(app, db)


@app.shell_context_processor
def shell_context():
    from app.models import User
    from app.forms import LoginForm

    return {
        'db': db,
        'User': User,
        'LoginForm': LoginForm
    }


@app.cli.command()
def test():
    from unittest import TestLoader, TextTestRunner

    tests = TestLoader().discover('tests')
    TextTestRunner().run(tests)
