<?php if (!defined('APPLICATION')) exit();
/**
  * Inserts the canvas where the coolclock.js script inserts the clock
  */
class CoolPanelClockModule extends Gdn_Module {
   public function AssetTarget() {
      return 'Panel';
   }
  
   public function ToString() {
      echo '<div id="CoolPanelClock" class="Box CoolPanelClockBox">';
      if (C('Plugins.CoolPanelClock.ShowHeading') == '1') {
         echo Wrap(T('CoolClock by Simon Baird'), 'h4');
      }
      echo '<canvas id="CoolPanelClockFace" class="'.$this->GetCoolClockClass().'"></canvas>';
      echo '</div>';
  }
  
  /**
   *  Creates the needed class string for the CoolClock script
   */
  private function GetCoolClockClass() {
      $CoolClockClass = 'CoolClock:'.C('Plugins.CoolPanelClock.Skin').':'.C('Plugins.CoolPanelClock.Radius').':';
      if (C('Plugins.CoolPanelClock.ShowSeconds') != '1') {
         $CoolClockClass .= 'noSeconds';
      }
      $CoolClockClass .= ':';
      if (C('Plugins.CoolPanelClock.SetGMTOffset') == '1') {
         $CoolClockClass .= C('Plugins.CoolPanelClock.GMTOffset');
      }
      if (C('Plugins.CoolPanelClock.ShowDigitalClock') == '1') {
         $CoolClockClass .= ':showDigital';
      }
      return $CoolClockClass;
  }
}