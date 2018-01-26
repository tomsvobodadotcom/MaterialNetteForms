<?php

namespace TS\MaterialNetteForms\Rendering;

use Nette;
use Nette\Utils\Html;
use Nette\Utils\Arrays;

/**
 * Renderer pro renderování podle pravidel materializecss frameworku pro docílení kompatibility
 *
 * @author Tom Svoboda
 */
class MaterialRenderer extends \Nette\Forms\Rendering\DefaultFormRenderer {

    /**
     * Material wrappers (MaterializeCss)
     * @var array
     */
    protected $materialWrappers = [
        'controls' => [
            'container' => 'div class="row"'
        ],
        
        'pair' => [
            'container' => 'div class="input-field col s12"',
            '.error'    => 'invalid'
        ],
        
        'error' => [
            'container' => 'div class="row error"',
            'item'      => 'div class="col s12 item"'
        ],
        
        'control' => [
            'errorcontainer' => 'div class="row inline-error"',
            'erroritem'      => 'div class="col s12 right-align"',
            'container'      => ''
        ],
        
        'label' => [
            'container' => ''
        ]
    ];

    /**
     * MaterialRenderer Constructor
     */
    public function __construct() {
        parent::__construct();
        
        // merge material wrappers with defaultRenderer ones
        $this->wrappers = Arrays::mergeTree($this->wrappers, $this->materialWrappers);
    }
    
    /**
     * Renders single visual row.
     * @return string
     */
    public function renderPair(Nette\Forms\IControl $control) {
        $pair = $this->getWrapper('pair container');
        // znásilnění UploadControl, aby se zobrazoval správně
        if ($control instanceof Nette\Forms\Controls\UploadControl) {
            $pair->class('file-field', TRUE);

            $controlPart = $control->getControl();

            $labelPart = $control->getLabel();

            $trueControlPart = clone $controlPart;

            $controlPart->setName('div');
            $controlPart->attrs = [];
            $controlPart->class('btn', TRUE);
            $controlPart->insert(0, Html::el('span', $labelPart->getText()));
            $controlPart->insert(1, $trueControlPart);

            $labelPart->setName('div');
            $labelPart->attrs = [];
            $labelPart->removeChildren();
            $labelPart->class('file-path-wrapper');
            $filepahtInput = $labelPart->create('input');

            $filepahtInput->type = 'text';
            $filepahtInput->class('file-path', TRUE);

            $pair->addHtml($controlPart);
            $pair->addHtml($labelPart . $this->renderErrors($control));
        } else if ($control instanceof Nette\Forms\Controls\Checkbox) {
            // Ošetření checkboxu - při třídě input-class nejde

            $oldClasses = $pair->attrs['class'];
            $pair->attrs['class'] = str_replace('input-field', 'input-field-checkbox', $oldClasses);

            $p = Html::el('p');

            $p->addHtml($this->renderControl($control));
            $p->addHtml($this->renderLabel($control));

            $pair->addHtml($p);
        } else {
            $pair->addHtml($this->renderControl($control)); // Opačné pořadí to chtělo
            $pair->addHtml($this->renderLabel($control));   //
        }

        $pair->class($this->getValue($control->isRequired() ? 'pair .required' : 'pair .optional'), TRUE);
        $pair->class($control->hasErrors() ? $this->getValue('pair .error') : NULL, TRUE);
        $pair->class($control->getOption('class'), TRUE);
        if (++$this->counter % 2) {
            $pair->class($this->getValue('pair .odd'), TRUE);
        }
        $pair->id = $control->getOption('id');
        return $pair->render(0);
    }

    /**
     * Renders single visual row of multiple controls.
     * @param  Nette\Forms\IControl[]
     * @return string
     */
    public function renderPairMulti(array $controls) {
        $s = [];
        foreach ($controls as $control) {
            if (!$control instanceof Nette\Forms\IControl) {
                throw new Nette\InvalidArgumentException('Argument must be array of Nette\Forms\IControl instances.');
            }
            $description = $control->getOption('description');
            if ($description instanceof IHtmlString) {
                $description = ' ' . $description;
            } elseif (is_string($description)) {
                if ($control instanceof Nette\Forms\Controls\BaseControl) {
                    $description = $control->translate($description);
                }
                $description = ' ' . $this->getWrapper('control description')->setText($description);
            } else {
                $description = '';
            }

            $control->setOption('rendered', TRUE);
            $el = $control->getControl();
            if ($el instanceof Html && $el->getName() === 'input') {
                $el->class($this->getValue("control .$el->type"), TRUE);
            }
            $s[] = $el . $description;
        }
        $pair = $this->getWrapper('pair container');

        // Přidá třídu kontejneru pro vystředění odesíl. tlačítka
        if ($control instanceof \App\Form\Control\SubmitButton) {

            if ($control->getPosition() === 'center') {
                $pair->class('center', TRUE);
            }
        }
        // Toť vše

        $pair->addHtml($this->renderLabel($control));
        $pair->addHtml($this->getWrapper('control container')->setHtml(implode(' ', $s)));
        return $pair->render(0);
    }

}