<div class="field icon right">
    <input
            type="{{ $type or 'text' }}"
            class="{{ $class or '' }}"
            id="{{ $field or '' }}"
            name="{{ $field or '' }}"
            placeholder="{{ trans('validation.attributes.' . $field) }}"
            title="{{ trans('validation.attributes_example.' . $field)}}"
            minlength="{{ $min or '' }}"
            maxlength="{{ $max or '' }}"
            value="{{ $value or '' }}"
            error-value="{{ trans('validation.javascript_validation.' . $field) }}"
            {{ $attr or '' }}
    >
    <div class="{{ $icon or '' }}"></div>
</div>