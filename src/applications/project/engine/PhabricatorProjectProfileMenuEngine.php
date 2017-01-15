<?php

final class PhabricatorProjectProfileMenuEngine
  extends PhabricatorProfileMenuEngine {

  protected function isMenuEngineConfigurable() {
    return true;
  }

  protected function getItemURI($path) {
    $project = $this->getProfileObject();
    $id = $project->getID();
    return "/project/{$id}/item/{$path}";
  }

  protected function getBuiltinProfileItems($object) {
    $items = array();

    $items[] = $this->newItem()
      ->setBuiltinKey(PhabricatorProject::ITEM_PROFILE)
      ->setMenuItemKey(PhabricatorProjectDetailsProfileMenuItem::MENUITEMKEY);

    $items[] = $this->newItem()
      ->setBuiltinKey(PhabricatorProject::ITEM_POINTS)
      ->setMenuItemKey(PhabricatorProjectPointsProfileMenuItem::MENUITEMKEY);

    $items[] = $this->newItem()
      ->setBuiltinKey(PhabricatorProject::ITEM_WORKBOARD)
      ->setMenuItemKey(PhabricatorProjectWorkboardProfileMenuItem::MENUITEMKEY);

    $items[] = $this->newItem()
      ->setBuiltinKey(PhabricatorProject::ITEM_MEMBERS)
      ->setMenuItemKey(PhabricatorProjectMembersProfileMenuItem::MENUITEMKEY);

    $items[] = $this->newItem()
      ->setBuiltinKey(PhabricatorProject::ITEM_SUBPROJECTS)
      ->setMenuItemKey(
        PhabricatorProjectSubprojectsProfileMenuItem::MENUITEMKEY);

    if (class_exists('PhabricatorMilestoneNavProfileMenuItem')) {
      $panels[] = $this->newItem()
        ->setBuiltinKey(PhabricatorMilestoneNavProfileMenuItem::PANELKEY)
        ->setPanelKey(PhabricatorMilestoneNavProfileMenuItem::PANELKEY);
    }


    $items[] = $this->newItem()
      ->setBuiltinKey(PhabricatorProject::ITEM_MANAGE)
      ->setMenuItemKey(PhabricatorProjectManageProfileMenuItem::MENUITEMKEY);

    return $items;
  }

}
