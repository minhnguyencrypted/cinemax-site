from os import getenv
from flask_migrate import Migrate
from app import create_app, db
from app.models import User

app = create_app(getenv('FLASK_CONFIG', 'default'))
migrate = Migrate(app, db)


@app.shell_context_processor
def shell_context():
    return {
        'db': db,
        'User': User
    }


@app.cli.command()
def test():
    from unittest import TestLoader, TextTestRunner

    tests = TestLoader().discover('tests')
    TextTestRunner(verbosity=2).run(tests)
