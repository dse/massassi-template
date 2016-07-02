<?php
/**
 * This is a native PHP templating system written in 51 lines of PHP.
 *
 * Maintained by Darren Embry <dse@webonastick.com>
 * https://github.com/dse/massassi-template/
 *
 * See also: http://www.massassi.com/php/articles/template_engines/
 *
 * This code is in the public domain.
 */
class Template {
    var $vars;                  // Holds all the template variables

    /**
     * Constructor
     *
     * @param $file string the file name you want to load
     */
    function Template($file = null) {
        $this->file = $file;
    }

    /**
     * Set a template variable.
     *
     * If the specified $value is a Template object, the fetch() method will
     * be called on it, and the result will be stored as the value.
     */
    function set($name, $value) {
        $this->vars[$name] = is_a($value, "Template")
                           ? $value->fetch() : $value;
    }

    /**
     * Open and parse the template file, and return the result.
     *
     * @param $file string the template file name
     */
    function fetch($file = null) {
        if (!$file) {
            $file = $this->file;
        }
        extract($this->vars);          // Extract the vars to local namespace
        ob_start();                    // Start output buffering
        include($file);                // Include the file
        $contents = ob_get_contents(); // Get the contents of the buffer
        ob_end_clean();                // End buffering and discard
        return $contents;              // Return the contents
    }
}
