<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
	 <div class="container">
		 <div class="row">
			  <div class="span9">
				<div class="header"></div>
			  </div>
		 </div>
		 <br />
		 <div class="row">
			<div class="span3">
			  <div class="well sidebar-nav">
				<ul class="nav nav-list">
				  <li class="nav-header">Hasil Dinas</li>
				  <li>
					<a href="<?php echo url_for('dntpidum/index') ?>">Denda Non Tilang Pidum</a>
				  </li>
				  <li>
					<a href="#">Denda Non Tilang Pidsus</a>
					<ul>
					  <li><a href="#">Lelang Barang Rampasan</a></li>
					</ul>
				  </li>
				  <li>
					<a href="<?php echo url_for('dntdatun/index') ?>">Denda Non Tilang Datun</a>
				  </li>
				</ul>
			  </div>
			</div>
			<div class="span9">
			  <div class="well"><?php echo $sf_content ?></div>
			</div>
		 </div>
	 </div>
  </body>
</html>
