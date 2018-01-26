<?php

namespace TS\MaterialNetteForms;

/**
 * Třída, která rozšiřuje Nette formuláře
 *
 * @author tom
 */
class MaterialForm extends \Nette\Application\UI\Form {

    /**
     * Material form constructor
     * @param string $name
     */
    public function __construct($name = null) {
        parent::__construct();
        
        $this->setRenderer( new Rendering\MaterialRenderer() );
    }
    
    /**
     * Add material text area
     * @param type $name
     * @param type $label
     * @param type $cols
     * @param type $rows
     * @return type
     */
    public function addTextArea($name, $label = NULL, $cols = NULL, $rows = NULL) {
        $control = parent::addTextArea($name, $label, $cols, $rows);
        
        $controlPrototype = $control->getControlPrototype();
        $controlPrototype->setAttribute('class', 'materialize-textarea');
        
        return $control;
    }
    
    /**
     * Přidá material checkbox
     * @param  string  control name
     * @param  string  caption
     * @return Controls\Checkbox
     */
    public function addCheckbox($name, $caption = NULL) {
        return $this[$name] = new Control\Checkbox($caption);
    }

    /**
     * Adds button used to submit form.
     * @param  string  control name
     * @param  string  caption
     * @return Controls\SubmitButton
     */
     public function addSubmit($name, $caption = NULL) {
         return $this[$name] = new Control\SubmitButton($caption);
     }
     
     /**
      * Add DatePicker
      * @param type $name
      * @param type $caption
      * @return type
      */
     public function addDatePicker($name, $caption = NULL) {
         return $this[$name] = new Control\DatePicker($caption);
     }
     
     /**
      * Add TimePicker
      * @param type $name
      * @param type $caption
      * @return type
      */
     public function addTimePicker($name, $caption = NULL) {
         return $this[$name] = new Control\TimePicker($caption);
     }
     
    /**
     * Adds set of checkbox controls to the form.
     * @param  string
     * @param  string|object
     * @return Controls\CheckboxList
     */
    public function addCheckboxList($name, $label = null, array $items = null) {
        return $this[$name] = new Control\CheckboxList($label, $items);
    }

    /**
     * Přidá material-design switch (aka checkbox)
     * @param string $name Název prvku
     * @param string $offCaption Popisek při vypnutí
     * @param string $onCaption Popisek při zapnutí
     * @return Control\MSwitch
     */
    public function addSwitch($name, $offCaption, $onCaption) {
        return $this[$name] = new Control\MaterialSwitch($offCaption, $onCaption);
    }
}
