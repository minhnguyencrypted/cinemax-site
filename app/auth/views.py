from flask import render_template, redirect, url_for, flash, request
from flask_login import login_user, logout_user, current_user
from app import db
from app.forms import LoginForm, SignUpForm
from app.models import User
from . import auth_bp


@auth_bp.route('/log-in', methods=['GET', 'POST'])
def login():
    # if user is logged in but goes to /log-in
    if current_user.is_authenticated:
        return render_template('auth/try_to_login.html', name=current_user.username)

    form = LoginForm()
    if form.validate_on_submit():
        user = User.query.filter_by(email=form.email.data).first()
        if user is not None and user.verify_password(form.password.data):
            login_user(user, form.remember.data)
            next_ = request.args.get('redirect')
            return redirect(validate_url(next_))
        flash('Incorrect email or password')

    return render_template('auth/login.html', form=form)


@auth_bp.route('/sign-up', methods=['GET', 'POST'])
def signup():
    if current_user.is_authenticated:
        return render_template('auth/try_to_signup.html', name=current_user.username)

    form = SignUpForm()
    success = False
    if form.validate_on_submit():
        user = User(
            username=form.username.data,
            email=form.email.data,
            password=form.password.data
        )
        db.session.add(user)
        db.session.commit()
        success = True
    return render_template('auth/signup.html', form=form, success=success)


@auth_bp.route('/log-out')
def logout():
    logout_user()
    next_ = request.args.get('redirect')
    return redirect(validate_url(next_))


def validate_url(url: str) -> str:
    '''
    Simple url validation, if it's starts with '/', return the the original, otherwise, return '/'
    :param url:
    :return:
    '''
    if url is None or not url.startswith('/'):
        url = '/'
    return url
