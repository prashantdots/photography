<?php
App::uses('AppModel', 'Model');
/**
 * JobToGallery Model
 *
 */
class GalleryImage extends AppModel {


/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Gallery' => array(
			'className' => 'Gallery',
			'foreignKey' => 'gallery_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
