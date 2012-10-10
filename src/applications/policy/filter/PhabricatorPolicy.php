<?php

/*
 * Copyright 2012 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

final class PhabricatorPolicy {

  private $phid;
  private $name;
  private $type;
  private $href;


  public function setType($type) {
    $this->type = $type;
    return $this;
  }

  public function getType() {
    return $this->type;
  }

  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  public function getName() {
    return $this->name;
  }

  public function setPHID($phid) {
    $this->phid = $phid;
    return $this;
  }

  public function getPHID() {
    return $this->phid;
  }

  public function setHref($href) {
    $this->href = $href;
    return $this;
  }

  public function getHref() {
    return $this->href;
  }

  public function getSortKey() {
    return sprintf(
      '%02d%s',
      PhabricatorPolicyType::getPolicyTypeOrder($this->getType()),
      $this->getSortName());
  }

  private function getSortName() {
    if ($this->getType() == PhabricatorPolicyType::TYPE_GLOBAL) {
      static $map = array(
        PhabricatorPolicies::POLICY_PUBLIC  => 0,
        PhabricatorPolicies::POLICY_USER    => 1,
        PhabricatorPolicies::POLICY_ADMIN   => 2,
        PhabricatorPolicies::POLICY_NOONE   => 3,
      );
      return idx($map, $this->getPHID());
    }
    return $this->getName();
  }

  public function getFullName() {
    switch ($this->getType()) {
      case PhabricatorPolicyType::TYPE_PROJECT:
        return pht('Project: %s', $this->getName());
      case PhabricatorPolicyType::TYPE_MASKED:
        return pht('Other: %s', $this->getName());
      default:
        return $this->getName();
    }
  }

  public function renderDescription() {
    if ($this->getHref()) {
      $desc = phutil_render_tag(
        'a',
        array(
          'href' => $this->getHref(),
        ),
        phutil_escape_html($this->getName()));
    } else {
      $desc = phutil_escape_html($this->getName());
    }

    switch ($this->getType()) {
      case PhabricatorPolicyType::TYPE_PROJECT:
        return pht('%s (Project)', $desc);
      case PhabricatorPolicyType::TYPE_MASKED:
        return pht(
          '%s (You do not have permission to view policy details.)',
          $desc);
      default:
        return $desc;
    }
  }


}
