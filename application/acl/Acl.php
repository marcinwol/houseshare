<?php

/**
 * Description of Acl
 *
 * @author marcin
 */
class My_Acl extends Zend_Acl {

    public function __construct(Zend_Config_Ini $acl) {
        $aclConfig = $acl;
        $roles = $aclConfig->acl->roles;
        $resources = $aclConfig->acl->resources;
        $this->_addRoles($roles);
        $this->_addResources($resources);
    }

    public function _addRoles($roles) {
        foreach ($roles as $name => $parents) {
            if (!$this->hasRole($name)) {
                if (empty($parents)) {
                    $parents = null;
                } else {
                    $parents = explode(',', $parents);
                }
                
                $this->addRole(new Zend_Acl_Role($name), $parents);             
            }
        }       
    }

    public function _addResources($resources) {
      

        foreach ($resources as $permissions => $controllers) {         

            foreach ($controllers as $controller => $actions) {
                if ($controller == 'all') {
                    $controller = null;
                } else {
                    if (!$this->has($controller)) {
                        $this->add(new Zend_Acl_Resource($controller));
                    }
                }

                foreach ($actions as $action => $role) {
                    if ($action == 'all') {
                        $action = null;
                    }
                    if ($permissions == 'allow') {
                        $this->allow($role, $controller, $action);
                    }
                    if ($permissions == 'deny') {
                       
                        $this->deny($role, $controller, $action);
                    }
                }
            }
        }
    }

}

?>
