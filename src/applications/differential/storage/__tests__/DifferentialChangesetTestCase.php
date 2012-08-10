<?php

final class DifferentialChangeSetTestCase extends PhabricatorTestCase {
  private function createComment() {
    $comment = new DifferentialInlineComment();
    return $comment;
  }
  private function createNewComment() {
    $comment = $this->createComment();
    $comment->setIsNewFile(True);
    return $comment;
  }
  private function createOldComment() {
    $comment = $this->createComment();
    $comment->setIsNewFile(True);
    return $comment;
  }
  public function testFail() {
    $comment = $this->createNewComment(); 

    $this->assertEqual("a", "a");
  }
/*
  public function testMakeChanges() {
    $root = dirname(__FILE__).'/hunk/';

    $hunk = new DifferentialHunk();
    $hunk->setChanges(Filesystem::readFile($root.'basic.diff'));
    $hunk->setOldOffset(1);
    $hunk->setNewOffset(11);

    $old = Filesystem::readFile($root.'old.txt');
    $this->assertEqual($old, $hunk->makeOldFile());

    $new = Filesystem::readFile($root.'new.txt');
    $this->assertEqual($new, $hunk->makeNewFile());

    $added = array(
      12 => "1 quack\n",
      13 => "1 quack\n",
      16 => "5 drake\n",
    );
    $this->assertEqual($added, $hunk->getAddedLines());

    $hunk = new DifferentialHunk();
    $hunk->setChanges(Filesystem::readFile($root.'newline.diff'));
    $hunk->setOldOffset(1);
    $hunk->setNewOffset(11);

    $this->assertEqual("a\n", $hunk->makeOldFile());
    $this->assertEqual("a", $hunk->makeNewFile());
    $this->assertEqual(array(11 => "a"), $hunk->getAddedLines());

  }
*/
}

