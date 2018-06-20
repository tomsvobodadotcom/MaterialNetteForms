<?php

namespace TS\MaterialNetteForms\Control;

/**
 * Odesílací tlačítko v Material Designu - kulaté s ikonkou
 *
 * @author tom
 */
class CircleSubmitButton extends \Nette\Forms\Controls\SubmitButton {

    /**
     * Pozice tlačítka (left|center|right|NULL)
     * @var string|NULL
     */
    protected $position = NULL;
    
    public function getControl($caption = NULL) {
        $el = parent::getControl($caption);
        
        $el->setName('button');
        $el->class('btn', TRUE);
        $el->class('btn-floating', TRUE);
        $el->class('waves-effect', TRUE);
        $el->class('waves-light', TRUE);
        
        if($this->position === 'left' || $this->position === 'right') {
            $el->class($this->position, TRUE);
        }

        $i = $el->create('i', $this->caption);
        $i->class('material-icons', TRUE);

        $el->removeAttribute('value');
        
        return $el;
    }
 
    /**
     * Nastaví pozici tlačítka v rámci kontejneru
     * @param string $position Pozice (left|center|right|NULL)
     * @throws \Nette\InvalidArgumentException
     */
    public function setPosition($position) {
        if(!in_array($position,  [NULL, 'left', 'right', 'center'])) {
            throw new \Nette\InvalidArgumentException("Bad position on SubmitButton");
        }
        
        $this->position = $position;
    }
    
    /**
     * Vrací pozici tlačítka v rámci kontejneru
     * @return string left|center|right|NULL
     */
    public function getPosition() {
        return $this->position;
    }

    
}
