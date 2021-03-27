# Contributing to Cinemax Site
Some conventions and rules you should follow when contributing to the project.

When you start contributing to the project, you should create your own branch and commit your changes to it. Once you're ready, feel free to make a pull request. First and foremost, here's what you should follow.


## Commit messages
Commit messages contains 2 parts: **Title** and **Body**

### Title
Title should be like this: `<type> <Subject>`, where:

`<type>` can be: 

* `Add` : for adding new feature
* `Fix` : for fixing bug
* `Change` / `Replace` / `Rewrite` : for changing some details
* `Improve` : for improving current features, algorithms, contents, etc.
* Other types can be accepted, as long as they describe a sensible type of the commit

`<Subject>` should be the target of the commit (to be added, fixed, changed, etc.) and should be less than 50 characters, no need to end with `.`

**Example**:
          
    Add Submit button
 
### Body

Body is not strictly required, it's only needed when extra details and explanations are needed.  
There's must be one blank line between **Title** and **Body**, each line of text shouldn't be longer than 72 characters.    

Bullet points should be used when doing this, starting with  `-`.


**Example**:
    
    Add Submit button

    - Submit button has increased size for better user experience
    - Large font size for readability
    - Modern design for better appearance

## Branches and Pull Requests
Your branch name should be appropriate regarding what you are doing or which are your working on.  
Something like `cutekitty42`, `hackerman2021`, etc. is not allowed.

Pull requests are all welcomed. However, remember to describe your pull request and make sure your works are done well.

### Default branches for developments
Default branches are where all contributors working together.
* `main`: for well done and completed source codes, be careful when making pull requests to this branch.
* `dev`: for developing and implementing new features, there are rooms for errors here.
* `fix`: for bug fixings, once your fix works, merge it back to `dev` to prepare for pull requests.
* `[dev/fix/...]_<specific-field>`: for works on specified field such as: `fix_input_form`

### Personal branches
Feel free to create your own branch to avoiding conflicts with others' works, remember to name your branch appropriately, here's some suggestion on naming based on default names:
* `<your-name>_<what-youre-working>`: for your own branch on specified work, such as: `john_input_form`
