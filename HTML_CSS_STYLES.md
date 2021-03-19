# HTML/CSS writing conventions
While writing HTML/CSS files, it is advised to follow one writing style, or a convention, in order
to make your work easier to read to other contributors.  
We know everybody is UNIX so we don't force you to follow it, but you're
encouraged to follow these conventions.

Here's what you should consider when writing HTML/CSS:

# General Rules
* All lines should not be longer than 80 characters, lines longer than this must be broken to a newline
* All tags, attribute, names (except some initial characters) must be all written in lower-case  
(exception:
	`<!DOCTYPE html>`)
* Indentations are 4 characters
* Using double quote `"` on every attribute values, even when the value doesn't include blank
space. For example: `id="name"`
* In CSS style attribute, all pairs of property and value must end with a semicolon `;`, this is optional for the last pair, if you want to make HTML more like a programming language, just do it.

# Tags

## Tag case-sensitivity
Even though HTML itself is case-insensitive in term of tags, but we strongly encourage you to write
your tags in lowercase, no capitalisation on any characters, including the first one.  
**Example**

```
<html>
    <header>
    ....
    </header>
    ....
</html>
```

You should not use something like: `<Html>` or `<HTML>` or `<hTmL>`

## Tag closing
Short answer: Always  
Long answer: You should always close HTML tags

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
    **Example**: `maxNumCount` or `max_Num_Count`
    * The very first letter of the name is not capitalised, while since the second word, only the initial character of these words  
(even acronyms), are capitalised  
    **Example**: `customerId`, not `CustomerId` or `customerID`

