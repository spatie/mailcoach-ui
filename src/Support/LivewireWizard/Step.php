<?php

namespace Spatie\MailcoachUi\Support\LivewireWizard;

use ReflectionClass;
use ReflectionProperty;

abstract class Step
{
    protected WizardComponent $wizard;

    abstract public function render();

    public function activatingStep(): step
    {

    }

    public function deactivatingStep()
    {

    }

    public function setWizard(WizardComponent $wizard): self
    {
        $this->wizard = $wizard;

        return $this;
    }

    public function nextStep(): void
    {
        $this->wizard->nextStep();
    }

    public function previousStep(): void
    {
        $this->wizard->previousStep();
    }

    public function validate()
    {
        $this->wizard->validate();
    }

    public function getState(): array
    {
        $reflection = new ReflectionClass($this);
        $public = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
        $static = $reflection->getProperties(ReflectionProperty::IS_STATIC);
        $properties = array_diff($public, $static);

        return collect($properties)
            ->mapWithKeys(function(ReflectionProperty $property) {
               $propertyName = $property->name;

               return [$propertyName => $this->$propertyName];
            })
        ->toArray();
    }
}
