<?php

final class MailingListWarningCustomField extends DifferentialCustomField {

  public function getFieldKey() {
    return 'mycompany:mycustomfield';
  }

  public function shouldAppearInPropertyView() {
    // This is required or the field won't be loaded on the detail page.
    return true;
  }

  public function renderPropertyViewValue(array $handles) {
    // This prevents it from actually rendering a property.
    return null;
  }

  public function getWarningsForRevisionHeader(array $handles) {
    $revision = $this->getObject();

    $ccs = PhabricatorSubscribersQuery::loadSubscribersForPHID(
      $revision->getPHID());

    $warnings = array();
    if (!in_array("PHID-MLST-a6vnqd2cxar4rzcamkbv", $ccs) &&
        !in_array("PHID-MLST-u552v27ov5ow7holklm7", $ccs) &&
        !in_array("PHID-MLST-fhgnri4oimm3q3n65w27", $ccs)) {
      $warnings[] = pht(
        "Always subscribe llvm-commits, cfe-commits or lldb-commits! " .
        "Please create a new revision, adding one of the lists.");
    }

    return $warnings;
  }

}
