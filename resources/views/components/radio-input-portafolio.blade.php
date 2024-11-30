<div>
    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
    <td class="d-flex">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="{{ $name }}" value="0"
                {{ $value == "0" ? 'checked' : '' }}>
            <label class="form-check-label"><i class="fa fa-times-circle" style="color: red;"></i></label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="{{ $name }}" value="1"
                {{ $value == "1" ? 'checked' : '' }}>
            <label class="form-check-label"><i class="fa fa-minus-square" style="color:orange;"></i></label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="{{ $name }}" value="2"
                {{ $value == "2" ? 'checked' : '' }}>
            <label class="form-check-label"><i class="fa fa-check-square" style="color:green"></i></label>
        </div>
    </td>
</div>
