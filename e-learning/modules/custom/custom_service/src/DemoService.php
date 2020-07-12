<?php

/**
 * @file
 * Contains Drupal\custom_service\DemoService.
 */
namespace Drupal\custom_service;

class DemoService {  
  public function toUpperCase($str) {
    return strtoupper($str);
  }  
}