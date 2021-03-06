<?php

abstract class PhabricatorSearchResultEngineExtension extends Phobject {

  private $viewer;

  final public function getExtensionKey() {
    return $this->getPhobjectClassConstant('EXTENSIONKEY');
  }

  final public function setViewer($viewer) {
    $this->viewer = $viewer;
    return $this;
  }

  final public function getViewer() {
    return $this->viewer;
  }

  abstract public function isExtensionEnabled();

  abstract public function getExtensionName();

    public function getExtensionOrder() {
    return 5000;
  }

  public function willRenderItemView(array $objects) {
    return null;
  }

  abstract public function renderItemView(
    PhabricatorFulltextResultSet $result_set,
    PHUIObjectItemView $item,
    $phid);

  final public static function getAllExtensions() {
    return id(new PhutilClassMapQuery())
      ->setAncestorClass(__CLASS__)
      ->setUniqueMethod('getExtensionKey')
      ->setSortMethod('getExtensionOrder')
      ->execute();
  }

  /**
   * @return PhabricatorSearchResultEngineExtension[]
   */
  final public static function getAllEnabledExtensions() {
    $extensions = self::getAllExtensions();

    foreach ($extensions as $key => $extension) {
      if (!$extension->isExtensionEnabled()) {
        unset($extensions[$key]);
      }
    }

    return $extensions;
  }


}
