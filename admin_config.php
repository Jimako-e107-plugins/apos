<?php

// Generated e107 Plugin Admin Area

require_once('../../class2.php');
if (!getperms('P')) {
    e107::redirect('admin');
    exit;
}

e107::lan('apos', true);
 

class apos_adminArea extends e_admin_dispatcher
{
    protected $modes = array(
    
        'main'	=> array(
            'controller' 	=> 'apos_ui',
            'path' 			=> null,
            'ui' 			=> 'apos_form_ui',
            'uipath' 		=> null
        ),
        

    );
    
    
    protected $adminMenu = array(
            
        'main/prefs' 		=> array('caption'=> LAN_PREFS, 'perm' => 'P'),
        
    );

    protected $adminMenuAliases = array(
        'main/edit'	=> 'main/list'
    );
    
    protected $menuTitle = 'Auto Post On Signup';
}

 
                
class apos_ui extends e_admin_ui
{
    protected $pluginTitle		= 'Auto Post On Signup';
    protected $pluginName		= 'apos';
    //	protected $eventName		= 'apos-'; // remove comment to enable event triggers in admin.
    protected $table			= '';
    protected $pid				= '';
    protected $perPage			= 10;
    protected $batchDelete		= true;
    protected $batchExport     = true;
    protected $batchCopy		= true;
 
    protected $listOrder		= ' DESC';
    
    protected $fields 		= array(
        );
        
    protected $fieldpref = array();
        

    //	protected $preftabs        = array('General', 'Other' );
    protected $prefs = array(
             
            'apos_forum'		=> array('title'=> APOS_ADMIN_04, 'tab'=>0, 'type'=>'dropdown', 'data' => 'str', 'help'=>'', 'writeParms' => array()),
            'apos_userid'		=> array('title'=> APOS_ADMIN_05, 'tab'=>0, 'type'=>'number', 'data' => 'str', 'help'=>'', 'writeParms' => array()),
            'apos_title'		=> array('title'=> APOS_ADMIN_06, 'tab'=>0, 'type'=>'text', 'data' => 'str', 'help'=>'', 'writeParms' => array('size'=>'block-level')),
            'apos_text'		    => array('title'=> APOS_ADMIN_07, 'tab'=>0, 'type'=>'bbarea', 'data' => 'str', 'help'=>'', 'writeParms' => array()),
 
        );

    
    public function init()
    {
        // This code may be removed once plugin development is complete.
        if (!e107::isInstalled('apos')) {
            e107::getMessage()->addWarning("This plugin is not yet installed. Saving and loading of preference or table data will fail.");
        }
            
        require_once(e_PLUGIN.'forum/forum_class.php');
        $forum = new e107forum;
        $apos_forum[0] = LAN_NONE;
        $forumList = $forum->forumGetAllowed();
        foreach ($forumList as $key=>$val) {
            $apos_forum[$key] = $val['forum_name'];
        }
            
        $this->prefs['apos_forum']['writeParms']['optArray'] = $apos_forum;
        // Set drop-down values (if any).
    }

        
    // ------- Customize Create --------
        
    public function beforeCreate($new_data, $old_data)
    {
        return $new_data;
    }
    
    public function afterCreate($new_data, $old_data, $id)
    {
        // do something
    }

    public function onCreateError($new_data, $old_data)
    {
        // do something
    }
        
        
    // ------- Customize Update --------
        
    public function beforeUpdate($new_data, $old_data, $id)
    {
        return $new_data;
    }

    public function afterUpdate($new_data, $old_data, $id)
    {
        // do something
    }
        
    public function onUpdateError($new_data, $old_data, $id)
    {
        // do something
    }
        
    // left-panel help menu area. (replaces e_help.php used in old plugins)
    public function renderHelp()
    {
        $caption = LAN_HELP;
        $text =
            '<span class="smalltext" style="font-weight: bold">'.APOS_HELP_00.'</span><br />
			'.APOS_HELP_01.'<br /><br />
			<ul><li>'.APOS_HELP_02.'</li>
			<li>'.APOS_HELP_03.'</li>
			<li>'.APOS_HELP_04.'</li></ul>';

        return array('caption'=>$caption,'text'=> $text);
    }
 
}
                


class apos_form_ui extends e_admin_form_ui
{
}
        
        
new apos_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;
