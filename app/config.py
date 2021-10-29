from os import environ, urandom
from urllib.parse import quote_plus


class BaseConfig:
    SECRET_KEY = environ.get('SECRET_KEY', urandom(32))
    SQLALCHEMY_TRACK_MODIFICATIONS = False
    DB_USER = environ.get('DB_USER')
    DB_PWD = environ.get('DB_PWD')

    @staticmethod
    def init_app(app):
        pass


class DevelopmentConfig(BaseConfig):
    DEBUG = True
    DEV_DB_ADDR = environ.get('DEV_DB_ADDR', 'localhost/dev_mall')
    credentials = f'{BaseConfig.DB_USER}:{quote_plus(BaseConfig.DB_PWD)}'
    SQLALCHEMY_DATABASE_URI = f'mysql://{credentials}@{DEV_DB_ADDR}'


class ProductionConfig(BaseConfig):
    DEBUG = True
    PROD_DB_ADDR = environ.get('DEV_DB_ADDR', 'localhost/prod_mall')
    credentials = f'{BaseConfig.DB_USER}:{quote_plus(BaseConfig.DB_PWD)}'
    SQLALCHEMY_DATABASE_URI = f'mysql://{credentials}@{PROD_DB_ADDR}'


config = {
    'development': DevelopmentConfig,
    'production': ProductionConfig,
    'default': DevelopmentConfig
}
