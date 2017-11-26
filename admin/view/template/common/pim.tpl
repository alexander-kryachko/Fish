<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en" xml:lang="en">
<head>
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<script type="text/javascript" src="view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="view/javascript/jquery/ui/themes/base/jquery.ui.all.css" />
<script type="text/javascript" src="view/javascript/jquery/ui/external/jquery.bgiframe-2.1.2.js"></script>
<script type="text/javascript" src="view/javascript/jquery/jstree/jquery.tree.min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ajaxupload.js"></script>
	<!-- elfinder core -->
	<script src="view/javascript/pim/elFinder.js"></script>
	<script src="view/javascript/pim/elFinder.version.js"></script>
	<script src="view/javascript/pim/jquery.elfinder.js"></script>
	<script src="view/javascript/pim/elFinder.resources.js"></script>
	<script src="view/javascript/pim/elFinder.options.js"></script>
	<script src="view/javascript/pim/elFinder.history.js"></script>
	<script src="view/javascript/pim/elFinder.command.js"></script>

	<!-- elfinder ui -->
	<script src="view/javascript/pim/ui/overlay.js"></script>
	<script src="view/javascript/pim/ui/workzone.js"></script>
	<script src="view/javascript/pim/ui/navbar.js"></script>
	<script src="view/javascript/pim/ui/dialog.js"></script>
	<script src="view/javascript/pim/ui/tree.js"></script>
	<script src="view/javascript/pim/ui/cwd.js"></script>
	<script src="view/javascript/pim/ui/toolbar.js"></script>
	<script src="view/javascript/pim/ui/button.js"></script>
	<script src="view/javascript/pim/ui/uploadButton.js"></script>
	<script src="view/javascript/pim/ui/viewbutton.js"></script>
	<script src="view/javascript/pim/ui/searchbutton.js"></script>
	<script src="view/javascript/pim/ui/sortbutton.js"></script>
	<script src="view/javascript/pim/ui/panel.js"></script>
	<script src="view/javascript/pim/ui/contextmenu.js"></script>
	<script src="view/javascript/pim/ui/path.js"></script>
	<script src="view/javascript/pim/ui/stat.js"></script>
	<script src="view/javascript/pim/ui/places.js"></script>

	<!-- elfinder commands -->
	<script src="view/javascript/pim/commands/back.js"></script>
	<script src="view/javascript/pim/commands/forward.js"></script>
	<script src="view/javascript/pim/commands/reload.js"></script>
	<script src="view/javascript/pim/commands/up.js"></script>
	<script src="view/javascript/pim/commands/home.js"></script>
	<script src="view/javascript/pim/commands/copy.js"></script>
	<script src="view/javascript/pim/commands/cut.js"></script>
	<script src="view/javascript/pim/commands/paste.js"></script>
	<script src="view/javascript/pim/commands/open.js"></script>
	<script src="view/javascript/pim/commands/rm.js"></script>
	<script src="view/javascript/pim/commands/info.js"></script>
	<script src="view/javascript/pim/commands/duplicate.js"></script>
	<script src="view/javascript/pim/commands/rename.js"></script>
	<script src="view/javascript/pim/commands/help.js"></script>
	<script src="view/javascript/pim/commands/getfile.js"></script>
	<script src="view/javascript/pim/commands/mkdir.js"></script>
	<script src="view/javascript/pim/commands/mkfile.js"></script>
	<script src="view/javascript/pim/commands/upload.js"></script>
	<script src="view/javascript/pim/commands/download.js"></script>
	<script src="view/javascript/pim/commands/edit.js"></script>
	<script src="view/javascript/pim/commands/quicklook.js"></script>
	<script src="view/javascript/pim/commands/quicklook.plugins.js"></script>
	<script src="view/javascript/pim/commands/extract.js"></script>
	<script src="view/javascript/pim/commands/archive.js"></script>
	<script src="view/javascript/pim/commands/search.js"></script>
	<script src="view/javascript/pim/commands/view.js"></script>
	<script src="view/javascript/pim/commands/resize.js"></script>
	<script src="view/javascript/pim/commands/sort.js"></script>	
	<script src="view/javascript/pim/commands/netmount.js"></script>	
	<script src="view/javascript/pim/commands/multiupload.js"></script>	

	<!-- elfinder dialog -->
	<script src="view/javascript/pim/jquery.dialogelfinder.js"></script>

	<!-- elfinder 1.x connector API support -->
	<script src="view/javascript/pim/proxy/elFinderSupportVer1.js"></script>



<?php if ($this->config->get('pim_joomla')) {?>
    <link rel="stylesheet" type="text/css" media="screen" href="/opencart/admin/view/stylesheet/pim.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/opencart/admin/view/stylesheet/pim_theme.css">

<?php } else {?>
  <link rel="stylesheet" type="text/css" media="screen" href="view/stylesheet/pim.css">
  <link rel="stylesheet" type="text/css" media="screen" href="view/stylesheet/pim_theme.css">
<?php } ?>

<?php if ($lang) { ?>
<script type="text/javascript" src="view/javascript/pim/i18n/<?php echo $lang;?>.js"></script>  
<?php } ?>
</head>
<body>
<div id="container">

</div>
<script type="text/javascript" charset="utf-8">
	$().ready(function() {


	  elFinder.prototype._options.commands.push('multiupload');
    elFinder.prototype._options.contextmenu.files.push('multiupload');
    elFinder.prototype.i18.en.messages['cmdmultiupload'] = 'Add selected to product';
		
		var elf = $('#container').elfinder({
			url : 'index.php?route=common/filemanager/connector&token=<?php echo $token; ?>',  // connector URL (REQUIRED)
			lang : '<?php echo $lang;?>', /* Setup your language here! */
			container: '<?php echo $field;?>',
			dirimage: '<?php echo HTTP_CATALOG."image/";?>', 
			height: '<?php echo ($this->config->get('pim_height')-65);?>',
			defaultView: 'list',
      uiOptions : {toolbar : [['home', 'back', 'forward'],['reload'],['mkdir', 'upload'],['open', 'download', 'getfile'],['info'],['quicklook'],['copy', 'cut', 'paste'],['rm'],['duplicate', 'rename', 'edit', 'resize'],['extract', 'archive','multiupload'],['search'],['view'],['help']]},		
      contextmenu: {navbar: ["open", "|", "copy", "cut", "paste", "duplicate", "|", "rm", "|", "info"],cwd: ["reload", "back", "|", "upload", "mkdir", "mkfile", "paste", "|", "sort", "|", "info"],files: ["getfile", "|", "open", "quicklook", "|", "download", "|", "copy", "cut", "paste", "duplicate", "|", "rm", "|", "edit", "rename", "resize", "|", "archive","multiupload", "extract", "|", "info"]},
      
			getFileCallback: function (f) {
    		<?php if ($fckeditor) { ?>
    		window.opener.CKEDITOR.tools.callFunction(<?php echo $fckeditor; ?>, f.url);        		
    		self.close();	
    		<?php } else { ?>  
    		    a = f.url;
            b = a.replace('<?php echo HTTP_CATALOG."image/";?>','');		

             <?php if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {?>
          			b = a.replace('<?php echo HTTPS_CATALOG."image/";?>','');		
          		<?php } else { ?>
          			b = a.replace('<?php echo HTTP_CATALOG."image/";?>','');		
          		<?php } ?>  


            b = replaceAll(b, '%20', ' ');
        		parent.$('#<?php echo $field; ?>').attr('value', b);
        		parent.$('#dialog').dialog('close');
        		
        		parent.$('#dialog').remove();	
        		<?php } ?>			   
        }
		}).elfinder('instance');
	});
	

	
function replaceAll(txt, replace, with_this) {
  return txt.replace(new RegExp(replace, 'g'),with_this);
}		
</script>
</body>
</html>