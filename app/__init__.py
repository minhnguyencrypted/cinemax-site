from flask import Flask
from flask_sqlalchemy import SQLAlchemy
from flask_login import LoginManager
from .config import config

db = SQLAlchemy()
login_manager = LoginManager()
login_manager.login_view = 'auth/login'


def create_app(config_name = 'default', **kwargs):
    app = Flask(__name__)
    app.config.from_object(config[config_name])
    for key, value in kwargs.items():
        app.config[key] = value

    db.init_app(app)
    login_manager.init_app(app)

    from .main import main_bp
    app.register_blueprint(main_bp)

    from .auth import auth_bp
    app.register_blueprint(auth_bp)

    return app
