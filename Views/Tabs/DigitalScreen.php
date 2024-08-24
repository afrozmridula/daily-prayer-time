<?php
function displayImage($slide){
    if (filter_var($slide, FILTER_VALIDATE_URL)) {
        return  '<img src="' . esc_html($slide ) . '" style="max-height: 25px;" class="grow">';
    }
    return '';
}
?>
<h3>Masjid/Mobile screen settings</h3>
<div class="container-fluid">
    <form class="form-group" name="digitalScreen" method="post">
    <div class="row ds-templates">
        <table class="table">
            <tr>
                <td class="align-middle">
                <?php $template = plugins_url('../../Assets/images/EICT.png', __FILE__)?>
                    <a href="<?php echo $template ?>" target="_new">
                        <img src="<?php echo $template ?>" width="200px">
                    </a>
                    <br/>or use shortcode <code>template='eict'</code>
                </td>
                <td>
                    <?php $template = plugins_url('../../Assets/images/masjid-e-usman.jpeg', __FILE__)?>
                    <a href="<?php echo $template ?>" target="_new">
                        <img src="<?php echo $template ?>" width="200px">
                    </a>
                    <br/>or use shortcode <code>template='usman'</code>
                </td>
                <td><img src="<?php echo plugins_url('../../Assets/images/new-template.png', __FILE__)?>" width="200px"></td>
            </tr>
            <tr>
                <td style="width: 33%;"><input type="radio" name="ds-template" value="eict" <?php if(get_option("dsTemplate") === 'eict'){ echo 'checked'; } ?>><strong>Edgware Islamic Cultural Trust</strong></td>
                <td><input type="radio" name="ds-template" value="usman" <?php if(get_option("dsTemplate") === 'usman'){ echo 'checked'; } ?>><strong>Masjid-E-Usman</strong></td>
                <td><input type="radio" name="ds-template" value="" disabled><a href="mailto:mmrs151@gmail.com?subject=Add my design to your plugin" target="_new">Add Your Design</a></td>
            </tr>
        </table>
    </div>
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <?php echo wp_nonce_field( 'digitalScreen'); ?>
                <table class="table">
                    <tr>
                        <td class="active-slider">Select Template</td>
                        <td><input class="templateChbox" type="checkbox" id="template-chbox" name="template-chbox" value="template" <?php if(get_option("template-chbox") === 'template'){ echo 'checked'; } ?>></td>
                    </tr>
                    <tr>
                        <td class="active-slider">Fading Messages </br><i><sub>seperated by full stop.</sub></i></td>
                        <td>
                            <textarea name="ds-fading-msg" cols="30"><?php echo esc_html(stripslashes(get_option("ds-fading-msg")) )?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="active-slider">Custom Site Logo</td>
                        <td><input type="text" class="slider-text" placeholder="Any message or image url" name="ds-logo" size="30" value=<?php echo esc_html(get_option("ds-logo") )?>></td>
                    </tr>
                    <tr>
                        <td class="active-slider">Scrolling Text</td>
                        <td><input type="text" class="" name="ds-scroll-text" size="30" value="<?php echo esc_html(stripslashes(get_option("ds-scroll-text")) )?>"></td>
                    </tr>
                    <tr>
                        <td class="active-slider">Scrolling Speed</td>
                        <td><input type="number" min="10" max="100" class="" name="ds-scroll-speed" size="30" value="<?php echo esc_html(get_option("ds-scroll-speed") )?>"></td>
                    </tr>
                    <tr>
                        <td class="active-slider">Blink Text</td>
                        <td><input type="text" class="slider-text" name="ds-blink-text" size="30" value="<?php echo esc_html(stripslashes(get_option("ds-blink-text")) )?>"></td>
                    </tr>
                    <tr>
                        <td class="active-slider">Display Quran verse</td>
                        <td><input class="oneChbox" type="checkbox" id="quran-chbox" name="quran-chbox" value="displayQuran" <?php if(get_option("quran-chbox") === 'displayQuran'){ echo 'checked'; } ?>></td>
                    </tr>
                    <tr>
                        <td class="active-slider">Activate Slider</td>
                        <td><input class="oneChbox" type="checkbox" id="slider-chbox" name="slider-chbox" value="slider" <?php if(get_option("slider-chbox") === 'slider'){ echo 'checked'; } ?>></td>
                    </tr>
                    <tr class="ds-slides">
                        <td>Re-display Next Prayer</td>
                        <td><input type="number" class="slider-text" placeholder=" after number of slides" name="nextPrayerSlide" min="0" value=<?php echo esc_html(get_option("nextPrayerSlide") )?>>
                        </td>
                    </tr>
                    <tr class="ds-slides">
                        <td>Transition Effect</td>
                        <td>
                            <label class="radio-inline">
                                <input type="radio" name="transitionEffect" value="slide" <?php if(get_option("transitionEffect") === 'slide'){ echo 'checked'; } ?>>Slide
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="transitionEffect" value="carousel-fade" <?php if(get_option("transitionEffect") === 'carousel-fade'){ echo 'checked'; } ?>>Fade
                            </label>
                        </td>
                    </tr>
                    <tr class="ds-slides">
                        <td>Transition Speed</td>
                        <td><input type="number" min="0" class="slider-text" name="transitionSpeed" placeholder="5" value=<?php echo esc_html(get_option("transitionSpeed")/1000 ) ?>> seconds </td>
                    </tr>

                    <tr class="ds-slides">
                        <td>Slider #1</td>
                        <td><input type="text" class="slider-text" placeholder="Any message or image url" name="slider1" size="30" value="<?php echo esc_html(stripslashes(get_option("slider1")) )?>">
                        <?php echo displayImage(get_option("slider1")); ?>
                            <br/>
                                <input type="text" class="slider-text" placeholder="[optional] http(s)://  url" name="slider1Url" size="30" value=<?php echo esc_html(get_option("slider1Url") )?>>
                        </td>
                    </tr>
                    <tr class="ds-slides">
                        <td>Slider #2</td>
                        <td><input type="text" class="slider-text" placeholder="Any message or image url" name="slider2" size="30" value="<?php echo esc_html(stripslashes(get_option("slider2")) )?>">
                        <?php echo displayImage(get_option("slider2")); ?>
                            <br/>
                                <input type="text" class="slider-text" placeholder="[optional] http(s)://  url" name="slider2Url" size="30" value=<?php echo esc_html(get_option("slider2Url") )?>>
                        </td>
                    </tr>
                    <tr class="ds-slides">
                        <td>Slider #3</td>
                        <td><input type="text" class="slider-text" placeholder="Any message or image url" name="slider3" size="30" value="<?php echo esc_html(stripslashes(get_option("slider3")) )?>">
                            <?php echo displayImage(get_option("slider3")); ?>
                            <br/>
                                <input type="text" class="slider-text" placeholder="[optional] http(s)://  url" name="slider3Url" size="30" value=<?php echo esc_html(get_option("slider3Url") )?>>
                        </td>
                    </tr>
                    <tr class="ds-slides">
                        <td>Slider #4</td>
                        <td><input type="text" class="slider-text" placeholder="Any message or image url" name="slider4" size="30" value="<?php echo esc_html(stripslashes(get_option("slider4")) )?>">
                            <?php echo displayImage(get_option("slider4")); ?>
                            <br/>
                                <input type="text" class="slider-text" placeholder="[optional] http(s)://  url" name="slider4Url" size="30" value=<?php echo esc_html(get_option("slider4Url") )?>>
                        </td>
                    </tr>
                    <tr class="ds-slides">
                        <td>Slider #5</td>
                        <td><input type="text" class="slider-text" placeholder="Any message or image url" name="slider5" size="30" value="<?php echo esc_html(stripslashes(get_option("slider5")) )?>">
                            <?php echo displayImage(get_option("slider5")); ?>
                            <br/>
                                <input type="text" class="slider-text" placeholder="[optional] http(s)://  url" name="slider5Url" size="30" value=<?php echo esc_html(get_option("slider5Url") )?>>
                        </td>
                    </tr>
                    <tr class="ds-slides">
                        <td>Slider #6</td>
                        <td><input type="text" class="slider-text" placeholder="Any message or image url" name="slider6" size="30" value="<?php echo esc_html(stripslashes(get_option("slider6")) )?>">
                            <?php echo displayImage(get_option("slider6")); ?>
                            <br/>
                                <input type="text" class="slider-text" placeholder="[optional] http(s)://  url" name="slider6Url" size="30" value=<?php echo esc_html(get_option("slider6Url") )?>>
                        </td>
                    </tr>
                    <tr class="ds-slides">
                        <td>Slider #7</td>
                        <td><input type="text" class="slider-text" placeholder="Any message or image url" name="slider7" size="30" value="<?php echo esc_html(stripslashes(get_option("slider7")) )?>">
                            <?php echo displayImage(get_option("slider7")); ?>
                            <br/>
                                <input type="text" class="slider-text" placeholder="[optional] http(s)://  url" name="slider7Url" size="30" value=<?php echo esc_html(get_option("slider7Url") )?>>
                        </td>
                    </tr>
                    <tr class="ds-slides">
                        <td>Slider #8</td>
                        <td><input type="text" class="slider-text" placeholder="Any message or image url" name="slider8" size="30" value="<?php echo esc_html(stripslashes(get_option("slider8")) )?>">
                            <?php echo displayImage(get_option("slider8")); ?>
                            <br/>
                                <input type="text" class="slider-text" placeholder="[optional] http(s)://  url" name="slider8Url" size="30" value=<?php echo esc_html(get_option("slider8Url") )?>>
                        </td>
                    </tr>
                    <tr class="ds-slides">
                        <td>Slider #9</td>
                        <td><input type="text" class="slider-text" placeholder="Any message or image url" name="slider9" size="30" value="<?php echo esc_html(stripslashes(get_option("slider9")) )?>">
                            <?php echo displayImage(get_option("slider9")); ?>
                            <br/>
                                <input type="text" class="slider-text" placeholder="[optional] http(s)://  url" name="slider9Url" size="30" value=<?php echo esc_html(get_option("slider9Url") )?>>
                        </td>
                    </tr>
                    <tr class="ds-slides">
                        <td>Slider #10</td>
                        <td><input type="text" class="slider-text" placeholder="Any message or image url" name="slider10" size="30" value="<?php echo esc_html(stripslashes(get_option("slider10")) )?>">
                            <?php echo displayImage(get_option("slider10")); ?>
                            <br/>
                                <input type="text" class="slider-text" placeholder="[optional] http(s)://  url" name="slider10Url" size="30" value=<?php echo esc_html(get_option("slider10Url") )?>>
                        </td>
                    </tr>
                    <tr class="ds-slides">
                        <td>Slider #11</td>
                        <td><input type="text" class="slider-text" placeholder="Any message or image url" name="slider11" size="30" value="<?php echo esc_html(stripslashes(get_option("slider11")) )?>">
                            <?php echo displayImage(get_option("slider11")); ?>
                            <br/>
                                <input type="text" class="slider-text" placeholder="[optional] http(s)://  url" name="slider11Url" size="30" value=<?php echo esc_html(get_option("slider11Url") )?>>
                        </td>
                    </tr>
                    <tr>
                        <td class="active-slider">Additional CSS</td>
                        <td><textarea name="ds-additional-css" cols="30"><?php echo esc_html(get_option("ds-additional-css") )?></textarea></td>
                    </tr>   
                </table>
                <?php submit_button('Save changes', 'primary', 'digitalScreen'); ?>
        </div>
        <div class="col-sm-6 col-xs-12" style="background-color: #eeeeee;">
            <h3 class="pt-2"><code>INSTRUCTIONS</code></h3>
            <li><a class="url" href="post-new.php?post_type=page">Create a new page</a></li>
            <li>Select page template <code>Digital Screen Prayer Time</code></li>
            <li>Use shortcode <code>[digital_screen]</code> to display in Monitor</li>
            <li><code>[digital_screen view='vertical']</code> for Mobile diaplay</li>
            <li><code>[digital_screen view='presentation']</code> display slides only, hiding prayer time</li>
            <li><code>[digital_screen slides="image1Url,image2Url,...image11Url"]</code> Override slides</li>
            <li><code>[digital_screen view='vertical' dim=10]</code> to dim vertically screen for 10 mins when prayer starts</li>
            <li><code>[digital_screen view='vertical' dim=10 scroll='any text']</code> to override scrolling message</li>
            <li><code>[digital_screen view='vertical' dim=10 blink='any text']</code> to override blinking alert message</li>
            <li><code>[digital_screen view='vertical' blink='any text' blnk_link='https://valid.url' scroll='any text' scroll_link='https://valid.url']</code> Allows mobile user to click on the text and possibly pay donation</li>
        </div>
    </div>
    </form>
</div>

