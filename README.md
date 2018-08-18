# View Source
PHP script that shows the HTML source code of a website with syntax highlighting and code beautifying for use on mobile devices.

## Setup
Setup a web server and upload `index.php`.

Download the latest version of GeSHi (Generic Syntax Highlighter) from the official website http://qbnz.com/highlighter/ and place the uncompressed folder `geshi` in the same directory of `index.php`.

On the mobile device, create a bookmark with an approperiate name e.g. `View Source`. In the URL field, enter the contents of `bookmark.js`, making sure to replace `localhost` with the URL of the web server.

## Customise

### Word Wrap
To prevent word wrap, removing the following code from `index.php`
```css
pre {
    overflow: auto;
    white-space: pre-wrap;
    word-wrap: break-word;
}
```

### Beautify HTML
Beautify HTML has many options to customise how the HTML is unminified. The main options are: `indent_inner_html` which affects if the `<head>` and `<body>` tags are indented from the `<html>` tag, `unformatted` which lists all of the HTML tags which should have their formatting preserved and `indent_scripts` which defines how scripts should be indented, with the options `keep`, `seperate` or `normal`. For now, the `script` and `style` tags have been added to the `unformatted` until a better solution to unminify the CSS and JavaScript can be found.
```php
$beautify = new Beautify_Html(array(
    'indent_inner_html' => true,
    'indent_char' => " ",
    'indent_size' => 2,
    'wrap_line_length' => 32786,
    'unformatted' => ['code', 'pre', 'script', 'style'],
    'preserve_newlines' => false,
    'max_preserve_newlines' => 32786,
    'indent_scripts' => 'normal'
));
```

## Future Development
- Find a more reliable syntax highlighter than can handle CSS and JavaScript embedded in HTML
- Extend code beautifying for CSS and JavaScript
- Show source code in pop-up above webpage instead of new tab

## Credits
Original project based upon a script made by Ole Michelsen at https://github.com/omichelsen/View-Source

Beautify HTML created by Ivan Weilder at https://github.com/ivanweiler/beautify-html under the MIT license

