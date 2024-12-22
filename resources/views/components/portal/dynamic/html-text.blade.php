<div class="dynamic-field  card_dynamic_field" data-card-id="{{ $row->uuid }}"  data-field-name="{{$fieldName}}"  >
    <span class="field-text" onclick="editField(this)">{{ $fieldText }}</span>
    <div class="action-buttons" style="display: none;">
        <input type="text" class="field-input" style="display: none;" value="{{ $fieldValue }}" />
        <button class="save-btn" onclick="saveField(this)">
            <i class="fa fa-check"></i>
        </button>
        <button class="cancel-btn" onclick="cancelEdit(this)">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="success-message" style="display: none;">{{__('portal/cards.mass_err_success')}}</div>
    <div class="error-message" style="display: none; color: red;"></div>
</div>
