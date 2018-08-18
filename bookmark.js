javascript: (function() {
    var w = window.open("about:blank");
    var d = w.document;
    d.write("<!DOCTYPE html><html><head></head><body></body></html>"), d.close();
    var f = d.createElement("form");
    f.setAttribute("method", "post"), f.setAttribute("action", "http://localhost/?url=" + encodeURIComponent(location.href));
    var i = d.createElement("input");
    i.setAttribute("type", "hidden"), i.setAttribute("name", "DOM"), i.setAttribute("value", encodeURIComponent(document.documentElement.innerHTML)), d.body.appendChild(f).appendChild(i), f.submit();
})()