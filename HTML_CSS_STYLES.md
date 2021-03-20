# HTML/CSS writing conventions
While writing HTML/CSS files, it is advised to follow one writing style, or a convention, in order
to make your work easier to read to other contributors.  
We know everybody is UNIX so we don't force you to follow it, but you're
encouraged to follow these conventions.

Here's what you should consider when writing HTML/CSS:

# General Rules
* All lines should not be longer than 80 characters, lines longer than this must be broken to a newline
* Indentations are equivalent to 4 space characters. For example: `id="name"`

# Tags & Attributes

## Lower-case tags
Even though HTML itself is case-insensitive in term of tags, attributes, properties, etc., we strongly encourage you to write
your **tags**, **attributes**, **properties**, etc. in lower-case, no capitalisation on any characters, including the initial one.  
**Example**

```
<html>
    <header>
    ....
    </header>
    ....
</html>
```

You should not mixing upper-case and lower-case characters like this: `<Html>` or `<HTML>` or `<hTmL>`.

## Quoting attributes and avoiding extra spaces
You should always quote your attributes with Double quote `"`, even when it's not separated by space character.  

**Example**: `id="name"`, `title="Go to website"`, `value="home_address"`

Spaces should not be placed to separate Equal sign `=` from other characters.

**Example**

    method="post"   <-- Right way
    method = "post" <-- Wrong way


Spaces should not be placed **after** opening parentheses and **before** closing parentheses.

**Example**

    value="Foo"    <-- Right way
    value=" Foo "  <-- Wrong way

## Breaking tags' attributes
Sometimes, an element contains a big number of attributes, results in over-length and unreadability for other contributors.  
In this circumstance, breaking tag attributes into individual lines is highly needed.

Let's take this example:
```
<a href="https://www.foo.com" style="color: red; font-size: 20px;" title="Foo website" target="_blank">Go to Foo website</a>
```
The element above should be broken into newlines by attributes, with 8-character indentation, like this:
```
<a href="https://www.foo.com"
        style="color: red; font-size: 20px;"
        title="Foo website"
        target="_blank">Go to Foo website</a>
```
Breaking lines by which attribute still depends on your personal choice, just make sure it's highly readable and follows the 8-character indentation. 

## Tag closing
Short answer: Always  
Long answer: You should always close HTML tags

# Naming conventions
Here's some advice on naming HTML/CSS attributes such as `id`, `name`, etc. : 

## Choosing name types:
* Single-character name: `i`, `j`, `k`, etc. - these kinds of name should be used only for short-time or temporary usage.
* Single-word name: `index`, `email`, `phone`, etc. - these kinds of name should be used for simple tasks' data/variables, which have no different variants, like `phone1`, `phone2`, etc. Except for arrays.
* Multi-word name: `srcAddr`, `targetAddr`, `currentUserId`, etc. - these kinds of name should be used for more complex tasks, when a large amount of data/variables are processed together.

## Name writing styles:
* For **Single-character** and **Single-word** names: no capitalisation at all.
* For **Multi-word** names:  
    * Each word can be either **not separate** or **separate** by Underscore `_`, the former is more advised 
 
      **Example**: `maxNumCount` or `max_num_count`
    * The very first letter of the name is not capitalised, while since the second word, only the initial character of these words  
(even acronyms), are capitalised. While writing with Underscore `_`, every characters can be lower-case.  

      **Example**: `customerId` or `customer_id`, not `CustomerId` or `customerID`

