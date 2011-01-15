<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<title><?=#$sitename_for_layout?> | <?=#$title_for_layout?></title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="Title" content="<?=#$sitename_for_layout?>" />
<meta name="Author" content="Pulsem" />
<meta name="Generator" content="daetherius" />
<meta name="Language" content="Spanish" /> 
<meta name="Robots" content="Index" />
<?=$_styles?> 
</head>
<body class="<?=#$this->params['controller']?>">
	<div id="nofooter">
		<div id="header">
			<a id="logo" href="/" title="<?=#$sitename_for_layout?>"></a>
			<div id="menu"><?=#$this->element('menu')?></div>
		</div>
		<div id="body"><?=$content?></div>
		<div id="cleaner"></div>
	</div><!-- end: #page -->
	<?
	echo
		#$this->element('footer'),
		#$html->script(array('moo124','moo124m','utils','pulsembox')),
		$_scripts
		#$moo->writeBuffer(array('onDomReady'=>false))
		//,$this->element('gfont',array('fonts'=>array('Cantarell','Droid+Serif')));
		;
	?>
</body>
</html>