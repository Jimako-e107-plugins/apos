<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2017 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * XXX HIGHLY EXPERIMENTAL AND SUBJECT TO CHANGE WITHOUT NOTICE.
*/

if (!defined('e107_INIT')) {
    exit;
}


class apos_event
{
    public function config()
    {
        $event = array();

        $event[] = array(
            'name'	=> "user_signup_activated",
            'function'	=> "apos_userveri"
        );
        
        $event[] = array(
            'name'	=> "admin_user_created",
            'function'	=> "apos_userveri"
        );
        
                
        return $event;
    }
    
    
    public function apos_userveri($data)
    {
        $plugPrefs = e107::getPlugConfig('apos')->getPref();
        
        $aposUserId=$data['user_id'];
        $userData=get_user_data($aposUserId);
            
        // who is sender
        $user = get_user_data($plugPrefs['apos_userid']);
            
        require_once(e_PLUGIN.'forum/forum_class.php');
        $forum = new e107forum;
                
        $forum_id=intval($plugPrefs['apos_forum']);
        $parent=0; // test
        $poster=array('post_userid'=>$plugPrefs['apos_userid'], 'post_user_name'=>$user['user_name']);
        $forum_sub=0; // test
                                
        // Replacements
        $apos_find=array("[USERNAME]", "[REALNAME]","[LOGINNAME]");
        $apos_replace=array($data['user_name'], $data['user_name'], $data['user_loginname']);
        $plugPrefs['apos_text']=str_replace($apos_find, $apos_replace, $plugPrefs['apos_text']);
        $plugPrefs['apos_title']=str_replace($apos_find, $apos_replace, $plugPrefs['apos_title']);
        
        //function thread_insert($thread_name, $thread_thread, $thread_forum_id, $thread_parent, $thread_poster, $thread_active, $thread_s, $forum_sub)
        //function threadAdd($threadInfo, $postInfo)
                
        $threadInfo = array();
        $postInfo['post_user']              = $plugPrefs['apos_userid'];
        $threadInfo['thread_user']          = $plugPrefs['apos_userid'];
                
        $time = time();
        $postInfo['post_entry']                 = $plugPrefs['apos_text'];
        $postInfo['post_forum']                 = $forum_id;
        $postInfo['post_datestamp']             = $time;
        $postInfo['post_ip']                    = e107::getIPHandler()->getIP(false);
                
        $postInfo['post_options']           = serialize(array('no_emote' => 1));
                 
        $threadInfo['thread_sticky']    = false;
        $threadInfo['thread_name']      = $plugPrefs['apos_title'];
        $threadInfo['thread_forum_id']  = $forum_id;
        $threadInfo['thread_active']    = 1;
        $threadInfo['thread_datestamp'] = $time;
                    
                    
        //	$iid = $forum->thread_insert($pref['apos_title'],$pref['apos_text'],$forum_id,$parent,$poster,1,0,$forum_sub);
        
        //return array('postid' => $newPostId, 'threadid' => $newThreadId, 'threadsef'=>$threadInfo['thread_sef']);
        $forum->threadAdd($threadInfo, $postInfo);
    }
}
