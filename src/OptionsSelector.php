<?php

namespace Pavloniym\OptionsSelector;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class OptionsSelector extends Field
{

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'options-selector';


    /**
     * The text alignment for the field's text in tables.
     *
     * @var string
     */
    public $textAlign = 'right';


    /**
     * Get options
     *
     * @param array $options
     * @return $this
     */
    public function options(array $options = []): self
    {
        return $this->withMeta(['options' => $options]);
    }


    /**
     * Hide label
     *
     * @return $this
     */
    public function hideLabel(): self
    {
        return $this->withMeta(['hideLabel' => true]);
    }


    /**
     * Show search panel
     *
     * @return $this
     */
    public function searchable(): self
    {
        return $this->withMeta(['searchable' => true]);
    }


    /**
     * Set grid columns gap
     *
     * @param int $gridColumnsGap
     * @return $this
     */
    public function setGridColumnsGap(int $gridColumnsGap = 4): self
    {
        return $this->withMeta(['gridColumnsGap' => $gridColumnsGap]);
    }


    /**
     * Set grid columns number
     *
     * @param int $gridColumnsWidth
     * @return $this
     */
    public function setGridColumnsWidth(int $gridColumnsWidth = 6): self
    {
        return $this->withMeta(['gridColumnsWidth' => $gridColumnsWidth]);
    }


    /**
     * Set max row width on index
     *
     * @param string|null $maxRowWidthOnIndex
     * @return $this
     */
    public function setMaxRowWidthOnIndex(string $maxRowWidthOnIndex = null): self
    {
        return $this->withMeta(['maxRowWidthOnIndex' => $maxRowWidthOnIndex]);
    }


    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param NovaRequest $request
     * @param string $requestAttribute
     * @param object $model
     * @param string $attribute
     * @return mixed
     */
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        $value = $request->input($requestAttribute) ?? null;
        $model->{$attribute} = is_null($value) ? null : json_decode($value, true);
    }
}
