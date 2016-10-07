@if(!isset( $cancelButton))
    <button name="cancel" type="button" class="btn btn-link" data-dismiss="modal" aria-label="close">
        {{ $cancelButton or trans('forms.button-cancel') }}
    </button>
@endif
<button name="submit" type="{{ $buttonType or "submit" }}" class="btn {{ $class or 'btn-default' }} ">
    @if(isset($icon))
        <span class="fa fa-{{$icon}}"></span>
    @endif
    {{ $saveButton or trans('forms.button-save')}}
</button>
