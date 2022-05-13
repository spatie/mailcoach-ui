<?php

namespace Spatie\MailcoachUi\Support\LivewireWizard;

use Livewire\Component;
use Livewire\Exceptions\MethodNotFoundException;

abstract class WizardComponent extends Component
{
    public ?string $activeStepName = null;

    protected array $rules = [];

    public function activeStep(): Step
    {
        $steps = collect($this->steps());

        /** @var Step $step */
        $step = $steps->first(fn(Step $step) => $step::class === $this->activeStepName);

        $step ??= $steps->first();

        $step->setWizard($this);

        if ($step::class !== $this->activeStepName) {
            $this->syncWithStepState($step);
        }

        // throw exception on no active step

        $this->activeStepName = $step::class;

        return $step;
    }

    /**
     * @return array<int, Step>
     */
    abstract function steps(): array;

    public function nextStep(): void
    {
        $nextStep = collect($this->steps())
            ->after(fn(Step $step) => $step::class === $this->activeStep()::class);

        if (!$nextStep) {
            return;
        }

        $this->syncWithStepState($nextStep);

        $this->activeStepName = $nextStep::class;
    }

    public function previousStep(): void
    {
        $previousStep = collect($this->steps())
            ->before(fn(Step $step) => $step::class === $this->activeStepName);

        if (!$previousStep) {
            return;
        }

        $this->activeStepName = $previousStep::class;

        $this->syncWithStepState($previousStep);
    }

    public function render()
    {
        $step = $this->activeStep();

        ray($this->rules);

        return $step->render();
    }

    public function callMethod($method, $params = [], $captureReturnValueCallback = null)
    {
        try {
            parent::callMethod($method, $params = [], $captureReturnValueCallback);
        } catch (MethodNotFoundException $exception) {
            $step = $this->activeStep();

            if (!method_exists($step, $method)) {
                throw $exception;
            }

            $result = $step->$method($params);

            $this->syncWithStepState($step);

            $captureReturnValueCallback($result);
        }
    }

    protected function syncWithStepState(Step $step)
    {
        $this->rules = [];

        foreach ($step->getState() as $name => $value) {
            $this->$name = $value;
        }
    }
}
