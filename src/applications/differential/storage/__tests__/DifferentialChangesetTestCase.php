<?php

final class DifferentialChangeSetTestCase extends PhabricatorTestCase {
  private function createComment() {
    $comment = new DifferentialInlineComment();
    return $comment;
  }
  // $line: 1 based
  // $length: 0 based (0 meaning 1 line)
  private function createNewComment($line, $length) {
    $comment = $this->createComment();
    $comment->setIsNewFile(True);
    $comment->setLineNumber($line);
    $comment->setLineLength($length);
    return $comment;
  }
  // $line: 1 based
  // $length: 0 based (0 meaning 1 line)
  private function createOldComment($line, $length) {
    $comment = $this->createComment();
    $comment->setIsNewFile(True);
    $comment->setLineNumber($line);
    $comment->setLineLength($length);
    return $comment;
  }
  private function createChange($hunks) {
    $change = new DifferentialChangeset();
    $change->setHunks($hunks);
  }
  public function testFail() {
    $change = $this->createChange(array(
      0 => $this->createHunk(1, 1, 0, 0, "-a"),
    ));
    $comment = $this->createNewComment(1, 0); 

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

