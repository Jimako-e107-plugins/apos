<?php
/*
* e107 website system
*
* Copyright (C) 2008-2013 e107 Inc (e107.org)
* Released under the terms and conditions of the
* GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
*
* Custom install/uninstall/update routines for blank plugin
**
*/

e107::lan('apos', true);

if (!class_exists("apos_setup")) {
    class apos_setup
    {
        public function install_pre($var)
        {
            // print_a($var);
            // echo "custom install 'pre' function<br /><br />";
        }

        /**
         * For inserting default database content during install after table has been created by the blank_sql.php file.
         */
        public function install_post($var)
        {
            $newPrefs= e107::getPlugConfig('apos')->getPref();
 
            $newPrefs['apos_title'] = APOS_PREF_01;
            $newPrefs['apos_text'] = APOS_PREF_02;
            $result = e107::getPlugConfig('apos')->setPref($newPrefs)->save(false, true, false);
        }

        public function uninstall_options()
        {
        }


        public function uninstall_post($var)
        {
            // print_a($var);
        }
    }
}
