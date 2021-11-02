from flask import render_template, redirect, url_for, flash, request
from flask_login import login_user, logout_user
from app import db
from app.forms import LoginForm, SignUpForm
from app.models import User
from . import auth_bp


@auth_bp.route('/log-in', methods=['GET', 'POST'])
def login():
    form = LoginForm()
    if form.validate_on_submit():
        user = User.query.filter_by(email=form.email.data).first()
        if user is not None and user.verify_password(form.password.data):
            login_user(user, form.remember.data)
            next_ = request.args.get('next')
            if next_ is None or not next_.startswith('/'):
                next_ = url_for('main.index')
            return redirect(next_)
        flash('Incorrect email or password')

    return render_template('login.html', form=form)


@auth_bp.route('/sign-up', methods=['GET', 'POST'])
def signup():
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
    return render_template('signup.html', form=form, success=success)


@auth_bp.route('/log-out')
def logout():
    logout_user()
    return redirect(url_for('main.index'))
