<?php

namespace TS\MaterialNetteForms\Control;

use Nette\Utils\Html;

/**
 * Material-Design switch
 *
 * @author Tom Svoboda <byliny@tomsvoboda.com>
 */
class MaterialSwitch extends Checkbox {
    
    /**
     * Popisek pro vypnutý stav
     * @var string
     */
    protected $offCaption;
    
    /**
     * Popisek pro zapnutý stav
     * @var string
     */
    protected $onCaption;
    
    public function __construct($offCaption, $onCaption) {
        parent::__construct(NULL); // nemá popisek
        
        $this->offCaption = $offCaption;
        $this->onCaption  = $onCaption;
    }
    
    public function getControl() {
        $wrapper = Html::el('div class=switch');
        $label   = $wrapper->create('label');
        
        $label->addHtml( $this->offCaption );
        $label->addHtml( $this->getControlPart() ); // přidáme skutečný checkbox
        $label->addHtml( Html::el('span class=lever') );
        $label->addHtml( $this->onCaption );
        
        return $wrapper;
    }
    
    public function getLabel($caption = NULL) {
        return "";
    }
    
}
