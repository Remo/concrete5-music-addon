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
$includeAssetLibrary = true;
$al = Loader::helper('concrete/asset_library');

$files = $controller->getFiles();
?>

<div style="height:390px;overflow:auto;">

<h2><?php   echo t('MP3 Files')?></h2>
<div id="mp3files">
<?php   foreach ($files as $file): ?>
   <div>
      <div>
         <input type="hidden" name="mp3files[]" value="<?php   echo $file->getFileID() ?> "/>
         <div style="width:300px;float:left;"><?php   echo $file->getVersion()->getFilename() ?></div>
         <div style=""><a href="#" onclick="$(this).parent().parent().remove()"><?php   echo t('remove file')?></a></div>
      </div>
   </div>
<?php   endforeach; ?>
</div>

<div id="mp3file" style="display:none">
   <div>      
      <input type="hidden" name="mp3files[]" value="FILE_ID"/>
      <div style="width:300px;float:left;height:20px;overflow:hidden;">
			FILE_NAME		
		</div>
      <div style="height:20px;"><a href="#" onclick="$(this).parent().parent().remove()"><?php   echo t('remove file')?></a></div>
   </div>
</div>

<a href="javascript:ccm_launchFileManager()" style="display: inline;" href="#"><?php   echo t('Add new file')?></a>

<h2><?php   echo t('Layout')?></h2>
<table>
   <tr>
      <td>
         <?php   echo t('Skin')?>
      </td>
      <td>
         <select name="skin" id="emff_skin_name">
         <?php   foreach ($controller->getSkins()as $skin): ?>
            <option value="<?php   echo substr($skin,0,strrpos($skin, ".")); ?>" <?php   echo substr($skin,0,strrpos($skin, "."))==$controller->skin?'selected="selected"':''?>><?php   echo substr($skin,0,strrpos($skin, ".")) ?></option>
         <?php   endforeach; ?>
         </select>
      </td>
   </tr>
   <tr>
      <td><?php   echo t('Width')?></td>
      <td><input type="text" name="width" id="emff_skin_width" value="<?php   echo $controller->width?>"/></td>
   </tr>
   <tr>
      <td><?php   echo t('Height')?></td>
      <td><input type="text" name="height" id="emff_skin_height" value="<?php   echo $controller->height?>"/></td>
   </tr>
   <tr>
      <td><?php   echo t('Window Mode')?></td>
      <td>
         <select name="wmode">
            <option value="window"<?php echo $controller->wmode == 'window' ? ' selected="selected"' : '' ?>>Window</option>
            <option value="opaque"<?php echo $controller->wmode == 'opaque' ? ' selected="selected"' : '' ?>>Opaque</option>
            <option value="transparent"<?php echo $controller->wmode == 'transparent' ? ' selected="selected"' : '' ?>>Transparent</option>
         </select>
   </tr>
</table>

<h2><?php   echo t('Settings')?></h2>

<input name="autoLoad" type="checkbox" value="1" <?php   echo (intval($controller->autoLoad)>=1)?'checked="checked"':''?> />
<?php   echo t('Auto Load MP3 Files')?><br/>
		
<input name="autoStart" type="checkbox" value="1" <?php   echo (intval($controller->autoStart)>=1)?'checked="checked"':''?> />
<?php   echo t('Auto Start')?><br/>

<input name="shuffle" type="checkbox" value="1" <?php   echo (intval($controller->shuffle)>=1)?'checked="checked"':''?> />
<?php   echo t('Shuffle')?><br/>

<input name="repeatTracks" type="checkbox" value="1" <?php   echo (intval($controller->repeatTracks)>=1)?'checked="checked"':''?> />	
<?php   echo t('Repeat')?><br/>

<input name="shortcuts" type="checkbox" value="1" <?php   echo (intval($controller->shortcuts)>=1)?'checked="checked"':''?> />
<?php   echo t('Enable Shortcuts')?><br/>

</div>