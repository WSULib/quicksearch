<?php

session_start();


// Return the root directory relative to current PHP file
// which is /app
function root() {
     return dirname(__FILE__) . '/';
}

// Render a template
function render_template($locals, $fileName) {
    extract($locals);
    ob_start();
    include(root() . 'views/' . $fileName . '.php');
    return ob_get_clean();
}

// Render a view
function render($fileName, $templateName, $variableArray=array()) {
    $variableArray['content'] = render_template($variableArray, $fileName);
    print render_template($variableArray, $templateName);
}


?>