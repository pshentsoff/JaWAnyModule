<?php
/**
 * @file        helper.php
 * @description Helper class for J@W AnyModule Plugin
 *
 * PHP Version  5.3.13
 *
 * @package     J@W AnyModule Plugin for Joomla!
 * @category    Joomla! Plugin
 * @plugin URI  http://joyatworks.ru/jaw-any-module
 * @copyright   2014, Vadim Pshentsov. All Rights Reserved.
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author      Vadim Pshentsov <pshentsoff@gmail.com> 
 * @link        http://pshentsoff.ru Author's homepage
 * @link        http://blog.pshentsoff.ru Author's blog
 *
 * @created     16.06.14
 */

defined('_JEXEC') or die;

class plgContentJaWAnyModuleHelper {

    public function renderModule($mod_id) {

        $document	= &JFactory::getDocument();
        $renderer	= $document->loadRenderer('module');
        $params = array('style'=>'xhtml');
        $dbo = JFactory::getDBO();

        $dbo->setQuery("SELECT * FROM #__modules WHERE id='$mod_id' ");
        $module = $dbo->loadObject();
        $module->user = '';

        $contents = $renderer->render($module, $params);
        return $contents;
    }
}