<?php

namespace TS\MaterialNetteForms\Control;

/**
 * Přetížený checkbox aby se renderoval jako materialdesign
 *
 * @author tom
 */
class Checkbox extends \Nette\Forms\Controls\Checkbox {
    
    public function getControl()
    {
        return $this->getControlPart();
    }
    
    public function getLabel($caption = NULL)
    {
        return $this->getLabelPart();
    }
    
}
