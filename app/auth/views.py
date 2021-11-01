from flask import render_template, redirect, url_for, flash, request
from flask_login import login_user, logout_user
from app.forms import LoginForm
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


@auth_bp.route('/log-out')
def logout():
    logout_user()
    return redirect(url_for('main.index'))
