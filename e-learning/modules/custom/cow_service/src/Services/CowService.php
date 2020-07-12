<?php

namespace Drupal\cow_service\Services;
use Drupal\Core\Session\AccountProxy;

/**
 * CowService is a simple example of a Drupal8 Service
 */
class CowService {

    protected $sounds = ["Start", "Barking"];
    protected $current_user;
    
    public function __construct(AccountProxy $currentUser) {
        $this->current_user = $currentUser;
    }

    
    /**
     * Returns a cow sound 
     */
    public function saySomething() {
        return $this->sounds[array_rand($this->sounds)]; 
    }
    
    /**
     *  Returns the cow owner
     */
    public static function whoIsUrOwner() {
       return $this->current_user->getDisplayName(); 
    }

}