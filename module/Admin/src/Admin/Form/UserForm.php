<?php
namespace Admin\Form; 

use Zend\Form\Element; 
use Zend\Form\Form; 

class UserForm extends Form 
{ 
    public function __construct($name = null) 
    { 
        parent::__construct(''); 
        
        $this->setAttribute('method', 'post'); 
        
        $this->add(array( 
            'name' => 'user_id', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
                'required' => 'required', 
            ), 
        )); 
        
        $this->add(array( 
            'name' => 'username', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
                'required' => 'required', 
            ), 
        )); 
 
        $this->add(array( 
            'name' => 'display_name', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
                'required' => 'required', 
            ),
        )); 
 
 
        $this->add(array( 
            'name' => 'email', 
            'type' => 'Zend\Form\Element\Email', 
            'attributes' => array( 
                'placeholder' => 'Email Address...', 
                'required' => 'required', 
            ), 
        )); 
 
        $this->add(array( 
            'name' => 'password', 
            'type' => 'Zend\Form\Element\Password', 
            'attributes' => array( 
                'required' => 'required', 
            ), 
        )); 


		$this->add(array(
			'name' => 'state',
			'type' => 'Zend\Form\Element\Select',
			'options' => array(
				'empty_option' => 'Please Select',
				'value_options' => array(
					0 => 'inactive',
					1 => 'active'
 				)
			),
			'attributes' => array(
				'required' => 'required'
			)
		));
    } 
}