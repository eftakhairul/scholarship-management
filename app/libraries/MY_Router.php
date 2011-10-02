<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * MY_Router
 *
 * Extended the core CI_Router class in order to force a different naming
 * convention for controllers.
 *
 */
class MY_Router extends CI_Router
{
    /*
     * Suffix in controller name
     *
     * @var String
     */
    private $_suffix = "Controller";

    /*
     * Call the parent constructor
     *
     * This is a requirement for extending base CI core class. Just abiding by
     * the rules.
     *
     * @access  public
     * @return  void
     */
    public function MY_Router()
    {
        parent::CI_Router();
    }

    /**
     * Validates the supplied segments.  Attempts to determine the path to
     * the controller.
     *
     * @access   private
     * @param    array
     * @return   array
     */
    function _validate_request($segments)
    {
        // Retain the original segments
        $orgSegments = array_slice($segments, 0);

        // Add suffix to the end
        $segments[0] = ucfirst($segments[0]) . $this->_suffix;

        // Does the requested controller exist in the root folder?
        if (file_exists(APPPATH.'controllers/'.$segments[0].EXT))
        {
            return $segments;
        }

        // OK, revert to the original segment
        $segments[0] = $orgSegments[0];

        // Is the controller in a sub-folder?
        if (is_dir(APPPATH.'controllers/'.$segments[0]))
        {
            // Set the directory and remove it from the segment array
            $this->set_directory($segments[0]);
            $segments = array_slice($segments, 1);

            if (count($segments) > 0)
            {
                // Add suffix to the end
                $segments[0] = ucfirst($segments[0]) . $this->_suffix;

                // Does the requested controller exist in the sub-folder?
                if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().$segments[0].EXT))
                {
                    show_404($this->fetch_directory().$segments[0]);
                }
            }
            else
            {
                // Add suffix to the end
                $this->default_controller = ucfirst($this->default_controller) . $this->_suffix;

                $this->set_class($this->default_controller);
                $this->set_method('index');

                // Does the default controller exist in the sub-folder?
                if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().$this->default_controller.EXT))
                {
                    $this->directory = '';
                    return array();
                }

            }

            return $segments;
        }

        // Can't find the requested controller...
        show_404($segments[0]);
    }
}
