<?php   

defined('C5_EXECUTE') or die(_("Access Denied."));

class MusicPackage extends Package {

	protected $pkgHandle = 'music';
	protected $appVersionRequired = '5.3.3';
	protected $pkgVersion = '1.0.4';
	
	public function getPackageDescription() {
		return t("Plays music files using the flash based EMFF player.");
	}
	
	public function getPackageName() {
		return t("Music");
	}
	
	public function install() {
		$pkg = parent::install();
		
		// install block		
		BlockType::installBlockTypeFromPackage('music', $pkg);
		
	}




}