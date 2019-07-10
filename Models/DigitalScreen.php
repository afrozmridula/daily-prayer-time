<?php

class DigitalScreen extends DailyShortCode
{
    /** @var array */
    protected $row = array();

    /** @var bool */
    private $isPortrait;

    /** @var int */
    private $screenTimeout;

    public function __construct($attr=array())
    {
        parent::__construct();

        if ( isset($attr['view']) ) {
            $this->isPortrait = ( strtolower($attr['view']) == 'vertical' );
        }

        if ( isset($attr['dim']) ) {
            $this->screenTimeout = $attr['dim'];
        }
    }

    public function displayDigitalScreen()
    {
        $html = $this->getTopRow()
            . $this->getMiddleRow()
            .$this->getBottomRow();

        return $html;
    }

    private function getTopRow()
    {
        $timeClass = "col-sm-3 ";
        $dateClass = "col-sm-7 ";
        $height = "height-100";
        $verticalClass = "";
        if (  $this->isPortrait  ) {
            $timeClass = "col-xs-12 vertical-time ";
            $dateClass = "col-xs-12 vertical-date";
            $height = "height-50 ";
            $verticalClass = "vertical";
        }

        if ( get_option('hijri-chbox')) {
            $date = date_i18n( 'D jS  M' );
        } else {
            $date = date_i18n( 'l ' . get_option( 'date_format' ) );
        }

        $html = '
        <div class="container-fluid x-board">
            <input type="hidden" value="' . $this->screenTimeout . '" id="screenTimeout">
            <input type="hidden" value="' . htmlspecialchars(json_encode($this->getRefreshPoints())) . '" id="refreshPoint">
            <input type="hidden" value="' . htmlspecialchars(json_encode($this->getOtherAdhanTimes())) . '" id="otherAdhanTimes">
            <input type="hidden" value="' . htmlspecialchars(json_encode($this->getFajrAdhanTime())) . '" id="fajrAdhanTime">
            <div class="row top-row">
                <div class="time ' . $timeClass . 'col-xs-12 text-center ' . $height . '">
                <div class="clock align-middle">
                  <ul class="clock">
                      <li id="hours"></li>
                      <li id="point">:</li>
                      <li id="min"></li>
                      <li id="ampm"></li>
                  </ul>
                </div>
                </div>
                <div class="' . $dateClass . ' col-xs-12 text-center bg-white ' . $height . '">
                    <div class="align-middle">
                        <span id="dsDate" class="date-eng h6 ' . $verticalClass . '">' . $date. '</span>
                        <span id="dsHijriDate" class="'. $verticalClass . 'hijri">
                        ' . $this->getHijriDate(date("d"), date("m"), date("Y"), $this->getRow()) . '
                        </span>
                    </div>
                </div>
                <div class="col-sm-2 col-xs-12 text-right align-middle padding-null">';
        $isLogo = get_option('ds-logo');
        if ( $isLogo && ! $this->isPortrait) {
            $html .= '<img class="logo" src="' . $isLogo . '">';
        }
        $html .=
            '</div>
            </div>';
        return $html;
    }
    private function getMiddleRow()
    {
        $leftClass = "col-sm-5 col-xs-12 bg-red height-100 padding-null text-center";
        $rightClass = "col-sm-7 col-xs-12 padding-null text-center bg-green height-100 padding-null";
        $verticalClass = "";

        if ( $this->isPortrait ) {
            $verticalClass = "vertical";
            $leftClass = "col-sm-12 bg-red padding-null text-center height-50";
            $rightClass = "col-sm-12 padding-null text-center bg-green height-50";
        }

        $html =  '
            <div class="row middle-row bg-red">
                <div class="'. $leftClass .'">
                    <table id="dsPrayerTimetable" class="table height-100 '. $verticalClass .'">
                    <thead class="bg-dark">
                <tr>
                    <td>
                        <span class="dpt_start">' . strtoupper($this->getLocalHeaders()['prayer']) . '</span>
                    </td>
                    <td>
                        <span class="dpt_start">' . strtoupper($this->getLocalHeaders()['begins']) . '</span>
                    </td>
                    <td> 
                        <span class="dpt_jamah">' . strtoupper($this->getLocalHeaders()['iqamah']) . '</span>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="prayerName">
                        <span>' . $this->getLocalPrayerNames()['fajr'] . '</span>
                    </td>
                    <td class="l-red">' . do_shortcode("[fajr_start]") . '</td>
                    <td>' . do_shortcode("[fajr_prayer]") . '</td>
                </tr>
                <tr>
                    <td class="prayerName"><span>' . $this->getLocalPrayerNames()['sunrise'] . '</span></td>
                    <td class="prayerName" colspan="2">' . do_shortcode("[sunrise]") . '</td>
                </tr>';

        if ( get_option('jumuah') && $this->todayIsFriday() && $this->isJumahDisplay($this->row)) {
            $html .= '<tr>
                            <td class="prayerName"><span>' . stripslashes($this->getLocalHeaders()['jumuah']) . '</span></td>
                            <td colspan="2" class="prayerName">' . get_option('jumuah') . '</td>
                        </tr>';
        } else {
            $html .= '
            <tr>
                <td class="prayerName"><span>' . $this->getLocalPrayerNames()['zuhr'] . '</span></td>
                <td class="l-red">' . do_shortcode("[zuhr_start]") . '</td>
                <td>' . do_shortcode("[zuhr_prayer]") . '</td>
            </tr>
    ';
        }

        $html .= '<tr>
            <td class="prayerName"><span>' . $this->getLocalPrayerNames()['asr'] . '</span></td>
            <td class="l-red">' . do_shortcode("[asr_start]") . '</td>
            <td>' . do_shortcode("[asr_prayer]") . '</td>
        </tr>
        <tr>
            <td class="prayerName"><span>' . $this->getLocalPrayerNames()['maghrib'] . '</span></td>
            <td class="l-red">' . do_shortcode("[maghrib_start]") . '</td>
            <td>' . do_shortcode("[maghrib_prayer]") . '</td>
        </tr>
        <tr>
            <td class="prayerName"><span>' . $this->getLocalPrayerNames()['isha'] . '</span></td>
            <td class="l-red">' . do_shortcode("[isha_start]") . '</td>
            <td>' . do_shortcode("[isha_prayer]") . '</td>
        </tr>';
        if ( get_option('jumuah') && (! $this->todayIsFriday() || ! $this->isJumahDisplay($this->row)) ) {
            $html .= '
                <tr>
                    <td class="prayerName"><span>' . stripslashes($this->getLocalHeaders()['jumuah']) . '</span></td>
                    <td colspan="2" class="prayerName"><span>' . get_option('jumuah') . '</span></td>
                </tr>';
            }
        $html .= '
            </tbody>
                    </table>
        </div>';

        $transitionEffect = get_option('transitionEffect');
        $transitionSpeed = get_option('transitionSpeed');
        $html .='
            <div class="'. $rightClass .'">
                <div id="text-carousel" class="carousel slide ' . $transitionEffect . ' 
                    height-100" data-ride="carousel" data-interval="'. $transitionSpeed .'" data-pause="false">
                    <div class="carousel-inner height-100">
                        <div class="item active height-100">
                        ' . $this->getFirstSlide() . '
                        </div>
                        ' . $this->getOtherSlides() . '
                    </div>
                </div>
            </div>
        </div>
        ';

        return $html;
    }

    private function getBottomRow()
    {
        $verticalClass = "";

        if ( $this->isPortrait ) {
            $verticalClass = "vertical";
        }

        $html = '
                <div class="row bottom-row">
                    <div class="notificationBackground col-sm-3 col-xs-12 text-center height-100 align-middle">
                        <div class="align-middle">
                                <span id="dsBlink" class="blink">' . $this->getBlink() . '</span>
                        </div>
                    </div>                
                    <div class="col-sm-9 col-xs-12 height-100">
                        <div class="align-middle">
                            <h3 class="text-primary scrolling">
                                <marquee id="dsIqamahUpdate" scrollamount="11">' . $this->getIqamahUpdate() . '</marquee> 
                            </h3> 
                        </div>
                    </div>
                </div>
            </div>
        ';

        if ($this->isPortrait) {
            $html = '
                <div class="row bottom-row">             
                    <div class="col-sm-12 col-xs-12 height-30">
                        <div class="align-middle">
                            <h3 class="text-primary scrolling-vertical">
                                <marquee id="dsIqamahUpdate" scrollamount="11">' . $this->getIqamahUpdate() . '</marquee> 
                            </h3> 
                        </div>
                    </div>
                    <div class="notificationBackground col-sm-12 col-xs-12 text-center height-50 align-middle">
                        <div class="align-middle">
                                <span id="dsBlink" class="blink-'.$verticalClass.'">' . $this->getBlink() . '</span>
                        </div>
                    </div>   
                </div>
            </div>
        ';
        }

        return $html;
    }

    private function getIqamahUpdate()
    {
        if ( get_option('scrolling-text')) {
            return get_option('scrolling-text');
        } else {
            return do_shortcode("[display_iqamah_update orientation='horizontal']");
        }
    }

    private function getBlink()
    {
        return get_option('blink-text', 'SILENT YOUR MOBILE');
    }

    private function getFirstSlide()
    {
        $verticalClass = "";
        if ( $this->isPortrait ) {
            $verticalClass = "vertical";
        }

        $html =  '
            <div class="nextPrayer height-100">
                <div class="align-middle">
                <h3 class="'.$verticalClass.'">'. $this->getLocalTimes()['next prayer'] . '</h3>
                    <h2 id="dsNextPrayer" class="dsNextPrayer '.$verticalClass.'"></h2>
                </div>
            </div>';

        return $html;
    }

    private function getOtherSlides()
    {
        $isSlide = get_option('slider-chbox');
        if ( $isSlide ) {
            $html = "";
            $slides = array();

            $slides[] = get_option('slider1Url');
            $slides[] = get_option('slider2Url');
            $slides[] = get_option('slider3Url');
            $slides[] = get_option('slider4Url');
            $slides[] = get_option('slider5Url');
            $slides[] = get_option('slider6Url');

            $slides = array_filter($slides);
            foreach ($slides as $i => $slideUrl) {
                $html .= '
                <div class="item" >
                    <img class="carousel-slide" src="' . $slideUrl . '">
                </div>               
                ';

                $count = $i + 1;
                if ( $count % 2 == 0 ) {
                    $html .= '
                        <div class="item">
                            ' . $this->getFirstSlide() . '
                        </div>
                    ';
                }
            }

            return $html;
        }

        return null;
    }

    private function getRefreshPoints()
    {
        $result = $this->db->getPrayerTimeForToday();
        $iqamahTimes =  array($result['fajr_jamah'], $result['sunrise'], $result['zuhr_jamah'], $result['asr_jamah'], $result['maghrib_jamah'], $result['isha_jamah']);

        $refreshPoints = array();
        foreach($iqamahTimes as $iqamah) {
            $refreshPoints[] = date( "H:i:s", strtotime( $iqamah . "-16 minutes" ) );
        }

        return $refreshPoints;
    }

    private function getOtherAdhanTimes()
    {
        $result = $this->db->getPrayerTimeForToday();
        $iqamahTimes =  array($result['zuhr_jamah'], $result['asr_jamah'], $result['maghrib_begins'], $result['isha_jamah']);

        $adhanTimes = array();
        $adhanTimes[] = date( "H:i:s", strtotime( $iqamahTimes[0] . "-15 minutes" ) ); // zuhr
        $adhanTimes[] = date( "H:i:s", strtotime( $iqamahTimes[1] . "-15 minutes" ) ); // asr
        $adhanTimes[] = date( "H:i:s", strtotime( $iqamahTimes[2] . "0 minutes" ) ); // maghrib
        $adhanTimes[] = date( "H:i:s", strtotime( $iqamahTimes[3] . "-15 minutes" ) ); // isha

        return $adhanTimes;
    }

    private function getFajrAdhanTime()
    {
        $result = $this->db->getPrayerTimeForToday();

        return date( "H:i:s", strtotime( $result['fajr_jamah'] . "-15 minutes" ) ); // fajr
    }

    
    

}