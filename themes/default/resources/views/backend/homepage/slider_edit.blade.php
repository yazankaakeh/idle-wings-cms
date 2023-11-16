@php
    $blogCategories = \Core\Models\TlBlogCategory::where('is_publish', config('settings.general_status.active'))->get();
@endphp
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
                <label class="font-14 bold black">{{ translate('Select Option') }}</label>
            </div>
            <div class="col-sm-12">
                <select class="theme-input-style custom-product-options" name="content" required
                    onchange="selectProductOption()">
                    <option value="latest" @selected(getHomePageSectionProperties($details->id, 'content') == 'latest')>{{ translate('Latest Blogs') }}</option>
                    <option value="featured" @selected(getHomePageSectionProperties($details->id, 'content') == 'featured')>{{ translate('Featured Blogs') }}</option>
                    <option value="most_viewed" @selected(getHomePageSectionProperties($details->id, 'content') == 'most_viewed')>{{ translate('Most Viewed Blog') }}
                    </option>
                    <option value="trending" @selected(getHomePageSectionProperties($details->id, 'content') == 'trending')>{{ translate('Trending Blog') }}</option>
                    <option value="category" @selected(getHomePageSectionProperties($details->id, 'content') == 'category')>{{ translate('Category Wise') }}</option>
                </select>

                @if ($errors->has('content'))
                    <div class="invalid-input">{{ $errors->first('content') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row mb-20 category-options d-none">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Select Category') }}</label>
            </div>
            <div class="col-sm-12">
                <select class="theme-input-style" name="category">
                    @foreach ($blogCategories as $category)
                        <option value="{{ $category->id }}" @selected(getHomePageSectionProperties($details->id, 'category') == $category->id)>{{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('category'))
                    <div class="invalid-input">{{ $errors->first('category') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Category Color') }} </label>
            </div>
            <div class="col-sm-12">
                <div class="input-group addon">
                    <input type="text" name="category_color" class="color-input form-control style--two"
                        placeholder="#000000" value="{{ getHomePageSectionProperties($details->id, 'category_color') }}">
                    <div class="input-group-append">
                        <input type="color" class="input-group-text theme-input-style2 color-picker" id="colorPicker"
                            value="{{ getHomePageSectionProperties($details->id, 'category_color') }}"
                            oninput="selectColor(event,this.value)">
                    </div>
                </div>
                @if ($errors->has('category_color'))
                    <div class="invalid-input">{{ $errors->first('category_color') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Title Color') }} </label>
            </div>
            <div class="col-sm-12">
                <div class="input-group addon">
                    <input type="text" name="title_color" class="color-input form-control style--two"
                        placeholder="#000000"
                        value="{{ getHomePageSectionProperties($details->id, 'title_color') }}">
                    <div class="input-group-append">
                        <input type="color" class="input-group-text theme-input-style2 color-picker" id="colorPicker"
                            value="{{ getHomePageSectionProperties($details->id, 'title_color') }}"
                            oninput="selectColor(event,this.value)">
                    </div>
                </div>
                @if ($errors->has('title_color'))
                    <div class="invalid-input">{{ $errors->first('title_color') }}</div>
                @endif
            </div>
        </div>
    </div>

    <!--Background-->
    <div class="tab-pane fade" id="background" role="tabpanel" aria-labelledby="background-tab">
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Background Color') }} </label>
            </div>
            <div class="col-sm-12">
                <div class="input-group addon">
                    <input type="text" name="bg_color" class="color-input form-control style--two"
                        placeholder="#000000" value="{{ getHomePageSectionProperties($details->id, 'bg_color') }}">
                    <div class="input-group-append">
                        <input type="color" class="input-group-text theme-input-style2 color-picker"
                            id="colorPicker" value="{{ getHomePageSectionProperties($details->id, 'bg_color') }}"
                            oninput="selectColor(event,this.value)">
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
                    'data' => getHomePageSectionProperties($details->id, 'bg_image'),
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
                    <option value="cover" @selected(getHomePageSectionProperties($details->id, 'background_size') == 'cover')>{{ translate('cover') }}</option>
                    <option value="auto" @selected(getHomePageSectionProperties($details->id, 'background_size') == 'auto')>{{ translate('auto') }}</option>
                    <option value="contain" @selected(getHomePageSectionProperties($details->id, 'background_size') == 'contain')>{{ translate('contain') }}</option>
                    <option value="initial" @selected(getHomePageSectionProperties($details->id, 'background_size') == 'initial')>{{ translate('initial') }}</option>
                    <option value="revert" @selected(getHomePageSectionProperties($details->id, 'background_size') == 'revert')>{{ translate('revert') }}</option>
                    <option value="inherit" @selected(getHomePageSectionProperties($details->id, 'background_size') == 'inherit')>{{ translate('inherit') }}</option>
                    <option value="revert-layer" @selected(getHomePageSectionProperties($details->id, 'background_size') == 'revert-layer')>{{ translate('revert-layer') }}
                    </option>
                    <option value="unset" @selected(getHomePageSectionProperties($details->id, 'background_size') == 'unset')>{{ translate('unset') }}</option>
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
                    <option value="bottom" @selected(getHomePageSectionProperties($details->id, 'background_position') == 'bottom')>{{ translate('bottom') }}</option>
                    <option value="center" @selected(getHomePageSectionProperties($details->id, 'background_position') == 'center')>{{ translate('center') }}</option>
                    <option value="inherit" @selected(getHomePageSectionProperties($details->id, 'background_position') == 'inherit')>{{ translate('inherit') }}</option>
                    <option value="initial" @selected(getHomePageSectionProperties($details->id, 'background_position') == 'initial')>{{ translate('initial') }}</option>
                    <option value="left" @selected(getHomePageSectionProperties($details->id, 'background_position') == 'left')>{{ translate('left') }}</option>
                    <option value="revert" @selected(getHomePageSectionProperties($details->id, 'background_position') == 'revert')>{{ translate('revert') }}</option>
                    <option value="revert-layer" @selected(getHomePageSectionProperties($details->id, 'background_position') == 'revert-layer')>{{ translate('revert-layer') }}
                    </option>
                    <option value="right" @selected(getHomePageSectionProperties($details->id, 'background_position') == 'right')>{{ translate('right') }}</option>
                    <option value="top" @selected(getHomePageSectionProperties($details->id, 'background_position') == 'top')>{{ translate('top') }}</option>
                    <option value="unset" @selected(getHomePageSectionProperties($details->id, 'background_position') == 'unset')>{{ translate('unset') }}</option>
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
                    <option value="no-repeat" @selected(getHomePageSectionProperties($details->id, 'background_repeat') == 'no-repeat')>no-repeat</option>
                    <option value="repeat" @selected(getHomePageSectionProperties($details->id, 'background_repeat') == 'repeat')>repeat</option>
                </select>
                @if ($errors->has('background_repeat'))
                    <div class="invalid-input">{{ $errors->first('background_repeat') }}</div>
                @endif
            </div>
        </div>
    </div>
    <!--End background-->

    <!--Advanced-->
    <div class="tab-pane fade" id="advanced" role="tabpanel" aria-labelledby="advanced-tab">
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Padding') }} </label>
            </div>
            <div class="col-sm-3">
                <div class="input-group addon">
                    <input type="text" class="form-control radius-0" name="padding_top" id="left-right-addons"
                        placeholder="00" value="{{ getHomePageSectionProperties($details->id, 'padding_top') }}">
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
                        placeholder="00" value="{{ getHomePageSectionProperties($details->id, 'padding_right') }}">
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
                        placeholder="00" value="{{ getHomePageSectionProperties($details->id, 'padding_bottom') }}">
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
                        placeholder="00" value="{{ getHomePageSectionProperties($details->id, 'padding_left') }}">
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
                        placeholder="00" value="{{ getHomePageSectionProperties($details->id, 'margin_top') }}">
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
                        placeholder="00" value="{{ getHomePageSectionProperties($details->id, 'margin_right') }}">
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
                        placeholder="00" value="{{ getHomePageSectionProperties($details->id, 'margin_bottom') }}">
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
                        placeholder="00" value="{{ getHomePageSectionProperties($details->id, 'margin_left') }}">
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
    <!--End advance-->
</div>
<script>
    function selectProductOption() {
        "use strict";
        let layout = $(".custom-product-options").val();
        if (layout === 'category') {
            $('.category-options').removeClass('d-none');
        } else {
            $('.category-options').addClass('d-none');
        }
    }
</script>
