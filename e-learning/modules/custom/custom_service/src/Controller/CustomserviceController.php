<?php

namespace Drupal\custom_service\Controller;
use Drupal\Core\Controller\ControllerBase;

class CustomserviceController extends ControllerBase {
	
	public function demo() {		
		return ['#markup' => \Drupal::service('custom_service.demo')->toUpperCase('Service used for converting into uppercase')];
	}
}