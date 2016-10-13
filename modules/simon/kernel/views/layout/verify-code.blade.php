@if($openVerify)
<div class="form-group">
    <label>Verify Code</label>
    <div class="row">
        <div class="col-md-7">
            <input type="text" name="verify_code" class="form-control input-lg"  placeholder="" />
        </div>
        <div class="col-md-5 text-right">
            <span id="verify-code"><img src="{{captcha_src()}}" onclick="this.src = this.src+'?'+Math.random()"></span>
        </div>
    </div>
</div>
@endif