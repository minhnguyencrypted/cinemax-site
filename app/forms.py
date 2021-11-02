from flask_wtf import FlaskForm
from wtforms import StringField, PasswordField, SubmitField, BooleanField
from wtforms.validators import DataRequired, Email, Length, EqualTo, Regexp, ValidationError
from app.models import User


class LoginForm(FlaskForm):
    email = StringField('Email', validators=[DataRequired(), Email()])
    password = PasswordField('Password', validators=[
        DataRequired(),
        Length(8, message='Password is too short (at least 8 characters).')])
    remember = BooleanField('Remember me')
    submit = SubmitField('Login')


class SignUpForm(FlaskForm):
    username = StringField('Username', validators=[
        DataRequired(),
        Regexp('^[a-zA-Z_](?!.*[.]{2})[a-zA-Z0-9_.]*[a-zA-Z0-9_]$', message='Invalid username'),
        Length(max=24, message='Username too long, at most 24 characters')
    ])
    email = StringField('Email', [DataRequired(), Email()])
    password = PasswordField('Password', [DataRequired(), Length(8, message='Password is too short')])
    confirm_password = PasswordField('Confirm password', [
        DataRequired(),
        EqualTo('password', message='Passwords don\'t match')
    ])
    submit = SubmitField('Sign Up')

    def validate_username(self, field):
        if User.query.filter_by(username=field.data).first():
            raise ValidationError('Username is already taken')

    def validate_email(self, field):
        if User.query.filter_by(email=field.data).first():
            raise ValidationError('Email is already registered')
