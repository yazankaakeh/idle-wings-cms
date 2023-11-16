<ul class="nav nav-tabs mb-20" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="content-info-tab" data-toggle="tab" href="#content-info" role="tab"
            aria-controls="content-info" aria-selected="true">{{ translate('Content') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="background-tab" data-toggle="tab" href="#background" role="tab"
            aria-controls="background" aria-selected="false">{{ translate('Background') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="advanced-tab" data-toggle="tab" href="#advanced" role="tab" aria-controls="button"
            aria-selected="false">{{ translate('Advanced') }}</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">

    <div class="tab-pane fade show active" id="content-info" role="tabpanel" aria-labelledby="content-info-tab">
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black"> {{ translate('Select Layouts') }} </label>
            </div>
            <div class="col-sm-12">
                <select class="theme-input-style" id="adsLayout" name="content" onchange="selectAdsLayout()" required>
                    <option value="">{{ translate('Select Layout') }}</option>
                    <option value="3_6_3">Layout 1</option>
                    <option value="6_6">Layout 2</option>
                    <option value="12">Layout 3</option>
                    <option value="6_3_3">Layout 4</option>
                    <option value="3_3_6">Layout 6</option>
                </select>
                @if ($errors->has('background_size'))
                    <div class="invalid-input">{{ $errors->first('background_size') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Title') }} </label>
            </div>
            <div class="col-sm-12">
                <input type="text" name="title" class="theme-input-style" value="{{ old('title') }}"
                    placeholder="{{ translate('Type title') }}" required>
                @if ($errors->has('title'))
                    <div class="invalid-input">{{ $errors->first('title') }}</div>
                @endif
                <small>{{ translate('Title is not visible in homepage') }}</small>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="background" role="tabpanel" aria-labelledby="background-tab">
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Background Color') }} </label>
            </div>
            <div class="col-sm-12">
                <div class="input-group addon">
                    <input type="text" name="bg_color" class="color-input form-control style--two"
                        placeholder="#000000" value="">
                    <div class="input-group-append">
                        <input type="color" class="input-group-text theme-input-style2 color-picker" id="colorPicker"
                            value="#000000" oninput="selectColor(event,this.value)">
                    </div>
                </div>
                @if ($errors->has('bg_color'))
                    <div class="invalid-input">{{ $errors->first('bg_color') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Background Image') }} </label>
            </div>
            <div class="col-md-12">
                @include('core::base.includes.media.media_input', [
                    'input' => 'bg_image',
                    'data' => old('bg_image'),
                ])
                @if ($errors->has('bg_image'))
                    <div class="invalid-input">{{ $errors->first('bg_image') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black"> {{ translate('Background Size') }} </label>
            </div>
            <div class="col-sm-12">
                <select class="theme-input-style" name="background_size">
                    <option value="cover">cover</option>
                    <option value="auto">auto</option>
                    <option value="contain">contain</option>
                    <option value="initial">initial</option>
                    <option value="revert">revert</option>
                    <option value="inherit">inherit</option>
                    <option value="revert-layer">revert-layer</option>
                    <option value="unset">unset</option>
                </select>
                @if ($errors->has('background_size'))
                    <div class="invalid-input">{{ $errors->first('background_size') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black"> {{ translate('Background Position') }} </label>
            </div>
            <div class="col-sm-12">
                <select class="theme-input-style" name="background_position">
                    <option value="bottom">bottom</option>
                    <option value="center">center</option>
                    <option value="inherit">inherit</option>
                    <option value="initial">initial</option>
                    <option value="left">left</option>
                    <option value="revert">revert</option>
                    <option value="revert-layer">revert-layer</option>
                    <option value="right">right</option>
                    <option value="top">top</option>
                    <option value="unset">unset</option>
                </select>
                @if ($errors->has('background_position'))
                    <div class="invalid-input">{{ $errors->first('background_position') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black"> {{ translate('Background Repeat') }} </label>
            </div>
            <div class="col-sm-12">
                <select class="theme-input-style" name="background_repeat">
                    <option value="no-repeat">no-repeat</option>
                    <option value="repeat">no-repeat</option>
                </select>
                @if ($errors->has('background_repeat'))
                    <div class="invalid-input">{{ $errors->first('background_repeat') }}</div>
                @endif
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="advanced" role="tabpanel" aria-labelledby="advanced-tab">

        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Padding') }} </label>
            </div>
            <div class="col-sm-3">
                <div class="input-group addon">
                    <input type="text" class="form-control radius-0" name="padding_top" id="left-right-addons"
                        placeholder="00">
                    <div class="input-group-append">
                        <span class="input-group-text style--three black bold">px</span>
                    </div>
                </div>
                <small>{{ translate('Top') }}</small>
                @if ($errors->has('padding_top'))
                    <div class="invalid-input">{{ $errors->first('padding_top') }}</div>
                @endif
            </div>
            <div class="col-sm-3">
                <div class="input-group addon">
                    <input type="text" class="form-control radius-0" name="padding_right" id="left-right-addons"
                        placeholder="00">
                    <div class="input-group-append">
                        <span class="input-group-text style--three black bold">px</span>
                    </div>
                </div>
                <small>{{ translate('Right') }}</small>
                @if ($errors->has('padding_right'))
                    <div class="invalid-input">{{ $errors->first('padding_right') }}</div>
                @endif
            </div>
            <div class="col-sm-3">
                <div class="input-group addon">
                    <input type="text" class="form-control radius-0" name="padding_bottom" id="left-right-addons"
                        placeholder="00">
                    <div class="input-group-append">
                        <span class="input-group-text style--three black bold">px</span>
                    </div>
                </div>
                <small>{{ translate('Bottom') }}</small>
                @if ($errors->has('padding_bottom'))
                    <div class="invalid-input">{{ $errors->first('padding_bottom') }}</div>
                @endif
            </div>
            <div class="col-sm-3">
                <div class="input-group addon">
                    <input type="text" class="form-control radius-0" name="padding_left" id="left-right-addons"
                        placeholder="00">
                    <div class="input-group-append">
                        <span class="input-group-text style--three black bold">px</span>
                    </div>
                </div>
                <small>{{ translate('Left') }}</small>
                @if ($errors->has('padding_left'))
                    <div class="invalid-input">{{ $errors->first('padding_left') }}</div>
                @endif
            </div>
        </div>

        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Margin') }} </label>
            </div>
            <div class="col-sm-3">
                <div class="input-group addon">
                    <input type="text" class="form-control radius-0" name="margin_top" id="left-right-addons"
                        placeholder="00">
                    <div class="input-group-append">
                        <span class="input-group-text style--three black bold">px</span>
                    </div>
                </div>
                <small>{{ translate('Top') }}</small>
                @if ($errors->has('margin_top'))
                    <div class="invalid-input">{{ $errors->first('margin_top') }}</div>
                @endif
            </div>
            <div class="col-sm-3">
                <div class="input-group addon">
                    <input type="text" class="form-control radius-0" name="margin_right" id="left-right-addons"
                        placeholder="00">
                    <div class="input-group-append">
                        <span class="input-group-text style--three black bold">px</span>
                    </div>
                </div>
                <small>{{ translate('Right') }}</small>
                @if ($errors->has('margin_right'))
                    <div class="invalid-input">{{ $errors->first('margin_right') }}</div>
                @endif
            </div>
            <div class="col-sm-3">
                <div class="input-group addon">
                    <input type="text" class="form-control radius-0" name="margin_bottom" id="left-right-addons"
                        placeholder="00">
                    <div class="input-group-append">
                        <span class="input-group-text style--three black bold">px</span>
                    </div>
                </div>
                <small>{{ translate('Bottom') }}</small>
                @if ($errors->has('margin_bottom'))
                    <div class="invalid-input">{{ $errors->first('margin_bottom') }}</div>
                @endif
            </div>
            <div class="col-sm-3">
                <div class="input-group addon">
                    <input type="text" class="form-control radius-0" name="margin_left" id="left-right-addons"
                        placeholder="00">
                    <div class="input-group-append">
                        <span class="input-group-text style--three black bold">px</span>
                    </div>
                </div>
                <small>{{ translate('Left') }}</small>
                @if ($errors->has('margin_left'))
                    <div class="invalid-input">{{ $errors->first('margin_left') }}</div>
                @endif
            </div>
        </div>

    </div>
</div>
