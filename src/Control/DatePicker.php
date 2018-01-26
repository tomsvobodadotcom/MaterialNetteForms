<?php

namespace TS\MaterialNetteForms\Control;

/**
 * Rozšíření Nextras Datepickeru pro zobrazení správného input type atributu
 *
 * @author Tom Svoboda
 */
class DatePicker extends \Nextras\Forms\Controls\DatePicker {
    
    const OWN_DATE_FORMAT = 'd. m. Y';
    
    protected $htmlFormat = self::OWN_DATE_FORMAT;
    
    protected $htmlType = 'text';
    
    /**
     * Třída html input elementu
     * @var string 
     */
    protected $htmlClass = 'datepicker';
    
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
