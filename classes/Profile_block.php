<?php
/*
 * LShai - a distributed microblogging tool
 */

if (!defined('SHAISHAI')) { exit(1); }

/**
 * Table Definition for profile_block
 */

require_once INSTALLDIR.'/classes/Memcached_DataObject.php';

class Profile_block extends Memcached_DataObject
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'profile_block';                   // table name
    public $blocker;                         // int(4)  primary_key not_null
    public $blocked;                         // int(4)  primary_key not_null
    public $modified;                        // timestamp()   not_null default_CURRENT_TIMESTAMP

    /* Static get */
    function staticGet($k,$v=null)
    { return Memcached_DataObject::staticGet('Profile_block',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    function get($blocker, $blocked)
    {
        return Memcached_DataObject::pkeyGet('Profile_block',
                                             array('blocker' => $blocker,
                                                   'blocked' => $blocked));
     }
}
