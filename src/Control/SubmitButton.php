<?php

namespace TS\MaterialNetteForms\Control;

/**
 * Odesílací tlačítko v Material Designu
 *
 * @author tom
 */
class SubmitButton extends \Nette\Forms\Controls\SubmitButton {
    
    /**
     * Ikonka odesílacího tlačíta
     * @var string
     */
    protected $icon = 'send';
    
    /**
     * Třída aplikovaná na element ikony (i)
     * @var string
     */
    protected $iconClass = 'right';
    
    /**
     * Pozice tlačítka (left|center|right|NULL)
     * @var string|NULL
     */
    protected $position = NULL;
    
    public function getControl($caption = NULL) {
        $el = parent::getControl($caption);
        
        $el->setName('button');
        $el->class('btn', TRUE);
        $el->class('waves-effect', TRUE);
        $el->class('waves-light', TRUE);
        $el->class('form-submit-button', TRUE);
        
        if($this->position === 'left' || $this->position === 'right') {
            $el->class($this->position, TRUE);
        }

        $i = $el->create('i', $this->icon);
        $i->class('material-icons', TRUE);
        $i->class($this->iconClass, TRUE);

        $span = $el->create('span', $el->value);
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

        /**
     * Nastaví ikonu
     * @param string $icon
     * @return \App\Utils\Form\Control\SubmitButton
     */
    public function setIcon($icon) {
        $this->icon = $icon;
        return $this;
    }
    
    /**
     * Nastaví třídu ikonky
     * @param string $iconClass
     * @return \App\Utils\Form\Control\SubmitButton
     */
    public function setIconClass($iconClass) {
        $this->iconClass = $iconClass;
        return $this;
    }
    
}
