# View Source
PHP script that shows the HTML source code of a website with syntax highlighting and code beautifying for use on mobile devices

Based upon https://github.com/omichelsen/View-Source

## Setup
Setup a web server and upload `index.php`

Download the latest version of GeSHi (Generic Syntax Highlighter) from the official website http://qbnz.com/highlighter/ and place the uncompressed folder `geshi` in the same directory of `index.php`

On the mobile device, create a bookmark with an approperiate name e.g. `View Source`. In the URL field, enter the contents of `bookmark.js`, making sure to replace `localhost` with the URL of the web server

### Word Wrap
To prevent word wrap, removing the following code from `index.php`
```css
pre {
    overflow: auto;
    white-space: pre-wrap;
    word-wrap: break-word;
}
```

## Future Development
- Extend syntax highlighting for CSS and JavaScript
- Extend code beautifying for CSS and JavaScript
- Create link and image previewer for hyperlinks
- Show source code in pop-up above webpage instead of new tab
