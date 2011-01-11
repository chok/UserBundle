<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bundle\FOS\UserBundle\Admin\Entity;

use Bundle\Sonata\BaseApplicationBundle\Admin\Admin;

class UserAdmin extends Admin
{

    protected $class = 'Application\FOS\UserBundle\Entity\User';

    protected $list_fields = array(
        'username' => array('identifier' => true),
        'email',
        'enabled',
        'locked',
        'created_at',
    );

    protected $form_fields = array(
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

    protected $form_groups = array(
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

    protected $filter_fields = array(
        'username',
        'locked',
        'email',
        'id',
    );

    protected $base_route = 'fos_user_admin';

    // don't know yet how to get this value
    protected $base_controller_name = 'UserBundle:PostAdmin';


    public function getForm($object, $fields)
    {
        $form = parent::getForm($object, $fields);
        $form->setValidationGroups(array('admin'));

        return $form;
    }

    public function preInsert($user)
    {
        parent::preInsert($user);

        $this->container->get('fos_user.user_manager')->updateUser($user);
    }
}