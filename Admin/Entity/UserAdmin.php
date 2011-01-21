<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\UserBundle\Admin\Entity;

use Sonata\BaseApplicationBundle\Admin\EntityAdmin as Admin;

class UserAdmin extends Admin
{

    protected $maxPerPage = 25;
    
    protected $class = 'Application\FOS\UserBundle\Entity\User';

    protected $listFields = array(
        'username' => array('identifier' => true),
        'email',
        'enabled',
        'locked',
        'createdAt',
    );

    protected $formFields = array(
        'username',
        'email',
        'enabled',
        'plainPassword' => array('type' => 'string'),
        'locked',
        'expired',
        'credentialsExpired',
        'credentialsExpireAt',
        'groups'
    );

    protected $formGroups = array(
        'General' => array(
            'fields' => array('username', 'email', 'plainPassword')
        ),
        'Groups' => array(
            'fields' => array('groups')
        ),
        'Management' => array(
            'fields' => array('locked', 'expired', 'enabled', 'credentialsExpired', 'credentialsExpireAt')
        )
    );

    protected $formOptions = array(
        'validation_groups' => 'admin'
    );

    protected $filterFields = array(
        'username',
        'locked',
        'email',
        'id',
    );

    // don't know yet how to get this value
    protected $baseControllerName = 'FOSUserBundle:UserAdmin';

    public function preInsert($user)
    {
        parent::preInsert($user);

        $this->container->get('fos_user.user_manager')->updatePassword($user);
    }
}