<?php defined('APPLICATION') or die(); ?>
<h1><?php echo $this->Data('Title'); ?></h1>
<div class="Info">
   <?php echo T('Please see the <a href="https://github.com/simonbaird/CoolClock/">original readme</a> files for further information'); ?>
</div>
<?php
echo $this->Form->Open();
echo $this->Form->Errors();
?>
<div class="Configuration">
   <div class="ConfigurationForm">
      <ul>
         <li>
            <?php
               echo $this->Form->Label(T('Module Heading'), 'Plugins.CoolPanelClock.ShowHeading');
               echo $this->Form->CheckBox('Plugins.CoolPanelClock.ShowHeading', T('Show Module Heading'));
            ?>
         </li>
         <li>
            <?php
               echo $this->Form->Label(T('Skin'), 'Plugins.CoolPanelClock.Skin');
               echo $this->Form->TextBox('Plugins.CoolPanelClock.Skin');
            ?>
         </li>
         <li>
            <?php
               echo $this->Form->Label(T('Seconds'), 'Plugins.CoolPanelClock.ShowSeconds');
               echo $this->Form->CheckBox('Plugins.CoolPanelClock.ShowSeconds', T('Show Seconds'));
            ?>
         </li>
         <li>
            <?php
               echo $this->Form->Label(T('Digital Clock'), 'Plugins.CoolPanelClock.ShowDigitalClock');
               echo $this->Form->CheckBox('Plugins.CoolPanelClock.ShowDigitalClock', T('Show Digital Clock'));
            ?>
         </li>
         <li>
            <?php
               echo $this->Form->Label(T('Clock Radius'), 'Plugins.CoolPanelClock.Radius');
               echo $this->Form->TextBox('Plugins.CoolPanelClock.Radius');
            ?>
         </li>
         <li>
            <?php
               echo $this->Form->Label(T('GMT Offset'), 'Plugins.CoolPanelClock.SetGMTOffset');
               echo $this->Form->TextBox('Plugins.CoolPanelClock.GMTOffset');
               echo $this->Form->CheckBox('Plugins.CoolPanelClock.SetGMTOffset', T('Set GMT Offset'));
            ?>
         </li>
      </ul>
   </div>
<?php
echo $this->Form->Button('Save');
echo $this->Form->Close();
