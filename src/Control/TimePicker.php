<?php

namespace TS\MaterialNetteForms\Control;

/**
 * Prvek timepicker formuláře
 *
 * @author Tom Svoboda
 */
class TimePicker extends \Nextras\Forms\Controls\DateTimePicker {
    
    const OWN_DATE_FORMAT = 'H:i';
    
    protected $htmlFormat = self::OWN_DATE_FORMAT;
    
    protected $htmlType = 'text';
    
    /**
     * Třída html input elementu
     * @var string 
     */
    protected $htmlClass = 'timepicker';
    
    public function getControl() {
        $control = parent::getControl();
        
        // Odstraní $htmlType třídu, kterou přidá Nextras Datepicker
        if(isset($control->attrs['class']['text'])) {
            unset($control->attrs['class']['text']);
        }
        
        // Přidá třídu, kterou chceme
        $control->class[] = $this->htmlClass;
        
        return $control;
    }
    
}
