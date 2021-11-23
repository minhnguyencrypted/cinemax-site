from datetime import datetime
from app import db


class Category(db.Model):
    __tablename__ = 'categories'
    id = db.Column(db.Integer, primary_key=True, autoincrement=True)
    name = db.Column(db.String(200), unique=True)
    store = db.relationship('Store', backref='category')


class Product(db.Model):
    __tablename__ = 'products'
    id = db.Column(db.Integer, primary_key=True, autoincrement=True)
    name = db.Column(db.String(200), index=True)
    created = db.Column(db.DateTime(), default=datetime.utcnow())
    price = db.Column(db.Float)
    store_id = db.Column(db.Integer, db.ForeignKey('stores.id'))
    featured_store = db.Column(db.Boolean)
    featured_mall = db.Column(db.Boolean)


class Store(db.Model):
    __tablename__ = 'stores'
    id = db.Column(db.Integer, primary_key=True, autoincrement=True)
    name = db.Column(db.String(200), index=True)
    created = db.Column(db.DateTime(), default=datetime.utcnow())
    featured = db.Column(db.Boolean)
    category_id = db.Column(db.Integer, db.ForeignKey('categories.id'))
    product = db.relationship('Product', backref='store')
