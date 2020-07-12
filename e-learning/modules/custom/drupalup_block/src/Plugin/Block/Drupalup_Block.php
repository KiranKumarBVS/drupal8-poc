<?php
namespace Drupal\drupalup_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\file\Entity\File;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'drupalup_block' block.
 *
 * @Block(
 *   id = "drupalup_block",
 *   admin_label = @Translation("drupalup_block"),
 *   category = @Translation("drupalup_block world block")
 * )
 */
class Drupalup_Block extends BlockBase {
  /**
  * {@inheritdoc}
  */
  public function blockForm($form, FormStateInterface $formState) {
	$form['heading'] = array(
	  '#type' => 'textfield',
	  '#title' => t('Heading'),
	  '#description' => t('Enter the main heading'),
	  '#default_value' => $this->configuration['heading']
	);
	$form['body'] = array(
	  '#type' => 'text_format',
	  '#title' => t('Body'),
	  '#description' => t('Main body'),
	  '#format' => 'full_html',
	  '#default_value' => $this->configuration['heading']
	);
	$form['image'] = array(
	  '#type' => 'managed_file',
	  '#upload_location' => 'public://image',
	  '#title' => t('Image'),
	  '#upload_validators' => [
	    'file_validate_extensions' => ['jpg', 'jpeg', 'png', 'gif']
	  ],
	  '#default_value' => isset($this->configuration['image']) ? $this->configuration['image'] : '',
	  '#description' => t('The image to display'),
	  '#required' => true
	);

	return $form;
  }
    
	/**
	 * {@inheritdoc}
	 */
	public function blockSubmit($form, FormStateInterface $formState) {
		$image = $formState->getValue('image');
		
		if ($image != $this->configuration['image']) {
		 if (!empty($image[0])) {
		  $file = File::load($image[0]);
		  $file->setPermanent();
		  $file->save();
		 }
		}
		$this->configuration['heading'] = $formState->getValue('heading');
		print_r($this->configuration['heading']);
		$this->configuration['body'] = $formState->getValue('body');
		print_r($this->configuration['body']);
		$this->configuration['image'] = $formState->getValue('image');
	}
    
	/**
	 * {@inheritdoc}
	 */
	public function build() {
		$build = [];
		$build['heading']['#markup'] = '<h1>'.$this->configuration['heading'].'</h1>';

		$image = $this->configuration['image'];
		if (!empty($image[0])) {
		  if ($file = File::load($image[0])) {
			$build['image'] = [
			  '#theme' => 'image_style',
			  '#style_name' => 'medium',
			  '#uri' => $file->getFileUri(),
			];
		  }
		}
		
		$build['body']['#markup'] = '<div>' . $this->configuration['body']['value'] . '</div>';
	
		return $build;
	  }
    }