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

class GroupAdmin extends Admin
{
    
    protected $class = 'Application\FOS\UserBundle\Entity\Group';

    protected $list_fields = array(
        'name' => array('identifier' => true),
        'roles'
    );

    protected $form_fields = array(
        'name',
        'roles'
    );


    protected $base_route = 'fos_group_admin';

    // don't know yet how to get this value
    protected $base_controller_name = 'UserBundle:PostAdmin';

    public function getNewInstance()
    {
        $class = $this->getClass();

        return new $class('');
    }
}