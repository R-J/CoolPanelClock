<?php if (!defined('APPLICATION')) exit();
/**
  * Implementation of "CoolClock" by Simon Baird 
  * CoolClock is a skinnable analog clock. You can find the sources here: https://github.com/simonbaird/CoolClock/
  * Clock is shown in panel
  */
$PluginInfo['CoolPanelClock'] = array(
   'Name' => 'Cool Panel Clock',
   'Description' => 'Cool Panel Clock shows a skinnable analog clock in the panel. The script was made by Simon Baird (https://github.com/simonbaird/CoolClock/). Please read there on how to customize the clock',
   'Version' => '0.1',
   'RequiredApplications' => array('Vanilla' => '2.0.18.8'),
   'HasLocale' => TRUE,
   'SettingsUrl' => '/settings/coolpanelclock',
   'SettingsPermission' => 'Garden.AdminUser.Only',
	'MobileFriendly' => TRUE,
   'Author' => 'Robin'
);

class CoolPanelClockPlugin extends Gdn_Plugin {
   /**
    *  create default values for settings
    */
   public function Setup() {
      if(C('Plugins.CoolPanelClock.Skin')=='') {
         SaveToConfig('Plugins.CoolPanelClock.Skin', 'vanilla');
      }
      if(C('Plugins.CoolPanelClock.Radius')=='') {
         SaveToConfig('Plugins.CoolPanelClock.Radius', '85');
      }
   } // End of Setup
   

   /**
    *  add module, styling and scripts
    *  
    */
   public function Base_Render_Before($Sender) {
      // don't show in dashboard
      if($Sender->MasterView != 'admin') {
			$Sender->AddCSSFile($this->GetResource('design/coolpanelclock.css', FALSE, FALSE));
         $Sender->AddJsFile($this->GetResource('js/coolclock/coolclock.js', FALSE, FALSE));
         $Sender->AddJsFile($this->GetResource('js/coolclock/moreskins.js', FALSE, FALSE));
         // only render our module in panel
         if(GetValue('Panel',$Sender->Assets)) {
            $CoolPanelClockModule = new CoolPanelClockModule($Sender);
            $Sender->AddModule($CoolPanelClockModule);
         }
      }
   } // End of Base_Render_Before
   
   /**
    *  Clean up the configuration file
    */
   public function OnDisable() {
      RemoveFromConfig(array(
         'Plugins.CoolPanelClock.Skin'
         ,'Plugins.CoolPanelClock.Radius'
         ,'Plugins.CoolPanelClock.ShowSeconds'
         ,'Plugins.CoolPanelClock.SetGMTOffset'
         ,'Plugins.CoolPanelClock.GMTOffset'
         ,'Plugins.CoolPanelClock.ShowDigitalClock'
         ,'Plugins.CoolPanelClock.ShowHeading'));
   } // End of OnDisable
   
   public function SettingsController_CoolPanelClock_Create($Sender) {
      $Sender->Permission('Garden.AdminUser.Only');
		$Sender->Title(T('Cool Panel Clock Settings'));
		$Sender->AddSideMenu('settings/coolpanelclock');
		$Validation = new Gdn_Validation();
    	$Validation->ApplyRule('Plugins.CoolPanelClock.Skin', 'Required');
    	$Validation->ApplyRule('Plugins.CoolPanelClock.Radius', 'Integer');
    	$Validation->ApplyRule('Plugins.CoolPanelClock.ShowSeconds', 'Boolean');
    	$Validation->ApplyRule('Plugins.CoolPanelClock.SetGMTOffset', 'Boolean');
    	$Validation->ApplyRule('Plugins.CoolPanelClock.GMTOffset', 'Integer');
    	$Validation->ApplyRule('Plugins.CoolPanelClock.ShowDigitalClock', 'Boolean');
    	$Validation->ApplyRule('Plugins.CoolPanelClock.ShowHeading', 'Boolean');
		$ConfigurationModel = new Gdn_ConfigurationModel($Validation);
		$ConfigurationModel->SetField(array(
         'Plugins.CoolPanelClock.Skin'
         ,'Plugins.CoolPanelClock.Radius'
         ,'Plugins.CoolPanelClock.ShowSeconds'
         ,'Plugins.CoolPanelClock.SetGMTOffset'
         ,'Plugins.CoolPanelClock.GMTOffset'
         ,'Plugins.CoolPanelClock.ShowDigitalClock'
         ,'Plugins.CoolPanelClock.ShowHeading'));
    	$Form = $Sender->Form;
		$Sender->Form->SetModel($ConfigurationModel);
		if ($Sender->Form->AuthenticatedPostBack() != FALSE) {
            if ($Sender->Form->Save() != FALSE) {
				$Sender->StatusMessage = T('Saved');
            }
		} else {
			$Sender->Form->SetData($ConfigurationModel->Data);
		}
		$Sender->View = $this->GetView('settings.php');
		$Sender->Render();
	} // End SettingsController_CoolPanelClock_Create
} // End of CoolPanelClockPlugin
