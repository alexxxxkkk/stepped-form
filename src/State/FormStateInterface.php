<?php

declare(strict_types=1);

namespace Lexal\SteppedForm\State;

use Lexal\SteppedForm\Exception\AlreadyStartedException;
use Lexal\SteppedForm\Exception\EntityNotFoundException;
use Lexal\SteppedForm\Exception\FormIsNotStartedException;
use Lexal\SteppedForm\Exception\NoStepsAddedException;
use Lexal\SteppedForm\Steps\Collection\Step;
use Lexal\SteppedForm\Steps\Collection\StepsCollection;

interface FormStateInterface
{
    /**
     * Returns a stepped form data of the last submitted step.
     *
     * @throws FormIsNotStartedException
     */
    public function getEntity(): mixed;

    /**
     * Returns a data related to the given step.
     *
     * @throws EntityNotFoundException
     */
    public function getStepEntity(string $key): mixed;

    /**
     * Checks if a given step contains data.
     */
    public function hasStepEntity(string $key): bool;

    /**
     * Returns an entity passed at the form start.
     *
     * @throws FormIsNotStartedException
     */
    public function getInitializeEntity(): mixed;

    /**
     * Returns current step key, null if not exists.
     */
    public function getCurrentStep(): ?string;

    /**
     * Initializes a new form state. Saves entity to the storage and a first step key.
     *
     * @param StepsCollection<Step> $steps
     *
     * @throws AlreadyStartedException
     * @throws NoStepsAddedException
     */
    public function initialize(mixed $entity, StepsCollection $steps): void;

    /**
     * Sets a step data and updates current step value.
     */
    public function handle(string $key, mixed $entity, ?Step $next = null): void;

    /**
     * Clear all form data.
     *
     * @throws FormIsNotStartedException
     */
    public function finish(): void;
}
