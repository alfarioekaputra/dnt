<?php
// auto-generated by sfViewConfigHandler
// date: 2012/11/26 08:49:22
$response = $this->context->getResponse();


  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());



  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', 'Pidum Denda Non Tilang', false, false);

  $response->addStylesheet('dnt/dnt.css', '', array ());
  $response->addStylesheet('dnt/bootstrap.css', '', array ());
  $response->addStylesheet('dnt/ui-lightness/jquery-ui-1.8.24.custom.css', '', array ());
  $response->addStylesheet('dnt/DT_bootstrap.css', '', array ());
  $response->addJavascript('dnt/jquery.js', '', array ());
  $response->addJavascript('dnt/bootstrap.js', '', array ());
  $response->addJavascript('global/jquery.dataTables.js', '', array ());
  $response->addJavascript('global/jquery-ui.js', '', array ());


