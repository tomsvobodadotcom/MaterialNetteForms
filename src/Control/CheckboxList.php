<?php

namespace TS\MaterialNetteForms\Control;

use Nette\Utils\Html;
use App\Form\Helpers;

/**
 * Material checkboxList
 *
 * @author Tom Svoboda
 */
class CheckboxList extends \Nette\Forms\Controls\CheckboxList {
    
    public function __construct($label = null, $items = null) {
        parent::__construct($label, $items);
        
        $this->separator = $this->separator = Html::el('p');
    }
    
    public function getControl() {
        $input = \Nette\Forms\Controls\MultiChoiceControl::getControl();
        
        
        $items = $this->getItems();
        reset($items);
        
        //dump($this);exit;

        //dump($this->separator);exit;
                
        return $this->container->setHtml(
            Helpers::createInputList(
                $this->translate($items),
                array_merge($input->attrs, [
                    'id' => null,
                    'checked?' => $this->value,
                    'disabled:' => $this->disabled,
                    'required' => null,
                    'data-nette-rules:' => [key($items) => $input->attrs['data-nette-rules']],
                ]),
                $this->itemLabel ? $this->itemLabel->attrs : $this->label->attrs,
                $this->separator
            )
        );
    }
    
    public function getLabel($caption = null) {
        return null;
    }
    
    
}
