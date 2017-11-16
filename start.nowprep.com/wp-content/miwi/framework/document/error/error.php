<?php
/*
* @package		Miwi Framework
* @copyright	Copyright (C) 2009-2014 Miwisoft, LLC. All rights reserved.
* @copyright	Copyright (C) 2005-2012 Open Source Matters, Inc. All rights reserved.
* @license		GNU General Public License version 2 or later
*/

defined('MIWI') or die('MIWI');

class MDocumentError extends MDocument {

    protected $_error;

    public function __construct($options = array()) {
        parent::__construct($options);

        // Set mime type
        $this->_mime = 'text/html';

        // Set document type
        $this->_type = 'error';
    }

    public function setError($error) {
        if ($error instanceof Exception) {
            $this->_error = & $error;
            return true;
        }
        else {
            return false;
        }
    }

    public function render($cache = false, $params = array()) {
        // If no error object is set return null
        if (!isset($this->_error)) {
            return;
        }

        // Set the status header
        MResponse::setHeader('status', $this->_error->getCode() . ' ' . str_replace("\n", ' ', $this->_error->getMessage()));
        $file = 'error.php';

        // Check template
        $directory = isset($params['directory']) ? $params['directory'] : 'templates';
        $template = isset($params['template']) ? MFilterInput::getInstance()->clean($params['template'], 'cmd') : 'system';

        if (!file_exists($directory . '/' . $template . '/' . $file)) {
            $template = 'system';
        }

        // Set variables
        $this->baseurl = MURI::base(true);
        $this->template = $template;
        $this->debug = isset($params['debug']) ? $params['debug'] : false;
        $this->error = $this->_error;

        // Load
        $data = $this->_loadTemplate($directory . '/' . $template, $file);

        parent::render();
        return $data;
    }

    public function _loadTemplate($directory, $filename) {
        $contents = '';

        // Check to see if we have a valid template file
        if (file_exists($directory . '/' . $filename)) {
            // Store the file path
            $this->_file = $directory . '/' . $filename;

            // Get the file content
            ob_start();
            require_once $directory . '/' . $filename;
            $contents = ob_get_contents();
            ob_end_clean();
        }

        return $contents;
    }

    public function renderBacktrace() {
        $contents = null;
        $backtrace = $this->_error->getTrace();
        if (is_array($backtrace)) {
            ob_start();
            $j = 1;
            echo '<table cellpadding="0" cellspacing="0" class="Table">';
            echo '	<tr>';
            echo '		<td colspan="3" class="TD"><strong>Call stack</strong></td>';
            echo '	</tr>';
            echo '	<tr>';
            echo '		<td class="TD"><strong>#</strong></td>';
            echo '		<td class="TD"><strong>Function</strong></td>';
            echo '		<td class="TD"><strong>Location</strong></td>';
            echo '	</tr>';
            for ($i = count($backtrace) - 1; $i >= 0; $i--) {
                echo '	<tr>';
                echo '		<td class="TD">' . $j . '</td>';
                if (isset($backtrace[$i]['class'])) {
                    echo '	<td class="TD">' . $backtrace[$i]['class'] . $backtrace[$i]['type'] . $backtrace[$i]['function'] . '()</td>';
                }
                else {
                    echo '	<td class="TD">' . $backtrace[$i]['function'] . '()</td>';
                }
                if (isset($backtrace[$i]['file'])) {
                    echo '		<td class="TD">' . $backtrace[$i]['file'] . ':' . $backtrace[$i]['line'] . '</td>';
                }
                else {
                    echo '		<td class="TD">&#160;</td>';
                }
                echo '	</tr>';
                $j++;
            }
            echo '</table>';
            $contents = ob_get_contents();
            ob_end_clean();
        }
        return $contents;
    }
}
