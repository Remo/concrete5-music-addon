<?php   
/**
* Concrete5 Music Player block based on EMFF Copyright
* 
* @author Remo Laubacher <remo.laubacher@gmail.com>
* @link http://www.concrete5.org
* @license http://www.gnu.org/licenses/ GPL
*
*/
defined('C5_EXECUTE') or die(_("Access Denied."));
global $c;

if ($c->isEditMode()) { 
   echo t('Content disabled in edit mode.');
}
else {
?>
<div class="musicplayer">
<div id="ccm-player-id<?php   echo $bID; ?>">
please install the flash player
</div>
</div>

<script type="text/javascript">
swfobject.embedSWF("<?php   echo $this->getBlockURL()?>/skins/<?php   echo $controller->skin?>.swf", 
                   "ccm-player-id<?php   echo $bID; ?>", 
                   "<?php   echo $controller->width?>", 
                   "<?php   echo $controller->height?>", 
                   "9.0.0", 
                   "expressInstall.swf", 
                     {src: "<?php   echo $controller->getFiles(true) ?>",
                      autoload: "<?php   echo $controller->autoLoad==1?'yes':'no'?>",
                      repeat: "<?php   echo $controller->repeatTracks==1?'yes':'no'?>",
                      shuffle: "<?php   echo $controller->shuffle==1?'yes':'no'?>",
                      shortcuts: "<?php   echo $controller->shortcuts==1?'yes':'no'?>",
                      autostart: "<?php   echo $controller->autoStart==1?'yes':'no'?>"},
                     {wmode: "<?php echo $controller->wmode ?>"});
</script>

<?php   } ?>