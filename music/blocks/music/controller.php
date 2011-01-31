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
	require_once(DIR_FILES_BLOCK_TYPES_CORE . '/library_file/controller.php');

   /**
    * The MusicBlockController class manages all the function of the block.
    * Manages information about the files, settings, skins in the database
    * 
    * @author Remo Laubacher <remo.laubacher@gmail.com>
    * @link http://www.concrete5.org
    * @license http://www.gnu.org/licenses/ GPL    
    */    
	class MusicBlockController extends BlockController {

		protected $btInterfaceWidth = 450;
		protected $btInterfaceHeight = 430;
		protected $btTable = 'btMusicPlayer';
		protected $btCacheBlockRecord = true;
		protected $btCacheBlockOutput = true;
		protected $btCacheBlockOutputOnPost = true;
		protected $btCacheBlockOutputForRegisteredUsers = true;
      protected $btCacheBlockOutputLifetime = 60*30; // 30 minutes
      
   	function __construct($obj = null) {
   		parent::__construct($obj);
   		$this->db = Loader::db();
      }
      
		public function getBlockTypeDescription() {
			return t("Plays music files using the flash based EMFF player.");
		}
		
		public function getBlockTypeName() {
			return t("Music");
		}      
		
		/**
		 * Returns all the selected files. Used by the block editor but also by
		 * view.php to pass the files to the flash player.		 
		 * 		 
		 * @access public
	    * @param  string $returnString 
		 * @return string list of mp3 files
		 * @return array  array of mp3 files		 
		*/
		public function getFiles($returnString = false) {
         $q = 'SELECT fID FROM btMusicPlayerFiles WHERE bID=?';
         $v = array($this->bID);
         
         $r = $this->db->Execute($q,$v);
         
         $filesString = array();
         $files = array();
         while ($row = $r->fetchRow()) {
            $fileObj       = File::getByID($row['fID']);
            $files[]       = $fileObj;
            $filesString[] = $fileObj->getURL();
            //$filesString[] = REL_DIR_FILES_UPLOADED . '/' . $fileObj->getFilename();
         }
         if ($returnString) {
            return join(',', $filesString);
         }
         else {
            return $files;
         }
		}
		
		/**
		 * Callback method that filters the directory list 
		 * 		 
		 * @access private
	    * @param  string $value directory name to check 
		 * @return boolean true if value doesn't have to be filtered		 
		*/
      private function filterDirectories($value)
      {
         return ($value != '..' && $value != '.');
      }
      
      /**
		 * Returns an array with all skins in the subdirectory "skins"
		 * 		 
		 * @access public
		 * @return array list with all the files
		*/
      public function getSkins()
      {
         $scripts = scandir(dirname(__FILE__) . '/skins');
         $scripts = array_filter($scripts,array($this,'filterDirectories'));
         return $scripts;
      }
      
      /**
		 * Override delete methode, makes sure the table btMusicPlayerFiles get
		 * cleaned		 
		 * 		 
		 * @access public
		*/     		
		public function delete() {
         $q = 'DELETE FROM btMusicPlayerFiles WHERE bID=?';
         $v = array($this->bID);
         $this->db->Execute($q,$v);
         
			parent::delete();
		}
		
		/**
		 * Saves all the data
		 * 
		 * @access public
		 */                     		
      public function save($data=array()) {
         $args['autoLoad']       = array_key_exists('autoLoad',$data) ? 1 : 0;
         $args['autoStart']      = array_key_exists('autoStart',$data) ? 1 : 0;
         $args['shuffle']        = array_key_exists('shuffle',$data) ? 1 : 0;
         $args['repeatTracks']   = array_key_exists('repeatTracks',$data) ? 1 : 0;
         $args['shortcuts']      = array_key_exists('shortcuts',$data) ? 1 : 0;
         
         $args['width']  = $data['width'];
         $args['height'] = $data['height'];         
         $args['skin']   = $data['skin'];
         $args['wmode']  = $data['wmode'];
         
         $q = 'DELETE FROM btMusicPlayerFiles WHERE bID=?';
         $v = array($this->bID);
         $this->db->Execute($q,$v);
         
         foreach ($data['mp3files'] as $value) {
            if ($value=='FILE_ID') continue;
            
            $q = 'INSERT INTO btMusicPlayerFiles (bID,fID) VALUES (?,?)';
            $v = array($this->bID, $value);
            $this->db->Execute($q,$v);
         }
         
   	   parent::save($args);
      }
      
		public function on_page_view() {
			$html = Loader::helper('html');
			$this->addHeaderItem($html->javascript('swfobject.js'));
		}        
      	
	}
?>
