from os import getenv
from flask_migrate import Migrate
from app import create_app, db
from app.models.user_account import User
from app.models.product import Category, Product, Store
from app.forms import LoginForm, SignUpForm

app = create_app(getenv('FLASK_CONFIG', 'default'))
migrate = Migrate(app, db)


@app.shell_context_processor
def shell_context():
    return dict(
        db=db,
        User=User,
        Category=Category,
        Product=Product,
        Store=Store,
        LoginForm=LoginForm,
        SignUpForm=SignUpForm
    )
