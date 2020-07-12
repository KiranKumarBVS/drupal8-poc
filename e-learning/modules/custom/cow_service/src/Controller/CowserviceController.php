<?php

namespace Drupal\cow_service\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\cow_service\Services;

class CowserviceController extends ControllerBase {

	protected $cow_service;

	public function __construct(CowService $cow_service) {
        $this->cow_service = $cow_service;
	}
	
	public function create(ContainerInterface $container){
		return new static(
			$container->get('cow_service.demo')
		);
	}
	
	public function demo() {		
		return ['#markup' =>  $this->cow_service->whoIsUrOwner()];
	}
}