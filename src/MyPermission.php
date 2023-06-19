<?php

namespace Drupal\shrey_exercise;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\node\Entity\NodeType;

/**
 * Module permissions.
 */
class MyPermission {

  use StringTranslationTrait;

  /**
   * Returns an array of permissions.
   *
   * @return array
   *   The permissions.
   *
   * @see \Drupal\user\PermissionHandlerInterface::getPermissions()
   */
  public function nodePermissions() {
    $perms = [];
    // Generate node permissions for all node types.
    foreach (NodeType::loadMultiple() as $type) {
      $type_id = $type->id();
      $type_params = ['%type' => $type->label()];
      $perms += [
        "clone $type_id content" => [
          'title' => $this->t('%type: controllerpermission', $type_params),
        ],
      ];
    }
    return $perms;
  }

}