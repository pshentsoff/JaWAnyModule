<?php
/**
 * @file        jawanymodule.php
 * @description J@W AnyModule Plugin for Joomla! let you place any module anywhere by id - just place shrotcode {anymodule mod_id=N}
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

jimport('joomla.plugin.plugin');

require_once(dirname(__FILE__) . DS . 'helper.php');

class plgContentJaWAnyModule extends JPlugin {

    const SHORTCODE = 'anymodule';

    public function plgContentJaWAnyModule($subject, $config) {
        parent::__construct($subject, $config);
        $this->helper = new plgContentJaWAnyModuleHelper();
    }

    public function onContentPrepare($context, &$article, &$params, $limitstart) {

        if(isset($article->text)) {
            if(preg_match_all("/\{".static::SHORTCODE." mod_id=(\d*)\}/im",$article->text, $mods)) {
                foreach ($mods[1] as $mod_id) {
                    $module_html = $this->helper->renderModule($mod_id);
                    $article->text = preg_replace(sprintf("/\{%s mod_id=%d\}/im", static::SHORTCODE, $mod_id),$module_html, $article->text);
                }

            }
        }
    }
}