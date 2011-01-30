var skins = new Array();

skins["easy_glaze"] = new Array("Marc Reichelt", "http://www.marcreichelt.de/", "32", "32", "")
skins["easy_glaze_small"] = new Array("Marc Reichelt", "http://www.marcreichelt.de/", "22", "22", "")
skins["lila"] = new Array("Marc Reichelt", "http://www.marcreichelt.de/", "200", "55", "Images taken from the \"lila\" XMMS skin by Franck Alcidi.")
skins["lila_info"] = new Array("Marc Reichelt", "http://www.marcreichelt.de/", "200", "55", "Images taken from the \"lila\" XMMS skin by Franck Alcidi. Font taken from: http://pixelfonts.style-force.net/");
skins["old"] = new Array("Marc Reichelt", "http://www.marcreichelt.de/", "120", "55", "");
skins["old_noborder"] = new Array("Marc Reichelt", "http://www.marcreichelt.de/", "91", "25", "");
skins["position_blue"] = new Array("René Schindler", "", "100", "50", "Font taken from: http://pixelfonts.style-force.net/");
skins["silk"] = new Array("Marc Reichelt", "http://www.marcreichelt.de/", "84", "32", "Images taken from http://www.famfamfam.com/lab/icons/silk/ - special thanks go to Mark James! Font taken from: http://pixelfonts.style-force.net/");
skins["silk_button"] = new Array("Marc Reichelt", "http://www.marcreichelt.de/", "16", "16", "Images taken from http://www.famfamfam.com/lab/icons/silk/ - special thanks go to Mark James!");
skins["standard"] = new Array("Marc Reichelt", "http://www.marcreichelt.de/", "110", "34", "");
skins["stuttgart"] = new Array("Mario Ernst", "http://www.netzgiganten.de/", "140", "30", "Netzgiganten (http://www.netzgiganten.de/), Marc Reichelt");
skins["wooden"] = new Array("Alexander Brock", "http://alexanderbrock.de/", "120", "60", "");

function updateSkinsDimenion() {
	var skinName = $("#emff_skin_name").val();

	if (skinName == "") return false;
	var skinInfo = skins[skinName];
	
	$("#emff_skin_width").val(skinInfo[2]);
	$("#emff_skin_height").val(skinInfo[3]);
}

$(document).ready(function() {
	updateSkinsDimenion();
	$("#emff_skin_name").change(updateSkinsDimenion);
});

ccm_chooseAsset = function(obj) { 
   var mp3FileHtml = $("#mp3file").html();

   mp3FileHtml = mp3FileHtml.replace(/FILE_ID/g,obj.fID)
   mp3FileHtml = mp3FileHtml.replace(/FILE_NAME/g,obj.title)

   $("#mp3files").append("<div>"+mp3FileHtml+"</div>");		
}
